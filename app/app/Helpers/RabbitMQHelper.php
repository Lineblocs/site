<?php

namespace App\Helpers;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Exception;
use Log;

class RabbitMQHelper
{
    const INVOICE_QUEUE_MONTHLY = 'monthly_invoices';
    const INVOICE_QUEUE_ANNUAL = 'annual_invoices';

    /**
     * Generic method to publish a message to any RabbitMQ queue.
     *
     * @param string $queue Name of the queue
     * @param array $payload Data to be JSON encoded
     * @return void
     */
    private static function publish(string $queue, array $payload)
    {
        try {
            $connection = new AMQPStreamConnection(
                env('RABBITMQ_HOST', 'localhost'),
                env('RABBITMQ_PORT', 5672),
                env('RABBITMQ_USER', 'guest'),
                env('RABBITMQ_PASSWORD', 'guest')
            );
            $channel = $connection->channel();

            // Declare queue as durable (true) to survive RabbitMQ restarts
            $channel->queue_declare($queue, false, true, false, false);

            $msg = new AMQPMessage(
                json_encode($payload),
                [
                    'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT,
                    'content_type'  => 'application/json'
                ]
            );

            $channel->basic_publish($msg, '', $queue);

            $channel->close();
            $connection->close();
            
            Log::info("RabbitMQ published to {$queue}: " . json_encode($payload));
        } catch (Exception $e) {
            Log::error("RabbitMQ Publish Error on queue {$queue}: " . $e->getMessage());
            // In a production environment, you might want to throw this exception 
            // so the Controller knows the billing task failed to queue.
            throw $e; 
        }
    }

    /**
     * Dispatches the 'immediate' billing task.
     * $amount should be the prorated value calculated via MainHelper.
     */
    public static function dispatchImmediateBilling($workspace, $subscription, $user, $servicePlan, $billingCycle, $amount)
    {
        $payload = [
            'run_id'          => 'signup_' . $user->id . '_' . time(),
            'billing_type'    => $billingCycle, // Already 'MONTHLY' or 'ANNUAL'
            'workspace_id'    => (int) $workspace->id,
            'subscription_id' => (int) $subscription->id,
            'creator_id'      => (int) $user->id,
            'action'          => 'immediate',
            'amount'          => (float) $amount, // e.g. 14.52
            'plan_to_bill'    => (int) $servicePlan->id
        ];

        return self::publish('billing_tasks', $payload);
    }

    public static function dispatchSurveyEmail($email, $surveyTypes = [], $name = '')
    {
        if (!is_array($surveyTypes)) {
            $surveyTypes = [];
        }

        $payload = [
            'email' => (string) $email,
            'name' => (string) $name,
            'survey_type' => $surveyTypes
        ];

        return self::publish('call_quality_surveys', $payload);
    }

    public static function dispatchCallQualitySurveyEmail($email, $workspaceId, $userId, $token, $name = '')
    {
        return self::dispatchSurveyEmail($email, [
            'call_quality' => [
                'workspace_id' => (int) $workspaceId,
                'user_id' => (int) $userId,
                'legacy_token' => (string) $token
            ]
        ], $name);
    }

    public static function dispatchMonthlyInvoiceTask($workspaceIdOrPayload, $triggeredBy = 'manual')
    {
        if (is_array($workspaceIdOrPayload)) {
            $payload = $workspaceIdOrPayload;
        } else {
            $workspaceId = (int) $workspaceIdOrPayload;
            $payload = [
                'run_id' => 'invoice_monthly_' . $workspaceId . '_' . time(),
                'workspace_id' => $workspaceId,
                'period' => 'MONTHLY',
                'triggered_by' => (string) $triggeredBy,
                'queued_at' => date('c')
            ];
        }

        return self::publish(self::INVOICE_QUEUE_MONTHLY, $payload);
    }

    public static function dispatchAnnualInvoiceTask($workspaceIdOrPayload, $triggeredBy = 'manual')
    {
        if (is_array($workspaceIdOrPayload)) {
            $payload = $workspaceIdOrPayload;
        } else {
            $workspaceId = (int) $workspaceIdOrPayload;
            $payload = [
                'run_id' => 'invoice_annual_' . $workspaceId . '_' . time(),
                'workspace_id' => $workspaceId,
                'period' => 'ANNUAL',
                'triggered_by' => (string) $triggeredBy,
                'queued_at' => date('c')
            ];
        }

        return self::publish(self::INVOICE_QUEUE_ANNUAL, $payload);
    }
    
}
