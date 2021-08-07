<?php

namespace app\plugins\european_youth_forum;

use app\models\db\{Consultation, Vote, VotingBlock};
use app\models\settings\Layout;
use app\models\UserOrganization;
use app\plugins\ModuleBase;

class Module extends ModuleBase
{
    public static function getForcedLayoutHooks(Layout $layoutSettings, ?Consultation $consultation): array
    {
        return [
            new LayoutHooks($layoutSettings, $consultation)
        ];
    }

    public static function getUserOrganizations(): array
    {
        return [
            new UserOrganization('nyo', 'NYO'),
            new UserOrganization('ingyo', 'INGYO'),
        ];
    }

    /**
     * @param Vote[] $votes
     */
    public static function calculateVoteResultsForApi(VotingBlock $voting, array $votes): ?array
    {
        $nyoVotes = $voting->getUserPresentByOrganization('nyo');
        $ingyoVotes = $voting->getUserPresentByOrganization('ingyo');

        $results = [
            'nyo' => [
                Vote::VOTE_API_YES => 0,
                'yes_multiplied' => null,
                Vote::VOTE_API_NO => 0,
                'no_multiplied' => null,
                Vote::VOTE_API_ABSTENTION => 0,
                'total' => 0,
                'total_multiplied' => null,
            ],
            'ingyo' => [
                Vote::VOTE_API_YES => 0,
                'yes_multiplied' => null,
                Vote::VOTE_API_NO => 0,
                'no_multiplied' => null,
                Vote::VOTE_API_ABSTENTION => 0,
                'total' => 0,
                'total_multiplied' => null,
            ],
            'total' => [
                Vote::VOTE_API_YES => 0,
                'yes_multiplied' => null,
                Vote::VOTE_API_NO => 0,
                'no_multiplied' => null,
                Vote::VOTE_API_ABSTENTION => 0,
                'total' => 0,
                'total_multiplied' => null,
            ],
        ];
        foreach ($votes as $vote) {
            $voteType = $vote->getVoteForApi();
            if (in_array('nyo', $vote->user->getMyOrganizationIds())) {
                $orga = 'nyo';
            } elseif (in_array('ingyo', $vote->user->getMyOrganizationIds())) {
                $orga = 'ingyo';
            } else {
                continue;
            }
            $results[$orga][$voteType]++;
            $results[$orga]['total']++;
            $results['total'][$voteType]++;
            $results['total']['total']++;
        }

        $results['nyo']['yes_multiplied'] = $results['nyo'][Vote::VOTE_API_YES] * $ingyoVotes;
        $results['nyo']['no_multiplied'] = $results['nyo'][Vote::VOTE_API_NO] * $ingyoVotes;
        $results['nyo']['total_multiplied'] = $results['nyo']['total'] * $ingyoVotes;
        $results['ingyo']['yes_multiplied'] = $results['ingyo'][Vote::VOTE_API_YES] * $nyoVotes;
        $results['ingyo']['no_multiplied'] = $results['ingyo'][Vote::VOTE_API_NO] * $nyoVotes;
        $results['ingyo']['total_multiplied'] = $results['ingyo']['total'] * $nyoVotes;

        $results['total']['yes_multiplied'] = $results['nyo']['yes_multiplied'] + $results['ingyo']['yes_multiplied'];
        $results['total']['no_multiplied'] = $results['nyo']['no_multiplied'] + $results['ingyo']['no_multiplied'];
        $results['total']['total_multiplied'] = $results['nyo']['total_multiplied'] + $results['ingyo']['total_multiplied'];

        return $results;
    }
}