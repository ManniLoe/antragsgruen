<?php

declare(strict_types=1);

namespace app\commands;

use app\components\LiveTools;
use app\models\api\SpeechQueue;
use app\models\db\{Consultation, Site};
use yii\console\Controller;

class LiveController extends Controller
{
    /**
     * Sends a test message to a user
     */
    public function actionSendUserMessage(string $site, string $consultation, int $userId, string $message): void
    {
        $routingKey = 'user.' . $site . '.' . $consultation . '.' . $userId;

        LiveTools::sendToRabbitMq($routingKey, (string)json_encode(['username' => $message]));
    }

    /**
     * Sends a speech queue object to the live server
     */
    public function actionSendSpeechQueue(string $site, string $conPath, int $speechId): void
    {
        $site = Site::findOne(['subdomain' => $site]);
        if (!$site) {
            $this->stderr('Site not found');
            return;
        }
        $consultation = null;
        foreach ($site->consultations as $con) {
            if ($con->urlPath === $conPath) {
                $consultation = $con;
            }
        }
        if (!$consultation) {
            $this->stderr('Consultation not found');
            return;
        }

        $queue = null;
        foreach ($consultation->speechQueues as $speechQueue) {
            if ($speechQueue->id) {
                $queue = $speechQueue;
            }
        }
        if (!$queue) {
            $this->stderr('Speech queue not found');
            return;
        }

        LiveTools::sendSpeechQueue($consultation, SpeechQueue::fromEntity($queue), true);
    }
}
