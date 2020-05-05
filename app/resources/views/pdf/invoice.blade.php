<body>
  <h1>Lineblocs.com Invoice</h1>
  <h4>{{$dateRange}}</h4>
  <hr/>
  <table width="100%">
    <tr>
      <td>Source</td>
      <td>Amount</td>
      <td>Balance</td>
      <td>Date/Time</td>
      <td>Status</td>
    </tr>
  @foreach ($rows as $row)
    <tr>
      <td>{{$row->type}}</td>
      <td>{{$row->balance}}</td>
      <td>{{$row->dollars}}</td>
      <td>{{$row->created_at}}</td>
      <td>{{$row->status}}</td>
    </tr>
    @endforeach
  </table>
</body>
