<body>
  <h1>{{$site}} Estimated Charges</h1>
  <h4>{{$dateRange}}</h4>
  <hr/>
  <table width="100%">
    <tr>
      <td><strong>Source</strong></td>
      <td><strong>Amount</strong></td>
      <td><strong>Balance</strong></td>
      <td><strong>Date/Time</strong></td>
      <td><strong>Status</strong></td>
    </tr>
  @foreach ($rows as $row)
    <tr>
      <td>{{$row->type}}</td>
      <td>${{number_format($row->dollars, 2)}}</td>
      <td>${{number_format($row->balance, 2)}}</td>
      <td>{{$row->created_at}}</td>
      <td>{{$row->status}}</td>
    </tr>
  @endforeach
  </table>
</body>
