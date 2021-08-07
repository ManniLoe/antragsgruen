<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\db\User;
use app\models\db\Vote;
use app\models\db\VotingBlock;
use app\models\proposedProcedure\Factory;
use yii\web\Response;

class VotingController extends Base
{
    // *** Shared methods ***

    private function getError(string $message): string
    {
        return json_encode([
            'success' => false,
            'message' => $message,
        ]);
    }

    // *** Admin-facing methods ***

    private function getVotingBlockAndCheckPermission(string $votingBlockId): VotingBlock
    {
        \Yii::$app->response->format = Response::FORMAT_RAW;
        \Yii::$app->response->headers->add('Content-Type', 'application/json');

        $user = User::getCurrentUser();
        if (!$user || !$user->hasPrivilege($this->consultation, User::PRIVILEGE_VOTINGS)) {
            $this->returnRestResponse(403, $this->getError('Missing privileges'));
            die();
        }

        $block = $this->consultation->getVotingBlock(intval($votingBlockId));
        if (!$block) {
            $this->returnRestResponse(404, $this->getError('Voting block not found'));
            die();
        }

        return $block;
    }

    private function getAllVotingAdminData(): string
    {
        $apiData = [];
        foreach (Factory::getAllVotingBlocks($this->consultation) as $votingBlock) {
            /** @noinspection PhpUnhandledExceptionInspection */
            $apiData[] = $votingBlock->getAdminApiObject();
        }

        return json_encode($apiData);
    }

    public function actionGetAdminVotingBlocks()
    {
        $this->handleRestHeaders(['GET'], true);

        \Yii::$app->response->format = Response::FORMAT_RAW;
        \Yii::$app->response->headers->add('Content-Type', 'application/json');

        $user = User::getCurrentUser();
        if (!$user || !$user->hasPrivilege($this->consultation, User::PRIVILEGE_VOTINGS)) {
            $this->returnRestResponse(403, $this->getError('Missing privileges'));
            die();
        }

        $responseJson = $this->getAllVotingAdminData();

        return $this->returnRestResponse(200, $responseJson);
    }

    public function actionPostVoteSettings(string $votingBlockId)
    {
        $this->handleRestHeaders(['POST'], true);

        \Yii::$app->response->format = Response::FORMAT_RAW;
        \Yii::$app->response->headers->add('Content-Type', 'application/json');

        $votingBlock = $this->getVotingBlockAndCheckPermission($votingBlockId);

        if (in_array($votingBlock->votingStatus, [VotingBlock::STATUS_OFFLINE, VotingBlock::STATUS_PREPARING])) {
            foreach (\Yii::$app->request->post('organizations', []) as $organization) {
                $users = ($organization['members_present'] !== '' ? intval($organization['members_present']) : null);
                $votingBlock->setUserPresentByOrganization($organization['id'], $users);
            }
            $votingBlock->save();
        }
        if (\Yii::$app->request->post('status') !== null) {
            $newStatus = intval(\Yii::$app->request->post('status'));
            if ($newStatus === VotingBlock::STATUS_PREPARING) {
                $votingBlock->switchToOnlineVoting();
            } elseif ($newStatus === VotingBlock::STATUS_OPEN) {
                $votingBlock->openVoting();

                foreach ($this->consultation->votingBlocks as $otherVotingBlock) {
                    if ($otherVotingBlock->votingStatus === VotingBlock::STATUS_OPEN && $votingBlock->id !== $otherVotingBlock->id) {
                        $otherVotingBlock->closeVoting();
                    }
                }
            } elseif ($newStatus === VotingBlock::STATUS_CLOSED) {
                $votingBlock->closeVoting();
            } elseif ($newStatus === VotingBlock::STATUS_OFFLINE) {
                $votingBlock->switchToOfflineVoting();
            }
        }

        $responseJson = $this->getAllVotingAdminData();
        return $this->returnRestResponse(200, $responseJson);
    }

    // *** User-facing methods ***

    private function getOpenVotingsUserData(): string
    {
        $user = User::getCurrentUser();
        $votingData = [];
        foreach (Factory::getOpenVotingBlocks($this->consultation) as $voting) {
            $votingData[] = $voting->getUserApiObject($user);
        }

        return json_encode($votingData);
    }

    public function actionGetOpenVotingBlocks()
    {
        $this->handleRestHeaders(['GET'], true);

        \Yii::$app->response->format = Response::FORMAT_RAW;
        \Yii::$app->response->headers->add('Content-Type', 'application/json');

        $responseJson = $this->getOpenVotingsUserData();

        return $this->returnRestResponse(200, $responseJson);
    }

    /**
     * votes[0][itemType]=amendment
     * votes[0][itemType]=amendment
     * votes[0][vote]=yes
     */
    public function actionPostVote($votingBlockId)
    {
        $this->handleRestHeaders(['POST'], true);

        $votingBlock = $this->consultation->getVotingBlock(intval($votingBlockId));
        if (!$votingBlock) {
            return $this->getError('Voting not found');
        }
        if ($votingBlock->votingStatus !== VotingBlock::STATUS_OPEN) {
            return $this->getError('Voting not open');
        }
        $user = User::getCurrentUser();
        if (!$user) {
            return $this->getError('Not logged in');
        }

        $votesToSave = [];
        foreach (\Yii::$app->request->post('votes', []) as $voteData) {
            if (!in_array($voteData['itemType'], ['motion', 'amendment'])) {
                return $this->getError('Invalid vote');
            }
            $itemId = intval($voteData['itemId']);

            $exitingVote = $votingBlock->getUserVote($user, $voteData['itemType'], $itemId);

            if ($exitingVote) {
                if ($voteData['vote'] === 'undo') {
                    $exitingVote->delete();
                    continue;
                } else {
                    return $this->getError('Already voted');
                }
            }

            if (!$votingBlock->userIsAllowedToVoteFor($user, $voteData['itemType'], $itemId)) {
                return $this->getError('Not possible to vote for this item');
            }

            $vote = new Vote();
            $vote->userId = $user->id;
            $vote->votingBlockId = $votingBlock->id;
            $vote->setVoteFromApi($voteData['vote']);
            if ($vote->vote === null) {
                return $this->getError('Invalid vote');
            }
            if ($voteData['itemType'] === 'motion') {
                $vote->motionId = $itemId;
                $vote->amendmentId = null;
            }
            if ($voteData['itemType'] === 'amendment') {
                $vote->motionId = null;
                $vote->amendmentId = $itemId;
            }
            if (isset($voteData['public']) && $voteData['public'] && $votingBlock->votesPublic) {
                $vote->public = 1;
            } else {
                $vote->public = 0;
            }
            $vote->dateVote = date('Y-m-d H:i:s');

            $votesToSave[] = $vote;
        }

        foreach ($votesToSave as $vote) {
            $vote->save();
        }

        $responseJson = $this->getOpenVotingsUserData();

        return $this->returnRestResponse(200, $responseJson);
    }

}