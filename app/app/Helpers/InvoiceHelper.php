<?php
namespace App\Helpers;
use \Config;
use \Log;
use \DB;
use \PDF;
use \DateTime;
use App\Settings;
use App\Customizations;
use App\BillingTax;
use App\UserInvoiceLineItem;
use App\Helpers\MainHelper;
use App\Helpers\WebSvcHelper;
final class InvoiceHelper {
  public static function placeholderIfEmpty($value, $placeholder="N/A") {
    if ( empty( $value )) {
      return $placeholder;
    }
    return $value;
  }
  public static function calculateTax($amount, $tax) {
    if (!$tax) {
      return 0;
    }
    $percentInDecimal = $tax->tax_percentage / 100;
    return ($percentInDecimal * $amount);
  }
  public static function createLineItemsFromInvoicRecords($lineItems, $tax) {
    $result = [];
    foreach ( $lineItems as $row ) {
      $item = $row->toArray();
      $item['item_desc'] = '';
      if ( $row['key_name'] == 'call_costs' ) {
        $item['item_desc'] = 'Voice calling services';
      } else if ( $row['key_name'] == 'recording_costs' ) {
        $item['item_desc'] = 'Recording storage';

      } else if ( $row['key_name'] == 'number_costs' ) {
        $item['item_desc'] = 'Monthly DID charges';
      } else if ( $row['key_name'] == 'membership_costs' ) {
        $item['item_desc'] = 'Charges for membership';
      }

      $item['date'] = $row->created_at;
      $item['total_amount_without_tax'] = $item['cents'];
      $taxCosts = self::calculateTax( $item['total_amount_without_tax'], $tax );
      $item['tax_amount'] =$taxCosts;
      $item['total_amount'] = $item['total_amount_without_tax'] + $taxCosts;
      $results[] = $item;
    }
    return $results;
  }
  public static function generatePrettyInvoice($user, $workspace, $invoice)
  {
      $site = MainHelper::getSiteName();  
      $invoiceDate = $invoice->created_at;
      //$billingRegionid = $workspace->billing_region_id;
      $billingRegionid = 2;
      $tax = BillingTax::where('region_id', $billingRegionid)
                        ->where('primary_tax', '1')
                        ->first();

      $lineItems = self::createLineItemsFromInvoicRecords(
          UserInvoiceLineItem::where('invoice_id', $invoice->id)->get(),
          $tax
      );
      $recurringLineItems = array_filter( $lineItems, function( $item )  {
        return $item['is_recurring'];
      });
      $fixedLineItems = array_filter( $lineItems, function( $item )  {
        return !$item['is_recurring'];
      });

      $accountName = self::placeholderIfEmpty($user->company_name, "N/A");
      $taxNumber = self::placeholderIfEmpty($user->tax_number);
      if (is_null($tax)) {
        $tax1 = "N/A";
        $taxPercentage = "N/A";
      } else {
        $tax1 = $tax['name'];
        $taxPercentage = sprintf("%d%%", $tax->tax_percentage);
      }
      $addr1 = self::placeholderIfEmpty( $user->address_line_1, "N/A" );
      $addr2 = self::placeholderIfEmpty($user->address_line_2, "&nbsp;" );
      $postalCode = self::placeholderIfEmpty( $user->postal_code, "&nbsp;" );
      $state = self::placeholderIfEmpty( $user->state, "&nbsp;" );
      $city = self::placeholderIfEmpty($user->city, "&nbsp;" );
      $country = self::placeholderIfEmpty( $user->country, "&nbsp;");

      $attn = [
        $addr1,
        $addr2,
        sprintf("%s, %s", $city, $state),
        sprintf("%s %s", $postalCode, $country)
      ];
      $invoiceAmt = $invoice->cents;
      $invoiceAmtInclTaxes = $invoice->cents_including_taxes;
      $invoiceNum = $invoice->invoice_no;
      $dueDate = $invoice->due_date;

      $statementDate = new DateTime();
      $paidInvoice = FALSE;
      $paymentRecvdDate = "N/A";
      if ( $invoice->status == 'COMPLETE' ) {
        $paidInvoice=TRUE;
        $paymentRecvdDate = $invoice->complete_date->format('d M Y');
      }

      $invoiceDesc = sprintf("%s invoice for %s", $site, $invoiceDate->format("M Y"));
      $invoiceMonth = $invoiceDate->format("M");
      $invoiceYear =  $invoiceDate->format("Y");
      $taxAmt = $invoice->cents_taxes;
      $invoiceItems = [
        [
          'item_desc' => 'Calls -- Orgination costs',
          'date' => '04/03',
          'total_amount_without_tax' => '9.99',
          'total_amount' => '10.99',
          'tax_amount' => '0.99',
        ]
      ];
      //$invoiceItemsPrice = '9.99';
      $invoiceItemsPrice = 0;
      $invoiceItemsTax = 0;
      $invoiceItemsTotal = 0;

      foreach ( $lineItems as $item ) {
        $cents = $item['cents'];
        $itemPrice = $cents;
        $itemTax = self::calculateTax($cents, $tax);
        $invoiceItemsPrice += $itemPrice;
        $invoiceItemsTax += $itemTax;
        $invoiceItemsTotal += ($itemPrice + $itemTax);
      }
      $paymentMethod = MainHelper::getPrimaryPaymentMethod($workspace);
      $accountNo = $workspace->account_no;
      $invoiceVars = [
        'leftFooterText' => 'Invoice',
        'paidInvoice' => $paidInvoice,
        'vars' => [
          'account_name' => $accountName,
          'attn' => $attn,
          'account_no' => $accountNo,
          'invoice_no' => $invoiceNum,
          'invoice_month' => $invoiceMonth,
          'invoice_year' => $invoiceYear,
          'statement_date' => $statementDate,
          'due_date' => $dueDate,
          'invoice_desc' => $invoiceDesc,
          'invoice_amount' => $invoiceAmtInclTaxes,
          'invoice_amount_no_tax' => $invoiceAmt,
          'tax_amount' => $taxAmt,
          'tax_name' => $tax1,
          'tax_percentage' => $taxPercentage,
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
            'recurring_rows' => $recurringLineItems,
            'fixed_rate_rows' => $fixedLineItems
          ]
        ],
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
