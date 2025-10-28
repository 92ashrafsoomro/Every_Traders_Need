<div class="d-flex flex-wrap flex-lg-nowrap gap-4 pt-0">
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

<!-- ✅ Internal CSS for mobile responsiveness -->
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
</style>
