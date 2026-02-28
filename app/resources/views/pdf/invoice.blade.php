<head>
  <style>
    * {
      margin: 0;
      padding: 0;
    }
    body {
      background-color: #f5f5f5;
      padding: 40px;
      color: #333;
    }
    .container {
      background-color: white;
      border-radius: 8px;
      padding: 40px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      max-width: 900px;
      margin: 0 auto;
    }
    h1 {
      font-size: 28px;
      font-weight: 700;
      color: #1a1a1a;
      margin-bottom: 8px;
      letter-spacing: -0.5px;
    }
    h4 {
      font-size: 14px;
      font-weight: 400;
      color: #666;
      margin-bottom: 24px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    thead tr {
      background-color: #f0f0f0;
      border-bottom: 2px solid #e0e0e0;
    }
    th {
      padding: 16px;
      text-align: left;
      font-weight: 600;
      font-size: 13px;
      color: #1a1a1a;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    tbody tr {
      border-bottom: 1px solid #e8e8e8;
      transition: background-color 0.2s ease;
    }
    tbody tr:hover {
      background-color: #fafafa;
    }
    tbody tr:last-child {
      border-bottom: none;
    }
    td {
      padding: 14px 16px;
      font-size: 14px;
      color: #333;
      font-weight: 400;
    }
    td:nth-child(2),
    td:nth-child(3) {
      font-weight: 500;
      color: #1a1a1a;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>{{$site}} billing history</h1>
    <h4>{{$dateRange}}</h4>
    <table>
      <thead>
        <tr>
          <th>Source</th>
          <th>Amount</th>
          <th>Balance</th>
          <th>Date/Time</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
      @foreach ($rows as $row)
        <tr>
          <td>{{$row->type}}</td>
          <td>${{number_format($row->dollars, 2)}}</td>
          <td>${{number_format($row->balance, 2)}}</td>
          <td>{{$row->created_at}}</td>
          <td>{{$row->status}}</td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</body>
