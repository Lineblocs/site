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

    .muted {
      color: #64748b;
    }

    .right {
      text-align: right;
    }

    .center {
      text-align: center;
    }

    .brand-rule {
      height: 4px;
      background: #3f51b5;
      font-size: 1px;
      line-height: 1px;
    }

    .header-table {
      width: 100%;
      margin-bottom: 28px;
    }

    .container {
      width: 100%;
    }

    .header {
      margin-bottom: 28px;
      display: flex;
      align-items: flex-start;
      gap: 20px;
      padding-bottom: 20px;
      border-bottom: 3px solid #3f51b5;
    }

    .header-content {
      flex: 1;
      margin-top: 60px;
    }

    .brand {
      font-size: 14px;
      font-weight: 600;
      color: #3f51b5;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 8px;
    }

    .header h1 {
      margin-top: 0;
      font-size: 32px;
      font-weight: 700;
      color: #1f2937;
      letter-spacing: -0.5px;
    }

    .header h4 {
      margin-top: 6px;
      font-weight: 400;
      font-size: 13px;
      color: #64748b;
    }

    .content {
      width: 100%;
      margin-bottom: 10px !important;
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
      margin-top: 15px;
    }

    .invoice-title {
      font-size: 30px;
      line-height: 36px;
      font-weight: 700;
      color: #0a1247;
      letter-spacing: 0;
    }

    .statement-label {
      margin-top: 4px;
      font-size: 12px;
      color: #64748b;
      text-transform: uppercase;
    }

    .summary {
      width: 100%;
      margin: 0 0 10px;
      display: flex;
      gap: 16px;
    }

    .summary-item {
      flex: 1;
      padding: 18px 20px;
      border: 1px solid #e5e7eb;
      background: #f6f8fb;
      border-radius: 4px;
      margin-bottom: 0;
    }

    .summary-label {
      display: block;
      margin-bottom: 8px;
      font-size: 10px;
      line-height: 14px;
      color: #64748b;
      text-transform: uppercase;
      letter-spacing: .6px;
      font-weight: 600;
    }

    .summary-value {
      display: block;
      font-size: 20px;
      line-height: 28px;
      font-weight: 700;
      color: #0a1247;
    }

    .section-title {
      margin: 24px 0 10px;
      padding-bottom: 8px;
      border-bottom: 2px solid #3f51b5;
      color: #0a1247;
      font-size: 16px;
      line-height: 22px;
      font-weight: 700;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    tr {
      margin: 5px;
    }

    .data-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
      border: 1px solid #e5e7eb;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .data-table th {
      padding: 13px 14px;
      background: #395373;
      color: #ffffff;
      font-size: 11px;
      line-height: 15px;
      font-weight: 700;
      text-align: left;
      text-transform: uppercase;
      letter-spacing: .35px;
      border-right: 1px solid #2a3d52;
    }

    .data-table th:last-child {
      border-right: none;
    }

    .data-table td {
      padding: 13px 14px;
      border-bottom: 1px solid #e5e7eb;
      border-right: 1px solid #e5e7eb;
      font-size: 12px;
      line-height: 18px;
      vertical-align: top;
    }

    .data-table tbody tr {
      height: 42px;
    }

    .data-table td:last-child {
      border-right: none;
    }

    .data-table tr:nth-child(odd) td {
      background: #fbfcfe;
    }

    .data-table tbody tr:last-child td {
      border-bottom: none;
    }

    .status-badge {
      display: inline-block;
      padding: 4px 10px;
      border-radius: 6px;
      font-size: 12px;
      font-weight: 600;
      text-transform: capitalize;
    }

    .status-completed {
      background-color: #d5f4e6;
      color: #16a34a;
    }

    .status-pending {
      background-color: #fff3cd;
      color: #856404;
    }

    .status-failed {
      background-color: #f8d7da;
      color: #721c24;
    }

    .status-paid {
      background-color: #d5f4e6;
      color: #16a34a;
    }

    .footer {
      color: #64748b;
      font-size: 10px;
      border-top: 2px solid #e5e7eb;
      padding-top: 12px;
      margin-top: 10px;
      display: flex;
      justify-content: space-between;
    }

    .footer-brand {
      margin-top: 5px;
      font-size: 16px;
      font-weight: 600;
      color: #3f51b5;
    }
    .footer-date {
      margin-top: 20px;
    }

    table th {
      text-align: left;
    }
  </style>
</head>
<?php
$logo = \App\Helpers\MainHelper::appLogo();
if (strpos($logo, '/') === 0 && file_exists(public_path(ltrim($logo, '/')))) {
  $logo = public_path(ltrim($logo, '/'));
}
?>
<body>
  <div class="container">
    <div class="header">
      <img src="{{$logo}}" class="logo" />
      <div class="header-content">
        <div class="brand">📊 Estimated Charges</div>
        <h4>{{$dateRange}}</h4>
      </div>
    </div>
    <div class="content">
      <div class="summary">
        <div class="summary-item">
          <div class="summary-label">Total Charges</div>
          @if(!empty($rows['dollars']))
          <div class="summary-value">${{ number_format($rows->sum('dollars'), 2) }}</div>
          @else
          <div class="summary-value">$0.00</div>
          @endif
        </div>
        <div class="summary-item">
          <div class="summary-label">Total Transactions</div>
          <div class="summary-value">{{ count($rows) }}</div>
        </div>
      </div>
      <table>
        <thead>
          <tr>
            <th>Source</th>
            <th>Amount</th>
            <th>Date/Time</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($rows as $row)
          <tr>
            <td>{{$row->type}}</td>
            <td>${{number_format($row->dollars, 2)}}</td>
            <td>{{$row->created_at}}</td>
            <td>
              <span class="status-badge status-{{ strtolower($row->status) }}">
                {{$row->status}}
              </span>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    <div class="footer">
      <span class="footer-brand">{{ \App\Helpers\MainHelper::getSiteName() }}</span>
      <p class="footer-date">Generated on {{ date('Y-m-d H:i:s') }}</p>
    </div>
  </div>
</body>
