<body>
  <style>
    table.bordered {
      border: 2px solid black;
    }
    table.invoice_tbl tr.header td {
      border-top: 2px solid black;
      border-bottom: 2px solid black;
    }
    table.invoice_tbl {
      border-bottom: 2px solid black;
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
                {{$vars['account_name']}}</td>
              </td>
            </tr>
            <tr>
              <td width="33%">
                <strong>Attn: </strong>
              </td>
              <td width="66%">
                {{$vars['attn'][0]}}</td>
              </td>
            </tr>
            <tr>
              <td width="33%">
                &nbsp;
              </td>
              <td width="66%">
                {{$vars['attn'][1]}}</td>
              </td>
            </tr>
            <tr>
              <td width="33%">
                &nbsp;
              </td>
              <td width="66%">
                {{$vars['attn'][2]}}</td>
              </td>
            </tr>
            <tr>
              <td width="33%">
                &nbsp;
              </td>
              <td width="66%">
                {{$vars['attn'][3]}}</td>
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
                <strong>Statement date: </strong> {{$vars['statement_date']}}</td>
              </td>
            </tr>
            <tr>
              <td>
            <strong>Due date: </strong> {{$vars['due_date']}}</td>
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
        <td><strong>Useful Information</strong></tr>
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
        <td>Outstanding balance on {{$vars['due_date']}}</td>
        <td></td>
        <td style="text-align: right;">{{$vars['invoice_amount']}}</td>
      </tr>
      @if ( $paidInvoice )
        <tr class="data">
          <td>Payment received  {{$vars['payment_recvd_date']}}</td>
          <td></td>
          <td style="text-align: right;">{{$vars['invoice_amount']}}</td>
        </tr>
      @endif
    </table>
    <table width="100%">
      <tr>
          <td>April  2023 invoice 3187-16190</td>
          <td>&nbsp;</td>
          <td style="text-align: right;">{{$vars['invoice_amount']}}</td>
      </tr>
    </table>
    <table width="100%">
      <tr>
          <td width="33%" style="text-align: left;" ><h2>&nbsp;</h2></td>
          <td width="33%" style="text-align: center;" ><h2>Total Payment Due</h2></td>
          <td width="33%" style="text-align: right;"><h2>{{$vars['invoice_amount']}}</h2></td>
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
                  {{$vars['account_name']}}</td>
                </td>
              </tr>
              <tr>
                <td width="33%">
                  <strong>Attn: </strong>
                </td>
                <td width="66%">
                  {{$vars['attn'][0]}}</td>
                </td>
              </tr>
              <tr>
                <td width="33%">
                  &nbsp;
                </td>
                <td width="66%">
                  {{$vars['attn'][1]}}</td>
                </td>
              </tr>
              <tr>
                <td width="33%">
                  &nbsp;
                </td>
                <td width="66%">
                  {{$vars['attn'][2]}}</td>
                </td>
              </tr>
              <tr>
                <td width="33%">
                  &nbsp;
                </td>
                <td width="66%">
                  {{$vars['attn'][3]}}</td>
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
                  <strong>Statement date: </strong> {{$vars['statement_date']}}</td>
                </td>
              </tr>
              <tr>
                <td>
              <strong>Due date: </strong> {{$vars['due_date']}}</td>
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
          <td>Description</td>
          <td>Month</td>
          <td>Price</td>
          <td>Tax</td>
          <td style="text-align: right;">Total</td>
      </tr>
        <tr class="data">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td style="text-align: right;">&nbsp;</td>
        </tr>
      </table>
      <table width="100%">
        <tr>
            <td>April  2023 invoice 3187-16190</td>
            <td>&nbsp;</td>
            <td style="text-align: right;">{{$vars['invoice_amount']}}</td>
        </tr>
      </table>
      <table class="invoice_tbl" width="100%">
        <tr>
            <td width="33%" style="text-align: left;" ><h2>&nbsp;</h2></td>
            <td width="33%" style="text-align: center;" ><h2>Total excl tax</h2></td>
            <td width="33%" style="text-align: right;"><h2>{{$vars['invoice_amount_no_tax']}}</h2></td>
        </tr>
        <tr>
            <td width="33%" style="text-align: left;" ><h2>&nbsp;</h2></td>
            <td width="33%" style="text-align: center;" ><h2>GST 5%</h2></td>
            <td width="33%" style="text-align: right;"><h2>{{$vars['tax1']}}</h2></td>
        </tr>
        <tr>
            <td width="33%" style="text-align: left;" ><h2>&nbsp;</h2></td>
            <td width="33%" style="text-align: center;" ><h2>Total w/ tax</h2></td>
            <td width="33%" style="text-align: right;"><h2>{{$vars['invoice_amount']}}</h2></td>
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
                  {{$vars['account_name']}}</td>
                </td>
              </tr>
              <tr>
                <td width="33%">
                  <strong>Attn: </strong>
                </td>
                <td width="66%">
                  {{$vars['attn'][0]}}</td>
                </td>
              </tr>
              <tr>
                <td width="33%">
                  &nbsp;
                </td>
                <td width="66%">
                  {{$vars['attn'][1]}}</td>
                </td>
              </tr>
              <tr>
                <td width="33%">
                  &nbsp;
                </td>
                <td width="66%">
                  {{$vars['attn'][2]}}</td>
                </td>
              </tr>
              <tr>
                <td width="33%">
                  &nbsp;
                </td>
                <td width="66%">
                  {{$vars['attn'][3]}}</td>
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
                  <strong>Statement date: </strong> {{$vars['statement_date']}}</td>
                </td>
              </tr>
              <tr>
                <td>
              <strong>Due date: </strong> {{$vars['due_date']}}</td>
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
          <td>Description</td>
          <td>Month</td>
          <td>Price</td>
          <td>Tax</td>
          <td style="text-align: right;">Total</td>
      </tr>
        <tr class="data">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td style="text-align: right;">&nbsp;</td>
        </tr>
      </table>
      <table width="100%">
        <tr>
            <td>April  2023 invoice 3187-16190</td>
            <td>&nbsp;</td>
            <td style="text-align: right;">{{$vars['invoice_amount']}}</td>
        </tr>
      </table>
      <table class="invoice_tbl" width="100%">
        <tr>
            <td width="33%" style="text-align: left;" ><h2>&nbsp;</h2></td>
            <td width="33%" style="text-align: center;" ><h2>Total excl tax</h2></td>
            <td width="33%" style="text-align: right;"><h2>{{$vars['invoice_amount_no_tax']}}</h2></td>
        </tr>
        <tr>
            <td width="33%" style="text-align: left;" ><h2>&nbsp;</h2></td>
            <td width="33%" style="text-align: center;" ><h2>GST 5%</h2></td>
            <td width="33%" style="text-align: right;"><h2>{{$vars['tax1']}}</h2></td>
        </tr>
        <tr>
            <td width="33%" style="text-align: left;" ><h2>&nbsp;</h2></td>
            <td width="33%" style="text-align: center;" ><h2>Total w/ tax</h2></td>
            <td width="33%" style="text-align: right;"><h2>{{$vars['invoice_amount']}}</h2></td>
        </tr>
      </table>
    </div>

    <div class="page-break"></div>
    <div class="page3 payment-methods">
      <center>
        <h1>Payment Methods</h1>
      </center>
    </div>
</body>
