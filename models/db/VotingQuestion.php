<?php

declare(strict_types=1);

namespace app\models\db;

use app\models\settings\AntragsgruenApp;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $title
 * @property int|null $votingStatus
 * @property int|null $votingBlockId
 * @property int $consultationId
 * @property string|null $votingData
 * @property VotingBlock|null $votingBlock
 * @property Vote[] $votes
 */
class VotingQuestion extends ActiveRecord implements IVotingItem
{
    use VotingItemTrait;

    public static function tableName(): string
    {
        return AntragsgruenApp::getInstance()->tablePrefix . 'votingQuestion';
    }

    public function getMyConsultation(): ?Consultation
    {
        $current = Consultation::getCurrent();
        if ($current && $current->getVotingQuestion($this->id)) {
            return $current;
        } else {
            return Consultation::findOne($this->consultationId);
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVotingBlock()
    {
        return $this->hasOne(VotingBlock::class, ['id' => 'votingBlockId'])
            ->andWhere(VotingBlock::tableName() . '.votingStatus != ' . VotingBlock::STATUS_DELETED);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVotes()
    {
        return $this->hasMany(Vote::class, ['questionId' => 'id']);
    }

    public function getAgendaApiBaseObject(): array
    {
        return [
            'type' => 'question',
            'id' => $this->id,
            'prefix' => '',
            'title_with_prefix' => $this->title,
            'url_json' => null,
            'url_html' => null,
            'initiators_html' => null,
            'procedure' => null,
            'item_group_same_vote' => $this->getVotingData()->itemGroupSameVote,
            'item_group_name' => $this->getVotingData()->itemGroupName,
            'voting_status' => $this->votingStatus,
        ];
    }

    public function setVotingResult(int $votingResult): void
    {
        $this->votingStatus = $votingResult;
        if ($votingResult === IMotion::STATUS_ACCEPTED) {
            ConsultationLog::log($this->getMyConsultation(), null, ConsultationLog::VOTING_QUESTION_ACCEPTED, $this->id);
        }
        if ($votingResult === IMotion::STATUS_REJECTED) {
            ConsultationLog::log($this->getMyConsultation(), null, ConsultationLog::VOTING_QUESTION_REJECTED, $this->id);
        }
    }
}
