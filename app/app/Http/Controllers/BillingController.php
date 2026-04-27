<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UsageTrigger;
use App\Subscription;
use App\ServicePlan;
use App\UserCard;
use App\UserInvoice;
use App\Helpers\RabbitMQHelper;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Api\ApiAuthController;
use DB;
use PDF;
use App\Helpers\MainHelper;
use App\Helpers\BillingDataHelper;
use App\Helpers\WorkspaceHelper;
use App\Helpers\InvoiceHelper;
use DateTime;

class BillingController extends ApiAuthController
{

    public function addUsageTrigger(Request $request) {
        $data = $request->json()->all();
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        $trigger = UsageTrigger::create([
          'percentage' => $data['percentage'],
          'user_id' => $user->id,
          'workspace_id' => $workspace->id,
        ]);
        return $this->response->noContent();
    }
    public function delUsageTrigger(Request $request, $triggerId) {
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        $trigger = UsageTrigger::findOrFail($triggerId);
        if (!WorkspaceHelper::canPerformAction($user, $workspace, 'manage_billing')) {
            return $this->response->errorForbidden();
        }
        $trigger->delete();
        return $this->response->noContent();
    }

    public function getBillingInfo(Request $request)
    {
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        $subscription = Subscription::where('workspace_id', $workspace->id)->first();
        $plan = ServicePlan::find($subscription->current_plan_id);
        $billingInfo = BillingDataHelper::getBillingInfo($user, $plan, $subscription, $workspace);
        return $this->response->array([
          'info' => $billingInfo
        ]);
    }

    public function getBillingHistory(Request $request)
    {
      $user = $this->getUser($request);
      $all = $request->all();
      $data = BillingDataHelper::billingData($user, $all['startDate'], $all['endDate']);
      return $this->response->array($data);

    }
    public function downloadBillingHistory(Request $request)
    {
      $site = MainHelper::getSiteName();
      $user = JWTAuth::parseToken('bearer', 'authorization', 'auth')->authenticate();
      $all = $request->all();
      $start = DateTime::createFromFormat("Y-m-d", $all['startDate']);
      $end = DateTime::createFromFormat("Y-m-d",$all['endDate']);

      $data = BillingDataHelper::billingData($user, $all['startDate'], $all['endDate']);
      $dateRange = sprintf("%s - %s", $start->format("Y-m-d"), $end->format("Y-m-d"));
      $pdf = PDF::loadView('pdf.invoice', [
        'rows' => $data, 
        'dateRange' => $dateRange,
        'site' => $site,
      ]);
      $filename = sprintf("%s_billing_history.pdf", $site);
      return $pdf->download($filename);

    }

    public function generateMonthlyInvoice(Request $request) {
      $user = User::all()[0];
      $all = $request->all();
      $month = new DateTime();
      $month->modify('first day of this month');
      $invoice = MainHelper::getMonthlyInvoice($user, $month);
      $pdf = InvoiceHelper::generatePrettyInvoice($user, $workspace, $invoice);
      //$pdf = PDF::loadView('pdf.invoice', ['rows' => $data, 'dateRange' => $dateRange]);
      return $pdf->download('monthly_invoice.pdf');
    }

    public function changeBillingSettings(Request $request)
    {
      $user = $this->getUser($request);
        $update = $request->only(['auto_recharge', 'auto_recharge_top_up', 'invoices_by_email', 'billing_package']);
        $user->update( $update );
        return $this->response->noContent();
    }

    public function viewEstimatedCharges(Request $request)
    {
      $site = MainHelper::getSiteName();
      $user = $this->getUser($request);
      $all = $request->all();
      
      $startDate = $all['startDate'] ?? null;
      $endDate = $all['endDate'] ?? null;
      
      if (!$startDate || !$endDate) {
        $now = new DateTime();
        $startDate = $startDate ?: $now->format('Y-m-01');
        $endDate = $endDate ?: $now->format('Y-m-d');
      }
      
      $data = BillingDataHelper::billingData($user, $startDate, $endDate);

      $dateRange = sprintf("%s - %s", $startDate, $endDate);
      
      $pdf = PDF::loadView('pdf.estimated_charges', [
        'rows' => $data, 
        'dateRange' => $dateRange,
        'site' => $site,
      ]);
      
      $filename = sprintf("%s_estimate_charges.pdf", $site);
      return $pdf->download($filename);
    }

    public function settleInvoice(Request $request, $invoiceId)
    {
      $user = $this->getUser($request);
      $workspace = $this->getWorkspace($request);
      $data = $request->json()->all();
      $invoices = $data['invoices'];
      // TODO: this code should be agnostic to the payment gateway we use but its only
      // currently built for Stripe. We should refactor this in the future to be more flexible
      $card = UserCard::where('stripe_payment_method_id', $data['payment_method_id'])->firstOrFail();

      foreach ($invoices as $invoiceId) {
        $message = [
          'run_id' => 'settle_invoice_' . $invoiceId . '_' . time(),
          'action' => 'SETTLE_INVOICE',
          'invoice_id' => $invoiceId,
          'user_id' => $user->id,
          'workspace_id' => $workspace->id,
          'payment_method_id' => $card->stripe_payment_method_id,
          'card_last_4' => $card->last_4,
          'card_brand' => $card->issuer,
        ];

        RabbitMQHelper::publish('billing_tasks', $message);
      }

      return $this->response->noContent();
    }

    public function settleInvoices(Request $request)
    {
      $user = $this->getUser($request);
      $workspace = $this->getWorkspace($request);
      $data = $request->json()->all();
      $invoices = $data['invoices'];
      // TODO: this code should be agnostic to the payment gateway we use but its only
      // currently built for Stripe. We should refactor this in the future to be more flexible
      $card = UserCard::where('id', $data['card_id'])
                      ->where('workspace_id', $workspace->id)
                      ->firstOrFail();
      $invoicesData = [];
      foreach ($invoices as $invoiceId) {
        $invoicesData[] = UserInvoice::where('id', $invoiceId)
          ->where('workspace_id', $workspace->id)
          ->firstOrFail();
      }

      foreach ($invoicesData as $invoice) {
        $message = [
          'run_id' => 'settle_invoice_' . $invoice['id'] . '_' . time(),
          'action' => 'SETTLE_INVOICE',
          'invoice_id' => $invoice['id'],
          'user_id' => $user->id,
          'workspace_id' => $workspace->id,
          'payment_method_id' => $card->stripe_payment_method_id,
          'card_last_4' => $card->last_4,
          'card_brand' => $card->issuer,
        ];

        RabbitMQHelper::publish('billing_tasks', $message);
      }

      return $this->response->noContent();
    }


    public function getInvoices(Request $request)
    {
      $user = $this->getUser($request);
      $workspace = $this->getWorkspace($request);
      $status = $request->query('status');

      $query = UserInvoice::where('workspace_id', $workspace->id);

      if ($status) {
        $query->where('status', $status);
      }

      $invoices = $query->get()->map(function($item) {
        $item['amount_in_dollars'] = MainHelper::toDollars($item['cents']);
        $item['friendly_created_at'] = \Carbon\Carbon::parse($item['created_at'])->format('M d, Y');
        return $item;
      });

      return $this->response->array(['invoices' => $invoices]);
    }
}
