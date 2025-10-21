@extends('user.partial.app')
{{-- @push('title')
    Auction Finder
@endpush --}}
@section('css')
    <style>
        .form-label {
            padding-top: 18px;
            padding-bottom: 6px;
            font-size: 15px;
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

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #444;
            line-height: 33px;
        }

        .select2-container {
            width: 236px;
            margin-right: 5px;
        }

        .select2-container--default .select2-selection--single {
            background-color: var(--bs-paper-bg) !important;
            border: 1px solid var(--bs-b-color) !important;
        }

        .filter .select2-container--default .select2-selection--single {
            background-color: var(--bs-body-bg) !important;

        }

        .my_btn {
            background: transparent;
            border: none;
        }

        .auction-table tr {
            vertical-align: baseline;
        }

        .auction-table .extra {
            display: none;
        }

        .auction-table .showing .extra {
            display: block;
            margin-top: 10px;
        }

        .auction-table .report-link {
            padding: 2px 7px;
            font-size: 10px;
        }


        .auction-table img {
            width: 60px;
        }

        .show_entries_div {}

        .auction-badge {
            display: inline-block;
            padding: 4px 10px;
            font-size: 0.65rem;
            color: #ffffffd6;

            border: 1px solid #0080ff;
            border-radius: 5px;
            box-shadow: 2px 0px 6px #0080ff;
            font-weight: 500;
            text-align: center;
        }

        .lightbox-overlay {
            display: none;
            position: fixed;
            z-index: 9999;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            justify-content: center;
            align-items: center;
            display: flex;
        }

        .lightbox-overlay img {
            max-width: 80%;
            max-height: 80%;
            border-radius: 8px;
        }

        .lightbox-prev,
        .lightbox-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 2rem;
            color: #fff;
            background: rgba(0, 0, 0, 0.5);
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 50%;
        }

        .lightbox-prev {
            left: 20px;
        }

        .lightbox-next {
            right: 20px;
        }


        .color-box {
            display: inline-block;
            width: 18px;
            height: 18px;
            border-radius: 4px;
            border: 1px solid #ccc;
            vertical-align: middle;
            cursor: pointer;
            margin-left: 5px;
            transition: transform 0.2s ease;
        }

        .color-box:hover {
            transform: scale(1.2);
        }

        .prev-icon {
            margin-right: 4px;
            color: #555;
            font-size: 14px;
            vertical-align: middle;
        }

        tr:hover {
            cursor: pointer;
        }

        .grade-box {
            display: inline-block;
            width: 25px;
            height: 25px;
            border-radius: 50px;
            color: white;
            font-weight: bold;
            text-align: center;
            line-height: 25px;
            font-size: 14px;
        }

        #tableSection {
            transition: width 0.4s ease;
        }

        .filter_sidebar {
            width: 22.5%;
            overflow: hidden;
            opacity: 0;
            transition: all 0.4s ease;
        }

        @media (max-width: 767px) {
            .row {
                flex-direction: column;
            }

            .filter_sidebar {
                width: 100% !important;
                opacity: 0;
                transition: all 0.4s ease;
            }

            .filter_sidebar.open {
                opacity: 1;
            }

            #tableSection {
                width: 100% !important;
            }
        }

        .deleteBtn {
            color: white;
            padding: 4px;
            border-radius: 4px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 14px;
        }

        .deleteBtn :hover {
            text-decoration: none !important;
        }


        /* titleCSS */

        .section-container {
            position: relative;
            width: 100%;
            height: auto;
            background-color: #000f21;
            overflow: hidden;
        }

        @media (min-width: 1024px) {
            .section-container {
                height: 25vh;
            }
        }

        .background-pattern {
            position: absolute;
            inset: 0;
            background-image: radial-gradient(#0080ff 1.5px, transparent 1.2px);
            background-size: 16px 16px;
            opacity: 0.25;
            pointer-events: none;
            z-index: 0;
        }

        .content {
            position: relative;
            z-index: 10;
            margin: 0 auto;
            padding-top: 3.5rem;
            padding: 2.5rem;
        }

        .heading {
            font-size: 3rem;
            font-weight: bold;
            color: white;
            margin-bottom: 1rem;
            text-align: left;
        }

        .subtext {
            font-size: 1.125rem;
            color: #d1d5db;
            text-align: left;
            margin: 0 auto;
        }

        .tabsDiv {
            padding: 0rem 2rem;
        }

        .dropdownDiv {
            padding-bottom: 20px;
            padding-right: 45px;
        }
    </style>

    <style>
        .pagination {
            display: flex;
            justify-content: center;
            list-style: none;
            gap: 6px;
            padding: 0;
            margin: 10px 0;
        }

        .pagination .page-item button {
            border: 1px solid #ccc;
            background: #fff;
            color: #333;
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.2s;
        }

        .pagination .page-item.active button {
            background: #007bff;
            color: #fff;
            border-color: #007bff;
        }

        .pagination .page-item button:hover {
            background: #f1f1f1;
        }

        .toggleFiltersBtn {
            padding: 6px;
            border-radius: 8px;
            font-size: small;
            color: white;
            border: 1px solid white;
            width: 120px;
            margin-bottom: 20px;
            height: 50px;
        }
    </style>
@endsection
@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <div class="section-container">
        <div class="background-pattern"></div>
        <div class="content">
            <h1 class="heading">Smart Auction Search</h1>
            <p class="subtext">
                Filter, compare, and uncover vehicles that match your profit goals.
            </p>
        </div>
        <div class="d-flex flex-wrap justify-content-between mb-4 tabsDiv">
            <div class="auction-tabs">
                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
                    <ul class="nav flex-column flex-md-row gap-md-0 gap-2">
                        <li class="nav-item">
                            <a data-id="auction" class="display_type nav-link active" href="javascript:void(0);"> Auction
                                Finder</a>
                        </li>
                        <li class="nav-item">
                            <a data-id="car" class="display_type nav-link" href="javascript:void(0);"> Vehicle
                                Valuation</a>
                        </li>
                    </ul>
                    <!-- Toggle Button -->
                    {{-- <button id="toggleFiltersBtn" class="btn btn-sm btn-outline-primary"
                        style="padding: 10px; border-radius: 8px; font-size: small; color: white; border: 1px solid white;">
                        Show Filters
                        <span class="material-symbols-outlined">
                            filter_alt
                        </span>
                    </button> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="py-5 container-fluid filter">

        <div class="d-flex justify-content-between align-items-center px-1 pt-1" style="width:22.5%;">
            <button id="toggleFiltersBtn" class="toggleFiltersBtn btn btn-sm btn-outline-primary">
                Show Filters
                <span class="material-symbols-outlined">
                    filter_alt
                </span>
            </button>
            <div class="d-flex align-items-center gap-2">
                <a id="clearFiltersLink" href="{{ url('/auction-finder') }}" class="text-decoration-none d-none deleteBtn">
                    <span class="material-symbols-outlined" style="font-size: 16px; margin: 5px;">
                        delete
                    </span>
                    Clear all
                </a>
            </div>
        </div>

        <div class="row" style="display: flex;">
            <!-- Left: 3col Table section -->
            <div id="filterDIV" class="filter_sidebar">
                <div class="card p-2" {{-- style="position: sticky; top: 100px; z-index: 10;" --}}>
                    <div class="d-flex justify-content-between align-items-center px-1 pt-1">
                        {{-- <h5 class="mb-0">Filters</h5> --}}
                        {{-- <div class="d-flex align-items-center gap-2">
                            <a id="clearFiltersLink" href="{{ url('/auction-finder') }}"
                                class="text-decoration-none d-none deleteBtn">
                                <span class="material-symbols-outlined" style="font-size: 16px; margin: 5px;">
                                    delete
                                </span>
                                Clear all
                            </a>
                        </div> --}}
                    </div>

                    <div class="accordion" id="filterAccordion">
                        @include('user.auctionfinder.sidebar')
                    </div>
                </div>
            </div>


            <!-- Right: 9col Table section -->
            <div id="tableSection" style="width:  75%;">
                <div class="d-flex justify-content-between dropdownDiv">
                    <div class=" align-self-center show_entries_div">
                        {{-- <span style="padding-right: 5px">Show Entries</span> --}}
                        <select style="height: 38px;padding: 0px 10px; border-radius: 4px; border-color:#44485e;"
                            name="length">
                            <option value="15">15</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="500">500</option>
                        </select>
                        <span class="show_pagging" style="padding-left: 5px; margin-right: 5px;"></span>

                        <span class="params"></span>
                    </div>
                    <div class="d-flex flex-wrap justify-content-end">
                        <div class="invoice_sort">
                            <select id="sortFilter" class="form-select">
                                <option selected value="">Sort By</option>
                                <!-- Name -->
                                <option value="name_asc">Name: A to Z</option>
                                <option value="name_desc">Name: Z to A</option>
                                <!-- Grade -->
                                <option value="grade_asc">Grade: Low to High</option>
                                <option value="grade_desc">Grade: High to Low</option>
                                <!-- Date & Time -->
                                <option value="date_asc">Date & Time: Oldest First</option>
                                <option value="date_desc">Date & Time: Newest First</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="table-responsive text-nowrap">
                        <table class="auction-table table table-hover">
                            <thead>

                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>

                    <div
                        style="
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        padding-top: 10px;
                        padding-bottom: 10px;
                        gap: 10px;
                        overflow-x: auto;
                        width: 100%;
                    ">
                        <nav aria-label="pagination" style="display: flex; justify-content: center; width: 100%;">
                            <ul class="pagination"
                                style="
                                display: flex;
                                list-style: none;
                                gap: 6px;
                                padding: 0;
                                margin: 0;
                                justify-content: center;
                            ">
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="lightbox-overlay" style="display:none;">
        <button class="lightbox-prev">&#10094;</button>
        <img src="" alt="Preview">
        <button class="lightbox-next">&#10095;</button>
    </div>
@endsection
@section('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toggleBtn = document.getElementById("toggleFiltersBtn");
            const filterDiv = document.getElementById("filterDIV");
            const clearLink = document.getElementById("clearFiltersLink");
            const tableSection = document.getElementById("tableSection");

            let isOpen = true;

            function isMobile() {
                return window.innerWidth <= 767;
            }
            let test = isMobile();
            console.log(test);

            function openFilter() {
                if (isMobile()) {
                    filterDiv.classList.add("open");
                } else {
                    filterDiv.style.width = "22.5%";
                    tableSection.style.width = "75%";
                    filterDiv.style.opacity = "1";
                }
                toggleBtn.textContent = "Hide Filters";
                clearLink.classList.remove("d-none");
                isOpen = true;
            }

            function closeFilter() {
                if (isMobile()) {
                    filterDiv.classList.remove("open");
                } else {
                    filterDiv.style.width = "0";
                    tableSection.style.width = "90%";
                    filterDiv.style.opacity = "0";
                }
                toggleBtn.textContent = "Show Filters";
                clearLink.classList.add("d-none");
                isOpen = false;
            }



            // Initialize state
            if (isMobile()) {
                filterDiv.classList.remove("open");
                tableSection.style.width = "90%";
                isOpen = false;
                toggleBtn.textContent = "Show Filters";
            } else {
                openFilter();
            }

            toggleBtn.addEventListener("click", function() {
                if (isOpen) {
                    closeFilter();
                } else {
                    openFilter();
                }
            });

            // Optional: Adjust layout on resize
            window.addEventListener("resize", function() {
                if (isMobile() && isOpen) {
                    filterDiv.classList.add("open");
                    tableSection.style.width = "100%";
                } else if (!isMobile() && isOpen) {
                    filterDiv.classList.remove("open");
                    openFilter();
                } else if (!isMobile() && !isOpen) {
                    closeFilter();
                }
            });
        });









        $(document).on('mouseenter', '.table tbody tr', function() {
            $(this).find('.extra').fadeIn(150);
        });

        $(document).on('mouseleave', '.table tbody tr', function() {
            $(this).find('.extra').fadeOut(150);
        });

        let images = []; // store current row images
        let currentIndex = 0;

        // Open lightbox
        $(document).on('click', '.lightbox-img', function() {
            let row = $(this).closest('tr');
            images = row.find('.lightbox-img').map(function() {
                return $(this).attr('src');
            }).get();
            currentIndex = images.indexOf($(this).attr('src'));
            $('.lightbox-overlay img').attr('src', images[currentIndex]);
            $('.lightbox-overlay').fadeIn(200);
        });

        // Close on clicking overlay (outside image)
        $('.lightbox-overlay').on('click', function(e) {
            if (!$(e.target).is('img') && !$(e.target).is('button')) $(this).fadeOut(200);
        });

        // Prev button
        $('.lightbox-prev').on('click', function(e) {
            e.stopPropagation();
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            $('.lightbox-overlay img').attr('src', images[currentIndex]);
        });

        // Next button
        $('.lightbox-next').on('click', function(e) {
            e.stopPropagation();
            currentIndex = (currentIndex + 1) % images.length;
            $('.lightbox-overlay img').attr('src', images[currentIndex]);
        });


        let url = "{{ url('/') }}";
        const baseUrl = "{{ url('/auction-finder/vehicle') }}";
        $(document).ready(function() {
            $('.menu-button').trigger('click');
            $('.menu-button').hide();

        });
    </script>
    <script src="{{ asset('/public/themeadmin/js/vehichle.js') }}"></script>
@endsection
