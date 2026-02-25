<?php

namespace App\Console\Commands; // Changed namespace to match Console directory

use Illuminate\Console\Command; // Changed from App\Commands\Command
use PhpAmqpLib\Connection\AMQPStreamConnection;
use App\Helpers\EmailHelper;
use App\User;
use Log;

class RabbitMQBillingConsumer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'billing:consume-failures';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consume failed payment messages from Go billing service';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
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
        } catch (\Exception $e) {
            $this->error("Could not connect to RabbitMQ: " . $e->getMessage());
            return;
        }

        // Must match the Go service declaration
        $channel->queue_declare('payment_failures', false, true, false, false);

        $this->info(" [*] Waiting for Go billing events. To exit press CTRL+C");

        $callback = function ($msg) {
            $data = json_decode($msg->body, true);
            
            if (!$data || !isset($data['creator_id'])) {
                $this->error("Invalid message payload.");
                return;
            }

            // 1. Fetch the user via Eloquent
            $user = User::find($data['creator_id']);

            if (!$user) {
                $this->error("User #{$data['creator_id']} not found. Acknowledging to clear queue.");
                $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
                return;
            }

            $this->info(" [x] Processing payment failure for: " . $user->email);

            // 2. Use your existing EmailHelper
            $subject = "Action Required: Payment Attempt Failed";
            $template = "billing_failed"; 
            
            $result = EmailHelper::sendEmail($subject, $user->email, $template, [
                'user'            => $user,
                'run_id'          => $data['run_id'],
                'workspace_id'    => $data['workspace_id'],
                'subscription_id' => $data['subscription_id'],
                'reason'          => $data['reason']
            ]);

            if ($result === TRUE) {
                $this->info(" [v] Email sent successfully via Helper.");
                $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
            } else {
                $this->error(" [!] Helper failed to send email. Check Laravel logs.");
            }
        };

        $channel->basic_qos(null, 1, null);
        $channel->basic_consume('payment_failures', '', false, false, false, false, $callback);

        while ($channel->is_consuming()) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }
}