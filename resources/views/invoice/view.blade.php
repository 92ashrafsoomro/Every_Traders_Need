<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Invoice #0001 • AutoBoli Pvt Ltd</title>
  <style type="text/css">
    body {
       font-family: 'Inter', sans-serif !important;
      font-size: 14px;
      color: #333;
      /* background: #f7f9fc; */
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
      border-radius: 12px;
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
      margin-top: 20px;
      vertical-align: middle;
      /* padding-left: 18px; */
    }
    .meta-text {
      display: inline-block;
      margin-top: 50px;
      vertical-align: middle;
      /* padding-left: 18px; */
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
      text-align: right;
      background: #ffffff;
    }

    .bill-grid {
      width: 100%;
    }

    .bill-grid table {
      width: 100%;
      border-collapse: collapse;
      table-layout: fixed;  
    }

    .bill-grid td {
      width: 50%;
      vertical-align: top;
      padding: 0 10px;     
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
      margin: 10px 0;
        border: 1px solid #e2e8f0;
    }
.info-table{
  width:100%;
  border-collapse: collapse;
  margin-bottom:5px;
}

.info-table td{
  padding:6px 0;
  border-bottom:1px solid #e2e8f0;
  font-size:13px;
}

.info-table .label{
  font-weight:600;
  width:45%;
  color:#475569;
}

.info-table .value{
  text-align:right;
  width:55%;
}

.payment-note{
  font-size:12px;
  color:#64748b;
  margin-top:6px;
}
    .items-table th,
    .items-table td {
      padding: 12px 10px;
      text-align: left;
      border-bottom: 1px solid #e2e8f0;
    }

    .items-table th {
      background: #0d1b3a;
      color: #fff;
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
    .footer-top{
      margin-top: 10px ;
      margin-bottom: 20px;
    }
    .footer-top p{
    font-size : 12px;
    color : #4e4e4f;
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
@php
    use Carbon\Carbon;
@endphp
<div class="invoice-container">

  <!-- Header -->
  <div class="invoice-header">
    <table class="header-table">
      <tr>
        <td>

        <td class="company-cell">
           <img src="{{ $logo }}" width="100" alt="Company Logo">

     
          <div class="company">
            <div class="company-text">
              <h2>{{ $Setting['sitename'] ?? 'AutoBoli Pvt Ltd' }}</h2>
              <p>Vehicle Auction Data & Market Intelligence Platform</p>
              <p>Website: {{ $Setting['website'] ?? 'www.autoboli.com' }} </p>
              <p>Email: {{ $Setting['email'] ?? 'info@autoboli.com' }} </p>
            </div>
          </div>
        </td>
        <td class="meta-cell">
         <div class="company">
            <div class="meta-text">
            <div >Invoice Number : {{ $data->id ?? '' }}  </div>
            <div>Invoice Date : {{ isset($data->payment->payment_date) ? date('d-m-Y', strtotime($data->payment->payment_date)) : '' }} </div>
         
            <div>  Payment Method : {{ $data->payment->payment_method ?? '' }} </div>
          <div>Cycle : {{ $billingCycle }} <br></div>
          </div>
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

        <!-- LEFT SIDE -->
        <td>

          <h4>Bill To</h4>

          <table class="info-table">
            <tr>
              <td class="label">Company Name</td>
              <td class="value">{{ $data->user->companyName ?? '' }}</td>
            </tr>
            <tr>
              <td class="label">Contact Person</td>
              <td class="value">{{ $data->user->telephone ?? '' }}</td>
            </tr>
            <tr>
              <td class="label">Email Address</td>
              <td class="value">{{ $data->user->personalEmail ?? '' }}</td>
            </tr>
            <tr>
              <td class="label">Billing Address</td>
              <td class="value">{{ $data->payment->address ?? '' }}</td>
            </tr>
            <tr>
              <td class="label">Country</td>
              <td class="value">{{ $data->user->country ?? '' }}</td>
            </tr>
          </table>

        </td>


        <!-- RIGHT SIDE -->
        <td>

          <h4>Subscription Details</h4>

          <table class="info-table">
              <tr>
                  <td class="label">Plan</td>
                  <td class="value">{{ $data->package_name ?? 'N/A' }}</td>
              </tr>
              <tr>
                  <td class="label">Billing Period</td>
                  <td class="value">
                      @if(isset($data->membership_start_date) && isset($data->membership_expiry_date))
                          {{ \Carbon\Carbon::parse($data->membership_start_date)->format('M Y') }} - 
                          {{ \Carbon\Carbon::parse($data->membership_expiry_date)->format('M Y') }}
                      @else
                          N/A
                      @endif
                  </td>
              </tr>
              {{-- <tr>
                  <td class="label">Qty</td>
                  <td class="value">1</td>
              </tr> --}}
              <tr>
                  <td class="label">Price</td>
                  <td class="value">€{{ number_format((float)($data->price ?? 0), 2) }}</td>
              </tr>
              @if(!empty($data->discount) && $data->discount > 0)
              <tr>
                  <td class="label">Discount</td>
                  <td class="value">-€{{ number_format((float)$data->discount, 2) }}</td>
              </tr>
              @endif
              <tr>
                  <td class="label">Total</td>
                  <td class="value"><strong>€{{ number_format((float)($data->total ?? 0), 2) }}</strong></td>
              </tr>
          </table>


          <h4>Payment Summary</h4>
          <table class="info-table">
              <tr>
                  <td class="label">Subtotal</td>
                  <td class="value">€{{ number_format((float)($data->price ?? 0), 2) }}</td>
              </tr>
              
              <tr>
                  <td class="label">VAT (if applicable)</td>
                  <td class="value">€0.00</td>
              </tr>

              <tr>
                  <td class="label">Discount</td>
                  <td class="value">
                      @if(!empty($data->discount) && $data->discount > 0)
                          -€{{ number_format((float)$data->discount, 2) }}
                      @else
                          €0.00
                      @endif
                  </td>
              </tr>

              <tr>
                  <td class="label">Billing Address</td>
                  <td class="value">
           
                      {{ $data->payment->address ?? 'Address Not Provided' }}
                  </td>
              </tr>

              <tr>
                  <td class="label">Total Amount</td>
                  <td class="value" style="font-weight: bold;">
                      €{{ number_format((float)($data->total ?? 0), 2) }}
                  </td>
              </tr>
          </table>


          <h4>Payment Information</h4>

          <table class="info-table">
            <tr>
              <td class="label">Payment Method</td>
              <td class="value">{{ $data->payment->payment_method ?? '' }}</td>
            </tr>
            <tr>
              <td class="label">Transaction ID</td>
              <td class="value">{{ $data->payment->transaction_id ?? 'N/A' }}</td>
            </tr>
          </table>

          <p class="payment-note">
            Payment will be automatically deducted according to your billing agreement.
          </p>

        </td>

      </tr>
    </table>
  </div>
</div>


  <!-- Items -->
  <table class="items-table">
    <thead>
      <tr> 
        <th>Plan Name</th>
        <th>Billing Cycle</th>
        <th style="width:18%">Date</th>
        <th style="width:14%">Start Date</th>
        <th style="width:14%">Next billing date</th>
        <th style="width:12%">Account Status</th>
      </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{ $data->package_name ?? 'N/A' }}</td>
        <td>{{ $billingCycle }}</td>
        <td>{{ isset($data->join_date) ? Carbon::parse($data->join_date)->format('d M, Y') : 'N/A' }}</td>
        <td>{{ isset($data->membership_start_date) ? Carbon::parse($data->membership_start_date)->format('d M, Y') : 'N/A' }}</td>
        <td>{{ $nextBillingDate }}</td>
        <td>
            @if($isExpired)
                <span class="status status-expired" style="color: red; font-weight: bold;">Expired</span>
            @else
                <span class="status status-paid" style="color: green; font-weight: bold;">Active</span>
            @endif
        </td>
    </tr>
    </tbody>
  </table>

  <!-- Totals + Thank you in one row -->
  <!-- <div class="totals-section">
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
  </div> -->
  <div class="footer-top">
    <p>
      This invoice confirms your subscription payment for Autoboli services <br>
      Your subscription provides access to vehicle auction insights, valuation data, and analytics tools.
    </p>
  </div>

  <div class="invoice-footer">
    {{ $Setting['sitename'] ?? 'AutoBoli Pvt Ltd' }} © 2026  •  {{ $Setting['website'] ?? 'www.autoboli.com' }}
  </div>

</div>

</body>
</html>