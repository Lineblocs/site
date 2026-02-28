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
        $channel->queue_declare('payment_receipts', false, true, false, false);

        $this->info(" [*] Event Consumer Online. Waiting for messages...");

        // 2. Register Consumers pointing to class methods
        $channel->basic_qos(null, 1, null);
        
        // Use an array syntax [$this, 'methodName'] for the callback
        $channel->basic_consume('payment_failures', '', false, false, false, false, [$this, 'handlePaymentFailure']);
        $channel->basic_consume('subscription_updates', '', false, false, false, false, [$this, 'handleSubscriptionUpdate']);
        $channel->basic_consume('payment_receipts', '', false, false, false, false, [$this, 'handlePaymentReceipt']);

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
}