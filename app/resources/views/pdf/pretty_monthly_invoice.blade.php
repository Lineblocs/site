<body>
  <center>
    <h1>{{$site}} monthly statement</h1>
  </center>
  <table width="100%">
    <tr>
      <td>
        <table width="100%">   
          <tr>
            <td>
              <strong>Account name: </strong> {{$vars['account_name']}}</td>
            </td>
          </tr>
          <tr>
            <td><strong>Attn: </strong> <span style="direction:rtl;">{!! $vars['attn'][0] !!}</span></td>
          </tr>
          <tr>
            <td><span style="direction:rtl;">{!! $vars['attn'][0] !!}</span></td>
          </tr>
          <tr>
            <td><span style="direction:rtl;">{!! $vars['attn'][1] !!}</span></td>
          </tr>
          <tr>
            <td><span style="direction:rtl;">{!! $vars['attn'][2] !!}</span></td>
          </tr>
          <tr>
            <td><span style="direction:rtl;">{!! $vars['attn'][3] !!}</span></td>
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
          <strong>Due date: </strong> {{$vars['due_date']}}</td>
        </table>
      </td>
    </tr>
  </table>
</body>
