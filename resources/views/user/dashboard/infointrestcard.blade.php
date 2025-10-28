<div style="display:flex;gap:24px;flex-wrap:wrap;margin:0 auto;">
    <!-- Total Auctions Card -->
    <div
        style="background-color:#000F21;border:1px solid #2a3142;border-bottom:4px solid #0d6efd;border-radius:4px;padding:24px;flex:1;min-width:220px;transition:all 0.3s ease;">
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px;position:relative;">
            <div
                style="width:40px;height:40px;background-color:#003164;border-radius:8px;display:flex;align-items:center;justify-content:center;position:relative;">
                <div
                    style="content:'';width:30px;height:30px;background-color:#0d6efd;border-radius:50%;position:absolute;">
                </div>
            </div>
            <h4 style="font-size:28px;font-weight:700;color:#ffffff;margin:0;" id="totalAuctions">0</h4>
        </div>
        <p style="font-size:14px;color:#8b92a9;margin-bottom:12px;font-weight:500;">Total Auctions</p>
        <div style="display:flex;justify-content:space-between;align-items:center;font-size:13px;">
            <div style="display:flex;gap:6px;align-items:center;">
                <span style="color:#8b92a9;">Live Auctions:</span>
                <span style="color:#ffffff;font-weight:600;" id="onlineAuctions">0</span>
            </div>
            <div style="display:flex;gap:6px;align-items:center;">
                <span style="color:#8b92a9;">Time Auctions:</span>
                <span style="color:#ffffff;font-weight:600;" id="offlineAuctions">0</span>
            </div>
        </div>
    </div>

    <!-- Inprogress Auction Card -->
    <div
        style="background-color:#000F21;border:1px solid #2a3142;border-bottom:4px solid #0d6efd;border-radius:4px;padding:24px;flex:1;min-width:220px;transition:all 0.3s ease;position:relative;">
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px;position:relative;">
            <div
                style="width:40px;height:40px;background-color:#003164;border-radius:8px;display:flex;align-items:center;justify-content:center;position:relative;">
                <div
                    style="content:'';width:30px;height:30px;background-color:#0d6efd;border-radius:50%;position:absolute;">
                </div>
            </div>
            <h4 style="font-size:28px;font-weight:700;color:#ffffff;margin:0;" id="vehiclesInProgress">0</h4>
            <div
                style="position:absolute;top:0;right:0;background-color:#dc3545;color:white;padding:4px 12px;border-radius:4px;font-size:12px;font-weight:600;display:flex;align-items:center;gap:6px;">
                <div style="width:8px;height:8px;background-color:white;border-radius:50%;animation:pulse 2s infinite;">
                </div>LIVE
            </div>
        </div>
        <p style="font-size:14px;color:#8b92a9;margin-bottom:12px;font-weight:500;">Inprogress Auction</p>
        <div style="display:flex;justify-content:space-between;align-items:center;font-size:13px;">
            <div style="display:flex;gap:6px;align-items:center;">
                <span style="color:#8b92a9;">Vehicle:</span>
                <span style="color:#ffffff;font-weight:600;" id="totalVehicles">0</span>
            </div>
            <a href="{{ url('/auctionscheduler') }}"
                style="color:#0d6efd;text-decoration:none;font-weight:600;font-size:12px;cursor:pointer;transition:color 0.2s;">View</a>
        </div>
    </div>

    <!-- Total Vehicle Card -->
    <div
        style="background-color:#000F21;border:1px solid #2a3142;border-bottom:4px solid #0d6efd;border-radius:4px;padding:24px;flex:1;min-width:220px;transition:all 0.3s ease;">
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px;position:relative;">
            <div
                style="width:40px;height:40px;background-color:#003164;border-radius:8px;display:flex;align-items:center;justify-content:center;position:relative;">
                <div
                    style="content:'';width:30px;height:30px;background-color:#0d6efd;border-radius:50%;position:absolute;">
                </div>
            </div>
            <h4 style="font-size:28px;font-weight:700;color:#ffffff;margin:0;" id="totalVehicleshead">0</h4>
        </div>
        <p style="font-size:14px;color:#8b92a9;margin-bottom:12px;font-weight:500;">Total Vehicle</p>
        <div
            style="display:flex;justify-content:space-between;align-items:center;font-size:13px;flex-wrap:wrap;gap:6px;">
            <div style="display:flex;gap:6px;align-items:center;">
                <span style="color:#8b92a9;">Sold:</span>
                <span style="color:#ffffff;font-weight:600;" id="soldVehicles">0</span>
            </div>
            <div style="display:flex;gap:6px;align-items:center;">
                <span style="color:#8b92a9;">NotSold:</span>
                <span style="color:#ffffff;font-weight:600;" id="unsoldVehicles">0</span>
            </div>
            <a href="{{ url('/reauction') }}"
                style="color:#0d6efd;text-decoration:none;font-weight:600;font-size:12px;cursor:pointer;transition:color 0.2s;">View</a>
        </div>
    </div>

    <!-- Vehicle in Reauction Card -->
    <div
        style="background-color:#000F21;border:1px solid #2a3142;border-bottom:4px solid #0d6efd;border-radius:4px;padding:24px;flex:1;min-width:220px;transition:all 0.3s ease;">
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px;position:relative;">
            <div
                style="width:40px;height:40px;background-color:#003164;border-radius:8px;display:flex;align-items:center;justify-content:center;position:relative;">
                <div
                    style="content:'';width:30px;height:30px;background-color:#0d6efd;border-radius:50%;position:absolute;">
                </div>
            </div>
            <h4 style="font-size:28px;font-weight:700;color:#ffffff;margin:0;" id="vehiclesInReauction">0</h4>
        </div>
        <p style="font-size:14px;color:#8b92a9;margin-bottom:12px;font-weight:500;">Vehicle in reauction</p>
        <div style="display:flex;justify-content:space-between;align-items:center;font-size:13px;">
            <div style="display:flex;gap:6px;align-items:center;">
                <span style="color:#8b92a9;">Vehicle:</span>
                <span style="color:#ffffff;font-weight:600;" id="vehiclesInReauction">0</span>
            </div>
            <a href="{{ url('/auction-finder') }}"
                style="color:#0d6efd;text-decoration:none;font-weight:600;font-size:12px;cursor:pointer;transition:color 0.2s;">View</a>
        </div>
    </div>
</div>

<style>
    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.5;
        }
    }
</style>
{{-- <div class="d-flex flex-wrap flex-lg-nowrap gap-4 pt-0">
    <div class="auction-card" style="width: 30%;">
        <div class="card h-100" style="border-bottom: 4px solid var(--bs-primary)!important;">
            <div class="card-body pb-8">
                <div class="d-flex align-items-center mb-2">
                    <div class="avatar">
                        <div class="dot-box"
                            style="width: 40px;height: 40px; background-color: #003164; border-radius: 8px;display: flex;align-items: center;justify-content: center;margin-right: 10px;">
                            <div class="dot"
                                style="width: 30px;height: 30px;background-color: #0d6efd;border-radius: 50%;"></div>
                        </div>
                    </div>
                    <h4 class="mb-0 ms-2"><span class="total_auctions">0</span></h4>
                </div>
                <p class="mb-1">Total Auctions</p>
                <p class="mb-0">
                    <small class="text-body-secondary">Live Auctions:</small>
                    <span class="text-heading fw-medium me-2 online_auctions">0</span>
                    <small class="text-body-secondary ps-3">Time Auctions:</small>
                    <span class="text-heading fw-medium me-0 time_auctions">0</span>
                </p>
            </div>
        </div>
    </div>

    <div class="auction-card" style="width: 30%;">
        <div class="card h-100" style="border-bottom: 4px solid var(--bs-primary)!important;">
            <div class="card-body pb-8 position-relative">
                <div class="d-flex align-items-center mb-2">
                    <div class="avatar">
                        <div class="dot-box"
                            style="width: 40px;height: 40px; background-color: #003164; border-radius: 8px;display: flex;align-items: center;justify-content: center;margin-right: 10px;">
                            <div class="dot"
                                style="width: 30px;height: 30px;background-color: #0d6efd;border-radius: 50%;"></div>
                        </div>
                    </div>
                    <h4 class="mb-0 ms-3"><span class="inprogress_auctions"></span></h4>
                </div>
                <div
                    class="position-absolute top-0 end-0 bg-danger text-white px-2 py-1 rounded-end d-flex align-items-center gap-2">
                    <div style="width: 10px; height: 10px; border-radius: 50%; background: var(--bs-heading-color);">
                    </div>
                    <div>live</div>
                </div>
                <p class="mb-1">Inprogress Auctions</p>
                <div class="d-flex justify-content-between">
                    <div>
                        <small class="text-body-secondary">Vehicles:</small>
                        <span class="text-heading fw-medium me-2 inprogress_vehicles"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="auction-card" style="width: 30%;">
        <div class="card h-100" style="border-bottom: 4px solid var(--bs-primary)!important;">
            <div class="card-body pb-8">
                <div class="d-flex align-items-center mb-2">
                    <div class="avatar">
                        <div class="dot-box"
                            style="width: 40px;height: 40px; background-color: #003164; border-radius: 8px;display: flex;align-items: center;justify-content: center;margin-right: 10px;">
                            <div class="dot"
                                style="width: 30px;height: 30px;background-color: #0d6efd;border-radius: 50%;"></div>
                        </div>
                    </div>
                    <h4 class="mb-0 ms-3"><span class="total_vehicles"></span></h4>
                </div>
                <p class="mb-1">Total Vehicles</p>
                <div class="d-flex justify-content-between">
                    <div>
                        <small class="text-body-secondary">Sold:</small>
                        <span class="text-heading fw-medium me-2 sold_vehicles"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="auction-card" style="width: 30%;">
        <div class="card h-100" style="border-bottom: 4px solid var(--bs-primary)!important;">
            <div class="card-body pb-8">
                <div class="d-flex align-items-center mb-2">
                    <div class="avatar">
                        <div class="dot-box"
                            style="width: 40px;height: 40px; background-color: #003164; border-radius: 8px;display: flex;align-items: center;justify-content: center;margin-right: 10px;">
                            <div class="dot"
                                style="width: 30px;height: 30px;background-color: #0d6efd;border-radius: 50%;"></div>
                        </div>
                    </div>
                    <h4 class="mb-0 ms-3"><span class="duplicate_vehicles"></span></h4>
                </div>
                <p class="mb-1">Vehicle in Reauctions</p>
                <div class="d-flex justify-content-between">
                    <div>
                        <small class="text-body-secondary">Vehicle:</small>
                        <span class="text-heading fw-medium me-2 duplicate_vehicles"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media (max-width: 768px) {
        .d-flex.flex-lg-nowrap {
            flex-direction: column !important;
            gap: 1rem !important;
        }

        .auction-card {
            width: 100% !important;
        }
    }
</style> --}}
