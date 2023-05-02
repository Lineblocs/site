<body>
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
</body>
