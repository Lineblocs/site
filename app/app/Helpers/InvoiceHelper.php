<?php
namespace App\Helpers;
use \Config;
use \Log;
use \DB;
use \PDF;
use App\Settings;
use App\Customizations;
use App\Helpers\MainHelper;
use App\Helpers\WebSvcHelper;
final class InvoiceHelper {
  public static function generatePrettyInvoice($user, $workspace, $data)
  {
      $site = MainHelper::getSiteName();  
      $accountName = "Test 123";
      $attn = [
        "Test 123",
        "7-11910102 AVE NW",
        "Edmonton, Alberta",
        "T5K0R7  Canada"
      ];

      $invoiceVars = [
        'vars' => [
          'account_name' => $accountName,
          'attn' => $attn,
          'account_no' => '',
          'invoice_no' => '',
          'statement_date' => '',
          'due_date' => '',
        ],
        'rows' => $data,
        'site' => $site
      ];
      $pdf = PDF::loadView('pdf.pretty_monthly_invoice', $invoiceVars);
      return $pdf;
  }
}
