<?php
use App\UsageTrigger;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Api\ApiAuthController;
use App\Helpers\MainHelper;
use App\Helpers\WorkspaceHelper;
use App\Helpers\InvoiceHelper;
use App\User;
use App\Workspace;
use App\UserInvoice;
use App\UserInvoiceLineItem;

$user = User::all()[0];
$workspace = Workspace::where('creator_id', $user->id)->first();
$month = new DateTime();
$month->modify('first day of this month');
$end = new DateTime();
$end->modify('last day of this month');
$invoiceSubtotal = 100*100;
$callCosts = 100*20;
$recordingCosts = 100*20;
$membershipCosts = 100*20;
$faxCosts = 100*20;
$numberCosts = 100*20;
$tax = \App\BillingTax::where('name', 'GST')->first();
$taxAmount = InvoiceHelper::calculateTax($invoiceSubtotal, $tax);

$invoiceTotal = $invoiceSubtotal+$taxAmount;
//$invoice = MainHelper::getMonthlyInvoice($user, $month);
$invoice = UserInvoice::create([
    'invoice_no' => "1000-12345",
    'due_date' => $end,
    'status' => 'INCOMPLETE',
    'cents' => $invoiceSubtotal,
    'cents_including_taxes' => $invoiceTotal,
    'cents_taxes' => $taxAmount,
    'tax_metadata' => [],
    'user_id' => $user->id,
    'workspace_id' => $workspace->id,
    'call_costs' => $callCosts,
    'recording_costs' => $recordingCosts,
    'fax_costs' => $faxCosts,
    'membership_costs' =>$membershipCosts,
    'number_costs' =>$numberCosts
]);
UserInvoiceLineItem::create([
    'invoice_id' => $invoice->id,
    'key_name' => 'call_costs',
    'name' => 'Call costs',
    'cents' => $callCosts,
    'is_recurring' => FALSE
]);

UserInvoiceLineItem::create([
    'invoice_id' => $invoice->id,
    'key_name' => 'recording_costs',
    'name' => 'Recording costs',
    'cents' => $recordingCosts,
    'is_recurring' => FALSE
]);

UserInvoiceLineItem::create([
    'invoice_id' => $invoice->id,
    'key_name' => 'fax_costs',
    'name' => 'Fax costs',
    'cents' => $faxCosts,
    'is_recurring' => FALSE
]);

UserInvoiceLineItem::create([
    'invoice_id' => $invoice->id,
    'key_name' => 'membership_costs',
    'name' => 'Membership costs',
    'cents' => $membershipCosts,
    'is_recurring' => TRUE
]);

UserInvoiceLineItem::create([
    'invoice_id' => $invoice->id,
    'key_name' => 'number_costs',
    'name' => 'Number costs',
    'cents' => $numberCosts,
    'is_recurring' => TRUE
]);





echo "billing data".PHP_EOL;
$pdf = InvoiceHelper::generatePrettyInvoice($user, $workspace, $invoice);
//$pdf = PDF::loadView('pdf.invoice', ['rows' => $data, 'dateRange' => $dateRange]);
$pdf->save(public_path('./monthly_invoice.pdf'));
