<?php
namespace App\Helpers;
use \Config;
use \DateTime;
use DB;
use Log;
use NumberFormatter;
use App\Helpers\MainHelper;
use App\Helpers\WorkspaceHelper;
use App\Helpers\StripeBillingHelper;

use App\CustomizationsKVStore;
use App\ApiCredentialKVStore;
use App\Settings;
use App\UserCredit;
use App\UserDebit;
use App\UserInvoice;
use App\WorkspaceUser;
use App\Enums\PaymentStatus;
use App\Enums\InvoiceSource;

final class BillingDataHelper {
  // update this to support multiple billing gateways in the future
  public static function updateWorkspaceBilling($gateway, $cardData, $user, $workspace)
  {
    switch ( $gateway ) {
      case "stripe":
        $card = MainHelper::addCard($cardData, $user, $workspace, TRUE, $gateway);
        return TRUE;
      break;
    }

    return FALSE;
  }
  public static function getBillingHistory($user) {
      $data = DB::select(sprintf('select * from (select status, cents, created_at, \'credit\' as type, user_id from users_credits  union  select status, cents, created_at, \'invoice\' as type, user_id from users_invoices order by created_at desc) as U where U.user_id = "%s";', $user->id));      $data = DB::select(sprintf('select * from (select status, cents, created_at, \'credit\' as type, user_id from users_credits  union  select status, cents, created_at, \'invoice\' as type, user_id from users_invoices order by created_at desc) as U where U.user_id = "%s";', $user->id));
      $data = array_map(function($item) {
        $array = (array) $item;
        $array['dollars'] = self::toDollars($array['cents']);
        return $array; 
      }, $data);
      return $data;
  }

  public static function getWorkspaceInvoices($workspace) {
      $data = UserInvoice::where('workspace_id', '=', $workspace->id)->get()->toArray();
      $data = array_map(function($item) {
        $array = (array) $item;
        $array['dollars'] = self::toDollars($array['cents']);
        return $array; 
      }, $data);
      return $data;
  }


  public static function billingData($user, $startDate=NULL, $endDate=NULL) {
    if (!is_null($startDate)) {
      Log::info(sprintf('billing data lookup between data ranges %s and %s', $startDate, $endDate));
      $query = sprintf('select * from (select status, cents, created_at, \'credit\' as type, user_id from users_credits  union  select status, cents, created_at, \'invoice\' as type, user_id from users_invoices order by created_at desc) as U 
      where U.user_id = "%s"
      and (DATE(U.created_at) BETWEEN \'%s\' AND \'%s\')
      ;', $user->id, $startDate, $endDate);
    } else {
      $query = sprintf('select * from (select status, cents, created_at, \'credit\' as type, user_id from users_credits  union  select status, cents, created_at, \'invoice\' as type, user_id from users_invoices order by created_at desc) as U 
      where U.user_id = "%s"
      ;', $user->id);
    }
    $data  = DB::select($query);
    foreach ($data as $key => $item) {
      $item->dollars = self::toDollars($item->cents);
      $data[ $key] = $item;
    }

    return $data;
  }
  public static function getBillingInfo($user, $plan=NULL, $subscription=NULL, $workspace=NULL) {
      $remainingBalance = 0;
      $chargesThisMonth = 0;
      $accountBalance = 0;
      $estimatedBalance = 0;
      $membershipFees = 0;
      $amountOwed = 0;
      $planCost = 0;
      $credits = UserCredit::where('user_id', '=',$user->id)->where('status', 'APPROVED')->get();
      $debits = UserDebit::where('user_id', '=',$user->id)->get();
      $invoices = UserInvoice::where('user_id', '=',$user->id)->get();
      if (!empty($workspace) && !$plan->pay_as_you_go) {
          $userCount = WorkspaceUser::where('workspace_id', $workspace->id)
              ->count();
          $planCost = $plan->monthly_cost_cents;
          if ($subscription->period=='ANNUAL') {
            $planCost = $plan->annual_cost_cents;
          }

          $membershipFees = $userCount * $planCost;
      }

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
          if ($invoice->status != PaymentStatus::PAID) {
            $accountBalance += $invoice->cents;
          }
          if ($invoice->source == InvoiceSource::CREDITS) {
            $remainingBalance -= $invoice->cents;
          }
      }
      //$estimatedBalance = $chargesThisMonth + $accountBalance;
      $estimatedBalance = $chargesThisMonth + $accountBalance + $membershipFees;
      $locale = 'en_US';
      $nf = new NumberFormatter($locale, NumberFormatter::ORDINAL);
      $month = $monthNext->format('M');
      $date = $monthNext->format('d');
      $date = $nf->format($date);
      $nextInvoiceDue =$month . ' ' . $date;
      $month = $monthStart->format('M');
      $date = $monthStart->format('d');
      $date = $nf->format($date);
      $userInvoiceDue =$month . ' ' . $date;

      $info =[
          'chargesThisMonthCents' => $chargesThisMonth,
          'chargesThisMonth' => MainHelper::toDollars($chargesThisMonth),
          'remainingBalanceCents' => $remainingBalance,
          'remainingBalance' => MainHelper::toDollars($remainingBalance),
          'accountBalanceCents' => $accountBalance,
          'accountBalance' => MainHelper::toDollars($accountBalance),
          'estimatedBalanceCents' => $estimatedBalance,
          'estimatedBalance' => MainHelper::toDollars($estimatedBalance),
          'membershipFeesCents' => $membershipFees,
          'membershipFees' => MainHelper::toDollars($membershipFees),
          'nextInvoiceDue' => $nextInvoiceDue,
          'thisInvoiceDue' => $userInvoiceDue,
          'trialMode' => $user->trial_mode,
          'settings' => [
            'auto_recharge' => $user->auto_recharge,
            'auto_recharge_top_up' => $user->auto_recharge_top_up,
            'auto_recharge_top_up_dollars' => MainHelper::toDollars($user->auto_recharge_top_up),
            'invoices_by_email' => $user->invoices_by_email,
            'billing_package' => $user->billing_package
          ],
          'limits' => WorkspaceHelper::getLimits($user)

      ];
      return $info;


  }


  public static function toDollars($cents) {
    if (!is_numeric($cents)) {
        return $cents;
    }
    return number_format(($cents /100), 2, '.', ' ');
  }
  public static function toCents($dollars) {
    if (!is_numeric($dollars)) {
        return $dollars;
    }
    $cents = \bcmul($dollars, 100);
    return  $cents;
  }

  public static function calculateProratedAmount($baseCost, $billingCycle, $returnCents = FALSE)
  {
    if (!is_numeric($baseCost)) {
        return $baseCost;
    }
    $baseCost = (float) $baseCost;

    $now = new \DateTime();
    
    if ($billingCycle === 'ANNUAL') {
        // Calculate days left in the current year
        $isLeapYear = (int) $now->format('L');
        if ($isLeapYear) {
            $daysInYear = 366;
        } else {
            $daysInYear = 365;
        }
        $dayOfYear = (int) $now->format('z') + 1; // 1-indexed day of year
        $daysRemaining = $daysInYear - $dayOfYear + 1;
        
        // (Yearly Price / Days in Year) * Days left
        $prorated = ($baseCost / $daysInYear) * $daysRemaining;
        $result = (float) round($prorated, 2);
        if ($returnCents) {
            return self::toCents($result);
        } else {
            return $result;
        }
    }

    // Default: MONTHLY
    $daysInMonth = (int) $now->format('t');
    $dayOfMonth = (int) $now->format('j');
    $daysRemaining = $daysInMonth - $dayOfMonth + 1;

    // (Monthly Price / Days in Month) * Days left
    $prorated = ($baseCost / $daysInMonth) * $daysRemaining;
    $result = (float) round($prorated, 2);
    
    if ($returnCents) {
        return self::toCents($result);
    } else {
        return $result;
    }
  }
  public static function refundInvoice($invoice)
  {
    $customizations = CustomizationsKVStore::getRecord();
    if ($customizations) {
      $paymentGateway = $customizations->payment_gateway;
    } else {
      $paymentGateway = null;
    }

    if ($paymentGateway === 'stripe') {
      try {
        $stripeBillingHelper = new StripeBillingHelper();
        $stripeBillingHelper->refundInvoice($invoice->payment_gateway_id);
        return true;
      } catch (\Exception $e) {
        Log::error('Stripe refund failed: ' . $e->getMessage());
        throw $e;
      }
    } elseif ($paymentGateway === 'braintree') {
      // Braintree refund implementation
      throw new \Exception('API support not implemented.');
    } else {
      throw new \Exception('payment gateway code unimplemented');
    }

    $invoice->status = 'REFUNDED';
    $invoice->save();
  }
}
