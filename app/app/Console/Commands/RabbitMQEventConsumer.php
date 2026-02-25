<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use App\Helpers\EmailHelper;
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

        $this->info(" [*] Event Consumer Online. Waiting for messages...");

        // 2. Register Consumers pointing to class methods
        $channel->basic_qos(null, 1, null);
        
        // Use an array syntax [$this, 'methodName'] for the callback
        $channel->basic_consume('payment_failures', '', false, false, false, false, [$this, 'handlePaymentFailure']);
        $channel->basic_consume('subscription_updates', '', false, false, false, false, [$this, 'handleSubscriptionUpdate']);

        // 3. Keep the process alive
        while ($channel->is_consuming()) {
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
        $this->info(" [BILLING] Received failure for Creator ID: " . ($data['creator_id'] ?? 'Unknown'));

        $user = User::find($data['creator_id']);
        if (!$user) {
            $this->error("User not found. Skipping.");
            $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
            return;
        }

        $result = EmailHelper::sendEmail("Action Required: Payment Failed", $user->email, "billing_failed", [
            'user' => $user,
            'reason' => $data['reason'] ?? 'Unknown error',
            'workspace_id' => $data['workspace_id'] ?? 0
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
        $this->info(" [SUBSCRIPTION] Received update for ID: " . ($data['subscription_id'] ?? 'Unknown'));

        // Implementation for subscription logic goes here
        
        $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
        $this->info(" [v] Subscription event acknowledged.");
    }
}