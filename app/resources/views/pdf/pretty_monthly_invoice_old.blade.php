<?php
use \App\Helpers\MainHelper;
?>
<body>
  <style>
    table.bordered {
      border: 2px solid black;
    }
    table.invoice_tbl tr.header td {
      border-top: 2px solid black;
      border-bottom: 2px solid black;
    }
    table.invoice_tbl tr.header_alt td {
      border-bottom: 2px solid black;
    }
    table.invoice_tbl {
      border-bottom: 2px solid black;
    }

    table.invoice_tbl tr.bordered td {
      border-top: 2px solid black;
    }
    table.invoice_tbl.five-cols tr td {
      width: 20%;
    }
    table.invoice_tbl.no_borders {
      border-top: none;
      border-bottom: none;
      border-left: none;
      border-right: none;
    }
    table.invoice_tbl.invoice_totals {
      margin-top: 20px;
    }
    .page-break {
      page-break-after: always;
    }
    .invoice_tbl h2 {
      margin: 0;
    }
    .invoice_tbl h1,h2,h3.h4.h5 {
      margin: 0;
    }
    .no_margins {
      margin: 0;
    }
    @page { margin-top: 120px; margin-bottom: 120px}
    header { position: fixed; left: 0px; top: -90px; right: 0px; height: 150px; text-align: center; }
    #footer { position: fixed; left: 0px; bottom: -145px; right: 0px; height: 150px; }
  </style>
  <script type="text/php">
      if ( isset($pdf) ) {
          $y = $pdf->get_height() - 20; 
          $x = $pdf->get_width() - 15 - 50;
          $pdf->page_text($x, $y, "Page No: {PAGE_NUM} of {PAGE_COUNT}", '', 8, array(0,0,0));
      }
  </script> 
<footer style="width: 100%;" id="footer">
  <table width="100%">
    <tr>
      <td style="text-align: left;">
        {{$leftFooterText}}
      </td>
      <td style="text-align: right;">
          <strong style="width: 100%; text-align: right;">{{$site}}</strong>
      </td>
    </tr>
    </table>

</footer> 
  <div class="page1">
    <center>
      <h1>{{$site}} monthly statement</h1>
    </center>
    <table width="100%">
      <tr>
        <td>
          <table width="100%">   
            <tr>
              <td width="33%">
                <strong>Account name: </strong>
              </td>
              <td width="66%">
                {!! $vars['account_name'] !!}
              </td>
            </tr>
            <tr>
              <td width="33%">
                <strong>Attn: </strong>
              </td>
              <td width="66%">
                {!! $vars['attn'][0] !!}
              </td>
            </tr>
            <tr>
              <td width="33%">
                &nbsp;
              </td>
              <td width="66%">
                {!! $vars['attn'][1] !!}
              </td>
            </tr>
            <tr>
              <td width="33%">
                &nbsp;
              </td>
              <td width="66%">
                {!! $vars['attn'][2] !!}
              </td>
            </tr>
            <tr>
              <td width="33%">
                &nbsp;
              </td>
              <td width="66%">
                {!! $vars['attn'][3] !!}
              </td>
            </tr>
          </table>
        </td>
        <td>
          <table>   
            <tr>
              <td>
                <strong>Account No: </strong> {{$vars['account_no']}}</td>
              </td>
            </tr>
            <tr>
              <td>
                <strong>Invoice No: </strong> {{$vars['invoice_no']}}</td>
              </td>
            </tr>
            <tr>
              <td>
                <strong>Statement date: </strong> {{$vars['statement_date']->format('Y-m-d')}}</td>
              </td>
            </tr>
            <tr>
              <td>
            <strong>Due date: </strong> {{$vars['due_date']->format('Y-m-d')}}</td>
              </td>
            </tr>
            <tr>
              <td>
                &nbsp;
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <table width="100%" class="bordered">
      <tr>
        <td><h3 class="no_margins"><strong>Useful Information</strong></h3></tr>
      </tr>
      <tr>
        <td>
          <ul>
            <li>one</li>
            <li>two</li>
            <li>three</li>
          </ul>
        </td>
      </tr>
      </tr>

    </table>
    <table width="100%" class="invoice_tbl">
      <tr class="header">
        <td>Account Balance</td>
        <td>Payment</td>
        <td style="text-align: right;">Amount</td>
    </tr>
      <tr class="data">
        <td>Outstanding balance on {{$vars['due_date']->format('Y-m-d')}}</td>
        <td></td>
        <td style="text-align: right;">{{MainHelper::toDollars($vars['invoice_amount'])}}</td>
      </tr>
      @if ( $paidInvoice )
        <tr class="data">
          <td>Payment received  {{$vars['payment_recvd_date']->format('Y-m-d')}}</td>
          <td></td>
          <td style="text-align: right;">{{MainHelper::toDollars($vars['invoice_amount'])}}</td>
        </tr>
      @endif
    </table>
    <table width="100%">
      <tr>
          <td>{{$vars['invoice_month']}} {{$vars['invoice_year']}} Invoice {{$vars['invoice_no']}}</td>
          <td>&nbsp;</td>
          <td style="text-align: right;">{{MainHelper::toDollars($vars['invoice_amount'])}}</td>
      </tr>
    </table>
    <table width="100%">
      <tr>
          <td width="33%" style="text-align: left;" ><h2>&nbsp;</h2></td>
          <td width="33%" style="text-align: center;" ><h2>Total Payment Due</h2></td>
          <td width="33%" style="text-align: right;"><h2>{{MainHelper::toDollars($vars['invoice_amount'])}}</h2></td>
      </tr>
    </table>
    </div>
    <div class="page-break"></div>
    <div class="page2">
      <center>
        <h1>Invoice</h1>
      </center>
      <table width="100%">
        <tr>
          <td>
            <table width="100%">   
              <tr>
                <td width="33%">
                  <strong>Account name: </strong>
                </td>
                <td width="66%">
                  {!! $vars['account_name'] !!}
                </td>
              </tr>
              <tr>
                <td width="33%">
                  <strong>Attn: </strong>
                </td>
                <td width="66%">
                  {!! $vars['attn'][0] !!}
                </td>
              </tr>
              <tr>
                <td width="33%">
                  &nbsp;
                </td>
                <td width="66%">
                  {!! $vars['attn'][1] !!}
                </td>
              </tr>
              <tr>
                <td width="33%">
                  &nbsp;
                </td>
                <td width="66%">
                  {!! $vars['attn'][2] !!}
                </td>
              </tr>
              <tr>
                <td width="33%">
                  &nbsp;
                </td>
                <td width="66%">
                  {!! $vars['attn'][3] !!}
                </td>
              </tr>
            </table>
          </td>
          <td>
            <table>   
              <tr>
                <td>
                  <strong>Account No: </strong> {{$vars['account_no']}}</td>
                </td>
              </tr>
              <tr>
                <td>
                  <strong>Invoice No: </strong> {{$vars['invoice_no']}}</td>
                </td>
              </tr>
              <tr>
                <td>
                  <strong>Statement date: </strong> {{$vars['statement_date']->format('Y-m-d')}}</td>
                </td>
              </tr>
              <tr>
                <td>
              <strong>Due date: </strong> {{$vars['due_date']->format('Y-m-d')}}</td>
                </td>
              </tr>
              <tr>
                <td>
              <strong>TAX number: </strong> {{$vars['tax_number']}}</td>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <table width="100%" class="invoice_tbl">
        <tr class="header">
          <td>Description of charges</td>
          <td>Month</td>
          <td>Price</td>
          <td>Tax</td>
          <td style="text-align: right;">Total</td>
      </tr>
        <tr class="data">
          <td>{{$vars['invoice_desc']}}</td>
          <td>{{$vars['invoice_month']}}</td>
          <td>{{MainHelper::toDollars($vars['invoice_amount_no_tax'])}}</td>
          <td>{{MainHelper::toDollars($vars['tax_amount'])}}</td>
          <td style="text-align: right;">{{MainHelper::toDollars($vars['invoice_amount'])}}</td>
        </tr>
      </table>
      <table width="100%">
        <tr>
            <td>{{$vars['invoice_month']}} {{$vars['invoice_year']}} Invoice {{$vars['invoice_no']}}</td>
            <td>&nbsp;</td>
            <td style="text-align: right;">{{MainHelper::toDollars($vars['invoice_amount'])}}</td>
        </tr>
      </table>
      <table class="invoice_tbl" width="100%">
        <tr>
            <td width="33%" style="text-align: left;" ><h2>&nbsp;</h2></td>
            <td width="33%" style="text-align: right;" ><h2>Total (exc. tax)</h2></td>
            <td width="33%" style="text-align: right;"><h2>{{MainHelper::toDollars($vars['invoice_amount_no_tax'])}}</h2></td>
        </tr>
        <tr>
            <td width="33%" style="text-align: left;" ><h2>&nbsp;</h2></td>
            <td width="33%" style="text-align: right;" ><h2>{{$vars['tax_name']}} {{$vars['tax_percentage']}}</h2></td>
            <td width="33%" style="text-align: right;"><h2>{{MainHelper::toDollars($vars['tax_amount'])}}</h2></td>
        </tr>
        <tr>
            <td width="33%" style="text-align: left;" ><h2>&nbsp;</h2></td>
            <td width="33%" style="text-align: right;" ><h2>Total (inc. tax) tax</h2></td>
            <td width="33%" style="text-align: right;"><h2>{{MainHelper::toDollars($vars['invoice_amount'])}}</h2></td>
        </tr>
      </table>
    </div>
    <div class="page-break"></div>
    <div class="page2 invoice-details">
      <center>
        <h1>Invoice Details</h1>
      </center>
      <table width="100%">
        <tr>
          <td>
            <table width="100%">   
              <tr>
                <td width="33%">
                  <strong>Account name: </strong>
                </td>
                <td width="66%">
                  {!! $vars['account_name'] !!}
                </td>
              </tr>
              <tr>
                <td width="33%">
                  <strong>Attn: </strong>
                </td>
                <td width="66%">
                  {!! $vars['attn'][0] !!}
                </td>
              </tr>
              <tr>
                <td width="33%">
                  &nbsp;
                </td>
                <td width="66%">
                  {!! $vars['attn'][1] !!}
                </td>
              </tr>
              <tr>
                <td width="33%">
                  &nbsp;
                </td>
                <td width="66%">
                  {!! $vars['attn'][2] !!}
                </td>
              </tr>
              <tr>
                <td width="33%">
                  &nbsp;
                </td>
                <td width="66%">
                  {!! $vars['attn'][3] !!}
                </td>
              </tr>
            </table>
          </td>
          <td>
            <table>   
              <tr>
                <td>
                  <strong>Account No: </strong> {{$vars['account_no']}}</td>
                </td>
              </tr>
              <tr>
                <td>
                  <strong>Invoice No: </strong> {{$vars['invoice_no']}}</td>
                </td>
              </tr>
              <tr>
                <td>
                  <strong>Statement date: </strong> {{$vars['statement_date']->format('Y-m-d')}}</td>
                </td>
              </tr>
              <tr>
                <td>
              <strong>Due date: </strong> {{$vars['due_date']->format('Y-m-d')}}</td>
                </td>
              </tr>
              <tr>
                <td>
              <strong>TAX number: </strong> {{$vars['tax_number']}}</td>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>

      <table width="100%">
        <tr>
          <td><h3>Recurring charges</h3></td>
        </tr>
    </table>

      <table width="100%" class="invoice_tbl five-cols">
        <tr class="header">
          <td>Item Description</td>
          <td>Date</td>
          <td>Price</td>
          <td>Tax Amount</td>
          <td style="text-align: right;">Total (inc. tax)</td>
      </tr>
      @foreach ( $vars['invoice_items']['recurring_rows'] as $item )
        <tr class="data">
          <td>{{$item['item_desc']}}</td>
          <td>{{$item['date']->format('Y-m-d')}}</td>
          <td>{{MainHelper::toDollars($item['total_amount_without_tax'])}}</td>
          <td>{{MainHelper::toDollars($item['tax_amount'])}}</td>
          <td style="text-align: right;">{{MainHelper::toDollars($item['total_amount'])}}</td>
        </tr>

      @endforeach
        <tr class="data bordered">
            <td>&nbsp;</td>
            <td>Subtotal</td>
            <td>{{MainHelper::toDollars($vars['invoice_items']['subtotal_price'])}}</td>
            <td>{{MainHelper::toDollars($vars['invoice_items']['subtotal_tax'])}}</td>
            <td style="text-align: right;">{{MainHelper::toDollars($vars['invoice_items']['subtotal_total'])}}</td>
        </tr>
    </table>

    <table width="100%">
        <tr>
          <td><h3>Call tolls</h3></td>
        </tr>
    </table>

      <table width="100%" class="invoice_tbl five-cols">
        <tr class="header">
          <td>Item Description</td>
          <td>Date</td>
          <td>Price</td>
          <td>Tax Amount</td>
          <td style="text-align: right;">Total (inc. tax)</td>
      </tr>
      @foreach ( $vars['invoice_items']['fixed_rate_rows'] as $item )
        <tr class="data">
          <td>{{$item['item_desc']}}</td>
          <td>{{$item['date']->format('Y-m-d')}}</td>
          <td>{{MainHelper::toDollars($item['total_amount_without_tax'])}}</td>
          <td>{{MainHelper::toDollars($item['tax_amount'])}}</td>
          <td style="text-align: right;">{{MainHelper::toDollars($item['total_amount'])}}</td>
        </tr>

      @endforeach
        <tr class="data bordered">
            <td>&nbsp;</td>
            <td>Subtotal</td>
            <td>{{MainHelper::toDollars($vars['invoice_items']['subtotal_price'])}}</td>
            <td>{{MainHelper::toDollars($vars['invoice_items']['subtotal_tax'])}}</td>
            <td style="text-align: right;">{{MainHelper::toDollars($vars['invoice_items']['subtotal_total'])}}</td>
        </tr>
    </table>
    <table width="100%" class="invoice_tbl five-cols no_borders invoice_totals">
        <tr class="data">
            <td>&nbsp;</td>
            <td>Total charges</td>
            <td>{{MainHelper::toDollars($vars['invoice_items']['price'])}}</td>
            <td>{{MainHelper::toDollars($vars['invoice_items']['tax'])}}</td>
            <td style="text-align: right;">{{MainHelper::toDollars($vars['invoice_items']['total'])}}</td>
        </tr>
      </table>
    </div>

    <div class="page-break"></div>
    <div class="page3 payment-methods">
      <center>
        <h1>Payment Methods</h1>
      </center>
      <table width="100%">
        <tr>
          <td>Your payment method is</td>
          <td>{{$vars['payment_method']}}</td>
        </tr>
      </table>

      <table width="100%" class="bordered">
        <tr>
          <td><strong>You can update your payment method at {{$site}}</strong></tr>
        </tr>
      </tr>
      </table>
      <center>
        <h1>Invoice Notices</h1>
      </center>
      <table width="100%">
        <tr class="header_alt">
          <td width="50%">Notices</td>
          <td width="50%"></td>
        </tr>
        <tr>
          <td width="50%"><strong>Account adjustments/refunds</strong></td>
          <td width="50%"></td>
        </tr>
        <tr>
          <td width="50%"><strong>Account balance</strong></td>
          <td width="50%"></td>
        </tr>
        <tr>
          <td width="50%"><strong>Credits</strong></td>
          <td width="50%"></td>
        </tr>
        <tr>
          <td width="50%"><strong>Due date</strong></td>
          <td width="50%"></td>
        </tr>
        <tr>
          <td width="50%"><strong>Payments received</strong></td>
          <td width="50%"></td>
        </tr>
        <tr>
          <td width="50%"><strong>Recurring charges</strong></td>
          <td width="50%"></td>
        </tr>
        <tr>
          <td width="50%"><strong>Total payment due</strong></td>
          <td width="50%"></td>
        </tr>
      </table>



    </div>
</body>
