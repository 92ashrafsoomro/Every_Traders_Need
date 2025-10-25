@extends('user.partial.app')
@push('title')
    All Interest
@endpush
@section('css')
    <style>
        .dataTables_length {
            display: none !important;
        }

        .table {
            width: 100% !important;
        }

        .datatables-products th {
            text-align: center;
        }

        .datatables-products td {
            text-align: center;
        }

        .table-responsive {
            overflow-x: auto !important;
            -webkit-overflow-scrolling: touch !important;
        }

        @media (max-width: 425px) {
            #searchInterest {
                margin-bottom: 10px !important;
            }
        }

        .table-border-bottom-0 tr:hover {
            cursor: pointer;
            background-color: #0f1c2c !important;
        }

        #blogTable tbody tr:hover {
            background-color: #0f1c2c !important;
        }
    </style>
@endsection
@section('content')
    <script src="https://cdn.tailwindcss.com"></script>
    <div class="relative w-full h-auto lg:h-[40vh] bg-[#000f21] overflow-hidden space-y-4">
        <div
            class="absolute inset-0 bg-[radial-gradient(#0080ff_1.5px,transparent_1.2px)] [background-size:16px_16px] opacity-25 pointer-events-none z-0">
        </div>
        <div class="relative z-10 container mx-auto py-10">
            <h1 class="text-5xl font-bold text-white mb-4 text-left">Personalized for You</h1>
            <p class="text-lg text-[#B1BFCD] mx-auto text-left">
                Save your interests to see matching auctions, stats, and valuations in one place.
            </p>
            <div class="pt-4">
                <a href="{{ url('/interest/create') }}" class="btn btn-primary" style="border-radius: 4px;">Create Interest</a>
            </div>
        </div>
    </div>
    <div class="container pt-5 space-y-2">
        <div class="row">
            <div class="col-md-10">
                <div class="flex items-center gap-x-2">
                    <span class="label-muted">Show Entries</span>
                    <select name="length" class="form-select entries-length"
                        style="width: 70px; outline: none !important; padding: 7px; border-radius: 6px; border: 1px solid #2b3b4f;">
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="500">500</option>
                    </select>
                </div>
                <span class="text-muted ms-2 pageinfo" style="font-size: 0.9rem;"></span>
            </div>
            <div class="col-md-2 text-end">
                <input placeholder="Search.." type="text" class="d-inline form-control" name="search"
                    style="outline: none !important; padding: 7px; border-radius: 6px; border: 1px solid #2b3b4f;"
                    id="searchInterest" />
            </div>
        </div>
    </div>
    <div class="container container-p-y" style="padding-top: 0% !important;">
        <div class="row g-6">
            <div class="col-md-12">

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <div class="pt-5 table-responsive text-nowrap">
                            <table id="interestTable" class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Make</th>
                                        <th>Model</th>
                                        <th>Variant</th>
                                        <th>Year</th>
                                        <th>Mileage</th>
                                        <th>CC</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {

            if ($.fn.DataTable.isDataTable('#interestTable')) {
                $('#interestTable').DataTable().destroy();
            }

            let table = $('#interestTable').DataTable({
                processing: true,
                serverSide: true,
                ordering: false,
                ajax: {
                    url: "{{ url('/interest') }}",
                    beforeSend: function() {
                        showLoader();
                    },
                    complete: function() {
                        hideLoader();
                    }
                },
            });

            table.on('draw.dt', function() {
                var info = table.page.info();
                $('.pageinfo').html(

                );
            });

            $("input[name='search']").on('keyup change', function() {
                table.search(this.value).draw();
            });

            $("select[name='length']").on('change', function() {
                const length = $(this).val();
                table.page.len(length).draw();
            }).trigger('change');
        });
    </script>
@endsection
