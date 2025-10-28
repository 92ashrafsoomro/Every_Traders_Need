{{-- Vehicle Valuation --}}
<style>
    .valuation-container {
        min-height: 100vh;
        padding: 20px;
    }

    .valuation-card {
        background: #000F21;
        border: 1px solid #2a3050;
        border-radius: 12px;
        padding: 20px;
        height: 100%;
    }

    .autoBoli-suggestion .upperPart-suggestion {
        background-color: #0080FF !important;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
        padding: 20px 30px;
    }

    .autoBoli-suggestion .lowerPart-suggestion {
        background: #011E3D;
        border-bottom-left-radius: 8px;
        border-bottom-right-radius: 8px;
        padding: 10px 30px;
    }

    .autoBoli-suggestion h6 {
        color: #0e1b2b !important;
        font-weight: 600 !important;
    }

    .vehicle-img {
        overflow: auto;
        object-fit: cover;
        border-radius: 4px;
        background: #1a1f3a;
    }

    @media (max-width: 992px) {
        .valuation-container {
            padding: 20px;
        }
    }

    @media (max-width: 768px) {
        .valuation-container .row>div {
            margin-bottom: 20px;
        }
    }



    /* AccuracyBar Div */
    .accuracy-label {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 14px;
        margin-bottom: 6px;
        color: #b9c1d2;
    }

    .progress {
        background-color: #1a2634;
        height: 50px;
        /* 🔥 Increased height */
        border-radius: 10px;
        overflow: hidden;
        display: flex;
        justify-content: flex-start;
        border: 1px solid #343E4B;
    }

    .progress-bar {
        background-color: #007bff;
        width: 90%;
        height: 100%;
        border-radius: 10px !important;
    }

    .percentDiv {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .percentDiv p {
        font-size: 13px;
        margin: 0;
        color: #CED4DD;
    }

    .percent-box {
        background-color: #740711;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        width: 65px;
        font-size: 12px;
        padding: 4px 6px;
        white-space: nowrap;
    }

    .percent-box span {
        font-size: 14px;
        color: red;
        padding-right: 3px;
    }

    .tradeValues>.col-6 {
        margin-bottom: 45px;
    }

    .headingVehicleValues {
        display: flex;
        align-items: center;
        gap: 8px;
        /* space between line and text */
        margin-bottom: 1rem;
    }

    .headingVehicleValues .line {
        width: 5px;
        height: 20px;
        background-color: #740711;
        /* red theme color */
        border-radius: 2px;
    }

    .headingVehicleValues h3 {
        font-weight: 600;
        font-size: 1rem;
        margin: 0;
    }

    .auctionHousespan {
        background-color: #0C3056;
        padding: 4px
    }



    .trade-body .price {
        font-size: 32px;
        font-weight: bold;
        margin: 0;
        color: white;
    }

    .trade-body .avg-text {
        font-size: 13px;
        color: #bbb;
        margin-bottom: 10px;
    }

    .compare-title {
        font-size: 12px;
        color: #999;
        margin-bottom: 6px;
    }

    .compare-list label {
        display: block;
        font-size: 13px;
        color: #aaa;
        margin-bottom: 4px;
    }

    .compare-list input[type="checkbox"] {
        margin-right: 6px;
        accent-color: #1d4ed8;
    }

    .dropdown-select {
        background-color: #0e1b32;
        color: #fff;
        border: 1px solid #2e3b55;
        border-radius: 6px;
        padding: 4px 10px;
        font-size: 13px;
    }

    .chart-area {
        background: linear-gradient(to bottom right, #112240, #0e1b32);
        border-radius: 8px;
        height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #3b82f6;
        font-size: 14px;
    }
</style>

<div class="container valuation-container" style="margin-top: 10px;">
    <div class="row g-4">
        <!-- Left Column -->
        <div class="col-lg-4 col-md-6">
            <div class="d-flex flex-column h-100 justify-content-between">

                <!-- Autoboli Suggestion -->
                <div class="autoBoli-suggestion mb-4">
                    <div class="upperPart-suggestion">
                        <h6 style="margin-top: 5px;">AUTOBOLI SUGGESTION</h6>
                        <div class="d-flex align-items-baseline gap-2 mb-3">
                            <span class="fs-2 fw-bold" style="color: white;">£14,000</span>
                            <span class="badge text-success"
                                style="color: white; background-color: #000F21;">+5.6%</span>
                            <small class="text-dark opacity-75" style="color: #0e1b2b !important;">From last
                                month</small>
                        </div>
                    </div>
                    <div class="lowerPart-suggestion">
                        <p class="small text-white mb-0">
                            Our price estimates use historical auction data and market trends to suggest likely values.
                            <a href="#" class="text-white text-decoration-underline">Learn more</a>
                        </p>
                    </div>
                </div>

                <!-- Vehicle Values -->
                <div class="valuation-card">
                    <h3 class="fs-6 fw-semibold mb-3">Vehicle Values</h3>

                    <div class="mb-3 border-bottom pb-3">
                        <div class="headingVehicleValues">
                            <div class="line"></div>
                            <h3>Trade Values</h3>
                        </div>
                        <div class="row tradeValues">
                            <div class="col-6">
                                <div>
                                    <small class="text-secondary d-block">Autotrader</small>
                                    <span class="fw-bold fs-5" s>£14,000</span>
                                </div>

                                <div class="percentDiv">
                                    <div class="percent-box">
                                        <span class="material-symbols-outlined">keyboard_control_key</span>
                                        5.6 %
                                    </div>
                                    <p>From Last Month</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div>
                                    <small class="text-secondary d-block">CAP</small>
                                    <span class="fw-bold fs-5">£14,000</span>
                                </div>

                                <div class="percentDiv">
                                    <div class="percent-box">
                                        <span class="material-symbols-outlined">keyboard_control_key</span>
                                        5.6 %
                                    </div>
                                    <p>From Last Month</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div>
                                    <small class="text-secondary d-block">Autotrader</small>
                                    <span class="fw-bold fs-5" s>£14,000</span>
                                </div>

                                <div class="percentDiv">
                                    <div class="percent-box">
                                        <span class="material-symbols-outlined">keyboard_control_key</span>
                                        5.6 %
                                    </div>
                                    <p>From Last Month</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div>
                                    <small class="text-secondary d-block">CAP</small>
                                    <span class="fw-bold fs-5">£14,000</span>
                                </div>

                                <div class="percentDiv">
                                    <div class="percent-box">
                                        <span class="material-symbols-outlined">keyboard_control_key</span>
                                        5.6 %
                                    </div>
                                    <p>From Last Month</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="headingVehicleValues">
                        <div class="line"></div>
                        <h3>Retail Values</h3>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div>
                                <small class="text-secondary d-block">Autotrader</small>
                                <span class="fw-bold fs-5">£14,000</span>
                            </div>
                            <div class="percentDiv">
                                <div class="percent-box">
                                    <span class="material-symbols-outlined">keyboard_control_key</span>
                                    5.6 %
                                </div>
                                <p>From Last Month</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <small class="text-secondary d-block">CAP</small>
                                <span class="fw-bold fs-5">£14,000</span>
                            </div>
                            <div class="percentDiv">
                                <div class="percent-box">
                                    <span class="material-symbols-outlined">keyboard_control_key</span>
                                    5.6 %
                                </div>
                                <p>From Last Month</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Center Column -->
        <div class="col-lg-4 col-md-6">
            <div class="valuation-card d-flex flex-column">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="fs-5 fw-bold mb-2"
                        style="background-color: white !important; color: black; width: 100px; font-size: 12px !important;  border-radius: 4px; text-align: center; padding: 7px; border-left:4px solid #0080FF; margin-bottom: 5px !important;">
                        {{ $vehicle->reg ?? 'N/A' }}</div>
                    <a class="btn btn-sm btn-primary fw-semibold" href={{ $vehicle->inspection_report }}
                        style="white-space: nowrap;">
                        Inspection Report</a>
                </div>

                {{-- Desktop Screen Heading Display --}}
                <h5 class="vehicleHeadingh5 text-secondary mb-0 d-none d-lg-block"
                    style="color: white !important; white-space: nowrap; font-weight: 600; margin-top: 8px !important; margin-bottom: 12px !important;">
                    {{ $vehicle->make->name ?? 'Make' }} -
                    {{ $vehicle->model->name ?? 'Model' }} -
                    {{ $vehicle->variant->name ?? 'Variant' }} -
                    {{ $vehicle->engine_cc ?? 'CC' }} -
                    {{ $vehicle->year ?? 'Year' }}
                </h5>

                {{-- Mobile Screen Heading Display --}}
                <h6 class="vehicleHeadingh6 text-secondary mb-0 d-block d-lg-none"
                    style="color: white !important; white-space: nowrap; font-weight: 600; margin-top: 8px !important; margin-bottom: 12px !important;">
                    {{ $vehicle->make->name ?? 'Make' }} -
                    {{ $vehicle->model->name ?? 'Model' }} -
                    {{ $vehicle->variant->name ?? 'Variant' }} -
                    {{ $vehicle->engine_cc ?? 'CC' }} -
                    {{ $vehicle->year ?? 'Year' }}
                </h6>


                <div class="row small  text-secondary"
                    style="background-color:#0F1C2C; border-left: 4px solid #0080FF; padding: 10px; margin-left: 1px; margin-right: 5px;">
                    <div class="col-4">
                        <span class="d-block" style="margin-bottom: 10px !important;">Auction House</span>
                        <span class="text-white auctionHousespan">{{ $vehicle->auction->name ?? 'N/A' }}</span>
                    </div>
                    <div class="col-4">
                        <span class="d-block" style="margin-bottom: 10px !important;">Date/End</span>
                        <span class="text-white">
                            {{ $vehicle->auction->auction_date ? \Carbon\Carbon::parse($vehicle->auction->auction_date)->format('d/m/Y H:i') : 'N/A' }}
                        </span>
                    </div>
                    <div class="col-4">
                        <span class="d-block" style="margin-bottom: 10px !important;">Status</span>
                        <span class="text-white">{{ $vehicle->bidding_status ?? 'Planned/Sold' }}</span>
                    </div>
                </div>

                <div class="text-center d-flex align-items-center justify-content-end mt-4">
                    @php $mainImage = $vehicle->getImages()[0] ?? null; @endphp
                    @if ($mainImage)
                        <img src="{{ $mainImage }}" class="vehicle-img" alt="Vehicle">
                    @else
                        <span>No Image Available</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="col-lg-4 col-md-12">
            <div class="d-flex flex-column h-100 justify-content-between">

                <!-- Autoboli Predicted -->
                <div class="valuation-card mb-4" style="padding: 0px !important;">
                    <div
                        style="background-color: #011E3D; padding: 20px;  border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;">
                        <h5>Autoboli Predicted</h5>
                        <div class="accuracy-container">
                            <div class="accuracy-label">
                                <span style="font-weight: 600; color: white;">Accuracy</span>
                                <span class="color: #0080FF; ">90%</span>
                            </div>
                            <div class="progress" style="padding: 0px!important;">
                                <div class="progress-bar"></div>
                            </div>
                        </div>
                    </div>
                    <div style="padding: 20px;">
                        <hr style="color: #343E4B; margin-top: 5px;">
                        <div class="d-flex justify-content-between align-items-center">
                            <p>CAP</p>
                            <p>90%</p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <p>AUTOTRADER</p>
                            <p>90%</p>
                        </div>
                    </div>
                </div>

                <!-- Auction Results -->
                <div class="valuation-card">
                    <span class="fs-6 mb-3"
                        style="font-weight: 500; font-size: 20px !important; color: #B1BFCD;">Auction Results</span>
                    <hr>
                    <div class="d-flex flex-column gap-2 small">
                        <div class="d-flex justify-content-between">
                            <span class="text-secondary" style="font-size: 15px;">Auction
                                Status</span>
                            <span class="fw-semibold">{{ $vehicle->bidding_status ?? 'N/A' }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-secondary" style="font-size: 15px;">Win Bid /
                                Last Bid</span>
                            <span class="fw-semibold">£{{ $vehicle->last_bid ?? 'N/A' }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-secondary" style="font-size: 15px;">No. ofBids</span>
                            <span class="fw-semibold">
                                @php
                                    $bids = [];
                                    if (!empty($vehicle->bidding_history)) {
                                        $raw = trim($vehicle->bidding_history, '[]');
                                        $raw = str_replace(["'", '"'], '', $raw);
                                        $bids = array_map('trim', explode(',', $raw));
                                    }
                                @endphp
                                {{ count($bids) }}
                            </span>
                        </div>

                        <hr>

                        <div>
                            <h4 class="fs-6 mb-1" style="#B1BFCD">Auc Bid History</h4>
                            @if (count($bids) > 0)
                                <p class="small mb-0" style="display: flex; flex-wrap: wrap; gap: 6px;">
                                    @foreach ($bids as $bid)
                                        <span
                                            style="
                color: #B1BFCD;
                background-color: #0F1C2C;
                border-radius: 4px;
                padding: 5px 8px;
                display: inline-block;
            ">
                                            {{ trim($bid) }}
                                        </span>
                                    @endforeach
                                </p>
                            @else
                                <p class="small text-secondary mb-0">No bids found</p>
                            @endif


                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="col-lg-8" style="margin-top: -1px;">
            <div class="valuation-card mt-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <p class="fs-6 mb-3" style="font-weight: 500; font-size: 20px !important; color: #B1BFCD;">Trade
                        History</p>
                    <select class="form-select form-select-sm border-secondary text-light w-auto">
                        <option>Select range</option>
                        <option>Last 3 months</option>
                        <option>Last 6 months</option>
                        <option>Last year</option>
                    </select>
                </div>

                <hr>

                <div class="row trade-body">
                    <div class="col-md-4">
                        <p class="price">£14,000</p>
                        <p class="avg-text">Avg winning</p>

                        <p class="compare-title">Compare with wing bids</p>
                        <div class="compare-list">
                            <label><input type="checkbox"> Autotrader</label>
                            <label><input type="checkbox"> CAP Clean</label>
                            <label><input type="checkbox" checked> <span style="color:#3b82f6;">CAP Avg</span></label>
                            <label><input type="checkbox"> CAP B</label>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="chart-area">
                            Chart Preview
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-12">
            <!-- Auction Results -->
            <div class="valuation-card">
                <span class="fs-6 mb-3" style="font-weight: 500; font-size: 20px !important; color: #B1BFCD;">Pre
                    Vehicals</span>
                <hr>
                <div class="col-lg-8">
                    <p style="font-size: 14px; ">Today</p>
                    <div class="d-flex align-items-center gap-3 mb-5">

                        <div style="width: 35px; height: 25px; border-radius: 4px; background-color: white;">
                        </div>
                        <div>ABC123</div>
                        <div style="background-color: #011E3D; color: white; border-radius: 4px; padding: 5px;">
                            Sold
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3 mb-5">

                        <div style="width: 35px; height: 25px; border-radius: 4px; background-color: white;">
                        </div>
                        <div>ABC123</div>
                        <div style="background-color: #011E3D; color: white; border-radius: 4px; padding: 5px;">
                            Sold
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3 mb-5">

                        <div style="width: 35px; height: 25px; border-radius: 4px; background-color: white;">
                        </div>
                        <div>ABC123</div>
                        <div style="background-color: #011E3D; color: white; border-radius: 4px; padding: 5px;">
                            Sold
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">

                </div>
            </div>
        </div>
    </div>
</div>

<!-- ✅ Optional: Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('tradChart').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'], // Example months
                datasets: [{
                        label: 'Autotrader',
                        data: [13000, 13500, 13800, 14000, 14500, 14700],
                        borderColor: '#0066ff',
                        backgroundColor: 'rgba(0,102,255,0.1)',
                        tension: 0.4,
                        fill: true,
                        borderWidth: 2
                    },
                    {
                        label: 'CAP Clean',
                        data: [12800, 13200, 13400, 13600, 13900, 14200],
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16,185,129,0.1)',
                        tension: 0.4,
                        fill: true,
                        borderWidth: 2
                    },
                    {
                        label: 'CAP Avg',
                        data: [12000, 12200, 12500, 12700, 13000, 13200],
                        borderColor: '#60a5fa',
                        backgroundColor: 'rgba(96,165,250,0.1)',
                        tension: 0.4,
                        fill: true,
                        borderWidth: 2
                    },
                    {
                        label: 'CAP B',
                        data: [11000, 11500, 11800, 12000, 12300, 12500],
                        borderColor: '#f59e0b',
                        backgroundColor: 'rgba(245,158,11,0.1)',
                        tension: 0.4,
                        fill: true,
                        borderWidth: 2
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: '#a0a9c9'
                        },
                        grid: {
                            color: '#1f2547'
                        }
                    },
                    y: {
                        ticks: {
                            color: '#a0a9c9',
                            callback: val => '£' + val.toLocaleString()
                        },
                        grid: {
                            color: '#1f2547'
                        }
                    }
                }
            }
        });
    });
</script> --}}
