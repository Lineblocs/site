<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use App\Helpers\EmailHelper;
use App\Helpers\TokenHelper;
use App\Helpers\RabbitMQHelper;
use App\Helpers\WorkspaceInvoiceHelper;
use App\User;
use App\Workspace;
use Exception;
use Log;

class RabbitMQEventConsumer extends Command
{
    const CALL_ACTIVITY_QUEUE = 'call_activity';

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
        $channel->queue_declare(self::CALL_ACTIVITY_QUEUE, false, true, false, false);
        $channel->queue_declare(RabbitMQHelper::INVOICE_QUEUE_MONTHLY, false, true, false, false);
        $channel->queue_declare(RabbitMQHelper::INVOICE_QUEUE_ANNUAL, false, true, false, false);

        $this->info(" [*] Event Consumer Online. Waiting for messages...");

        // 2. Register Consumers pointing to class methods
        $channel->basic_qos(null, 1, null);
        
        // Use an array syntax [$this, 'methodName'] for the callback
        $channel->basic_consume('payment_failures', '', false, false, false, false, [$this, 'handlePaymentFailure']);
        $channel->basic_consume('subscription_updates', '', false, false, false, false, [$this, 'handleSubscriptionUpdate']);
        $channel->basic_consume('payment_receipts', '', false, false, false, false, [$this, 'handlePaymentReceipt']);
        $channel->basic_consume('call_quality_surveys', '', false, false, false, false, [$this, 'handleSurvey']);
        $channel->basic_consume(self::CALL_ACTIVITY_QUEUE, '', false, false, false, false, [$this, 'handleCallActivity']);
        $channel->basic_consume(RabbitMQHelper::INVOICE_QUEUE_MONTHLY, '', false, false, false, false, [$this, 'handleMonthlyInvoiceTask']);
        $channel->basic_consume(RabbitMQHelper::INVOICE_QUEUE_ANNUAL, '', false, false, false, false, [$this, 'handleAnnualInvoiceTask']);

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
        try {
            $data = json_decode($msg->body, true);

            // 1. Validate Root 'data' key
            if (!isset($data['data']) || !is_array($data['data'])) {
                throw new \Exception("Invalid payload: Missing 'data' attribute.");
            }
            $surveyData = $data['data'];

            // 2. Validate Header Attributes
            if (!isset($surveyData['email'])) {
                throw new \Exception("Invalid payload: Missing 'email' attribute.");
            }
            $email = $surveyData['email'];

            if (!isset($surveyData['name'])) {
                throw new \Exception("Invalid payload: Missing 'name' attribute.");
            }
            $recipientName = $surveyData['name'];

            if (!isset($surveyData['survey_type']) || !is_array($surveyData['survey_type'])) {
                throw new \Exception("Invalid payload: Missing or invalid 'survey_type' attribute.");
            }
            $surveyTypes = $surveyData['survey_type'];

            $this->info(" [SURVEY] Received survey request for email: " . $email);

            $allSucceeded = true;

            foreach ($surveyTypes as $surveyType => $typePayload) {
                // Ensure payload for the specific type is an array
                if (!is_array($typePayload)) {
                    throw new \Exception("Invalid payload: survey_type '$surveyType' must have an associated data array.");
                }

                if ($surveyType === 'call_quality') {
                    // 3. Validate specific attributes for call_quality (No Defaults)
                    if (!isset($typePayload['workspace_id'])) {
                        throw new \Exception("Invalid payload: Missing 'workspace_id' for call_quality.");
                    }
                    if (!isset($typePayload['user_id'])) {
                        throw new \Exception("Invalid payload: Missing 'user_id' for call_quality.");
                    }

                    $status = $this->sendCallQualitySurveyEmail($email, $recipientName, $typePayload);
                    
                    if (!$status) {
                        $allSucceeded = false;
                    }
                    continue;
                }

                // Handle unsupported types
                $this->error(" [!] Unsupported survey type: " . $surveyType);
                $allSucceeded = false;
            }

            if ($allSucceeded) {
                $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
                $this->info(" [v] Survey message acknowledged.");
            } else {
                $this->error(" [!] Survey processing failed for one or more survey types.");
            }
        } catch (Exception $e) {
            $this->error(" [SURVEY] " . $e->getMessage());
            $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
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

    public function handleCallActivity($msg)
    {
        $data = json_decode($msg->body, true);

        if (json_last_error() !== JSON_ERROR_NONE || !is_array($data)) {
            $this->logConsumerError(' [CALL_ACTIVITY] Malformed JSON: ' . json_last_error_msg(), [
                'body' => $msg->body
            ]);
            $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
            return;
        }

        if (!isset($data['event_type']) || $data['event_type'] !== 'call_activity') {
            $this->logConsumerError(' [CALL_ACTIVITY] Unsupported event_type: ' . (isset($data['event_type']) ? $data['event_type'] : 'missing'), [
                'payload' => $data
            ]);
            $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
            return;
        }

        $runId = isset($data['run_id']) ? (string) $data['run_id'] : '';
        $workspaceId = isset($data['workspace_id']) ? (string) $data['workspace_id'] : '';
        $userId = isset($data['user_id']) ? (int) $data['user_id'] : 0;
        $description = isset($data['description']) ? (string) $data['description'] : '';

        $this->logConsumerInfo(sprintf(
            ' [CALL_ACTIVITY] Received run_id=%s workspace_id=%s user_id=%d',
            $runId,
            $workspaceId,
            $userId
        ));

        if (!$this->isCallActivityError($data)) {
            $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
            $this->logConsumerInfo(' [v] Call activity processed without alert.', [
                'run_id' => $runId,
                'workspace_id' => $workspaceId,
                'user_id' => $userId
            ]);
            return;
        }

        if ($userId <= 0) {
            $this->logConsumerError(' [CALL_ACTIVITY] Error event missing user_id. Acknowledging without email.', [
                'run_id' => $runId,
                'workspace_id' => $workspaceId,
                'payload' => $data
            ]);
            $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
            return;
        }

        $user = User::find($userId);
        if (!$user) {
            $this->logConsumerError(sprintf(' [CALL_ACTIVITY] User #%d not found. Acknowledging without email.', $userId), [
                'run_id' => $runId,
                'workspace_id' => $workspaceId
            ]);
            $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
            return;
        }

        $result = EmailHelper::sendEmail('Call Activity Error Alert', $user->email, 'call_activity_alert', [
            'user' => $user,
            'run_id' => $runId,
            'workspace_id' => $workspaceId,
            'from' => isset($data['from']) ? $data['from'] : '',
            'to' => isset($data['to']) ? $data['to'] : '',
            'description' => $description
        ]);

        if ($result === TRUE) {
            $this->logConsumerInfo(sprintf(' [v] Call activity error email sent to %s for run_id=%s', $user->email, $runId), [
                'workspace_id' => $workspaceId,
                'user_id' => $userId,
                'description' => $description
            ]);
            $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
            return;
        }

        $this->logConsumerError(sprintf(' [!] Call activity alert email failed for %s: %s', $user->email, $result), [
            'run_id' => $runId,
            'workspace_id' => $workspaceId,
            'user_id' => $userId
        ]);
    }

    private function isCallActivityError($data)
    {
        $description = strtolower(isset($data['description']) ? (string) $data['description'] : '');

        $errorKeywords = [
            'error',
            'failed',
            'failure',
            'rejected',
            'unregistered caller id',
            'voipms'
        ];

        foreach ($errorKeywords as $keyword) {
            if (strpos($description, $keyword) !== false) {
                return true;
            }
        }

        return false;
    }

    private function logConsumerInfo($message, array $context = [])
    {
        $this->info($message);
        Log::info($message, $context);
    }

    private function logConsumerError($message, array $context = [])
    {
        $this->error($message);
        Log::error($message, $context);
    }

    public function handleMonthlyInvoiceTask($msg)
    {
        $this->handleInvoiceTask($msg, 'MONTHLY');
    }

    public function handleAnnualInvoiceTask($msg)
    {
        $this->handleInvoiceTask($msg, 'ANNUAL');
    }

    private function handleInvoiceTask($msg, $period)
    {
        $data = json_decode($msg->body, true);
        $workspaceId = array_key_exists('workspace_id', $data) ? (int) $data['workspace_id'] : 0;
        $this->info(sprintf(" [INVOICE] Received %s task for workspace #%d", $period, $workspaceId));

        $workspace = Workspace::find($workspaceId);
        if (!$workspace) {
            $this->error(sprintf('Workspace #%d not found. Acknowledging and skipping.', $workspaceId));
            $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
            return;
        }

        try {
            $invoiceId = NULL;
            if ($data['invoice_generated']) {
                $invoiceId = $data['invoice_id'];
            }

            $result = WorkspaceInvoiceHelper::sendInvoiceForWorkspace($workspace, $period, NULL, $invoiceId);
            $this->info(sprintf(
                " [v] %s invoice sent to %s for workspace #%d (invoice %s)",
                $period,
                $result['email'],
                $result['workspace_id'],
                $result['invoice_no']
            ));
            $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
        } catch (Exception $e) {
            $this->error(sprintf(' [!] %s invoice failed for workspace #%d: %s', $period, $workspaceId, $e->getMessage()));
        }
    }
}
