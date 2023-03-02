<?php
namespace App\Http\Controllers;

use App\Helpers\MainHelper;
use App\Helpers\WorkspaceHelper;
use App\Http\Controllers\Api\ApiAuthController;
use App\UsageTrigger;
use DateTime;
use DB;
use Illuminate\Http\Request;
use JWTAuth;
use PDF;

class BillingController extends ApiAuthController
{

    public function addUsageTrigger(Request $request)
    {
        $data = $request->json()->all();
        $user = $this->getUser($request);
        $trigger = UsageTrigger::create([
            'percentage' => $data['percentage'],
            'user_id' => $user->id,
        ]);
        return $this->response->noContent();
    }
    public function delUsageTrigger(Request $request, $triggerId)
    {
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
        $billingInfo = $user->getBillingInfo();
        return $this->response->array([
            'info' => $billingInfo,
        ]);
    }
    private function billingData($user, $request)
    {
        $all = $request->all();
        $start = $all['startDate'];
        $end = $all['endDate'];
        $data = DB::select(sprintf('select * from (select balance, status, cents, created_at, \'credit\' as type, user_id from users_credits  union  select balance, status, cents, created_at, \'invoice\' as type, user_id from users_invoices order by created_at desc) as U
      where U.user_id = "%s"
      and (U.created_at BETWEEN "%s" AND "%s")
      ;', $user->id, $start, $end));
        foreach ($data as $key => $item) {
            $item->balance = MainHelper::toDollars($item->balance);
            $item->dollars = MainHelper::toDollars($item->cents);
            $data[$key] = $item;
        }

        return $data;
    }

    public function getBillingHistory(Request $request)
    {
        $user = $this->getUser($request);
        $all = $request->all();
        $data = $this->billingData($user, $request);
        return $this->response->array($data);

    }
    public function downloadBillingHistory(Request $request)
    {
        $user = JWTAuth::parseToken('bearer', 'authorization', 'auth')->authenticate();
        $all = $request->all();
        $start = DateTime::createFromFormat("Y-m-d H:i:s", $all['startDate']);
        $end = DateTime::createFromFormat("Y-m-d H:i:s", $all['endDate']);

        $data = $this->billingData($user, $request);
        $dateRange = sprintf("%s - %s", $start->format("Y-m-d"), $end->format("Y-m-d"));
        $pdf = PDF::loadView('pdf.invoice', ['rows' => $data, 'dateRange' => $dateRange]);
        return $pdf->download('invoice.pdf');

    }

    public function changeBillingSettings(Request $request)
    {
        $user = $this->getUser($request);
        $update = $request->only(['auto_recharge', 'auto_recharge_top_up', 'invoices_by_email', 'billing_package']);
        $user->update($update);
        return $this->response->noContent();
    }

}
