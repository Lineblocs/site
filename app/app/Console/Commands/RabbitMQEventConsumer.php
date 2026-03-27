<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use App\Helpers\EmailHelper;
use App\Helpers\TokenHelper;
use App\User;
use Exception;

class RabbitMQEventConsumer extends Command
{
    protected $signature = 'rabbitmq:consume-events';
    protected $description = 'Unified consumer for RabbitMQ events using class-based handlers';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Main Entry Point
     */
    public function handle()
    {
        try {
            $connection = new AMQPStreamConnection(
                env('RABBITMQ_HOST', 'localhost'),
                env('RABBITMQ_PORT', 5672),
                env('RABBITMQ_USER', 'guest'),
                env('RABBITMQ_PASSWORD', 'guest')
            );
            $channel = $connection->channel();
        } catch (Exception $e) {
            $this->error("Could not connect to RabbitMQ: " . $e->getMessage());
            return;
        }

        // 1. Declare Queues
        $channel->queue_declare('payment_failures', false, true, false, false);
        $channel->queue_declare('subscription_updates', false, true, false, false);
        $channel->queue_declare('payment_receipts', false, true, false, false);
        $channel->queue_declare('call_quality_surveys', false, true, false, false);

        $this->info(" [*] Event Consumer Online. Waiting for messages...");

        // 2. Register Consumers pointing to class methods
        $channel->basic_qos(null, 1, null);
        
        // Use an array syntax [$this, 'methodName'] for the callback
        $channel->basic_consume('payment_failures', '', false, false, false, false, [$this, 'handlePaymentFailure']);
        $channel->basic_consume('subscription_updates', '', false, false, false, false, [$this, 'handleSubscriptionUpdate']);
        $channel->basic_consume('payment_receipts', '', false, false, false, false, [$this, 'handlePaymentReceipt']);
        $channel->basic_consume('call_quality_surveys', '', false, false, false, false, [$this, 'handleSurvey']);

        // 3. Keep the process alive
        while (count($channel->callbacks)) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }

    /**
     * Handler for Payment Failures
     */
    public function handlePaymentFailure($msg)
    {
        $data = json_decode($msg->body, true);
        $this->info(" [BILLING] Received failure for Creator ID: " . $data['creator_id']);

        $user = User::find($data['creator_id']);
        if (!$user) {
            $this->error("User not found. Skipping.");
            $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
            return;
        }

        $result = EmailHelper::sendEmail("Action Required: Payment Failed", $user->email, "billing_failed", [
            'user' => $user,
            'reason' => $data['reason'],
            'workspace_id' => $data['workspace_id']
        ]);

        if ($result === TRUE) {
            $this->info(" [v] Payment failure email sent to " . $user->email);
            $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
        } else {
            $this->error(" [!] Email helper failed for " . $user->email);
        }
    }

    /**
     * Handler for Subscription Updates
     */
    public function handleSubscriptionUpdate($msg)
    {
        $data = json_decode($msg->body, true);
        $this->info(" [SUBSCRIPTION] Received update for ID: " . $data['subscription_id']);

        // Implementation for subscription logic goes here
        
        $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
        $this->info(" [v] Subscription event acknowledged.");
    }

    /**
     * Handler for Payment Receipts
     */
    public function handlePaymentReceipt($msg)
    {
        $data = json_decode($msg->body, true);
        $this->info(" [RECEIPT] Received receipt for Creator ID: " . $data['creator_id']);

        $user = User::find($data['creator_id']);
        if (!$user) {
            $this->error("User not found. Skipping.");
            $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
            return;
        }

        $result = EmailHelper::sendEmail("Payment Receipt", $user->email, "payment_receipt", [
            'user' => $user,
            'run_id' => $data['run_id'],
            'workspace_id' => $data['workspace_id'],
            'subscription_id' => $data['subscription_id'],
            'card_last_4' => $data['card_last_4'],
            'card_brand' => $data['card_brand'],
            'payment_amount' => $data['payment_amount'],
            'timestamp' => $data['timestamp']
        ]);

        if ($result === TRUE) {
            $this->info(" [v] Payment receipt email sent to " . $user->email);
            $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
        } else {
            $this->error(" [!] Email helper failed for " . $user->email);
        }
    }

    public function handleSurvey($msg)
    {
        $data = json_decode($msg->body, true);
        $surveyData = (array_key_exists('data', $data) && is_array($data['data'])) ? $data['data'] : $data;
        $email = array_key_exists('email', $surveyData) ? $surveyData['email'] : '';
        $recipientName = array_key_exists('name', $surveyData) ? $surveyData['name'] : '';
        $surveyTypes = (array_key_exists('survey_type', $surveyData) && is_array($surveyData['survey_type']))
            ? $surveyData['survey_type']
            : [];

        if (empty($surveyTypes)) {
            $surveyTypes = [
                'call_quality' => [
                    'workspace_id' => array_key_exists('workspace_id', $surveyData) ? $surveyData['workspace_id'] : 1,
                    'user_id' => array_key_exists('user_id', $surveyData) ? $surveyData['user_id'] : 1
                ]
            ];
        }

        $this->info(" [SURVEY] Received survey request for email: " . $email);

        $allSucceeded = true;
        foreach ($surveyTypes as $surveyType => $typePayload) {
            if (!is_array($typePayload)) {
                $typePayload = [];
            }

            if ($surveyType === 'call_quality') {
                $status = $this->sendCallQualitySurveyEmail($email, $recipientName, $typePayload);
                if (!$status) {
                    $allSucceeded = false;
                }
                continue;
            }

            $this->error(" [!] Unsupported survey type: " . $surveyType);
            $allSucceeded = false;
        }

        if ($allSucceeded) {
            $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
            $this->info(" [v] Survey message acknowledged.");
        } else {
            $this->error(" [!] Survey processing failed for one or more survey types.");
        }
    }

    private function sendCallQualitySurveyEmail($email, $recipientName, $typePayload)
    {
        $workspaceId = array_key_exists('workspace_id', $typePayload) ? (int) $typePayload['workspace_id'] : 1;
        $userId = array_key_exists('user_id', $typePayload) ? (int) $typePayload['user_id'] : 1;
        $surveyBaseUrl = \App\Helpers\MainHelper::createUrl('survey/callquality');

        $surveyLinks = [];
        for ($rating = 1; $rating <= 5; $rating++) {
            $token = TokenHelper::createSurveyToken('call_quality', [
                'workspace_id' => $workspaceId,
                'user_id' => $userId,
                'email' => (string) $email,
                'rating' => $rating
            ]);

            $surveyLinks[$rating] = $surveyBaseUrl . '?' . http_build_query([
                'workspaceid' => $workspaceId,
                'userId' => $userId,
                'ratings' => $rating,
                'token' => $token,
                'email' => $email
            ]);
        }

        $result = EmailHelper::sendEmail("How was your call quality experience?", $email, "call_quality_survey", [
            'recipient_name' => $recipientName,
            'workspace_id' => $workspaceId,
            'user_id' => $userId,
            'token' => '',
            'survey_links' => $surveyLinks
        ]);

        if ($result === TRUE) {
            $this->info(" [v] Call quality survey email sent to " . $email);
            return true;
        }

        $this->error(" [!] Email helper failed for " . $email);
        return false;
    }
}
