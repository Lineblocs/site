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
      $taxNumber = "123";
      $tax1 = "GST";
      $attn = [
        "10665 Jasper Ave NW",
        "Unit 1412",
        "Edmonton, Alberta",
        "T5K0R7  Canada"
      ];
      $invoiceAmt = "99.99";
      $dueDate = "31 March 2023";
      $paidInvoice = TRUE;
      $paymentRecvdDate = '18 April 2023';
      $invoiceDesc = "$site invoice for April 2023";
      $invoiceMonth = "April";
      $taxAmt = "0.99";
      $invoiceItems = [
        [
          'item_desc' => 'Calls -- Orgination costs',
          'date' => '04/03',
          'total_amount_without_tax' => '9.99',
          'total_amount' => '10.99',
          'tax_amount' => '0.99',
        ]
      ];
      $invoiceItemsPrice = '9.99';
      $invoiceItemsTax = '0.99';
      $invoiceItemsTotal = '19.99';
      $paymentMethod = "Credit card";
      $invoiceVars = [
        'leftFooterText' => '123',
        'paidInvoice' => $paidInvoice,
        'vars' => [
          'account_name' => $accountName,
          'attn' => $attn,
          'account_no' => '',
          'invoice_no' => '',
          'invoice_month' => $invoiceMonth,
          'statement_date' => '',
          'due_date' => $dueDate,
          'invoice_desc' => $invoiceDesc,
          'invoice_amount' => $invoiceAmt,
          'invoice_amount_no_tax' => $invoiceAmt,
          'tax_amount' => $taxAmt,
          'payment_recvd_date' => $paymentRecvdDate,
          'tax_number' => $taxNumber,
          'tax1' => $tax1,
          'payment_method' => $paymentMethod,
          'invoice_items' => [
            'subtotal_price' => $invoiceItemsPrice,
            'subtotal_tax' => $invoiceItemsTax,
            'subtotal_total' => $invoiceItemsTotal,
            'price' => $invoiceItemsPrice,
            'tax' => $invoiceItemsTax,
            'total' => $invoiceItemsTotal,
            'recurring_rows' => $invoiceItems,
            'call_tolls_rows' => $invoiceItems
          ]
        ],
        'rows' => $data,
        'site' => $site
      ];
      $pdfLoaded = \PDF::loadView('pdf.pretty_monthly_invoice', $invoiceVars);
      $mergedValues = array_merge( $invoiceVars, [
        'pdf' => $pdfLoaded
      ] );
      $pdf = PDF::loadView('pdf.pretty_monthly_invoice', $mergedValues);
      return $pdf;
  }
}
