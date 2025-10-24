@extends('user.partial.app')
@push('title')
    Reauction
@endpush
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .dropdown-menu {
            max-height: 300px;
            overflow-y: auto;
        }

        .form-label {
            font-weight: 500;
        }

        .table thead th {
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .table tbody td {
            font-size: 0.85rem;
        }

        @media (max-width: 768px) {
            .platform-badges {
                overflow-x: auto;
                flex-wrap: nowrap !important;
                /* Disable wrapping on mobile */
                white-space: nowrap;
                -webkit-overflow-scrolling: touch;
                max-width: 100vw;
                /* Prevent overflowing screen */
            }

            .platform-badges span {
                display: inline-block;
                margin-right: 0.5rem;
            }

            /* Prevent gap between h6 and scrollable content from breaking layout */
            .centers-container {
                flex-shrink: 1;
                min-width: 0;
            }
        }
    </style>
@endsection
@section('content')
    @include('user.reauction.topfilters')

    <div class="container mx-auto pt-4">
        <div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <!-- Filters -->
            <div class="flex flex-col md:flex-row items-start gap-2 md:gap-0 md:items-center justify-between w-full py-4">
                <div>
                    <div id="customLengthControl" class="my-length-control flex items-center gap-x-2">
                        <p>Show Entries</p>
                        <select id="myLengthSelect" name="length" class="p-2 rounded border border-[#2b3b4f]">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row gap-3 items-start md:items-center justify-end md:gap-x-3">
                    <div>
                        {{-- <select id="auctionSelector" class="form-select">
                            <option value="">Select Auction Date</option>
                        </select> --}}
                    </div>
                    <!-- Search Input -->
                    <div>
                        {{-- <label for="search" class="form-label">Search by Reg</label> --}}
                        <input type="text" name="search" class="form-control" style="border: 1px solid #2b3b4f;"
                            placeholder="Enter registration">
                    </div>

                    <!-- Interest Dropdown -->
                    <div>
                        {{-- <label class="form-label d-block">Select Interest</label> --}}
                        <div class="dropdown w-100">
                            <button class="btn dropdown-toggle w-100 text-start"
                                style="background-color: #0080ff !important; color: white !important;" type="button"
                                id="interestDropdownBtn" data-bs-toggle="dropdown" aria-expanded="false">
                                Select Interest
                            </button>
                            <ul class="dropdown-menu w-100" aria-labelledby="interestDropdownBtn" id="interestDropdown">
                                <li><a class="dropdown-item" data-id="">Select Interest</a></li>
                               @forelse($interests as $interest)
                                    <li>
                                        <a class="dropdown-item" href="#" data-id="{{ $interest->id }}">
                                            {{ $interest->title }}
                                        </a>
                                    </li>
                                @empty
                                    <li><span class="dropdown-item text-muted">No interests found</span></li>
                                @endforelse
                            </ul>
                            <input type="hidden" id="selected_interest_id" value="">
                        </div>
                    </div>
                </div>
            </div>


            <div class="card shadow-sm rounded-3 border">
                <div class="card-body">
                    <!-- Table -->
                    <div class="table-responsive">
                        <table id="blogTable" class="table table-hover align-middle">
                            <thead class="text-nowrap">
                                <tr>
                                    <th>Vehicle</th>
                                    <th>Reg</th>
                                    <th>Previous</th>
                                    <th>Platform</th>
                                    <th>Center</th>
                                    <th>Cap Clean</th>
                                    <th>Cap Avg</th>
                                    <th>Mileage</th>
                                    <th>Status</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-nowrap">
                                <!-- Dynamically populated -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Previous Popup -->
                    @include('user.reauction.previouspopup')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {

            // Get today's date in Y-m-d
            function getTodayDate() {
                let today = new Date();
                let yyyy = today.getFullYear();
                let mm = String(today.getMonth() + 1).padStart(2, '0');
                let dd = String(today.getDate()).padStart(2, '0');
                return `${yyyy}-${mm}-${dd}`;
            }

            // Initialize default filter
            let defaultDate = getTodayDate();
            $('#auctionSelector').val(defaultDate).trigger('change');
            showLoader();
            let table = $('#blogTable').DataTable({
                processing: false,
                ordering: false,
                serverSide: true,
                lengthChange: false,
                ajax: {
                    url: "{{ url('/reauction') }}",
                    data: function(d) {
                        d.inprogress_check = $('#inprogress_check').is(':checked') ? 1 : 0;
                        d.interest_id = $('#selected_interest_id').val();
                        d.auction_date = $('#auctionSelector').val();

                    },
                    dataSrc: function(json) {
                        updatePlatformCenterUI(json.platforms, json.centers, json.recordsTotal);
                        hideLoader();
                        return json.data;
                    }
                }
            });


            table.on('draw.dt', function() {
                var info = table.page.info();

                $('.pageinfo').html(
                    `Showing ${info.start + 1} to ${info.end} of ${info.recordsDisplay} entries`);
            });


            $("input[name='search']").on('keyup change', function() {
                table.search(this.value).draw();
            });


            $("select[name='length']").on('change', function() {
                table.page.len($(this).val()).draw();
                showLoader();
            }).trigger('change');


            $('#inprogress_check').on('change', function() {
                showLoader();
                table.ajax.reload();
            });


            $('#interestDropdown').on('click', '.dropdown-item', function(e) {
                e.preventDefault();
                $('#selected_interest_id').val($(this).data('id'));
                $('#dropdownMenuButton').text($(this).text());
                showLoader();
                table.ajax.reload();
            });


            $('#auctionSelector').on('change', function() {
                showLoader();
                table.ajax.reload();
            });


            function updatePlatformCenterUI(platforms, centers, recordsTotal) {
                const platformContainer = $('.platforms-container');
                const centerContainer = $('.centers-container');
                const vehicleCountToday = $('#vehicleCountToday');


                platformContainer.empty();
                centerContainer.empty();
                vehicleCountToday.text(recordsTotal || 0);


                if (platforms?.length) {
                    $.each(platforms, function(i, p) {
                        platformContainer.append(`<span class="platform-badge">${p}</span>`);
                    });
                } else {
                    platformContainer.append(`<span style="color: gray;">No Platforms</span>`);
                }


                if (centers?.length) {
                    $.each(centers, function(i, c) {
                        centerContainer.append(
                            `<span class="center-badge" style="font-size: var(--font-p3); color: var(--dimtext)">${c}</span>`
                        );
                    });
                } else {
                    centerContainer.append(`<span style="color: gray;">No Centers</span>`);
                }
            }


        });







        $(document).on('click', '.PreviousBtnRec', function() {
            let reg = $(this).data('ref');
            let vehicleId = $(this).data('vehid');

            if (!reg) return;

            let isUpcoming = $('#Upcoming').is(':checked') ? 1 : 0;

            $.ajax({
                url: '{{ route('reauctioninfo') }}',
                method: 'POST',
                data: {
                    reg: reg,
                    vehId: vehicleId,
                    upcoming: isUpcoming,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (!response || !response.current) {
                        $('#vehicleModalTableBody').html(
                            '<tr><td colspan="6">No data found.</td></tr>'
                        );
                        return;
                    }

                    let current = response.current;
                    let previous = response.previous || [];

                    $('.vehicleName').html(
                        `${current.name} - ${current.variant} 
                        <small class="text-danger" style="font-size: 80%;">${current.reg}</small>`
                    );

                    $('#vehicleModalTableBody').empty();
                    if (current) {
                        let currentRow = `
                                <tr>
                                    <td style="padding:16px 12px;text-align:left;font-weight:600;font-size:13px;">${current.date}</td>
                                    <td style="padding:16px 12px;text-align:left;font-weight:600;font-size:13px;">${current.platform}</td>
                                    <td style="padding:16px 12px;text-align:left;font-weight:600;font-size:13px;">${current.center}</td>
                                    <td style="padding:16px 12px;text-align:left;font-weight:600;font-size:13px;">${current.mileage}</td>
                                    <td style="padding:16px 12px;text-align:left;font-weight:600;font-size:13px;">${current.priceSymbol}${current.cap_clean}</td>
                                    <td style="padding:16px 12px;text-align:left;font-weight:600;font-size:13px;">${current.priceSymbol}${current.cap_average}</td>
                                    <td style="padding:16px 12px;text-align:left;font-weight:600;font-size:13px;">${current.priceSymbol}${current.cap_below}</td>
                                    <td style="padding:16px 12px;text-align:left;font-weight:600;font-size:13px;">${current.priceSymbol}${current.last_bid}</td>
                                    <td style="padding:14px 12px;">
                                        <span style="color:#dc2626;padding:6px 12px;
                                                    border:1px solid #dc2626;
                                                    border-radius:4px;font-size:12px;font-weight:600;display:inline-block;">
                                        High
                                        </span></td>
                                </tr>`;
                        $('#currentVehicleModalTableBody').append(currentRow);
                        $('#regnumber_veh').text(current.reg);
                        $('#name_veh').text(current.name);
                        $('#DetailView').attr('href', current.inspection_report);

                    }

                    if (previous.length === 0) {
                        $('#vehicleModalTableBody').html(
                            '<tr><td colspan="6">No previous records found.</td></tr>'
                        );
                    } else {
                        previous.forEach(function(item) {
                            let row = `
                                <tr>
                                    <td style="padding:16px 12px;text-align:left;font-weight:600;font-size:13px;">${item.date}</td>
                                    <td style="padding:16px 12px;text-align:left;font-weight:600;font-size:13px;">${item.platform}</td>
                                    <td style="padding:16px 12px;text-align:left;font-weight:600;font-size:13px;">${item.center}</td>
                                    <td style="padding:16px 12px;text-align:left;font-weight:600;font-size:13px;">${item.mileage}</td>
                                    <td style="padding:16px 12px;text-align:left;font-weight:600;font-size:13px;">${item.priceSymbol}${current.cap_clean}</td>
                                    <td style="padding:16px 12px;text-align:left;font-weight:600;font-size:13px;">${item.priceSymbol}${current.cap_average}</td>
                                    <td style="padding:16px 12px;text-align:left;font-weight:600;font-size:13px;">${item.priceSymbol}${current.cap_below}</td>
                                    <td style="padding:16px 12px;text-align:left;font-weight:600;font-size:13px;">${item.priceSymbol}${current.last_bid}</td>
                                    <td style="padding:16px 12px;text-align:left;font-weight:600;font-size:13px;">${item.status}</td>
                                </tr>`;
                            $('#vehicleModalTableBody').append(row);
                        });
                    }

                    $('#vehicleModal').modal('show');
                },

                error: function() {
                    $('#vehicleModalTableBody').html(
                        '<tr><td colspan="6">Failed to load data.</td></tr>');
                    $('#vehicleModal').modal('show');
                }
            });
        });




        const scrollContainer = document.getElementById('scrollableRow');
        const scrollAmount = 250;

        document.getElementById('scrollLeft').addEventListener('click', () => {
            scrollContainer.scrollBy({
                left: -scrollAmount,
                behavior: 'smooth'
            });
        });

        document.getElementById('scrollRight').addEventListener('click', () => {
            scrollContainer.scrollBy({
                left: scrollAmount,
                behavior: 'smooth'
            });
        });
    </script>
    <script>
        $(document).ready(function() {

            // Initialize Select2
            $('#auctionSelector').select2({
                placeholder: 'Select Auction Date',
                allowClear: true,
                width: '100%'
            });

            $.ajax({
                url: "{{ url('get-reauction-stats') }}",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    let dropdown = $('#auctionSelector');
                    dropdown.empty();
                    dropdown.append('<option value="">Select Auction Date</option>');

                    let today = new Date();
                    let tomorrow = new Date();
                    tomorrow.setDate(today.getDate() + 1);

                    $.each(response, function(index, item) {

                        let parts = item.auction_date.split('-');
                        let auctionDate = new Date(parts[0], parts[1] - 1, parts[2]);

                        let label = '';
                        if (auctionDate.toDateString() === today.toDateString()) {
                            label = 'Today';
                        } else if (auctionDate.toDateString() === tomorrow.toDateString()) {
                            label = 'Tomorrow';
                        } else {
                            label = auctionDate.toLocaleDateString('en-US', {
                                weekday: 'long'
                            });
                        }

                        let optionText = `${label} ( ${item.reauction_count} )`;
                        dropdown.append(
                            `<option value="${item.auction_date}">${optionText}</option>`);
                    });

                    // Reinitialize Select2 after data load
                    dropdown.trigger('change.select2');
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });
    </script>

    <script>
        $(document).off('click.addNotify', '.add-notification') // 
            .on('click.addNotify', '.add-notification', function(e) {
                e.preventDefault();

                var auction_id = $(this).data('auction-id');


                $.ajax({
                    url: "{{ route('notifications.store') }}",
                    method: "POST",
                    data: {
                        auction_id: auction_id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        toastr.clear();
                        if (response.status === 'success') {
                            toastr.success(response.message);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function() {
                        toastr.clear();
                        toastr.error('Server error! Please try again.');
                    }
                });
            });
    </script>
@endsection
