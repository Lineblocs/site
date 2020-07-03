<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\User;
use App\UserInvoice;
use App\UserDebit;
use App\DIDNumber;
use App\Recording;
use App\Fax;
use App\PlanUsagePeriod;
use DateTime;
use Config;

class MonthlyBillCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monthlybill';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create monthly invoices for users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    private function markDebitsAsCompleted($monthStart, $monthLast, $debits) {
      foreach ($debits as $debit) {
            if ($debit->created_at >= $monthStart && $debit->created_at <= $monthLast) {
              $debit->update(['status' => 'completed']);
            }
      }
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
        $stripe = \Config::get("stripe");
        $costs = \Config::get("costs");
        \Stripe\Stripe::setApiKey($stripe['secret_key']);

        //
        //$monthStart = new DateTime('first day of last month');
        //$monthLast = new DateTime('last day of last month');
        $monthStart = new DateTime('first day of this month');
        $monthLast = new DateTime('last day of this month');

        //$users = User::where('admin', '=', '0')->get();
        $users = User::where('admin', '=', '0')->where('email', '=', 'new-user-100@infinitet3ch.com')->get();
        foreach ($users as $user) {

          $workspace = Workspace::where('creator_id', $user->id)->firstOrFail();
          $periods = PlanUsagePeriod::where('workspace_id', $workspace->id)->where('active', '1')->firstOrFail();
          $plan = $plans[ $workspace->plan ];

          //$costs = $this->calculateMonthlyCosts($user);
          $costs = 0;
          $membershipCosts = 0;
          $callTolls = 0;
          $recordingCosts = 0;
          $faxCosts = 0;
          $monthlyNumberRentals =  0;
          $balance = $user->getBillingInfo();
          $plans = Config::get("service_plans");
          $membershipCosts = $plan['per_month'];
          $invoiceDesc=  sprintf("LineBlocs invoice for %s", $balance['thisInvoiceDue']);
          $debits = UserDebit::where('user_id', '=',$user->id)
              ->whereBetween('created_at', [$monthStart->format('Y-m-d H:i:s'), $monthLast->format('Y-m-d H:i:s')])->get();

          echo "user balance info is: ".PHP_EOL;
          echo var_dump($balance);
          echo "invoice desc is: " . $invoiceDesc. PHP_EOL;

          $usedMonthlyMinutes = $plan['minutes_per_month'];
          foreach ($debits as $debit) {
            echo var_dump($debit);
            if ($debit->source=="CALL") {
              $call = Call::find($debit->module_id);
              $duration = $call->getDuration();
              $minutes = $duration / 60;
              $change = $usedMonthlyMinutes - $minutes;
              $percentOfDebit = 1.0;
              //when total goes below 0, only change the amount that went below 0
              if ($usedMonthlyMinutes > 0 && $change < 0) {
                //$change =  -5;
                //$usedMonthlyMinutes =  10;
                $positive = abs($change);

                $set1 = $usedMonthlyMinutes + $positive;
                $percentOfDebit = $set1 / $positive;
                $percentOfDebit = (float)(sprintf(".%d", $percentOfDebit));
                $centsToCharge = $debit->cents * $percentOfDebit;
                $callTolls = $callTolls + $centsToCharge;
              } elseif ($usedMonthlyMinutes <= 0) { 
                $callTolls = $callTolls + $debit->cents;
              } elseif ($usedMonthlyMinutes > 0 && $change >= 0) {
                $callTolls = $callTolls;
              }
              $usedMonthlyMinutes = $usedMonthlyMinutes - $minutes;
            }
            if ($debit->source=="NUMBER_RENTAL") {
              $number = DIDNumber::find($debit->module_id);
              $monthlyNumberRentals += $debit->cents;
            }
          }

          // calculate recording costs for this month
          $recordings = Recording::where('user_id', $user->id)->get();
          $minuteCharge = $costs['recordings']['per_minute'];
          foreach ($recordings as $recording) {
            $cost = ceil($recording->duration / 60) * $minuteCharge;
            $recordingCosts += $cost;
          }

          // TODO add fax costs
          $faxes = Fax::where('user_id', $user->id)->get();
          foreach ($faxes as $fax) {
            $cost =  0;
            $size = $fax->size;
            $faxCosts += $cost;
          }

          echo "call tolls are: " . $callTolls . PHP_EOL;
          echo "recording costs are: " . $recordingCosts . PHP_EOL;
          echo "fax costs are: " . $faxCosts . PHP_EOL;
          echo "monthly number rental costs are: " . $monthlyNumberRentals . PHP_EOL;
          $costs += $callTolls;
          $costs += $recordingCosts;
          $costs += $faxCosts;
          $costs += $monthlyNumberRentals;
          $invoice = UserInvoice::create([
            'cents' => $costs,
            'status' => 'incomplete',
            'user_id' => $user->id
          ]);

          //try to pay the invoice in full
          //1. check if we have enough remaining balance and negate from there first
          //2. try to charge one of the customer cards
          //in the case both fail leave invoice outstanding
          if ($balance['remainingBalanceCents']>=$costs) {
            echo "charging credits " . PHP_EOL;
            $invoice->update([
              'status' => 'completed',
              'source' => 'CREDITS'
            ]);
            $this->markDebitsAsCompleted($monthStart, $monthLast, $debits);
            continue;
          }
          try {
            echo "charging customer card " . PHP_EOL;
            $charge = \Stripe\Charge::create([
                'amount' => $costs,
                'currency' => 'usd',
                'description' => $invoiceDesc,
                'customer' => $user->stripe_id
              ]); 
              echo var_dump($charge); 
              $source = sprintf("%s ending in %s", $charge->source->brand, $charge->source->last4);
             $invoice->update([
              'status' => 'completed',
              'source' => $source
            ]);
            $this->markDebitsAsCompleted($monthStart, $monthLast, $debits);
          } catch (\Exception $ex) {
            echo "stripe payment failed because: " . $ex->getMessage();
          }
      }
    }
}
