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
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-radius: 10px;
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
                        <h4 class="fs-6 mb-2">Trad Values</h4>
                        <div class="row">
                            <div class="col-6">
                                <small class="text-secondary d-block">Autotrader</small>
                                <span class="fw-bold fs-5">£14,000</span>
                            </div>
                            <div class="col-6">
                                <small class="text-secondary d-block">CAP</small>
                                <span class="fw-bold fs-5">£14,000</span>
                            </div>
                        </div>
                    </div>

                    <h4 class="fs-6 mb-2">Retail Values</h4>
                    <div class="row">
                        <div class="col-6">
                            <small class="text-secondary d-block">Autotrader</small>
                            <span class="fw-bold fs-5">£14,000</span>
                        </div>
                        <div class="col-6">
                            <small class="text-secondary d-block">CAP</small>
                            <span class="fw-bold fs-5">£14,000</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Center Column -->
        <div class="col-lg-4 col-md-6">
            <div class="valuation-card d-flex flex-column">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h3 class="fs-5 fw-bold mb-1">{{ $vehicle->reg ?? 'N/A' }}</h3>
                        <h6 class="text-secondary mb-0" style="white-space: nowrap;">
                            {{ $vehicle->make->name ?? 'Make' }} -
                            {{ $vehicle->model->name ?? 'Model' }} -
                            {{ $vehicle->variant->name ?? 'Variant' }} -
                            {{ $vehicle->engine_cc ?? 'CC' }} -
                            {{ $vehicle->year ?? 'Year' }}
                        </h6>
                    </div>
                    <button class="btn btn-sm btn-primary fw-semibold" style="white-space: nowrap;">New Report</button>
                </div>

                <div class="row small  text-secondary"
                    style="background-color:#0F1C2C; border-left: 4px solid #0080FF; padding: 10px; margin-left: 1px; margin-right: 5px;">
                    <div class="col-4">
                        <span class="d-block" style="margin-bottom: 10px !important;">Auction House</span>
                        <span class="text-white">{{ $vehicle->auction->name ?? 'N/A' }}</span>
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

                <div>
                    <div class="rounded mb-3" style="height:300px;">
                        <canvas id="tradChart"></canvas>
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
