<?php
use App\UsageTrigger;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Api\ApiAuthController;
use App\Helpers\MainHelper;
use App\Helpers\WorkspaceHelper;
use App\Helpers\InvoiceHelper;
use App\User;
use App\Workspace;

$user = User::all()[0];
$workspace = Workspace::where('creator_id', $user->id)->first();
$startDate = "2023-04-01 00:00:00";
$endDate = "2023-05-01 00:00:00";
$data = MainHelper::billingData($user, $startDate, $endDate);
echo "billing data".PHP_EOL;
echo var_dump($data);
$pdf = InvoiceHelper::generatePrettyInvoice($user, $workspace, $data);
//$pdf = PDF::loadView('pdf.invoice', ['rows' => $data, 'dateRange' => $dateRange]);
$pdf->save(public_path('./monthly_invoice.pdf'));
