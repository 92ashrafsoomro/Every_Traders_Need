@extends('user.partial.app')
@push('title')
    Reauction
@endpush
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
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

        .negative-margin {
            margin-top: -13rem;
        }

        @media (max-width: 1024px) {
            .negative-margin {
                margin-top: -5rem;
            }
        }

        @media (max-width: 425px) {
            .negative-margin {
                margin-top: -1rem;
            }
        }
    </style>
@endsection
@section('content')
    @include('user.reauction.topfilters')

    <div class="container-fluid container-p-y negative-margin">
        <div class="row g-4">
            <div class="col-12">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card shadow-sm rounded-3 border">
                    <div class="card-header pb-2">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <h4 class="mb-0 fw-semibold">Reauction Details</h4>
                        </div>
                    </div>

                    <div class="card-body">

                        <!-- Filters -->
                        <div class="row g-3 align-items-end mb-4">

                            <!-- Page Length -->
                            <div class="col-md-2">
                                <label for="pageLength" class="form-label">Rows per page</label>
                                <select id="pageLength" class="form-select">
                                    <option value="10">10</option>
                                    <option value="100">100</option>
                                    <option value="200">200</option>
                                    <option value="500">500</option>
                                </select>
                            </div>

                            <!-- Auction Selector -->
                            <div class="col-md-3">
                                <label for="auctionSelector" class="form-label">Auction Date</label>
                                <select id="auctionSelector" class="form-select">
                                    <option value="">Select Auction Date</option>
                                    <!-- Populated dynamically -->
                                </select>
                            </div>

                            <!-- Search Input -->
                            <div class="col-md-3">
                                <label for="search" class="form-label">Search by Reg</label>
                                <input type="text" name="search" class="form-control" placeholder="Enter registration">
                            </div>

                            <!-- Interest Dropdown -->
                            <div class="col-md-4">
                                <label class="form-label d-block">Select Interest</label>
                                <div class="dropdown w-100">
                                    <button class="btn btn-outline-primary dropdown-toggle w-100 text-start" type="button"
                                        id="interestDropdownBtn" data-bs-toggle="dropdown" aria-expanded="false">
                                        Select Interest
                                    </button>
                                    <ul class="dropdown-menu w-100" aria-labelledby="interestDropdownBtn"
                                        id="interestDropdown">
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

                        <!-- Page Info -->
                        <div class="mb-3">
                            <span class="text-muted small">Showing <span class="pageinfo fw-semibold">0</span>
                                entries</span>
                        </div>

                        <!-- Table -->
                        <div class="table-responsive">
                            <table id="blogTable" class="table table-bordered table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Vehicle</th>
                                        <th>Reg</th>
                                        <th>Previous</th>
                                        <th>Platform</th>
                                        <th>Center</th>
                                        <th>Cap Clean</th>
                                        <th>Cap Avg</th>
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

            let table = $('#blogTable').DataTable({
                processing: false,
                ordering: false,
                serverSide: true,
                ajax: {
                    url: "{{ url('/reauction') }}",
                    data: function(d) {
                        d.inprogress_check = $('#inprogress_check').is(':checked') ? 1 : 0;
                        d.interest_id = $('#selected_interest_id').val();
                        d.auction_date = $('#auctionSelector').val(); // date filter
                    },
                    dataSrc: function(json) {
                        updatePlatformCenterUI(json.platforms, json.centers, json.recordsTotal);
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
            }).trigger('change');


            $('#inprogress_check').on('change', function() {
                table.ajax.reload();
            });


            $('#interestDropdown').on('click', '.dropdown-item', function(e) {
                e.preventDefault();
                $('#selected_interest_id').val($(this).data('id'));
                $('#dropdownMenuButton').text($(this).text());
                table.ajax.reload();
            });


            $('#auctionSelector').on('change', function() {
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
            if (!reg) return;

            let isUpcoming = $('#Upcoming').is(':checked') ? 1 : 0;

            $.ajax({
                url: '{{ route('reauctioninfo') }}',
                method: 'POST',
                data: {
                    reg: reg,
                    upcoming: isUpcoming,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.length === 0) {
                        $('#vehicleModalTableBody').html(
                            '<tr><td colspan="6">No data found.</td></tr>');
                        return;
                    }

                    $('.vehicleName').html(
                        response[0].name + ' - ' + response[0].variant + ' - ' +
                        '<small class="text-danger" style="font-size: 80%;">' + reg + '</small>'
                    );

                    $('#vehicleModalTableBody').empty();
                    response.forEach(function(item) {
                        let row = `
                    <tr>
                        <td style="font-size: var(--font-p2); color: var(--bs-heading-color);">${item.platform}</td>
                        <td style="font-size: var(--font-p2); color: var(--bs-heading-color);">${item.center}</td>
                        <td style="font-size: var(--font-p2); color: var(--bs-heading-color);">${item.last_bid}</td>
                        <td style="font-size: var(--font-p2); color: var(--bs-heading-color);">${item.cap_clean}</td>
                        <td style="font-size: var(--font-p2); color: var(--bs-heading-color);">${item.status}</td>
                        <td style="font-size: var(--font-p2); color: var(--bs-heading-color);">${item.difference}</td>
                        <td style="font-size: var(--font-p2); color: var(--bs-heading-color);">${item.time}</td>
                    </tr>`;
                        $('#vehicleModalTableBody').append(row);
                    });

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
        // $(document).ready(function() {


        //     function loadInterests(interestId = null) {
        //         $.ajax({
        //             url: '{{ route('reauction-interest') }}',
        //             method: 'GET',
        //             data: interestId ? {
        //                 secondary: interestId
        //             } : {},
        //             dataType: 'json',
        //             success: function(interests) {
        //                 let html = '';

        //                 interests.forEach(function(interest) {
        //                     html += `
    //             <div class="col-auto" style="width: 22%;">
    //                 <div class="card h-100" style="border-bottom: 4px solid var(--bs-primary)!important;">
    //                     <div class="card-body pb-1 text-start">
    //                         <div class="d-flex align-items-start mb-2">
    //                             <div class="dot-box"
    //                                 style="width: 40px;height: 40px; background-color: #003164; border-radius: 8px;display: flex;align-items: center;justify-content: center;margin-right: 10px;">
    //                                 <div class="dot"
    //                                     style="width: 30px; height: 30px; background-color: #0d6efd; border-radius: 50%;">
    //                                 </div>
    //                             </div>
    //                             <h4 class="mb-0 ms-2">
    //                                 <span class="auction-count">${interest.matched_reauction_cars}</span>
    //                             </h4>
    //                         </div>
    //                         <p class="text-start mb-1 total_auctions">${interest.title}</p>
    //                         <p class="mb-0 text-start">
    //                             <label class="d-flex align-items-center cursor-pointer mb-2">
    //                                 <input type="checkbox" 
    //                                        class="secondary-toggle me-2" 
    //                                        data-id="${interest.interest_id}"
    //                                        ${interestId == interest.interest_id ? 'checked' : ''}>
    //                                 <small style="font-size:var(--font-p2)">Include Secondary</small>
    //                             </label>
    //                         </p>
    //                     </div>
    //                 </div>
    //             </div>
    //             `;
        //                 });

        //                 $('#scrollableRow').html(html);
        //             },
        //             error: function(xhr, status, error) {
        //                 console.error('AJAX Error:', error);
        //                 $('#scrollableRow').html(
        //                 '<p class="text-danger">Failed to load interests.</p>');
        //             }
        //         });
        //     }


        //     loadInterests();


        //     $(document).on('change', '.secondary-toggle', function() {
        //         const interestId = $(this).data('id');
        //         const isChecked = $(this).is(':checked');


        //         loadInterests(isChecked ? interestId : null);
        //     });
        // });
    </script>



    <script>
        $(document).off('click.addNotify', '.add-notification') // namespace diya
            .on('click.addNotify', '.add-notification', function(e) {
                e.preventDefault();

                var auction_id = $(this).data('auction-id');
                console.log("Sending AJAX for auction_id:", auction_id);

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
@endsection
