<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DateTime;
use Config;
use Mail;
use App\User;
use App\UsageTrigger;
use App\UsageTriggerResult;
use App\UserCredit;

class SendBackgroundEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send-bg-emails';

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
      $date = new \DateTime();
      printf("Starting cron at %s\r\n", $date->format("Y-m-d H:i:s"));
        //
        // 14 day inactivity email
        $ago = new DateTime('-14 day');
        $reminded = new DateTime('-28 day');
        $users = User::where('last_login', '<=', $ago->format('Y-m-d H:i:s'))->whereNull('last_login_reminded')->get();
        $mail = Config::get('mail');
        foreach ($users as $user) {
              $data = [
                'user' => $user
            ];
            Mail::send('emails.inactive_user', $data, function ($message) use ($user, $mail) {
                $message->to($user->email);
                $message->subject("Your Lineblocs.com account");
                $from = $mail['from'];
                $message->from($from['address'], $from['name']);
            });
            $user->update([
              'last_login_reminded' => new DateTime()
            ]);
        }
        // usage triggers
        $users = User::all();
        foreach ($users as $user) {
            $triggers = UsageTrigger::where('user_id', '=', $user->id)->get();
            $billingInfo = $user->getBillingInfo();
            foreach ($triggers as $trigger) {
                printf("checking trigger percentage %d on user %s", $trigger->percentage, $user->email);
                $credits = UserCredit::where('user_id', '=', $user->id)->get();
                $last = $credits[ count( $credits ) - 1];
                $balance = $last->balance;
                $percentage = (float)(".".$trigger->percentage);
                $amount = $balance * $percentage;
                $count = UsageTriggerResult::where('usage_trigger_id', '=', $trigger->id)->where('credit_id', '=', $last->id)->count();
                //if ($billingInfo['remainingBalance']<=$amount && $count == 0) {
                if ($count == 0) {
                //if (TRUE) {
                    printf("sending out email now\r\n");
                    $data = [
                        'user' => $user,
                        'usage_trigger' => $trigger
                    ];
                    Mail::send('emails.usage_trigger', $data, function ($message) use ($user, $mail) {
                        $message->to($user->email);
                        $message->subject("Lineblocs.com usage trigger");
                        $from = $mail['from'];
                        $message->from($from['address'], $from['name']);
                    });
                    $result = UsageTriggerResult::create([
                        'usage_trigger_id' => $trigger->id,
                        'credit_id' => $credit->id
                    ]);

                }
            }
        }
    }
}
