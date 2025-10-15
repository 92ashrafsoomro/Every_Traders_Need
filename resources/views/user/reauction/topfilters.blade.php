    <script src="https://cdn.tailwindcss.com"></script>


    <div class="relative w-full h-auto lg:h-[40vh] bg-[#000f21] overflow-hidden space-y-5">
        <div
            class="absolute inset-0 bg-[radial-gradient(#0080ff_1.5px,transparent_1.2px)] [background-size:16px_16px] opacity-25 pointer-events-none z-0">
        </div>
        <div class="relative z-10 container mx-auto pt-20">
            <h1 class="text-5xl font-bold text-white mb-4 text-left">Reauction</h1>
            <p class="text-lg text-gray-300 mx-auto text-left">
                Manage and view platform reauctions across all centers in one place.
            </p>
        </div>

        <div
            class="container mx-auto d-flex flex-column flex-md-row justify-content-start align-items-center gap-5 text-center text-md-start py-5">

            <!-- Stats Card -->
            <div class="stats-card text-white px-4 py-3 border rounded-4 shadow-sm text-center">
                <h3 class="display-5 fw-bold mb-1" id="vehicleCountToday">0</h3>
                <p class="mb-0 fs-6 text-muted">Today</p>
            </div>

            <!-- Platform and Center Info -->
            <div class="platform-info text-white">
                <!-- Platform Section -->
                <div class="d-flex align-items-center gap-3 mb-3">
                    <h6 class="mb-0 text-uppercase text-muted" style="letter-spacing: 0.5px;">Platform</h6>
                    <div class="platform-badges platforms-container d-flex flex-wrap gap-2"></div>
                </div>

                <!-- Center Section -->
                <div class="d-flex align-items-center gap-3">
                    <h6 class="mb-0 text-uppercase text-muted" style="letter-spacing: 0.5px;">Center</h6>
                    <div class="platform-badges centers-container d-flex flex-wrap gap-2"></div>
                </div>
            </div>

        </div>
    </div>
