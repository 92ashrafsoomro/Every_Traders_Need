<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Invoice #0001 • AutoBoli Pvt Ltd</title>
  <style type="text/css">
    body {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 14px;
      color: #333;
      background: #f7f9fc;
      margin: 0;
      padding: 0;
    }

    .invoice-container {
      max-width: 800px;
      background: white;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 25px rgba(0,0,0,0.08);
    }

    /* Header */
    .invoice-header {
      background: #0d1b3a;
      color: white;
      padding: 30px 40px;
    }

    .header-table {
      width: 100%;
      border-collapse: collapse;
    }

    .header-table td {
      vertical-align: middle;
    }

    .company-cell {
      width: 60%;
    }

    .meta-cell {
      width: 40%;
      text-align: right;
    }

    .company {
      display: table;
    }

    .company img {
      width: 60px;
      height: auto;
      vertical-align: middle;
    }

    .company-text {
      display: inline-block;
      vertical-align: middle;
      padding-left: 18px;
    }

    .company h2 {
      margin: 0;
      font-size: 22px;
      letter-spacing: 0.5px;
    }

    .company p {
      margin: 4px 0 0;
      font-size: 13px;
      opacity: 0.9;
    }

    .invoice-meta .label {
      background: #2563eb;
      color: white;
      padding: 6px 14px;
      border-radius: 6px;
      font-weight: bold;
      font-size: 13px;
      display: inline-block;
    }

    .invoice-meta .number {
      font-size: 28px;
      margin: 8px 0 4px;
      font-weight: bold;
    }

    .invoice-meta .date {
      font-size: 13px;
      opacity: 0.9;
    }

    /* Bill to & Details – gap kam kiya */
    .bill-section {
      padding: 35px 0 20px;
      background: #ffffff;
    }

    .bill-grid {
      width: 100%;
    }

    .bill-grid table {
      width: 100%;
      border-collapse: collapse;
      table-layout: fixed;   /* ← isse columns balanced rehte hain */
    }

    .bill-grid td {
      width: 50%;
      vertical-align: top;
      padding: 0 10px;       /* ← gap ko 15px se 10px kiya (aur kam bhi kar sakte ho) */
    }

    .bill-grid td:first-child {
      padding-left: 0;
    }

    .bill-grid td:last-child {
      padding-right: 0;
    }

    .bill-grid h4 {
      margin: 0 0 12px;
      color: #2563eb;
      font-size: 16px;
      font-weight: 600;
    }

    .bill-grid p {
      margin: 6px 0;
      line-height: 1.5;
    }

    /* Items */
    .items-table {
      width: 100%;
      border-collapse: collapse;
      margin: 30px 0;
    }

    .items-table th,
    .items-table td {
      padding: 12px 10px;
      text-align: left;
      border-bottom: 1px solid #e2e8f0;
    }

    .items-table th {
      background: #f1f5f9;
      color: #475569;
      font-weight: 600;
      text-transform: uppercase;
      font-size: 12px;
      letter-spacing: 0.5px;
    }

    .items-table td {
      font-size: 14px;
    }

    .items-table .amount {
      text-align: right;
    }

    .items-table .status {
      display: inline-block;
      padding: 4px 10px;
      border-radius: 999px;
      font-size: 12px;
      font-weight: 600;
    }

    .status-active   { background: #ecfdf5; color: #065f46; }
    .status-pending  { background: #fef3c7; color: #92400e; }
    .status-paid     { background: #dbeafe; color: #1e40af; }

    /* Totals + Thank you – same as before but padding fix */
    .totals-section {
      padding: 0 0px 30px;
    }

    .totals-table {
      width: 100%;
      border-collapse: collapse;
    }

    .thank-you-cell {
      width: 55%;
      vertical-align: top;
      text-align: left;
      color: #64748b;
      font-style: italic;
      font-size: 14px;
      line-height: 1.5;
      padding-right: 20px;
    }

    .totals-cell {
      width: 45%;
      vertical-align: top;
      text-align: right;
    }

    .totals-inner {
      width: auto;
      margin-left: auto;
      border-collapse: collapse;
    }

    .totals-inner td {
      padding: 8px 0;
      font-size: 15px;
    }

    .totals-inner .label {
      padding-right: 40px;
      color: #64748b;
      white-space: nowrap;
    }

    .grand-total {
      font-size: 20px;
      font-weight: bold;
      color: #0f172a;
      border-top: 2px solid #e2e8f0;
      padding-top: 12px;
      margin-top: 8px;
    }

    /* Footer */
    .invoice-footer {
      background: #0d1b3a;
      color: white;
      text-align: center;
      padding: 20px;
      font-size: 13px;
    }

    @media print {
      body { background: white; }
      .invoice-container { box-shadow: none; margin: 0; border-radius: 0; }
    }
  </style>
</head>
<body>

<div class="invoice-container">

  <!-- Header -->
  <div class="invoice-header">
    <table class="header-table">
      <tr>
        <td class="company-cell">
          <div class="company">
            <img src="{{ public_path('build/assets/newLogo-B4aftMUZ.png') }}" width="60">
            <div class="company-text">
              <h2>AutoBoli Pvt Ltd</h2>
              <p>Karachi, Pakistan<br>info@autoboli.com | +92 21 1234567</p>
            </div>
          </div>
        </td>
        <td class="meta-cell">
          <div class="invoice-meta">
            <div class="label">INVOICE</div>
            <div class="number">#0001</div>
            <div class="date">Issued: 19 February 2026</div>
          </div>
        </td>
      </tr>
    </table>
  </div>

  <!-- Bill To & Details – tight gap -->
  <div class="bill-section">
    <div class="bill-grid">
      <table>
        <tr>
          <td>
            <h4>Billed To</h4>
            <p><strong>Muhammad Shakeeb</strong><br>
              shakeeb@email.com<br>
              +92 300 1234567<br>
              Gulshan-e-Iqbal, Karachi</p>
          </td>
          <td>
            <h4>Subscription Details</h4>
            <p><strong>Plan:</strong> Trader Basic<br>
              <strong>Payment Method:</strong> Stripe<br>
              <strong>Period:</strong> 19 Feb 2026 – 19 Mar 2026<br>
              <strong>Status:</strong> <span class="status status-active">Active</span></p>
          </td>
        </tr>
      </table>
    </div>
  </div>

  <!-- Items -->
  <table class="items-table">
    <thead>
      <tr>
        <th style="width:8%">ID</th>
        <th style="width:18%">Date</th>
        <th>Plan</th>
        <th style="width:14%">Start Date</th>
        <th style="width:14%">Expiry</th>
        <th style="width:12%" class="amount">Amount</th>
        <th style="width:12%">Status</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>19-Feb-2026</td>
        <td>Trader Basic - Monthly</td>
        <td>19-Feb-2026</td>
        <td>19-Mar-2026</td>
        <td class="amount">£49.00</td>
        <td><span class="status status-paid">Paid</span></td>
      </tr>
    </tbody>
  </table>

  <!-- Totals + Thank you in one row -->
  <div class="totals-section">
    <table class="totals-table">
      <tr>
        <td class="thank-you-cell">
          Thank you for your business!<br>
          We appreciate your trust in AutoBoli.
        </td>
        <td class="totals-cell">
          <table class="totals-inner">
            <tr>
              <td class="label">Subtotal:</td>
              <td>£49.00</td>
            </tr>
            <tr>
              <td class="label">Tax (0%):</td>
              <td>£0.00</td>
            </tr>
            <tr>
              <td class="grand-total">Total Due:</td>
              <td class="grand-total" style="text-align: right;">£49.00</td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </div>

  <div class="invoice-footer">
    AutoBoli Pvt Ltd © 2026  •  www.autoboli.com
  </div>

</div>

</body>
</html>