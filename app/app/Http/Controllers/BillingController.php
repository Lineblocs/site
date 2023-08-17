<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UsageTrigger;
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
        $billingInfo = BillingDataHelper::getBillingInfo($user);
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
      $user = JWTAuth::parseToken('bearer', 'authorization', 'auth')->authenticate();
      $all = $request->all();
      $start = DateTime::createFromFormat("Y-m-d H:i:s", $all['startDate']);
      $end = DateTime::createFromFormat("Y-m-d H:i:s",$all['endDate']);

      $data = MainHelper::billingData($user, $all['startDate'], $all['endDate']);
      $dateRange = sprintf("%s - %s", $start->format("Y-m-d"), $end->format("Y-m-d"));
      $pdf = PDF::loadView('pdf.invoice', ['rows' => $data, 'dateRange' => $dateRange]);
      return $pdf->download('invoice.pdf');

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


}
