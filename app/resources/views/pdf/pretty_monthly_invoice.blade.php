<?php

use \App\Helpers\MainHelper;

$brandPrimary = '#0a1247';
$brandBlue = '#3f51b5';
$brandSlate = '#395373';
$brandMuted = '#64748b';
$brandBorder = '#e5e7eb';
$brandBg = '#f6f8fb';
$brandGreen = '#16a34a';
$brandAmber = '#d97706';
$statusText = 'Balance Due';
$statusColor = $brandAmber;
$paymentStatus = 'Pending';
if ($paidInvoice) {
  $statusText = 'Paid';
  $statusColor = $brandGreen;
  $paymentStatus = 'Paid';
}
$logo = \App\Helpers\MainHelper::appLogo();
if (strpos($logo, '/') === 0 && file_exists(public_path(ltrim($logo, '/')))) {
  $logo = public_path(ltrim($logo, '/'));
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style>
    @page {
      margin: 46px 42px 58px;
    }

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: Roboto, DejaVu Sans, Arial, Helvetica, sans-serif;
      font-size: 12px;
      line-height: 1.45;
      color: #1f2937;
      background: #ffffff;
    }

    h1,
    h2,
    h3,
    p {
      margin: 0;
    }

    .page-break {
      page-break-after: always;
    }

    .muted {
      color: <?php echo $brandMuted; ?>;
    }

    .right {
      text-align: right;
    }

    .center {
      text-align: center;
    }

    .brand-rule {
      height: 4px;
      background: <?php echo $brandBlue; ?>;
      font-size: 1px;
      line-height: 1px;
    }

    .header-table {
      width: 100%;
      margin-bottom: 24px;
    }

    .header-logo-cell {
      width: 50%;
    }

    .header-meta-cell {
      width: 50%;
      text-align: right;
    }

    .logo {
      width: 176px;
      max-height: 64px;
    }

    .invoice-title {
      font-size: 30px;
      line-height: 36px;
      font-weight: 700;
      color: <?php echo $brandPrimary; ?>;
      letter-spacing: 0;
    }

    .statement-label {
      margin-top: 4px;
      font-size: 12px;
      color: <?php echo $brandMuted; ?>;
      text-transform: uppercase;
    }

    .status-pill {
      padding: 6px 12px;
      border-radius: 16px;
      background: #fff7ed;
      color: <?php echo $statusColor; ?>;
      font-size: 12px;
      font-weight: 700;
      text-transform: uppercase;
    }

    .status-wrap {
      width: 100%;
      margin-top: 12px;
      text-align: right;
    }

    .summary {
      width: 100%;
      margin: 18px 0 22px;
      border-collapse: separate;
      border-spacing: 0;
    }

    .summary td {
      width: 33.333%;
      padding: 16px 18px;
      border-top: 1px solid <?php echo $brandBorder; ?>;
      border-bottom: 1px solid <?php echo $brandBorder; ?>;
      background: <?php echo $brandBg; ?>;
      vertical-align: top;
    }

    .summary td:first-child {
      border-left: 1px solid <?php echo $brandBorder; ?>;
    }

    .summary td:last-child {
      border-right: 1px solid <?php echo $brandBorder; ?>;
    }

    .summary .label {
      display: block;
      margin-bottom: 6px;
      font-size: 10px;
      line-height: 14px;
      color: <?php echo $brandMuted; ?>;
      text-transform: uppercase;
      letter-spacing: .6px;
    }

    .summary .value {
      display: block;
      font-size: 18px;
      line-height: 24px;
      font-weight: 700;
      color: <?php echo $brandPrimary; ?>;
    }

    .summary .value.total {
      font-size: 22px;
      color: <?php echo $brandBlue; ?>;
    }

    .two-col {
      width: 100%;
      margin: 20px 0 24px;
    }

    .two-col td {
      width: 50%;
      vertical-align: top;
    }

    .panel {
      border: 1px solid <?php echo $brandBorder; ?>;
      background: #ffffff;
      padding: 16px 18px;
    }

    .panel-title {
      margin-bottom: 10px;
      font-size: 12px;
      line-height: 16px;
      color: <?php echo $brandPrimary; ?>;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: .5px;
    }

    .meta-table {
      width: 100%;
      border-collapse: collapse;
    }

    .meta-table td {
      padding: 4px 0;
      vertical-align: top;
    }

    .meta-table .key {
      width: 42%;
      color: <?php echo $brandMuted; ?>;
    }

    .section-title {
      margin: 24px 0 10px;
      padding-bottom: 8px;
      border-bottom: 2px solid <?php echo $brandBlue; ?>;
      color: <?php echo $brandPrimary; ?>;
      font-size: 16px;
      line-height: 22px;
      font-weight: 700;
    }

    .data-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 16px;
      border: 1px solid <?php echo $brandBorder; ?>;
    }

    .data-table th {
      padding: 11px 12px;
      background: <?php echo $brandSlate; ?>;
      color: #ffffff;
      font-size: 11px;
      line-height: 15px;
      font-weight: 700;
      text-align: left;
      text-transform: uppercase;
      letter-spacing: .35px;
    }

    .data-table td {
      padding: 12px;
      border-bottom: 1px solid <?php echo $brandBorder; ?>;
      font-size: 12px;
      line-height: 18px;
      vertical-align: top;
    }

    .data-table tr:nth-child(odd) td {
      background: #fbfcfe;
    }

    .data-table .subtotal td,
    .data-table .total-row td {
      background: <?php echo $brandBg; ?>;
      font-weight: 700;
      color: <?php echo $brandPrimary; ?>;
    }

    .payment-summary {
      width: 100%;
      border-collapse: collapse;
      margin-top: 2px;
    }

    .payment-summary td {
      vertical-align: top;
    }

    .payment-note-cell {
      width: 50%;
      padding-right: 22px;
    }

    .payment-totals-cell {
      width: 50%;
    }

    .totals {
      width: 100%;
      border-collapse: collapse;
      border: 1px solid <?php echo $brandBorder; ?>;
    }

    .totals td {
      padding: 10px 12px;
      border-bottom: 1px solid <?php echo $brandBorder; ?>;
    }

    .totals .grand td {
      background: <?php echo $brandBlue; ?>;
      color: #ffffff;
      font-size: 15px;
      font-weight: 700;
    }

    .note-box {
      padding: 14px 16px;
      background: <?php echo $brandBg; ?>;
      border-left: 4px solid <?php echo $brandBlue; ?>;
      color: #374151;
    }

    .footer {
      position: fixed;
      left: 42px;
      right: 42px;
      bottom: -34px;
      color: <?php echo $brandMuted; ?>;
      font-size: 10px;
      border-top: 1px solid <?php echo $brandBorder; ?>;
      padding-top: 8px;
    }
  </style>
  <script type="text/php">
    if ( isset($pdf) ) {
          $y = $pdf->get_height() - 28;
          $x = $pdf->get_width() - 108;
          $pdf->page_text($x, $y, "Page {PAGE_NUM} of {PAGE_COUNT}", '', 8, array(100,116,139));
      }
  </script>
</head>

<body>
  <div class="footer">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>{{$site}} invoice</td>
        <td class="right">{{$vars['invoice_no']}}</td>
      </tr>
    </table>
  </div>

  <table class="header-table" width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td class="header-logo-cell" valign="top">
        <img src="{{$logo}}" alt="{{$site}}" class="logo" />
      </td>
      <td class="header-meta-cell" valign="top" align="right">
        <div class="invoice-title">Invoice</div>
        <div class="statement-label">{{$site}} monthly statement</div>
        <div class="status-wrap">
          <span class="status-pill">{{$statusText}}</span>
        </div>
      </td>
    </tr>
  </table>
  <div class="brand-rule">&nbsp;</div>

  <table class="summary" width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td>
        <span class="label">Invoice Number</span>
        <span class="value">{{$vars['invoice_no']}}</span>
      </td>
      <td>
        <span class="label">Due Date</span>

        <span class="value">
          @if ($vars['due_date'])
            {{ $vars['due_date']->format('Y-m-d') }}
          @else
            N/A
          @endif
        </span>
      </td>
      <td align="right">
        <span class="label">Total Due</span>
        <span class="value total">{{MainHelper::toDollars($vars['invoice_amount'])}}</span>
      </td>
    </tr>
  </table>

  <table class="two-col" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td style="padding-right: 10px;">
        <div class="panel">
          <div class="panel-title">Bill To</div>
          <strong>{!! $vars['account_name'] !!}</strong><br>
          {!! $vars['attn'][0] !!}<br>
          {!! $vars['attn'][1] !!}<br>
          {!! $vars['attn'][2] !!}<br>
          {!! $vars['attn'][3] !!}
        </div>
      </td>
      <td style="padding-left: 10px;">
        <div class="panel">
          <div class="panel-title">Invoice Details</div>
          <table class="meta-table" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td class="key">Account No</td>
              <td>{{$vars['account_no']}}</td>
            </tr>
            <tr>
              <td class="key">Statement Date</td>
              <td>
                @if ($vars['statement_date'])
                  {{ $vars['statement_date']->format('Y-m-d') }}
                @else
                  N/A
                @endif
              </td>
            </tr>
            <tr>
              <td class="key">Tax Number</td>
              <td>{{$vars['tax_number']}}</td>
            </tr>
            <tr>
              <td class="key">Payment Method</td>
              <td>{{$vars['payment_method']}}</td>
            </tr>
          </table>
        </div>
      </td>
    </tr>
  </table>

  <div class="section-title">Balance Summary</div>
  <table class="data-table" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <th>Account Balance</th>
      <th>Payment</th>
      <th class="right">Amount</th>
    </tr>
    <tr>
      <td>Outstanding balance on 
        @if ($vars['due_date'])
          {{ $vars['due_date']->format('Y-m-d') }}
        @else
          N/A
        @endif
      </td>
      <td>{{$paymentStatus}}</td>
      <td class="right">{{MainHelper::toDollars($vars['invoice_amount'])}}</td>
    </tr>
    @if ($paidInvoice)
    <tr>
      <td>Payment received {{$vars['payment_recvd_date']}}</td>
      <td>Received</td>
      <td class="right">{{MainHelper::toDollars($vars['invoice_amount'])}}</td>
    </tr>
    @endif
  </table>

  <table class="payment-summary" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td class="payment-note-cell">
        <div class="note-box">
          You can pay and review this invoice in the {{\App\Helpers\MainHelper::getSiteName()}} user portal. All amounts are billed in {{$customizations->default_currency}}.
        </div>
      </td>
      <td class="payment-totals-cell">
        <table class="totals" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>Total excluding tax</td>
            <td class="right">{{MainHelper::toDollars($vars['invoice_amount_no_tax'])}}</td>
          </tr>
          @if (!empty($vars['tax_name']) && !empty($vars['tax_percentage']))
            <tr>
              <td>{{$vars['tax_name']}} {{$vars['tax_percentage']}}</td>
              <td class="right">{{MainHelper::toDollars($vars['tax_amount'])}}</td>
            </tr>
          @endif
          <tr class="grand">
            <td>Total payment due</td>
            <td class="right">{{MainHelper::toDollars($vars['invoice_amount'])}}</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>

  <div class="page-break"></div>

  <table class="header-table" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td class="header-logo-cell" valign="top">
        <img src="{{$logo}}" alt="{{$site}}" class="logo" />
      </td>
      <td class="header-meta-cell" valign="top">
        <div class="invoice-title">Charges</div>
        <div class="statement-label">{{$vars['invoice_month']}} {{$vars['invoice_year']}} Invoice {{$vars['invoice_no']}}</div>
      </td>
    </tr>
  </table>
  <div class="brand-rule">&nbsp;</div>

  <div class="section-title">Description of Charges</div>
  <table class="data-table" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <th>Description</th>
      <th>Month</th>
      <th class="right">Price</th>
      <th class="right">Tax</th>
      <th class="right">Total</th>
    </tr>
    <tr>
      <td>{{$vars['invoice_desc']}}</td>
      <td>{{$vars['invoice_month']}}</td>
      <td class="right">{{MainHelper::toDollars($vars['invoice_amount_no_tax'])}}</td>
      <td class="right">{{MainHelper::toDollars($vars['tax_amount'])}}</td>
      <td class="right">{{MainHelper::toDollars($vars['invoice_amount'])}}</td>
    </tr>
  </table>

  <div class="section-title">Recurring Charges</div>
  <table class="data-table" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <th>Item Description</th>
      <th>Date</th>
      <th class="right">Price</th>
      <th class="right">Tax Amount</th>
      <th class="right">Total</th>
    </tr>
    @forelse ($vars['invoice_items']['recurring_rows'] as $item)
    <tr>
      <td>{{$item['item_desc']}}</td>
      <td>
        @if ($item['date'])
          {{ $item['date']->format('Y-m-d') }}
        @else
          N/A
        @endif
      </td>
      <td class="right">{{MainHelper::toDollars($item['total_amount_without_tax'])}}</td>
      <td class="right">{{MainHelper::toDollars($item['tax_amount'])}}</td>
      <td class="right">{{MainHelper::toDollars($item['total_amount'])}}</td>
    </tr>
    @empty
    <tr>
      <td colspan="5" class="center muted">No recurring charges for this invoice.</td>
    </tr>
    @endforelse
    <tr class="subtotal">
      <td>&nbsp;</td>
      <td>Subtotal</td>
      <td class="right">{{MainHelper::toDollars($vars['invoice_items']['subtotal_price'])}}</td>
      <td class="right">{{MainHelper::toDollars($vars['invoice_items']['subtotal_tax'])}}</td>
      <td class="right">{{MainHelper::toDollars($vars['invoice_items']['subtotal_total'])}}</td>
    </tr>
  </table>

  <div class="section-title">Usage And Toll Charges</div>
  <table class="data-table" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <th>Item Description</th>
      <th>Date</th>
      <th class="right">Price</th>
      <th class="right">Tax Amount</th>
      <th class="right">Total</th>
    </tr>
    @forelse ($vars['invoice_items']['fixed_rate_rows'] as $item)
    <tr>
      <td>{{$item['item_desc']}}</td>
      <td>
        @if ($item['date'])
          {{ $item['date']->format('Y-m-d') }}
        @else
          N/A
        @endif
      </td>
      <td class="right">{{MainHelper::toDollars($item['total_amount_without_tax'])}}</td>
      <td class="right">{{MainHelper::toDollars($item['tax_amount'])}}</td>
      <td class="right">{{MainHelper::toDollars($item['total_amount'])}}</td>
    </tr>
    @empty
    <tr>
      <td colspan="5" class="center muted">No usage charges for this invoice.</td>
    </tr>
    @endforelse
    <tr class="subtotal">
      <td>&nbsp;</td>
      <td>Subtotal</td>
      <td class="right">{{MainHelper::toDollars($vars['invoice_items']['subtotal_price'])}}</td>
      <td class="right">{{MainHelper::toDollars($vars['invoice_items']['subtotal_tax'])}}</td>
      <td class="right">{{MainHelper::toDollars($vars['invoice_items']['subtotal_total'])}}</td>
    </tr>
    <tr class="total-row">
      <td>&nbsp;</td>
      <td>Total Charges</td>
      <td class="right">{{MainHelper::toDollars($vars['invoice_items']['price'])}}</td>
      <td class="right">{{MainHelper::toDollars($vars['invoice_items']['tax'])}}</td>
      <td class="right">{{MainHelper::toDollars($vars['invoice_items']['total'])}}</td>
    </tr>
  </table>

  <div class="page-break"></div>

  <table class="header-table" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td class="header-logo-cell" valign="top">
        <img src="{{$logo}}" alt="{{$site}}" class="logo" />
      </td>
      <td class="header-meta-cell" valign="top">
        <div class="invoice-title">Payment</div>
        <div class="statement-label">Methods and notices</div>
      </td>
    </tr>
  </table>
  <div class="brand-rule">&nbsp;</div>

  <div class="section-title">Payment Method</div>
  <div class="panel">
    Your payment method is <strong>{{$vars['payment_method']}}</strong>. You can update your payment method in the {{$site}} user portal.
  </div>

  <div class="section-title">Invoice Notices</div>
  <table class="data-table" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <th>Notice</th>
      <th>Description</th>
    </tr>
    <tr>
      <td><strong>Account adjustments/refunds</strong></td>
      <td>Any adjustments or refunds will appear on your account balance.</td>
    </tr>
    <tr>
      <td><strong>Credits</strong></td>
      <td>Credits are applied before any payable balance is collected.</td>
    </tr>
    <tr>
      <td><strong>Due date</strong></td>
      <td>
        Please pay by
        @if ($vars['due_date'])
          {{ $vars['due_date']->format('Y-m-d') }}
        @else
          N/A
        @endif
        to avoid service disruption.
      </td>
    </tr>
    <tr>
      <td><strong>Recurring charges</strong></td>
      <td>Recurring charges reflect active services for this billing period.</td>
    </tr>
    <tr>
      <td><strong>Total payment due</strong></td>
      <td>{{MainHelper::toDollars($vars['invoice_amount'])}}</td>
    </tr>
  </table>
</body>

</html>
