<div class="modal fade" id="vehicleModal" tabindex="-1" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-xl modal-simple modal-enable-otp modal-dialog-centered">
    <div class="modal-content" style="background:#0f172a;color:#ffffff;">
      <div class="modal-body" style="background:#0f172a;color:#ffffff;">

        <!-- Header Section -->
        <div style="border:1px solid #475569;
                    border-radius:12px;
                    padding:30px;
                    margin-bottom:40px;">
          <div style="display:flex;align-items:center;gap:20px;flex-wrap:wrap;">
            <div style="color:#64748b;
                        padding:8px 16px;border-radius:6px;
                        font-weight:700;font-size:14px;min-width:fit-content;
                        background-color:#ffffff;;
                        border:1px solid  #ffffff;" id="regnumber_veh">
              
            </div>
            <h1 style="font-size:32px;font-weight:700;color:#ffffff;flex:1;min-width:300px;" id="name_veh">
           
            </h1>
            <a href="#" id="DetailView" target="_blank" class="btn btn-sm btn-primary"  style="color:#ffffff;border:1px solid #64748b;
                        
                           padding:10px 24px;border-radius:6px;
                           font-weight:600;font-size:14px;cursor:pointer;
                           transition:all 0.3s ease;">
              Detail View
        </a>
          </div>
        </div>

        <!-- Main Auction Table -->
        <div style="margin-bottom:50px;">
          <div style="">
            <table style="width:100%;border-collapse:collapse;margin:0;">
              <thead style="border-bottom:2px solid #475569;">
                <tr>
                  <th style="padding:16px 12px;text-align:left;font-weight:600;font-size:13px;
                             color:#ffffff;text-transform:uppercase;letter-spacing:0.5px;">Date</th>
                  <th style="padding:16px 12px;text-align:left;font-weight:600;font-size:13px;color:#ffffff;">Auc House</th>
                  <th style="padding:16px 12px;text-align:left;font-weight:600;font-size:13px;color:#ffffff;">Center</th>
                  <th style="padding:16px 12px;text-align:left;font-weight:600;font-size:13px;color:#ffffff;">Mileage</th>
                  <th style="padding:16px 12px;text-align:left;font-weight:600;font-size:13px;color:#ffffff;">CAP C</th>
                  <th style="padding:16px 12px;text-align:left;font-weight:600;font-size:13px;color:#ffffff;">CAP Avg</th>
                  <th style="padding:16px 12px;text-align:left;font-weight:600;font-size:13px;color:#ffffff;">CAP B</th>
                  <th style="padding:16px 12px;text-align:left;font-weight:600;font-size:13px;color:#ffffff;">Last Bid</th>
                  <th style="padding:16px 12px;text-align:left;font-weight:600;font-size:13px;color:#ffffff;">Risk Ratio</th>
                </tr>
              </thead>
              <tbody id="currentVehicleModalTableBody">
            
              </tbody>
            </table>
          </div>
        </div>

        <!-- Pre Auc Section -->
        <div style="margin-bottom:30px;">
          <h2 style="font-size:28px;font-weight:700;color:#ffffff;margin-bottom:20px;text-align:center;">
            Pre Auc
          </h2>
          <div style="">
            <table style="width:100%;border-collapse:collapse;margin:0;">
              <thead style="border-bottom:2px solid #475569;">
                <tr>
                  <th style="padding:16px 12px;text-align:left;font-weight:600;font-size:13px;color:#ffffff;">Date</th>
                  <th style="padding:16px 12px;text-align:left;font-weight:600;font-size:13px;color:#ffffff;">Auc House</th>
                  <th style="padding:16px 12px;text-align:left;font-weight:600;font-size:13px;color:#ffffff;">Center</th>
                  <th style="padding:16px 12px;text-align:left;font-weight:600;font-size:13px;color:#ffffff;">Mileage</th>
                  <th style="padding:16px 12px;text-align:left;font-weight:600;font-size:13px;color:#ffffff;">CAP C</th>
                  <th style="padding:16px 12px;text-align:left;font-weight:600;font-size:13px;color:#ffffff;">CAP Avg</th>
                  <th style="padding:16px 12px;text-align:left;font-weight:600;font-size:13px;color:#ffffff;">CAP B</th>
                  <th style="padding:16px 12px;text-align:left;font-weight:600;font-size:13px;color:#ffffff;">Last Bid</th>
                  <th style="padding:16px 12px;text-align:left;font-weight:600;font-size:13px;color:#ffffff;">Status</th>
                </tr>
              </thead>
              <tbody id="vehicleModalTableBody" style="color:#ffffff;">
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
