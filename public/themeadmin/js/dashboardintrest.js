
const UserIntrest = {};
let stockAuctionChartInstance;
UserIntrest.updateInterest = function (interestId, $button = null) {
    if (!interestId) return;


    if ($button) {
        $('#interest-buttons-wrapper .interest-button').removeClass('active');
        $button.addClass('active');
    }


    const selectedYear = $('#yearFilter').val();
    const selectedGrade = $('#gradeFilter').val();
    // const selectedMileage = $('#mileageFilter').val();

    $.ajax({
        url: path + "/dashboard/setIntrest",
        type: "GET",
        data: {
            id: interestId,
            year: selectedYear,
            grade: selectedGrade,
            // mileage: selectedMileage
        },
        dataType: "json",
        success: function (res) {
            if (res.success) {
       
                $('#veh_name').text(res.name || 'N/A');

    
                const $yearFilter = $('#yearFilter');
                $yearFilter.empty().append('<option value="">Year</option>');
                res.years.forEach(year => {
                    $yearFilter.append(
                        `<option value="${year}" ${selectedYear == year ? 'selected' : ''}>${year}</option>`
                    );
                });

    
                const $gradeFilter = $('#gradeFilter');
                $gradeFilter.empty().append('<option value="">Grade</option>');
                res.grades.forEach(grade => {
                    $gradeFilter.append(
                        `<option value="${grade}" ${selectedGrade == grade ? 'selected' : ''}>${grade}</option>`
                    );
                });

       
                // const $mileageFilter = $('#mileageFilter');
                // $mileageFilter.empty().append('<option value="">Mileage</option>');
                // res.mileages.forEach(mileage => {
                //     $mileageFilter.append(
                //         `<option value="${mileage}" ${selectedMileage == mileage ? 'selected' : ''}>${mileage.toLocaleString()} km</option>`
                //     );
                // });

          
                UserIntrest.activeId = interestId;
            }
        },
        error: function (err) {
            console.error("Error updating interest:", err);
        }
    });
};

UserIntrest.loadStockAuctionHouse = function (interestId) {
  const selectedYear = $('#yearFilter').val();
  const selectedGrade = $('#gradeFilter').val();

  $.ajax({
    url: path + "/dashboard/stockAuctionHouse",
    dataType: "json",
    data: { id: interestId, year: selectedYear, grade: selectedGrade },
    success: function (response) {
      const container = $("#stockAuctionHouse");

      if (container.find(".chart-container").length === 0) {
        container.find(".chart").wrap('<div class="chart-container"></div>');
      }

      const chartContainer = container.find(".chart-container");
      const ctx = container.find(".chart")[0].getContext("2d");

      chartContainer.css({
        width: "100%",
        overflow: "hidden",          // hard safety: no visual overflow
        borderRadius: "10px",
        padding: "10px 15px",
        position: "relative"
      });

      // ---- Prepare data ----
      const filteredData = response.values
        .map((v, i) => ({
          ...v,
          label: (response.labels[i] || "").trim(),
          color: response.colors[i],
        }))
        .filter(item => item.interest > 0);

      const labels = filteredData.map(item => item.label);
      const values = filteredData.map(item => item.interest);
      const colors = filteredData.map(item => item.color);

      // Dynamic height (nice spacing for 1..N rows)
      const rowH = 52;                         // per bar height
      const minH = 140;                        // look good for 1–2 rows
      const maxH = 520;                        // avoid giant containers
      const dynamicHeight = Math.max(minH, Math.min(labels.length * rowH, maxH));
      chartContainer.css("height", dynamicHeight + "px");

      // Destroy old chart instance if present
      if (window.stockAuctionChartInstance) window.stockAuctionChartInstance.destroy();

      // Headroom so right-side labels never hit the edge
      const maxVal = values.length ? Math.max(...values) : 0;
      const suggestedMax = maxVal ? Math.ceil(maxVal * 1.2) : 5; // +20% headroom or default 5

      // Helper: decide if label fits inside the bar in pixels
      const fitsInside = (chart, value) => {
        const x = chart.scales.x;
        if (!x) return false;
        const barPx = x.getPixelForValue(value) - x.left; // bar width in px
        return barPx >= 64; // threshold where chip can sit inside comfortably
      };

      // Create chart
      window.stockAuctionChartInstance = new Chart(ctx, {
        type: "bar",
        data: {
          labels,
          datasets: [{
            label: "Interest Vehicles",
            data: values,
            backgroundColor: colors,
            borderRadius: 6,
            barThickness: 24,
            categoryPercentage: 0.8,
            barPercentage: 0.72,
          }],
        },
        options: {
          indexAxis: "y",
          responsive: true,
          maintainAspectRatio: false,
          devicePixelRatio: window.devicePixelRatio || 1,
          layout: { padding: { left: 10, right: 28, top: 6, bottom: 8 } },
          animation: { duration: 650, easing: "easeOutCubic" },
          plugins: {
            legend: { display: false },
            tooltip: {
              enabled: true,
              backgroundColor: "#222",
              titleColor: "#fff",
              bodyColor: "#fff",
              titleFont: { weight: "bold", size: 13 },
              bodyFont: { size: 12 },
              callbacks: {
                title: (tt) => labels[tt[0].dataIndex],
                label: (tt) => {
                  const i = tt.dataIndex;
                  return `Interest/Total: ${values[i]}/${filteredData[i].total}`;
                },
              },
            },
            datalabels: {
              // Smart positioning: inside if bar wide, else just outside left
              anchor: (ctx) => {
                const chart = ctx.chart;
                const v = ctx.dataset.data[ctx.dataIndex];
                return fitsInside(chart, v) ? "end" : "start";
              },
              align: (ctx) => {
                const chart = ctx.chart;
                const v = ctx.dataset.data[ctx.dataIndex];
                return fitsInside(chart, v) ? "right" : "left";
              },
              offset: (ctx) => {
                const chart = ctx.chart;
                const v = ctx.dataset.data[ctx.dataIndex];
                return fitsInside(chart, v) ? -2 : 8; // inside nudge / outside gap
              },
              clamp: true,    // never draw beyond chart area
              clip: false,
              color: (ctx) => {
                const chart = ctx.chart;
                const v = ctx.dataset.data[ctx.dataIndex];
                return fitsInside(chart, v) ? "#fff" : "#fff";
              },
              backgroundColor: (ctx) => {
                const chart = ctx.chart;
                const v = ctx.dataset.data[ctx.dataIndex];
                // subtle chip bg whether inside or outside
                // return fitsInside(chart, v) ? "rgba(255,255,255,0.18)" : "rgba(0,128,255,0.20)";
              },
              borderRadius: 5,
              padding: { top: 2, bottom: 2, left: 6, right: 6 },
              font: { weight: "bold", size: 13 },
              formatter: (value, ctx) => {
                const i = ctx.dataIndex;
                return `${values[i]}/${filteredData[i].total}`;
              },
            },
          },
          scales: {
            x: {
              beginAtZero: true,
              suggestedMax,
              grid: { color: "#2a2a2a", borderColor: "#2a2a2a" },
              ticks: {
                color: "#bbb",
                font: { size: 12 },
                callback: (v) => Number(v).toLocaleString(),
              },
            },
            y: {
              display: false,
              grid: { display: false },
              ticks: { display: false },
            },
          },
        },
        plugins: [ChartDataLabels],
      });

      // ---- Legend ----
      const legendContainer = $("#chats_color");
      legendContainer.empty().css({
        display: "grid",
        gridTemplateColumns: "repeat(2, 1fr)",
        gap: "6px 15px"
      });

      filteredData.forEach(item => {
        legendContainer.append(`
          <div style="display:flex; align-items:center; gap:6px; white-space:nowrap;">
            <div style="width:20px; height:20px; background-color:${item.color}; border-radius:4px;"></div>
            <div style="color:#fff; font-size:13px;">${item.label}</div>
          </div>
        `);
      });
    },
    error: function (xhr) {
      console.error("❌ Error loading Stock Auction House chart:", xhr);
    },
  });
};

UserIntrest.topheader = function(interestId) {
    if (!interestId) return;

    const selectedYear = $('#yearFilter').val();
    const selectedGrade = $('#gradeFilter').val();
    // const selectedMileage = $('#mileageFilter').val();

    $.ajax({
        url: path + "/dashboard/gettopheaderintrest",
        type: "GET",
        data: {
            id: interestId,
            year: selectedYear,
            grade: selectedGrade,
            // mileage: selectedMileage
        },
        dataType: "json",
        success: function(res) {
            if (res.success) {
                const stats = res.stats;

                // Update HTML elements dynamically
                $('#totalAuctions').text(stats.total_auctions);
                $('#onlineAuctions').text(stats.online_auctions);
                $('#offlineAuctions').text(stats.offline_auctions);
                $('#vehiclesInProgress').text(stats.vehicles_in_progress_auctions);
                $('#totalVehicles').text(stats.totalVehiclesInProgress);
                $('#totalVehicleshead').text(stats.total_vehicles);
                $('#soldVehicles').text(stats.sold_vehicles);
                $('#unsoldVehicles').text(stats.unsold_vehicles);
                $('#vehiclesInReauction').text(stats.vehicles_in_reauction);
            } else {
                console.warn("No stats returned for this interest");
            }
        },
        error: function(err) {
            console.error("Error updating interest:", err);
        }
    });
};

UserIntrest.Valuation = function (interestId) {
    if (!interestId) return;

    const selectedYear = $('#yearFilter').val();
    const selectedGrade = $('#gradeFilter').val();

    $.ajax({
        url: path + "/dashboard/getValuation",
        dataType: "json",
        data: { id: interestId, year: selectedYear, grade: selectedGrade },
        success: function (response) {
            if (!response.success || !response.data.length) {
                $('#valuationTableBody').html(`
                    <tr>
                        <td colspan="5" style="text-align:center; color:#999; padding:20px;">
                            No valuation data found
                        </td>
                    </tr>
                `);
                return;
            }

            let html = "";
            response.data.forEach(item => {
                html += `
                    <tr style="border-bottom:1px solid #2a3142; font-size:14px; vertical-align:middle;">
                        <td style="padding:16px 12px;">
                            <div style="display:flex; align-items:center; gap:10px;">
                                <div style="width:32px; height:32px; background-color:#e8e8e8; border-radius:4px; overflow:hidden; flex-shrink:0;">
                                    <img src="${path}/public/uploads/platforms/${item.platform_image}" 
                                         style="width:100%; height:100%; object-fit:contain;" 
                                         alt="${item.platform_name}">
                                </div>
                                <span style="color:#0066cc; font-weight:600; font-size:13px;">
                                    ${item.platform_name}
                                </span>
                            </div>
                        </td>

                        <td style="padding:16px 12px; color:#0066cc; font-weight:500;">
                            ${item.center_name ?? '-'}
                        </td>

                        <td style="padding:16px 12px; color:#ffffff; font-weight:500;">
                            ${item.cap_clean_range}
                            <small style="display:block; font-size:12px; color:#8b92a9; margin-top:4px;">
                                CAP C
                            </small>
                        </td>

                        <td style="padding:16px 12px; color:#ffffff; font-weight:500;">
                            ${item.cap_average_range}
                            <small style="display:block; font-size:12px; color:#8b92a9; margin-top:4px;">
                                CAP AVG
                            </small>
                        </td>

                        <td style="padding:16px 12px; display:flex; align-items:center; gap:6px; color:#00ff88; font-weight:600;">
                            <span style="display:inline-block; width:0; height:0; 
                                         border-left:4px solid transparent; border-right:4px solid transparent; 
                                         border-bottom:5px solid #00ff88;"></span>
                            ${item.one_week_average}
                        </td>
                    </tr>
                `;
            });

            $('#valuationTableBody').html(html);
        },
        error: function (err) {
            console.error("Error updating interest:", err);
        }
    });
};


$(document).on('click', '#interest-buttons-wrapper .interest-button', function() {
    const $button = $(this);
    const interestId = $button.data('id');

    UserIntrest.updateInterest(interestId, $button);
    UserIntrest.topheader(interestId);
    UserIntrest.loadStockAuctionHouse(interestId);
    UserIntrest.Valuation(interestId);
});


$('#yearFilter, #gradeFilter, #mileageFilter').on('change', function () {
    const interestId = UserIntrest.activeId;
    if (!interestId) return console.warn("No active interest selected.");
    UserIntrest.updateInterest(interestId);
    UserIntrest.topheader(interestId);
    UserIntrest.loadStockAuctionHouse(interestId);
    UserIntrest.Valuation(interestId);
});

