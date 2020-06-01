<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use App\User;
use Config;

class FreeTrialEndingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:free-trial-ending';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        //
      $date = new \DateTime();
      printf("Starting cron at %s\r\n", $date->format("Y-m-d H:i:s"));
        $daysCheck = 8;
        $users = User::whereRaw("free_trial_started <= DATE_ADD(NOW(), INTERVAL -$daysCheck DAY)")
                    ->where('free_trial_reminder_sent', '0')
                    ->get();
        $mail = Config::get('mail');
        foreach ($users as $user) {
            $data = [];
            Mail::send('emails.free_trial_expiring', $data, function ($message) use ($user, $mail) {
                $message->to($user->email);
                $message->subject("Lineblocs.com free trial expiring soon");
                $from = $mail['from'];
                $message->from($from['address'], $from['name']);
            });
            $user->update([
                'free_trial_reminder_sent' => TRUE
            ]);
        }

    }
}
