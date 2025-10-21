@extends('user.partial.app')
@push('title')
    Vehicle
@endpush
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" /> --}}
    <style>
        .menu-button {
            display: none;
        }

        .form-label {
            padding-top: 18px;
            padding-bottom: 6px;
            font-size: 15px;
        }

        .ck-editor__editable {
            min-height: 300px !important;

        }

        .filter-sidebar {}

        .sider1 {

            margin: 10px;

        }

        .vehicle-list .show {
            background-color: var(--bs-navbar-bg);
        }

        .vehicle-list .btn1 {
            background-color: var(--bs-navbar-bg);
            border: none;
        }

        .vehicle-list .collapsed {
            background: #0f1c2c
        }

        .disc {
            color: white;
        }

        .sider {
            background-color: #0f1c2c !important;
        }

        .form-check-input {
            border: 2px solid #0d6efd;
            /* Bootstrap primary blue */
        }

        .form-check-input:checked {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .dot-box {
            width: 28px;
            height: 28px;
            background-color: #0f1c2c;
            /* Dark blue box */
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
        }

        .dotstats-box {
            width: 50px;
            height: 50px;
            /* background-color: #0A2E55; Dark blue box */
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
        }

        .dot {
            width: 14px;
            height: 14px;
            background-color: #0d6efd;
            /* Blue dot */
            border-radius: 50%;
            box-shadow: 0 0 6px rgba(13, 110, 253, 0.6);
            /* Optional glow */
        }

        .dotstats {
            width: 44px;
            height: 44px;
            background-color: #0d6efd;
            border-radius: 30%;

            /* box-shadow: 0px 0px 5px 12px #0a2e55;
                                                                                                                                                                                                        -webkit-box-shadow: 0px 0px 5px 12px #0a2e55;
                                                                                                                                                                                                        -moz-box-shadow: 0px 0px 5px 12px #0a2e55; */
        }

        .disc {
            color: #ffffff;
            /* Optional white text */
        }

        .service-list {
            list-style: none;
            padding-left: 0;
            margin-bottom: 1rem;
        }

        .service-title {
            font-weight: 600;
            color: #cccccc;
            margin-bottom: 0.3rem;
        }

        .active-tab {
            background-color: #1e3a8a !important;
            /* Tailwind blue-800 */
            border: 2px solid #3b82f6;
        }



        */ .nav-tabs .nav-link {
            background-color: transparent;
            border: none;
            color: var(--bs-heading-color);
            border-radius: 8px;
            box-shadow: none;
            margin-right: 5px;
            transition: 0.3s ease;
        }

        /* Your custom active style */
        .nav-tabs .nav-link.active {
            background-color: var(--bs-primary);
            color: var(--bs-heading-color) !important;
            border-radius: 8px;
            box-shadow: none;
        }

        /* Optional: Hover effect */
        .nav-tabs .nav-link:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        /* Optional: Remove tab bottom border */
        .nav-tabs {
            border-bottom: none;
        }

        #chart {
            max-width: 700px;
            margin: 30px auto;
        }


        .circle-checkbox {
            display: flex;
            align-items: center;
            position: relative;
            padding-left: 28px;
            margin-bottom: 10px;
            font-size: 14px;
            color: white;
            cursor: pointer;
        }

        .circle-checkbox input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .circle-checkbox .circle {
            position: absolute;
            left: 0;
            top: 2px;
            width: 16px;
            height: 16px;
            background-color: transparent;
            border: 2px solid var(--bs-border-color) !important;
            /* default border */
            border-radius: 6px;
            /* lightly rounded box */
            box-sizing: border-box;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* inner dot when checked */
        .circle-checkbox input:checked+.circle::after {
            content: "";
            width: 8px;
            height: 8px;
            background-color: #0d6efd;
            border-radius: 50%;
        }

        /* if checked, change outer border */
        .circle-checkbox input:checked+.circle {
            border-color: #0d6efd;
        }

        /* disabled style */
        .circle-checkbox.disabled {
            color: #6c757d;
            cursor: not-allowed;
        }


        /* My Css */
        #toggleNotificationBtn {
            background-color: #000f21;
            border: none;
            padding: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 10px
        }

        #toggleNotificationBtn span {
            color: #0080ff;
        }

        .sidebar {
            width: 281px;
            transition: width 0.3s ease;
            height: 100vh;
            position: fixed;
            z-index: 1000;
        }

        .sidebar.collapsed {
            width: 0;
            overflow: hidden;
        }

        .sidebar>* {
            opacity: 1;
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed>* {
            opacity: 0;
        }

        #ContentDiv {
            margin-left: 281px;
            transition: margin-left 0.3s ease;
            width: calc(100% - 281px);
        }

        #ContentDiv.sidebar-visible {
            margin-left: 0;
            width: 100%;
        }
    </style>
@endsection
@section('content')
    <div class="sider vehicle-detail-page" style="padding-left: 0px; padding-right: 14px">
        <div class="d-flex">
            <div id="sidebar" class="sidebar">
                @include('user.vehicle.sidebar')
            </div>
            <div class=" py-5 showblade-bg-img-dot " id="ContentDiv" style="width: 100%; ">
                <div class="d-flex justify-content-between align-items-center" style="padding-left: 60px;">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                        <li class="nav-item" role="presentation" style="margin-right: 10px;">
                            <button id="toggleSidebarBtn" class="btn btn-secondary" style="background-color: #0080ff;">
                                ☰
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                type="button" role="tab" aria-controls="home" aria-selected="true">
                                Vehicle Details
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                type="button" role="tab" aria-controls="profile" aria-selected="false">
                                Vehicle Valuation
                            </button>
                        </li>

                        {{-- <li class="nav-item" role="presentation">
                            <button class="nav-link" id="condition-tab" data-bs-toggle="tab" data-bs-target="#condition"
                                type="button" role="tab" aria-controls="condition" aria-selected="false">
                                Conditions
                            </button>
                        </li> --}}
                    </ul>

                    @if (!empty($notifiction) && $notifiction)
                        <button id="toggleNotificationBtn" data-noti-id="{{ $notifiction->id }}"
                            data-vehicle-id="{{ $vehicle->id }}" data-exists="true">
                            <span class="material-symbols-outlined">
                                notifications_active
                            </span>
                        </button>
                    @else
                        <button id="toggleNotificationBtn" data-noti-id="{{ $vehicle->id }}"
                            data-vehicle-id="{{ $vehicle->id }}" data-exists="false"> <span
                                class="material-symbols-outlined">
                                notifications_active
                            </span></button>
                    @endif




                </div>


                <div class="tab-content p-0" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div id="tabContent">
                            @include('user.vehicle.vehicle_details')
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        {{-- @include('user.vehicle.vehicle_valuation') --}}
                        @include('user.vehicle.vehicle_valuation2')
                    </div>
                    <div class="tab-pane fade" id="condition" role="tabpanel" aria-labelledby="condition-tab">
                        @include('user.vehicle.vehicle_valuation')
                        {{-- @include('user.vehicle.vehicle_conditions') --}}
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('user.vehicle.popup')
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function loadTabFromButton(button) {
            const url = button.getAttribute('data-url');

            fetch(url)
                .then(response => {
                    if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                    return response.text();
                })
                .then(html => {
                    document.getElementById('tabContent').innerHTML = html;

                    // Optional: toggle button styling
                    document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active-tab'));
                    button.classList.add('active-tab');
                })
                .catch(error => {
                    document.getElementById('tabContent').innerHTML =
                        `<p class="text-danger">Failed to load: ${error.message}</p>`;
                });
        }

        document.addEventListener("DOMContentLoaded", function() {
            const toggleBtn = document.getElementById('toggleSidebarBtn');
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('ContentDiv');

            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                content.classList.toggle('sidebar-visible');
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Swiper
            const swiper = new Swiper('.mySwiper', {
                slidesPerView: 4,
                spaceBetween: 10,
                breakpoints: {
                    640: {
                        slidesPerView: 5
                    },
                    768: {
                        slidesPerView: 6
                    },
                }
            });

            // Handle click on main image to open modal
            const mainImage = document.getElementById('mainImage');
            const modalImage = document.getElementById('modalImage');

            if (mainImage) {
                mainImage.addEventListener('click', function() {
                    if (modalImage) {
                        modalImage.src = this.src;
                    }
                });
            }

            // Image array and index for cycling
            const imageUrls = @json($vehicle->getImages());
            let currentMainIndex = 0;

            function cycleMainImage() {
                currentMainIndex = (currentMainIndex + 1) % imageUrls.length;
                if (mainImage && modalImage) {
                    mainImage.src = imageUrls[currentMainIndex];
                    modalImage.src = imageUrls[currentMainIndex];
                }
            }

            // Set main image on thumbnail click
            window.setMainImage = function(src) {
                if (mainImage && modalImage) {
                    mainImage.src = src;
                    modalImage.src = src;
                }
            };
        });
    </script>


    <script>
        $(function() {

            const filterSidebar = {
                el: $(".filters-sidebar"),
            };

            filterSidebar.load = function() {

                filterSidebar.el.find('.vehicle-list > div').html(`<p class="text-center">Loading..</p>`);

                $.ajax({
                    type: "get",
                    url: "{{ url('/auction-finder/data/getRelatedVehicle/') }}" + "/" +
                        "{{ $vehicle->id }}",
                    data: {
                        length: 15,
                        page: 1,
                        platform: filterSidebar.el.find('.platform').val(),
                        date_range: filterSidebar.el.find('#date_range').val(),
                    },
                    dataType: "json",
                    success: function(response) {

                        filterSidebar.el.find('.total_count').text(response.total);
                        filterSidebar.el.find('.vehicle-list > div').html('');

                        response.data.forEach(element => {

                            filterSidebar.el.find('.vehicle-list > div').append(`
                                <div class="vehicle-card mb-4 border-top" style="border-radius: 2px;">
                                <button type="button" class="btn btn1 btn-primary w-100 dropdown-toggle text-start  collapsed waves-effect waves-light" style="justify-content: space-between; font-weight: 300; border-color:#44485e; box-shadow: none;" data-bs-toggle="collapse" data-bs-target="#vehicle-${element.id}" aria-controls="vehicle-${element.id}">
                                    <div class="text-left"> 
                                        <div class="d-flex align-items-center gap-2">
                                            <!-- Vehicle Image -->
                                            <img src="${element.image}" alt="Vehicle Image" 
                                                style="width: 60px; height: 45px; object-fit: cover; border-radius: 6px;">

                                            <!-- Vehicle Info -->
                                            <div class="text-left"> 
                                                <p class="m-0" style="text-align: left; font-size: 15px;">${element.make_name} ${element.model_name}</p>
                                                <p class="m-0" style="text-align: left; font-size: 15px;">${element.price_symbol} ${element.price}</p>
                                            </div>
                                        </div>

                                    </div>
                                </button>
                            <a href="${element.id}">  
                                <div class="collapse" style="padding: 17px; padding-top: 0px;" id="vehicle-${element.id}">
                                <div class="">
                                    <div class="mb-2" style="  text-decoration: none;">
                                        <button type="button" class="pickup-badge btn border my-2 " style="font-size: 15px; background-color: var();border: 1px solid var(--bs-primary) !important; color: var(--bs-heading-color)">${element.platform_name}</button>
                                        <span class="ms-2">${element.date}</span>
                                        <span class="ms-2">${element.center_name}</span>
                                    </div>        
                                    
                                    </div> 
                            </div></a>
                            </div>`);
                        });

                    }
                });

            }

            filterSidebar.el.find('.platform').change(() => {
                filterSidebar.load();
            });

            filterSidebar.el.find('#date_range').change(() => {
                filterSidebar.load();
            });


            filterSidebar.load();

        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Swiper
            const swiper = new Swiper('.mySwiper', {
                slidesPerView: 4,
                spaceBetween: 10,
                breakpoints: {
                    640: {
                        slidesPerView: 5
                    },
                    768: {
                        slidesPerView: 6
                    },
                }
            });

            // Handle click on main image to open modal
            const mainImage = document.getElementById('mainImage');
            const modalImage = document.getElementById('modalImage');

            if (mainImage) {
                mainImage.addEventListener('click', function() {
                    if (modalImage) {
                        modalImage.src = this.src;
                    }
                });
            }

            // Image array and index for cycling
            const imageUrls = @json($vehicle->getImages());
            let currentMainIndex = 0;

            function cycleMainImage() {
                currentMainIndex = (currentMainIndex + 1) % imageUrls.length;
                if (mainImage && modalImage) {
                    mainImage.src = imageUrls[currentMainIndex];
                    modalImage.src = imageUrls[currentMainIndex];
                }
            }

            // Set main image on thumbnail click
            window.setMainImage = function(src) {
                if (mainImage && modalImage) {
                    mainImage.src = src;
                    modalImage.src = src;
                }
            };
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.menu-button').trigger('click');
        });
    </script>

    <script>
        let currentMainIndex = 0;
        const mainImage = document.getElementById('mainImage');
        const imageUrls = @json($vehicle->getImages());

        document.getElementById('mainImage')?.addEventListener('click', function() {
            document.getElementById('modalImage').src = this.src;
        });

        function changeMainImage(src) {
            document.getElementById('mainImage').src = src;
            document.getElementById('modalImage').src = src;

        }

        function cycleMainImage() {
            currentMainIndex = (currentMainIndex + 1) % imageUrls.length;
            mainImage.src = imageUrls[currentMainIndex];
            openModalSwiper(currentMainIndex);
        }


        function setMainImage(imageUrl) {
            const mainImage = document.getElementById('mainImage');
            mainImage.src = imageUrl;
        }
    </script>




    <script>
        const trade_history_graph = {
            el: $('.trade_history_graph'),
        };


        trade_history_graph.getTrade = function() {


            $.ajax({
                type: "GET",
                url: "{{ url('/auction-finder/getPlatformVehicle') }}",
                data: {
                    platform_id: trade_history_graph.el.find('.platform').val()
                },
                dataType: "json",
                success: function(response) {


                    console.log(response);

                    const options = {
                        chart: {
                            type: 'area',
                            height: 350,
                            background: '#0b1d2a',
                            toolbar: {
                                show: false
                            }
                        },
                        colors: response.colors,
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: 'smooth',
                            width: 2
                        },
                        series: response.data,
                        xaxis: {
                            categories: ['Jan', 'Feb', 'Mar'],
                            labels: {
                                style: {
                                    colors: '#ccc'
                                }
                            }
                        },
                        yaxis: {
                            labels: {
                                formatter: val => `£${val.toLocaleString()}`,
                                style: {
                                    colors: '#ccc'
                                }
                            }
                        },
                        tooltip: {
                            theme: 'dark'
                        },
                        legend: {
                            position: 'top',
                            labels: {
                                colors: '#fff'
                            }
                        },
                        fill: {
                            type: 'gradient',
                            gradient: {
                                shade: 'dark',
                                opacityFrom: 0.5,
                                opacityTo: 0.2,
                            }
                        },
                        grid: {
                            borderColor: '#333'
                        }
                    };

                    const chart = new ApexCharts(trade_history_graph.el.find("#charts")[0], options);
                    chart.render();

                }
            });

        }


        trade_history_graph.el.find(".platform").change(function() {
            trade_history_graph.getTrade();
        });


        trade_history_graph.getTrade();
    </script>


    <script>
        // document.addEventListener('DOMContentLoaded', function() {

        // });


        // document.querySelector('.disclaimer-link').addEventListener('click', function(e) {

        // });
    </script>
    {{-- <button id="toggleNotificationBtn" data-vehicle-id="{{ $vehicle->id }}" data-exists="true" class="btn btn-sm btn-danger"> <i class="fa fa-bell text-secondary"></i></button> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $('#toggleNotificationBtn').on("click", function() {
            let btn = $(this);
            let vehicleId = btn.data('vehicle-id');
            let notiId = btn.data('noti-id');
            let exists = btn.data('exists');

            if (!exists) {
                // 🔔 ADD Notification
                $.ajax({
                    url: "{{ url('/notificationsstore') }}",
                    method: "POST",
                    data: {
                        auction_id: vehicleId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response.status === 'success');
                        if (response.status === 'success') {
                            toastr.success(response.message);


                            btn.data('exists', true);
                            btn.data('noti-id', response.id);
                            btn.removeClass('btn-primary').addClass('btn-danger');

                        } else {
                            toastr.warning(response.message);
                        }
                    },
                    error: function(err) {
                        console.error(err);
                        toastr.error('Something went wrong while adding notification.');
                    }
                });

            } else {

                $.ajax({
                    url: "{{ url('/viewhistory/alerts') }}/" + notiId,
                    type: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response.status);
                        if (response.message === "Alert deleted successfully") {
                            toastr.success('Notification deleted successfully');


                            btn.data('exists', false);
                            btn.data('noti-id', '');
                            btn.removeClass('btn-danger').addClass('btn-primary');

                        } else {
                            toastr.warning(response.message);
                        }
                    },
                    error: function(err) {
                        console.error(err);
                        toastr.error('Something went wrong while deleting notification.');
                    }
                });
            }
        });
    </script>


    <script>
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
    </script>


    <script>
        function loadVehicleDetails(vehicleId, regNum) {


            $('#vehicleModal .modal-body').html(`
        <div style="text-align:center;padding:40px;color:#a0aec0;">
            Loading vehicle details...
        </div>
    `);

            $.ajax({
                url: '{{ url('/auction-finder/vehicle/get-vehicle-details') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: vehicleId,
                    regnum: regNum
                },
                success: function(response) {
                    if (!response.status) {
                        $('#vehicleModal .modal-body').html(`
                    <p style="color:#dc2626;text-align:center;">${response.message}</p>
                `);
                        $('#vehicleModal').modal('show');
                        return;
                    }

                    const v = response.vehicle;
                    const prev = response.previous_vehicle;
                    const viewsCount = response.views;

                    const mileageDiff = v.mileage && prev?.mileage ?
                        v.mileage - prev.mileage :
                        0;
                    const mileageDiffHtml = mileageDiff > 0 ?
                        `<span style="color:#ff9500;">+${mileageDiff}</span>` :
                        `<span style="color:#10b981;">${mileageDiff}</span>`;


                    let vehicleInfo = `
                <div style="background-color:#1a2a42;border:1px solid #2a3a52;border-radius:8px;padding:16px;margin-bottom:24px;border-left:4px solid #0066ff;">
                    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;">
                        <div>
                            <span style="font-size:12px;color:#a0aec0;text-transform:uppercase;letter-spacing:0.5px;display:block;margin-bottom:4px;">Auction House</span>
                            <span style="font-size:16px;font-weight:600;color:#ffffff;">${v.platform_name ?? '—'}</span>
                        </div>

                        <div>
                            <span style="font-size:12px;color:#a0aec0;text-transform:uppercase;letter-spacing:0.5px;display:block;margin-bottom:4px;">Date Time / End</span>
                            <span style="font-size:16px;font-weight:600;color:#ffffff;">
                                ${v.auction_date ? v.auction_date : '—'}
                                <br><span style="font-size:12px;">${v.auction_end_time ?? '—'}</span>
                            </span>
                        </div>

                        <div>
                            <span style="font-size:12px;color:#a0aec0;text-transform:uppercase;letter-spacing:0.5px;display:block;margin-bottom:4px;">Auction Status</span>
                            <span style="font-size:16px;font-weight:600;color:#ff9500;">${v.auction_status ?? '—'}</span>
                        </div>

                        <div>
                            <span style="font-size:12px;color:#a0aec0;text-transform:uppercase;letter-spacing:0.5px;display:block;margin-bottom:4px;">Previous Auction</span>
                            <span style="font-size:16px;font-weight:600;color:#ffffff;">${prev ? "Before " + getDaysDiff(prev.auction_date, v.auction_date) + " Days" : "—"}</span>
                        </div>

                        <div>
                            <span style="font-size:12px;color:#a0aec0;text-transform:uppercase;letter-spacing:0.5px;display:block;margin-bottom:4px;">Mileage</span>
                            <span style="font-size:16px;font-weight:600;color:#ffffff;">
                                ${v.mileage ?? '—'} ${mileageDiffHtml}
                            </span>
                        </div>

                        <div>
                            <span style="font-size:12px;color:#a0aec0;text-transform:uppercase;letter-spacing:0.5px;display:block;margin-bottom:4px;">Grade</span>
                            <span style="background-color:#dc2626;color:#fff;padding:4px 8px;border-radius:4px;display:inline-block;">
                                ${v.grade ?? '—'}
                            </span>
                        </div>

                        <div>
                            <span style="font-size:12px;color:#a0aec0;text-transform:uppercase;letter-spacing:0.5px;display:block;margin-bottom:4px;">Last Service</span>
                            <span style="font-size:16px;font-weight:600;color:#ffffff;">${v.last_service ?? '—'}</span>
                        </div>

                        <div>
                            <span style="font-size:12px;color:#a0aec0;text-transform:uppercase;letter-spacing:0.5px;display:block;margin-bottom:4px;">MOT Expiry</span>
                            <span style="font-size:16px;font-weight:600;color:#ffffff;">${v.mot_expiry_date ?? '—'}</span>
                        </div>
                    </div>
                </div>
            `;


                    let preAucTable = '';
                    if (prev && prev.length > 0) {
                        let rows = '';

                        prev.forEach(item => {
                            rows += `
                        <tr style="border-bottom:1px solid #2a3a52;">
                            <td style="padding:12px 16px;">${item.auction_date ?? '—'}</td>
                            <td style="padding:12px 16px;">${item.auction_name ?? '—'}</td>
                            <td style="padding:12px 16px;">${item.cap_clean ?? '—'}</td>
                            <td style="padding:12px 16px;">${item.cap_average ?? '—'}</td>
                            <td style="padding:12px 16px;">${item.cap_below ?? '—'}</td>
                            <td style="padding:12px 16px;">${item.last_bid ?? '—'}</td>
                        </tr>
                    `;
                        });

                        preAucTable = `
                    <div style="margin-top:24px;">
                        <h3 style="font-size:18px;font-weight:700;margin-bottom:16px;color:#ffffff;">Pre Auc</h3>
                        <div style="border:1px solid #2a3a52;border-radius:8px;overflow:hidden;">
                            <table style="width:100%;border-collapse:collapse;background-color:#1a2a42;">
                                <thead style="background-color:#0f1f35;border-bottom:1px solid #2a3a52;">
                                    <tr>
                                        <th style="padding:12px 16px;text-align:left;font-size:12px;font-weight:600;color:#a0aec0;text-transform:uppercase;">Date</th>
                                        <th style="padding:12px 16px;text-align:left;font-size:12px;font-weight:600;color:#a0aec0;text-transform:uppercase;">Auc House</th>
                                        <th style="padding:12px 16px;text-align:left;font-size:12px;font-weight:600;color:#a0aec0;text-transform:uppercase;">CAP C</th>
                                        <th style="padding:12px 16px;text-align:left;font-size:12px;font-weight:600;color:#a0aec0;text-transform:uppercase;">CAP Avg</th>
                                        <th style="padding:12px 16px;text-align:left;font-size:12px;font-weight:600;color:#a0aec0;text-transform:uppercase;">CAP B</th>
                                        <th style="padding:12px 16px;text-align:left;font-size:12px;font-weight:600;color:#a0aec0;text-transform:uppercase;">Last Bid</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${rows}
                                </tbody>
                            </table>
                        </div>
                    </div>
                `;
                    }

                    const headerTop = `
            <div style="display:flex;align-items:flex-start;gap:20px;">

                <!-- Badge -->
                <div style="background:linear-gradient(135deg,#0066ff,#1a7fff);
                            color:white;
                            padding:8px 14px;
                            border-radius:8px;
                            font-weight:700;
                            font-size:14px;
                            letter-spacing:0.5px;
                            box-shadow:0 0 10px rgba(0,102,255,0.5);">
                    ${v.reg}
                </div>

                <!-- Title and Actions -->
                <div>
                    <h2 style="font-size:26px;
                                font-weight:800;
                                margin-bottom:6px;
                                color:#ffffff;
                                text-shadow:0 1px 6px rgba(0,0,0,0.4);
                                line-height:1.3;">
                        ${v.make_name} ${v.model_name} ${v.variant_name}<br>
                        <span style="font-size:16px;font-weight:500;color:#a0aec0;">${v.cc} - ${v.year}</span>
                    </h2>

                    <div style="display:flex;align-items:center;gap:10px;margin-top:8px;">
                        <a href="${v.inspection_report}" target="_blank" style="background:linear-gradient(135deg,#0066ff,#1a7fff);
                                    color:white;
                                    border:none;
                                    padding:6px 14px;
                                    border-radius:6px;
                                    font-size:12px;
                                    font-weight:600;
                                    cursor:pointer;
                                    transition:0.3s;">
                            View Report
                        </a>
                        <span style="color:#a0aec0;font-size:14px;">👁️ ${viewsCount} Views</span>
                    </div>
                </div>
            </div>
              <button type="button" data-bs-dismiss="modal" aria-label="Close"
                style="background:none;
                        border:none;
                        color:#a0aec0;
                        font-size:22px;
                        cursor:pointer;
                        width:36px;
                        height:36px;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        border-radius:8px;
                        transition:0.3s;">
            ✕
        </button>
            `;
                    const riskmanagemnt = `
                <div style="background-color:rgba(220,38,38,0.15);border-left:4px solid #dc2626;padding:16px;border-radius:6px;margin-bottom:24px;">
          <h3 style="color:#dc2626;font-size:20px;font-weight:700;margin-bottom:8px;">Not Recommended</h3>
          <div style="display:flex;align-items:center;gap:8px;font-size:14px;">
            <span style="background-color:#dc2626;color:white;padding:4px 8px;border-radius:4px;font-weight:600;">75%</span>
            <span>Risk ratio</span>
          </div>
        </div>
            
            `;


                    let lastPrev = prev[prev.length - 1];

                    // Compare current vs previous
                    let AutotraderPrv = getValueDifferenceHTML(v.autotrader_retail_value, lastPrev
                        .autotrader_retail_value);
                    let cap_cleanPrv = getValueDifferenceHTML(v.cap_clean, lastPrev.cap_clean);
                    let cap_averagePrv = getValueDifferenceHTML(v.cap_average, lastPrev.cap_average);
                    let cap_belowPrv = getValueDifferenceHTML(v.cap_below, lastPrev.cap_below);
                    const pricingCards = `
                    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;margin-bottom:24px;">
                        <div style="background-color:#1a2a42;border:1px solid #2a3a52;border-radius:8px;padding:16px;">
                            <div style="font-size:12px;color:#a0aec0;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:8px;">Autotrader</div>
                            <div style="font-size:24px;font-weight:700;color:#ffffff;margin-bottom:8px;">${v.autotrader_retail_value ?? 0}</div>
                            ${ AutotraderPrv }
                        </div>
                        <div style="background-color:#1a2a42;border:1px solid #2a3a52;border-radius:8px;padding:16px;">
                            <div style="font-size:12px;color:#a0aec0;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:8px;">CAP C</div>
                            <div style="font-size:24px;font-weight:700;color:#ffffff;margin-bottom:8px;">${v.cap_clean}</div>
                            ${cap_cleanPrv}
                        </div>
                        <div style="background-color:#1a2a42;border:1px solid #2a3a52;border-radius:8px;padding:16px;">
                            <div style="font-size:12px;color:#a0aec0;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:8px;">CAP Average</div>
                            <div style="font-size:24px;font-weight:700;color:#ffffff;margin-bottom:8px;">${v.cap_average}</div>
                            ${cap_averagePrv}
                        </div>
                        <div style="background-color:#1a2a42;border:1px solid #2a3a52;border-radius:8px;padding:16px;">
                            <div style="font-size:12px;color:#a0aec0;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:8px;">CAP B</div>
                            <div style="font-size:24px;font-weight:700;color:#ffffff;margin-bottom:8px;">${v.cap_below}</div>
                            ${cap_belowPrv}
                        </div>
                        </div>
            
            `;
                    $('#vehicleModal .modal-header').html(headerTop);

                    $('#vehicleModal .modal-body').html(riskmanagemnt + vehicleInfo + pricingCards +
                        preAucTable);
                    $('#vehicleModal').modal('show');
                },
                error: function() {
                    $('#vehicleModal .modal-body').html(`
                <div style="text-align:center;padding:40px;color:#dc2626;">
                    ❌ Failed to load vehicle details.
                </div>
            `);
                    $('#vehicleModal').modal('show');
                }
            });
        }
        $(document).on('click', '#prvactionspopup', function() {
            const vehicleId = $(this).data('vehid');
            const regNum = $(this).data('regnum');
            loadVehicleDetails(vehicleId, regNum);
        });
        $(document).ready(function() {
            const urlParams = new URLSearchParams(window.location.search);

            if (urlParams.has('reg')) {
                // Automatically trigger click
                $('#prvactionspopup').trigger('click');
            }
        });

        function getDaysDiff(prevDate, currentDate) {
            if (!prevDate || !currentDate) return 0;
            const d1 = new Date(prevDate);
            const d2 = new Date(currentDate);
            const diff = Math.abs(d2 - d1);
            return Math.ceil(diff / (1000 * 60 * 60 * 24));
        }


        function getValueDifferenceHTML(current, previous) {

            const parseValue = (val) => {
                if (val === null || val === undefined) return null;
                if (typeof val === 'string') {
                    val = val.replace(/[£,\s]/g, '');
                }
                const num = parseFloat(val);
                return isNaN(num) ? null : num;
            };

            const curr = parseValue(current);
            const prev = parseValue(previous);


            if (curr === null || prev === null || prev === 0) {
                return `<div style="font-size:14px;color:#999;font-weight:600;">
      No change from previous value
    </div>`;
            }


            const diffPercent = ((curr - prev) / prev) * 100;

            if (diffPercent === 0) {
                return `<div style="font-size:14px;color:#999;font-weight:600;">
      No change from previous value
    </div>`;
            }

            const isUp = diffPercent > 0;
            const arrow = isUp ? '⬆' : '⬇';
            const color = isUp ? '#ff9500' : '#ff3b30';
            const formattedDiff = Math.abs(diffPercent).toFixed(1);

            return `
    <div style="font-size:14px;color:${color};font-weight:600;">
      ${arrow} ${formattedDiff}% From previous value
    </div>
  `;
        }
    </script>
@endsection
