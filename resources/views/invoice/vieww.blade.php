<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Invoice #0001 • AutoBoli Pvt Ltd</title>
<style>
body { font-family: Arial, sans-serif; background:#f4f6fa; }

.invoice-wrapper {
  max-width: 750px;
  margin: 40px auto;
  background: #fff;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

/* Header */
.invoice-header {
  background: #0a1930;
  color: #fff;
  padding: 25px 30px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.company-info {
  display: flex;
  align-items: center;
  gap: 15px;
}

.company-info img { width: 55px; }

.invoice-label span {
  background: #0080ff;
  padding: 5px 12px;
  border-radius: 6px;
  font-weight: bold;
}

.invoice-label p {
  margin: 6px 0 0;
  font-size: 12px;
}

/* Customer Table */
.customer-info-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
  border: 1px solid #e0e6ef;
  background: #f9fbfe;
}

.customer-info-table td {
  width: 50%;
  padding: 15px 20px;
  vertical-align: top;
  border-right: 1px solid #e0e6ef;
}

.customer-info-table td:last-child { border-right: none; }

.customer-info-table h4 {
  margin-bottom: 8px;
  font-size: 15px;
  color: #0080ff;
}

/* Items Table */
.invoice-items {
  width: 100%;
  border-collapse: collapse;
  margin-top: 25px;
}

.invoice-items th, 
.invoice-items td {
  border: 1px solid #ddd;
  padding: 10px;
  text-align: center;
}

.invoice-items th {
  background: #f6f8fb;
}

/* Status */
.status {
  padding: 3px 8px;
  border-radius: 5px;
  font-size: 12px;
  font-weight: bold;
}

.paid {
  background: #e6f8ec;
  color: #1a8f3d;
}

.unpaid {
  background: #ffeaea;
  color: #cc0000;
}

/* Footer */
.invoice-footer {
  text-align: center;
  background: #0a1930;
  color: #fff;
  padding: 20px;
  margin-top: 30px;
}

.download-btn {
  text-align: center;
  margin: 25px 0;
}

.btn {
  background: #0a1930;
  color: #fff;
  padding: 10px 18px;
  border-radius: 6px;
  text-decoration: none;
  font-weight: bold;
}
</style>
</head>

<body>

<div class="invoice-wrapper">

  <!-- Header -->
  <div class="invoice-header">
    <div class="company-info">
      <img src="logo.png" alt="Logo">
      <div>
        <h2>AutoBoli Pvt Ltd</h2>
        <p>Karachi, Pakistan<br>info@autoboli.com</p>
      </div>
    </div>

    <div class="invoice-label">
      <span>INVOICE</span>
      <p>#0001<br>2026-02-19</p>
    </div>
  </div>

  <!-- Customer Info -->
  <table class="customer-info-table">
    <tr>
      <td>
        <h4>Billed To</h4>
        <p><strong>Name:</strong> Muhammad Shakeeb</p>
        <p><strong>Email:</strong> shakeeb@email.com</p>
        <p><strong>Phone:</strong> +92 300 1234567</p>
      </td>

      <td>
        <h4>Billing Details</h4>
        <p><strong>Plan:</strong> Trader Basic</p>
        <p><strong>Payment Method:</strong> Stripe</p>
        <p><strong>Status:</strong> <span class="status paid">Active</span></p>
      </td>
    </tr>
  </table>

  <!-- Items -->
  <table class="invoice-items">
    <thead>
      <tr>
        <th>ID</th>
        <th>Date</th>
        <th>Plan</th>
        <th>Start</th>
        <th>Expiry</th>
        <th>Amount</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>2026-02-19</td>
        <td>Trader Basic</td>
        <td>19-Feb-2026</td>
        <td>19-Mar-2026</td>
        <td>£49.00</td>
        <td><span class="status paid">Active</span></td>
      </tr>
    </tbody>
  </table>

  <p style="padding:20px;">Thank you for your business!</p>

  <div class="invoice-footer">
    <p>AutoBoli Pvt Ltd © 2026 — All rights reserved</p>
    <p>www.autoboli.com</p>
  </div>

</div>

<div class="download-btn">
  <a href="#" class="btn">Download PDF</a>
</div>

</body>
</html>
