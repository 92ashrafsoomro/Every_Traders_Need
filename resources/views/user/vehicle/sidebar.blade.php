    {{-- Sidebar Filters --}}
    <div id="sidebar-container" style="position: relative; display: flex;">
        <div id="filtersSidebar" class="filters-sidebar border-end text-white py-3"
            style="background-color: #0f1c2c; width: 281px; z-index: 1; transition: transform 0.3s ease;">

            {{-- 
            <p id="toggleSidebarBtn" style="position: absolute; top: 20px; left: 285px; z-index: 2; cursor: pointer;">
                <span class="material-symbols-outlined">
                    dehaze
                </span>
            </p> --}}

            <div class="d-flex justify-content-between align-items-center pt-7 px-3">
                <span class="mb-0" style=" font-size: 15px">Filters</span>
                <div style="display: flex; justify-content: center; align-items: center;">
                    <span class="total_count"
                        style="
                                font-size: 14px; 
                                font-weight: 600; 
                                color: #fff; 
                                background: #0080FF; 
                                padding: 6px 14px; 
                                border-radius: 5px;
                                box-shadow: 0 4px 12px rgba(0,0,0,0.25);
                                text-align: center;
                                transition: transform 0.3s ease, box-shadow 0.3s ease;
                            ">
                        0
                    </span>
                </div>



                <a href="{{ URL::to('/auction-finder/' . $vehicle->id) }}" class="btn"
                    style="text-decoration: underline; text-decoration-color: #07509a; font-size: 15px; margin-right: -20px;">Clear
                    All</a>
            </div>

            {{-- Example: Platform Filter --}}
            <div class="d-flex px-3">
                <div style="width: 50%;" class="">
                    <select id="date_range" name="date_range" class="form-select">
                        <option selected value="">All</option>
                        <option value="future">Future</option>
                        <option value="previous">Previous</option>
                    </select>
                </div>
                <div style="width: 50%;" class="">
                    <select class="form-control platform" name="platform_ids"></select>
                </div>

            </div>

            {{-- Vehicle List --}}
            <div class="vehicle-list mt-4" style="height: 90vh; overflow-y: scroll;">
                <div class="form-group mt-4">
                </div>
            </div>
        </div>
    </div>
    <script>
        // Optional: Start with sidebar visible
        document.getElementById("filtersSidebar").style.transform = "translateX(0)";
    </script>
