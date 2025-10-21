
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
    const selectedMileage = $('#mileageFilter').val();

    $.ajax({
        url: path + "/dashboard/setIntrest",
        type: "GET",
        data: {
            id: interestId,
            year: selectedYear,
            grade: selectedGrade,
            mileage: selectedMileage
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

       
                const $mileageFilter = $('#mileageFilter');
                $mileageFilter.empty().append('<option value="">Mileage</option>');
                res.mileages.forEach(mileage => {
                    $mileageFilter.append(
                        `<option value="${mileage}" ${selectedMileage == mileage ? 'selected' : ''}>${mileage.toLocaleString()} km</option>`
                    );
                });

          
                UserIntrest.activeId = interestId;
            }
        },
        error: function (err) {
            console.error("Error updating interest:", err);
        }
    });
};

UserIntrest.loadStockAuctionHouse = function () {
    $.ajax({
        url: path + "/dashboard/stockAuctionHouse",
        dataType: "json",
        success: function (response) {
            const container = $("#stockAuctionHouse");

            if (container.find(".chart-container").length === 0) {
                container.find(".chart").wrap('<div class="chart-container"></div>');
            }

            const chartContainer = container.find(".chart-container");
            const ctx = container.find(".chart")[0].getContext("2d");

            chartContainer.css({
                width: "100%",
                overflowX: "auto",
                overflowY: "auto",
                borderRadius: "10px",
                padding: "10px 15px",
            });

            // Filter out items with interest <= 0 and trim labels
            const filteredData = response.values
                .map((v, i) => ({
                    ...v,
                    label: response.labels[i].trim(),
                    color: response.colors[i],
                    ratio: response.ratios[i]
                }))
                .filter(item => item.interest > 0);

            // Labels, values, colors, ratios
            const labels = filteredData.map(item => item.label);
            const values = filteredData.map(item => item.interest);
            const colors = filteredData.map(item => item.color);
            const ratios = filteredData.map(item => item.ratio);

            // Dynamic height
            const dynamicHeight = Math.min(labels.length * 55, 500);
            chartContainer.css("height", dynamicHeight + "px");

            // Destroy old chart
            if (stockAuctionChartInstance) stockAuctionChartInstance.destroy();

            // Create Chart
            stockAuctionChartInstance = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: labels,
                    datasets: [{
                        label: "Interest Vehicles",
                        data: values,
                        backgroundColor: colors,
                        borderRadius: 6,
                        barThickness: 24,
                        categoryPercentage: 0.8,
                        barPercentage: 0.7,
                    }],
                },
                options: {
                    indexAxis: "y",
                    responsive: true,
                    maintainAspectRatio: false,
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
                                title: ctx => labels[ctx[0].dataIndex],
                                label: ctx => {
                                    const idx = ctx.dataIndex;
                                    return `Interest/Total: ${values[idx]}/${filteredData[idx].total} (${ratios[idx]}%)`;
                                },
                            },
                        },
                        datalabels: {
                            anchor: "end",      
                            align: "end", 
                            color: "#fff",
                            font: { weight: "bold", size: 13 },
                            formatter: (value, ctx) => {
                                const idx = ctx.dataIndex;
                                return `${values[idx]}/${filteredData[idx].total}`;
                            },
                        },
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            grid: { color: "#2a2a2a", borderColor: "#2a2a2a" },
                            ticks: {
                                color: "#bbb",
                                font: { size: 12 },
                                callback: v => v.toLocaleString(),
                            },
                        },
                        y: {
                            display: false,
                            grid: { display: false },
                            ticks: { display: false },
                        },
                    },
                    layout: { padding: { left: 10, right: 20, top: 10, bottom: 10 } },
                    animation: { duration: 700, easing: "easeOutCubic" },
                },
                plugins: [ChartDataLabels],
            });

            // Legend (2-column grid)
            const legendContainer = $("#chats_color");
            legendContainer.empty(); 
            legendContainer.css({
                display: "grid",
                gridTemplateColumns: "repeat(2, 1fr)",
                gap: "6px 15px"
            });

            filteredData.forEach(item => {
                const legendItem = $(`
                    <div style="display:flex; align-items:center; gap:6px; white-space:nowrap;">
                        <div style="width:20px; height:20px; background-color:${item.color}; border-radius:4px;"></div>
                        <div style="color:#fff; font-size:13px;">${item.label}</div>
                    </div>
                `);
                legendContainer.append(legendItem);
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
    const selectedMileage = $('#mileageFilter').val();

    $.ajax({
        url: path + "/dashboard/gettopheaderintrest",
        type: "GET",
        data: {
            id: interestId,
            year: selectedYear,
            grade: selectedGrade,
            mileage: selectedMileage
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
                $('#totalVehicles').text(stats.total_vehicles);
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

$(document).on('click', '#interest-buttons-wrapper .interest-button', function() {
    const $button = $(this);
    const interestId = $button.data('id');

    UserIntrest.updateInterest(interestId, $button);
    UserIntrest.topheader(interestId);
});


$('#yearFilter, #gradeFilter, #mileageFilter').on('change', function () {
    const interestId = UserIntrest.activeId;
    if (!interestId) return console.warn("⚠️ No active interest selected.");
    UserIntrest.updateInterest(interestId);
});

$(document).ready(function () {
    UserIntrest.loadStockAuctionHouse();
});