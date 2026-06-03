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
    const BILLING_EVENTS_EXCHANGE = 'billing.events';
    const WORKSPACE_SUSPENDED_QUEUE = 'workspace_account_suspended';
    const WORKSPACE_SUSPENDED_ROUTING_KEY = 'workspace.account.suspended';

    /**
     * Generic method to publish a message to any RabbitMQ queue.
     *
     * @param string $queue Name of the queue
     * @param array $payload Data to be JSON encoded
     * @return void
     */
    public static function publish(string $queue, array $payload)
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

    public static function publishToExchange($exchange, $routingKey, array $payload, $exchangeType = 'topic')
    {
        try {
            $connection = new AMQPStreamConnection(
                env('RABBITMQ_HOST', 'localhost'),
                env('RABBITMQ_PORT', 5672),
                env('RABBITMQ_USER', 'guest'),
                env('RABBITMQ_PASSWORD', 'guest')
            );
            $channel = $connection->channel();

            $channel->exchange_declare($exchange, $exchangeType, false, true, false);

            $msg = new AMQPMessage(
                json_encode($payload),
                [
                    'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT,
                    'content_type'  => 'application/json'
                ]
            );

            $channel->basic_publish($msg, $exchange, $routingKey);

            $channel->close();
            $connection->close();

            Log::info("RabbitMQ published to {$exchange} with routing key {$routingKey}: " . json_encode($payload));
        } catch (Exception $e) {
            Log::error("RabbitMQ Publish Error on exchange {$exchange}: " . $e->getMessage());
            throw $e;
        }
    }

    public static function dispatchWorkspaceSuspended($workspace, $suspension, $owner = null)
    {
        if (!$owner && $workspace && !empty($workspace->creator_id)) {
            $owner = \App\User::find($workspace->creator_id);
        }

        $suspendedAt = $suspension && $suspension->suspended_at
            ? $suspension->suspended_at->format('Y-m-d H:i:s')
            : date('Y-m-d H:i:s');

        $payload = [
            'event' => 'workspace.suspended',
            'timestamp' => gmdate('c'),
            'data' => [
                'workspace_id' => (int) $workspace->id,
                'owner_email' => $owner ? $owner->email : null,
                'suspended_at' => $suspendedAt,
                'grace_period_extension_days' => $suspension ? $suspension->grace_period_extension : null,
                'reason' => $suspension ? $suspension->reason : 'payment_past_due'
            ]
        ];

        return self::publishToExchange(
            self::BILLING_EVENTS_EXCHANGE,
            self::WORKSPACE_SUSPENDED_ROUTING_KEY,
            $payload
        );
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
            'action'          => 'IMMEDIATE',
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

    public static function dispatchWorkspaceUpgrade($workspaceId, $upgradeFee, $subscriptionId, $currentPlan, $scheduledPlan, $scheduledEffectiveDate)
    {
        $payload = [
            'run_id'                   => 'workspace_upgrade_' . (int) $workspaceId . '_' . time(),
            'workspace_id'             => (int) $workspaceId,
            'subscription_id'          => (int) $subscriptionId,
            'upgrade_fee'              => (int) $upgradeFee,
            'current_plan'             => (int) $currentPlan,
            'scheduled_plan'           => (int) $scheduledPlan,
            'scheduled_effective_date' => (string) $scheduledEffectiveDate,
        ];

        return self::publish('workspace_upgrades', $payload);
    }


}
