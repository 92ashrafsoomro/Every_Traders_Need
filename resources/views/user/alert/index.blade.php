@extends('user.partial.app')
@push('title')
    Watchlist
@endpush
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --acsi-bg: #0f172a;
            --acsi-surface: #111827;
            --acsi-border: #223047;
            --acsi-foreground: #e5e7eb;
            --acsi-muted: #94a3b8;

            --acsi-accent: #0080ff;
            --acsi-accent-ink: #081523;
            --acsi-danger: #ff4d4f;

            --radius: 10px;
        }

        .acsi-theme .card,
        .acsi-theme .table-wrap {
            background: var(--acsi-surface);
            border: 1px solid var(--acsi-border);
            border-radius: var(--radius);
            transition: all 0.3s ease;
        }

        .acsi-theme .label-muted {
            color: var(--acsi-muted);
            font-size: 0.875rem;
        }

        .acsi-theme .nav-pills .nav-link {
            color: var(--acsi-muted);
            background: transparent;
            border-radius: 999px;
            padding: 0.375rem 0.875rem;
            border: 1px solid transparent;
            transition: all 0.3s ease;
            position: relative;
        }

        .acsi-theme .nav-pills .nav-link:hover {
            color: var(--acsi-accent);
        }

        .acsi-theme .nav-pills .nav-link.active {
            color: var(--acsi-accent);
            border-radius: 0;
        }

        .acsi-theme .nav-pills .nav-link.active::after {
            content: "";
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: var(--acsi-accent);
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .acsi-theme .form-select,
        .acsi-theme .form-control {
            color: var(--acsi-foreground);
            background: #0e1626;
            border: 1px solid var(--acsi-border);
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .acsi-theme .form-select:focus,
        .acsi-theme .form-control:focus {
            border-color: var(--acsi-accent);
            box-shadow: 0 0 0 .2rem rgba(0, 128, 255, 0.25);
        }

        .acsi-theme .table {
            color: var(--acsi-foreground);
            margin-bottom: 0;
        }

        .acsi-theme .table> :not(caption)>*>* {
            background: transparent !important;
            border-bottom: 1px solid var(--acsi-border);
            transition: background 0.3s ease;
        }

        .acsi-theme thead th {
            color: var(--acsi-muted);
            font-weight: 600;
            white-space: nowrap;
            background: #0e1626 !important;
        }

        .acsi-theme tbody tr:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .acsi-theme .cell-muted {
            color: var(--acsi-muted);
            font-size: .8125rem;
        }

        .acsi-theme .cell-price a,
        .acsi-theme .link-accent {
            color: var(--acsi-accent);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .acsi-theme .link-accent:hover,
        .acsi-theme .cell-price a:hover {
            text-decoration: underline;
        }

        .acsi-theme .chip {
            display: inline-block;
            padding: 0.125rem 0.5rem;
            border: 1px solid var(--acsi-border);
            border-radius: 999px;
            color: var(--acsi-foreground);
            background: #0e1626;
            font-size: .75rem;
            line-height: 1.25rem;
            transition: all 0.3s ease;
        }

        .acsi-theme .chip-accent {
            border-color: rgba(46, 168, 255, .35);
            background: rgba(46, 168, 255, .1);
            color: var(--acsi-accent);
        }

        .acsi-theme .chip-danger {
            border-color: rgba(255, 77, 79, .35);
            background: rgba(255, 77, 79, .08);
            color: var(--acsi-danger);
        }

        .acsi-theme .thumb {
            width: 48px;
            height: 36px;
            border-radius: 6px;
            background: #0e1626;
            border: 1px solid var(--acsi-border);
            transition: all 0.3s ease;
        }

        .acsi-theme .thumb:hover {
            transform: scale(1.05);
            border-color: var(--acsi-accent);
        }

        .acsi-theme .soft-sep {
            border-top: 1px solid var(--acsi-border);
        }

        .acsi-theme .fit {
            white-space: nowrap;
        }

        .expandable-row {
            position: relative;
            transition: all 0.3s ease;
        }

        .extra-content {
            display: none;
            margin-top: 10px;
            font-size: 14px;
            color: var(--acsi-foreground);
            background: rgba(0, 128, 255, 0.05);
            padding: 10px;
            border-radius: 8px;
        }

        .expandable-row.expanded .extra-content {
            display: block;
            animation: expandFade 0.3s ease forwards;
        }

        .modal-backdrop.show {
            opacity: 1 !important;
            background: var(--acsi-backdrop) !important;
            backdrop-filter: blur(8px) saturate(120%);
        }

        .modal-dialog {
            margin: 1.25rem auto;
        }

        .modal-content {
            background: transparent !important;
            border: 0 !important;
            box-shadow: none !important;
        }

        .close-btn-custom {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--acsi-surface);
            color: var(--acsi-foreground);
            border: 1px solid var(--acsi-border);
            box-shadow: var(--acsi-shadow);
            transition: all 160ms ease;
            font-size: 1.1rem;
            z-index: 10;
        }

        .close-btn-custom:hover,
        .close-btn-custom:focus {
            background: var(--acsi-accent);
            color: var(--acsi-accent-ink);
            transform: rotate(90deg) scale(1.1);
            box-shadow: 0 10px 26px rgba(0, 128, 255, 0.35);
        }

        .close-btn-custom:active {
            transform: scale(0.95);
        }


        #previewImage {
            border-radius: calc(var(--acsi-radius) + 0.25rem);
            border: 1px solid var(--acsi-border);
            box-shadow: var(--acsi-shadow);
            background: rgba(0, 0, 0, 0.2);
        }


        .nav-btn {
            width: 44px;
            height: 44px;
            border-radius: 9999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--acsi-surface);
            color: var(--acsi-foreground);
            border: 1px solid var(--acsi-border);
            box-shadow: var(--acsi-shadow);
            transition: background-color 160ms ease, color 160ms ease, transform 160ms ease, box-shadow 160ms ease;
        }

        .nav-btn:hover,
        .nav-btn:focus {
            background: var(--acsi-accent);
            color: var(--acsi-accent-ink);
            transform: translateY(-1px);
            box-shadow: 0 12px 28px rgba(0, 128, 255, 0.35);
        }

        .nav-btn:active {
            transform: translateY(0);
        }

        .modal-caption {
            color: var(--acsi-muted);
            font-size: 0.95rem;
        }

        .modal-body {
            position: relative;
        }

        @keyframes expandFade {
            0% {
                opacity: 0;
                transform: translateY(-5px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        #auction-table {
            border-radius: 90px !important;
        }

        .auction-tabs a {
            border: 1px solid var(--bs-border-color);
            background-color: var(--bs-paper-bg);
        }

        .auction-tabs .active {
            background: #0080ff;
        }

        .auction-tabs .active:hover {
            color: white !important;
        }

        .auction-tabs .active:focus {
            color: white !important;
        }
    </style>
@endsection
@section('content')
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- <main class="acsi-theme container-fluid py-4"> --}}
    <div class="relative w-full h-auto lg:h-[40vh] bg-[#000f21] overflow-hidden space-y-4">
        <div
            class="absolute inset-0 bg-[radial-gradient(#0080ff_1.5px,transparent_1.2px)] [background-size:16px_16px] opacity-25 pointer-events-none z-0">
        </div>
        <div class="relative z-10 container mx-auto pt-10">
            <h1 class="text-5xl font-bold text-white mb-4 text-left">Watched & Alerted</h1>
            <p class="text-lg text-gray-300 mx-auto text-left">
                Track recently watched and alerted vehicles — stay ahead of every auction opportunity
            </p>
            <div class="auction-tabs relative z-10 pt-5">
                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">

                    <ul class="nav flex-column flex-md-row gap-md-0 gap-2">
                        <li class="nav-item">
                            <a class="cursor-pointer display_type nav-link active" id="watchlist-tab" data-bs-toggle="tab"
                                data-bs-target="#watchlist" role="tab" aria-controls="watchlist" aria-selected="true">
                                Watchlist</a>
                        </li>
                        <li class="nav-item">
                            <a class="cursor-pointer display_type nav-link" id="alerts-tab" data-bs-toggle="tab"
                                data-bs-target="#alerts" role="tab" aria-controls="alerts" aria-selected="false"> Your
                                Alerts</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container mx-auto">
        <div
            class="flex flex-col lg:flex-row items-start lg:items-center justify-normal gap-2 lg:justify-between pt-5 !w-full">
            <div class="flex items-center w-full">
                <div class="hidden lg:flex items-center !justify-between lg:justify-normal gap-2">
                    <span class="label-muted ">Show Entries</span>
                    <select class="form-select entries-length" style="width: 90px;">
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="500">500</option>
                    </select>

                    <span id="entryCount" class="text-muted ms-2" style="font-size: 0.9rem;"></span>
                </div>
                <div>
                    <select id="year1" class="form-select year select2-filter">
                        <option value="">All Years</option>
                        @foreach ($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class=" flex justify-between lg:justify-end items-center gap-2 ">


                <div style="position: relative;" class="w-full">
                    <input type="text" id="reg_search" class="form-control form-control-sm"
                        placeholder="Search by Reg Number"
                        style="width: 200px; padding-left: 30px!important; padding: 10px; border-radius: 6px; color: #fff; border: 1px solid #2b3b4f;">
                    <span style="position: absolute; left: 8px; top: 50%; transform: translateY(-50%); color: #888;">
                        <i class="fas fa-search"></i>
                    </span>
                </div>

                <select
                    style="border: 1px solid #2b3b4f !important; padding: 9px 20px !important; background-color: #0f1c2c; border-radius: 6px; appearance: none;">
                    <option value="">Select Make</option>
                </select>

                <select
                    style="border: 1px solid #2b3b4f !important; padding: 9px 20px !important; background-color: #0f1c2c; border-radius: 6px; appearance: none;">
                    <option value="">Select Model</option>
                </select>

                {{-- <select id="make1" class=""
                    style="border: 1px solid #2b3b4f !important; padding: 10px 20px !important;">
                    <option value="">Select Make</option>
                </select>


                <select id="model1" class="" disabled>
                    <option value="">Select Model</option>
                </select> --}}


            </div>
        </div>


        <div class="py-5">
            <!-- Watchlist Table -->
            <section class="tab-pane fade show active card p-0 overflow-hidden" id="watchlist" role="tabpanel"
                aria-labelledby="watchlist-tab">
                <div class="table-responsive table-wrap">
                    <table class="table align-middle" id="auction-table">
                        <thead>
                            <tr>
                                <th style="width:28px"></th>
                                <th>Vehicle</th>
                                <th class="fit">Reg</th>
                                <th class="fit">Clean</th>
                                <th class="fit">Average</th>
                                <th class="fit">Below</th>
                                <th class="fit">Autotrader</th>
                                <th class="fit">Auction</th>
                                <th class="fit">Last Bid</th>
                                <th class="fit">AutoBoli</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>


                </div>
            </section>

            <!-- Alerts Table -->
            <section class="tab-pane fade card p-0 overflow-hidden" id="alerts" role="tabpanel"
                aria-labelledby="alerts-tab">
                <div class="table-responsive table-wrap">
                    <table class="table align-middle" id="alert-table">
                        <thead>
                            <tr>
                                <th style="width:28px"></th>
                                <th>Vehicle</th>
                                <th class="fit">Reg</th>
                                <th class="fit">Clean</th>
                                <th class="fit">Average</th>
                                <th class="fit">Below</th>
                                <th class="fit">Autotrader</th>
                                <th class="fit">Auction</th>
                                <th class="fit">Last Bid</th>
                                <th class="fit">AutoBoli</th>
                                <th class="fit">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </section>

        </div>

    </div>
    {{-- </main> --}}

    <div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-hidden="true" aria-modal="true" role="dialog"
        aria-labelledby="imagePreviewTitle">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">

                <h2 id="imagePreviewTitle" class="visually-hidden">Image Preview</h2>

                <!-- 🔹 Improved Close Button -->
                <button type="button" class="close-btn-custom position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"
                    aria-label="Close" title="Close preview">
                    <i class="fa-solid fa-xmark"></i>
                </button>

                <div class="modal-body text-center">
                    <img id="previewImage" src="/placeholder.svg" class="img-fluid" alt="Preview"
                        style="max-height:80vh; object-fit:contain;" />

                    <!-- 🔹 Prev Button -->
                    <button class="nav-btn position-absolute top-50 start-0 translate-middle-y prev-img" type="button"
                        aria-label="Previous image" title="Previous">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M15.41 7.41 14 6l-6 6 6 6 1.41-1.41L10.83 12z" />
                        </svg>
                    </button>

                    <!-- 🔹 Next Button -->
                    <button class="nav-btn position-absolute top-50 end-0 translate-middle-y next-img" type="button"
                        aria-label="Next image" title="Next">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M8.59 16.59 10 18l6-6-6-6-1.41 1.41L13.17 12z" />
                        </svg>
                    </button>

                    <div class="modal-caption mt-3"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @include('user.alert.script')
    <script>
        $('#auction-table, .alert-table').on('mouseenter', '.expandable-row', function() {
            $(this).addClass('expanded');
        });

        $('#auction-table, .alert-table').on('mouseleave', '.expandable-row', function() {
            $(this).removeClass('expanded');
        });

        $('#alerts-tab').on('click', function() {
            $('#auction-table').css("display", "none")
        });
        $('#watchlist-tab').on('click', function() {
            $('#auction-table').css("display", "block")

        });



        $(document).ready(function() {




            function formatDateTime(dateStr) {
                if (!dateStr) return '';
                const d = new Date(dateStr);
                const options = {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true
                };
                return d.toLocaleString('en-US', options);
            }

            function renderRow(a, isAlert = false) {
                let imagesHtml = '';
                if (a.vehicle.image) {
                    const images = a.vehicle.image.split(',');
                    images.slice(0, 4).forEach(imgUrl => {
                        imagesHtml += `<div class="thumb">
                    <img src="${imgUrl.trim()}" alt="vehicle" style="width:48px;height:36px;border-radius:6px;object-fit:cover;">
                </div>`;
                    });
                }

                let actionBtn = '';
                if (isAlert) {
                    actionBtn = `<td class="fit">
                                <button class="btn btn-sm btn-danger delete-btn" title="Delete Alert" data-id="${a.id}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>`;
                }

                return `
                    <tr class="expandable-row">
                        <td class="fit expand-btn">
                            <a href="{{ url('auction-finder/vehicle') }}/${a.vehicle.id}" 
                            target="_blank" 
                            title="View Vehicle">
                                <span class="material-symbols-outlined">
                                visibility
                                </span>
                            </a>
                        </td>
                        <td>
                            <div class="fw-semibold">${a.vehicle.vehicle}</div>
                            <div class="cell-muted">${a.vehicle.title ?? ''}</div>
                            <div class="extra-content">
                                <div class="extra-images d-flex gap-2 mt-2">${imagesHtml}</div>
                            </div>
                        </td>
                        <td>${a.vehicle.reg ?? '-'}</td>
                        <td>${a.vehicle.cap_clean ?? '-'}</td>
                        <td>${a.vehicle.cap_average ?? '-'}</td>
                        <td>${a.vehicle.cap_below ?? '-'}</td>
                        <td>${a.vehicle.autotrader_retail_value ?? '-'}</td>
                        <td class="fit"><span class="chip">${a.vehicle.auction.name ?? ''}</span></td>
                        <td class="fit">
                            <div>${formatDateTime(a.vehicle.auction.auction_date)}</div>
                            <div class="cell-muted">${a.vehicle.last_bid ?? ''}</div>
                        </td>
                        <td class="cell-price"><a href="#">0</a></td>
                        ${actionBtn}
                    </tr>`;
            }


            function loadTables() {
                let length = $('.entries-length').val() || 50;
                showLoader();
                $.ajax({
                    url: "{{ route('get.auction.data') }}",
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        make: $('#make1').val(),
                        model: $('#model1').val(),
                        year: $('.year').val(),
                        reg_search: $('#reg_search').val(),
                        length: length
                    },
                    success: function(res) {
                        hideLoader();
                        let auctionTbody = $('#auction-table tbody').empty();
                        let alertTbody = $('#alert-table tbody').empty();

                        if (res.auctionData.length === 0 && res.recentData.length === 0) {
                            auctionTbody.append(
                                '<tr><td colspan="10" class="text-center">No vehicles found</td></tr>'
                            );
                            alertTbody.append(
                                '<tr><td colspan="10" class="text-center">No vehicles found</td></tr>'
                            );
                            $('#entryCount').text('No entries found');
                            return;
                        }

                        res.recentData.forEach(a => auctionTbody.append(renderRow(a)));
                        res.auctionData.forEach(a => alertTbody.append(renderRow(a, true)));


                        let activeTab = $('.tab-pane.active').attr('id');
                        let count = activeTab === 'watchlist' ? res.recentData.length : res.auctionData
                            .length;
                        const selectedLength = $('.entries-length').val();

                        // $('#entryCount').text(`Showing ${count} of ${selectedLength} entries`);

                    },

                    error: function(err) {
                        console.error(err);
                        hideLoader();
                    }
                });
            }



            loadTables();


            $('#auction-table, .alert-table').on('click', '.expand-btn', function() {
                $(this).closest('tr').toggleClass('expanded');
            });

            $('#alert-table').on('click', '.delete-btn', function() {
                let btn = $(this);
                let alertId = btn.data('id');

                alertify.confirm(
                    'Delete Alert',
                    'Are you sure you want to delete this alert?',
                    function() {

                        $.ajax({
                            url: '{{ url('/viewhistory/alerts/') }}/' + alertId,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(res) {
                                btn.closest('tr').fadeOut(300, function() {
                                    $(this).remove();
                                });

                                alertify.notify('Alert deleted successfully!', 'success',
                                    5);
                            },
                            error: function(err) {
                                console.error(err);

                                alertify.notify('Failed to delete alert!', 'error', 5);
                            }
                        });
                    },
                    function() {

                        alertify.notify('Deletion cancelled', 'message', 3);
                    }
                );
            });






            $('#make1, #model1, .year').on('change', function() {
                showLoader();
                loadTables();
            });
            $('#reg_search').on('keyup', function() {

                loadTables();
            });

            $('.entries-length').on('change', function() {
                showLoader();
                loadTables();
            });

        });
    </script>
@endsection
