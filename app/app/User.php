<?php 
namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Helpers\MainHelper;
use App\UserCredit;
use App\UserDebit;
use App\UserInvoice;
use App\Recording;
use App\Workspace;
use DateTime;
use DateInterval;
use NumberFormatter;
use Config;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    protected $guarded  = array();
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    protected $casts = array(
      "auto_recharge" => "boolean",
      "ip_whitelist_disabled" => "boolean",
      "invoices_by_email" => "boolean",
      "admin" => "boolean",
      "free_trial_started" => "date"
    );

    public function getBillingInfo() {
        $remainingBalance = 0;
        $chargesThisMonth = 0;
        $accountBalance = 0;
        $estimatedBalance = 0;
        $amountOwed = 0;
        $credits = UserCredit::where('user_id', '=',$this->id)->where('status', 'approved')->get();
        $debits = UserDebit::where('user_id', '=',$this->id)->get();
        $invoices = UserInvoice::where('user_id', '=',$this->id)->get();
        $now = new DateTime();
        $monthStart = new DateTime('first day of this month');
        $monthLast = new DateTime('last day of this month');
        $monthNext = new DateTime('first day of next month');
        foreach ($credits as $credit) {
            $remainingBalance += $credit->cents;
        }
        foreach ($debits as $debit) {
            if ($debit->created_at >= $monthStart && $debit->created_at <= $monthLast) {
                $chargesThisMonth += $debit->cents;
            }
            $remainingBalance -= $debit->cents;
        }
        foreach ($invoices as $invoice) {
            if ($invoice->status != 'completed') {
              $accountBalance += $invoice->cents;
            }
            if ($invoice->source == 'CREDITS') {
              $remainingBalance -= $invoice->cents;
            }
        }
        $estimatedBalance = $chargesThisMonth + $accountBalance;
        $locale = 'en_US';
        $nf = new NumberFormatter($locale, NumberFormatter::ORDINAL);
        $month = $monthNext->format('M');
        $date = $monthNext->format('d');
        $date = $nf->format($date);
        $nextInvoiceDue =$month . ' ' . $date;
        $month = $monthStart->format('M');
        $date = $monthStart->format('d');
        $date = $nf->format($date);
        $thisInvoiceDue =$month . ' ' . $date;

        $info =[
            'chargesThisMonthCents' => $chargesThisMonth,
            'chargesThisMonth' => MainHelper::toDollars($chargesThisMonth),
            'remainingBalanceCents' => $remainingBalance,
            'remainingBalance' => MainHelper::toDollars($remainingBalance),
            'accountBalanceCents' => $accountBalance,
            'accountBalance' => MainHelper::toDollars($accountBalance),
            'estimatedBalanceCents' => $estimatedBalance,
            'estimatedBalance' => MainHelper::toDollars($estimatedBalance),
            'nextInvoiceDue' => $nextInvoiceDue,
            'thisInvoiceDue' => $thisInvoiceDue,
            'trialMode' => $this->trial_mode,
            'settings' => [
              'auto_recharge' => $this->auto_recharge,
              'auto_recharge_top_up' => $this->auto_recharge_top_up,
              'auto_recharge_top_up_dollars' => MainHelper::toDollars($this->auto_recharge_top_up),
              'invoices_by_email' => $this->invoices_by_email,
              'billing_package' => $this->billing_package
            ],
            'limits' => $this->getLimits()

        ];
        return $info;


    }
    public function getSIPURL() {
      //return sprintf("%s:%s", $this->ip_address, $this->sip_port);
      return sprintf("%s.lineblocs.com", $this->container_name);
    }
    public function canBuyNumber($workspace, $user, $number, $cost) {
      $limit = MainHelper::checkLimit($workspace, $user, "numbers");
      if ($limit) {
        if ($workspace->trial_mode) {
          return array(FALSE, "Trial accounts cannot buy more than 1 number");
        } else {
          return array(FALSE, "Cannot purchase more numbers under this plan");
        }
      }
      $balance = $this->getBillingInfo();
      if ($balance['remainingBalance']<=$cost && $workspace->plan == 'pay-as-you-go') {
        return array(FALSE, "Your remaining balance is below the number's monthly cost");
      }
      return array(TRUE, "");
    }
    public function toArray($allData=FALSE) {
        $array = parent::toArray();
        if (!$allData) {
          return $array;
        }

        $array['free_trial_status'] = $this->checkFreeTrialStatus();
        // data was not fully queried
        //if (!isset($array['reserved_ip'])) {
          //return $array;
        //}
        $recordings = Recording::where('user_id', $this->id)->sum('size');

        $array['recordings_space'] = $recordings;

        $array['recordings_space_mb'] = $recordings / pow(1024,2);
        //$array['pbx_ip'] = sprintf("%s:%s", $array['reserved_ip'], $array['sip_port']);
        $headers = getallheaders();
        if (isset($headers['X-Workspace-ID'])) {
          $id = $headers['X-Workspace-ID'];
          $workspace = Workspace::find($id);
          $domain = sprintf("%s.lineblocs.com", $workspace->name);

          $array['sip_url'] = $domain;
          $array['domain'] = $domain;
        }
        //$array['proxy'] = sprintf("proxy_%s", $array['container_name']);
      return $array;
      }
    public function checkFreeTrialStatus() {
      if ( $this->plan == 'trial') {
          $now = new DateTime();
          $expires =clone $this->free_trial_started;
          $expires->add(new DateInterval('P10D'));
          if ($expires->getTimestamp()<=$now->getTimestamp()) {
            return 'expired';
         }
          return 'pending-expiry';
        }
      return 'not-applicable';
    }

    public function getLimits() {
      $work = \App\Workspace::where('creator_id', $this->id)->first();
      if ( $work ) {
        $limits = Config::get("service_plans")[$work->plan];
        return $limits;
      } else {
        return [
          'call_duration' => 'N/A',
          'recording_space' => 'N/A',
        ];
      }
    }
    public function getName() {
      return sprintf("%s %s", $this->first_name, $this->last_name);
    }

  public static function getAdminRecord() {
    return User::where('admin', '1')->firstOrFail();
  }
}
