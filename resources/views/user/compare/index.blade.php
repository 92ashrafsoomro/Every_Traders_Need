@extends('user.partial.app')
@push('title')
    Compare
@endpush
@section('css')
    <style>
        input.select2-search__field {
            background-color: #0f1c2c;
        }

        #mileage_range_min::-webkit-slider-thumb,
        #mileage_range_max::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            border: 2px solid #fff;
            cursor: pointer;
            box-shadow: 0 0 2px rgba(0, 0, 0, 0.5);
            transition: background 0.2s;
        }


        #mileage_range_min::-webkit-slider-thumb {
            background: #3b82f6;
        }


        #mileage_range_max::-webkit-slider-thumb {
            background: #f70000;
        }


        #mileage_range_min::-webkit-slider-thumb:hover {
            background: #60a5fa;
        }

        #mileage_range_max::-webkit-slider-thumb:hover {
            background: #ff4d4d;
        }


        #mileage_range_min::-moz-range-thumb {
            background: #3b82f6;
            border: none;
        }

        #mileage_range_max::-moz-range-thumb {
            background: #2563eb;
            border: none;
        }

        .select2-container--default .select2-selection--multiple {
            background-color: #1f2937;
            /* border: 1px solid #d1d5db; */
            border-radius: 0.5rem;
            min-height: 40px;
            padding: 5px 10px;
            color: #f3f4f6;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #3b82f6;
            color: white;
            border-radius: 0.4rem;
            padding: 2px 6px;
            margin-right: 4px;
            margin-top: 4px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #fff;
            margin-right: 2px;
        }

        .select2-container--default .select2-selection--multiple .select2-search__field {
            color: #f3f4f6;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__display {

            padding-left: 15px !important;

        }

        .form-label.required::after {
            content: " *";
            color: red;
            font-weight: bold;
        }

        input[type=range] {
            -webkit-appearance: none;
            width: 100%;
            height: 6px;
            background: #333b4f;
            border-radius: 4px;
            outline: none;
        }

        input[type=range]::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: #0080ff;
            cursor: pointer;
            border: 2px solid white;
            transition: transform 0.2s ease-in-out;
        }

        input[type=range]::-webkit-slider-thumb:hover {
            transform: scale(1.1);
        }

        input[type=range]::-moz-range-thumb {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: #0080ff;
            cursor: pointer;
            border: 2px solid white;
        }

        .scroll-button {
            border: 1px solid #ccc;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        .footer-container {
            display: none !important;
        }

        tr {
            white-space: nowrap;
        }

        td {
            border-bottom: none !important;
        }

        #table-scroll-container {
            overflow-x: auto;
            scrollbar-width: none;
            /* Firefox */
        }

        #table-scroll-container::-webkit-scrollbar {
            display: none;
            /* Chrome, Safari */
        }

        .container.relative.overflow-hidden {
            padding-top: 0px;
            padding-bottom: 0px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 31px;
            align-items: center;
        }

        .select2-container--default .select2-results__option--selected {
            background-color: #ddd3;
        }
    </style>
@endsection
@include('user.compare.customestyle')
@section('content')
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <section>

        <div class="relative w-full h-auto lg:h-[40vh] bg-[#000f21] overflow-hidden">
            <div
                class="absolute inset-0 bg-[radial-gradient(#0080ff_1.5px,transparent_1.2px)] [background-size:16px_16px] opacity-25 pointer-events-none z-0">
            </div>
            <div class="relative z-10 container mx-auto pt-14">
                <h1 class="text-5xl font-bold text-white mb-4 text-left">Find the Best Auction Deal</h1>
                <p class="text-lg text-gray-300 mx-auto text-left">
                    Review and compare live auctions side by side to find the smartest deal.
                </p>
            </div>

            <div class="container">
                <div class="relative z-10">
                    <button id="filterToggle" class="flex items-center text-white focus:outline-none">
                        <span class="mr-2 text-lg">Filters</span>
                        <svg id="filterIcon" class="w-4 h-4 transform transition-transform duration-200" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                </div>
                <div id="filterSection" class="relative z-10">
                    <div class="rounded border border-[#d1d5db] bg-[#000f21] mb-4 ">

                        <div class="p-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 !items-center">
                            <div>
                                <label class="form-label required" for="make_id">Make</label>
                                <select name="make_id" id="make_id" class="form-control make select2"
                                    style="outline: none !important; border: 1px solid #d1d5db;" required>
                                    <option value="">Select Make</option>
                                </select>
                            </div>
                            <div>
                                <label class="form-label required" for="model_id">Model</label>
                                <select name="model_id" id="model_id" class="form-control model select2"
                                    style="outline: none !important; border: 1px solid #2b3b4f;" required>
                                    <option value="">Select Model</option>
                                </select>
                            </div>
                            <div>
                                <label class="form-label" for="variant_id">Variant</label>
                                <select name="variant_id" id="variant_id"
                                    style="outline: none !important; border: 1px solid #2b3b4f;"
                                    class="form-control variants select2">
                                    <option value="">Select Variant</option>
                                </select>
                            </div>
                            <div>
                                <label class="form-label" for="year">Year</label>
                                <select name="year" id="year" class="form-control select2 !bg-[#000f21]"
                                    style="outline: none !important; border: 1px solid #e5e7eb30; border-radius: 4px;">
                                    <option value="">Select Year</option>
                                    @foreach ($years as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>

                                <label class="form-label" for="transmission">Transmission</label>
                                <select name="transmission" id="transmission" class="form-control select2 !bg-[#000f21]"
                                    style="outline: none !important; border: 1px solid #e5e7eb30; border-radius: 4px;">
                                    <option value="">Select Transmission</option>
                                    @foreach ($transmissions as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div>
                                <label class="form-label" for="fuel">Fuel</label>
                                <select name="fuel" id="fuel" class="form-control select2 !bg-[#000f21]"
                                    style="outline: none !important; border: 1px solid #e5e7eb30; border-radius: 4px;">
                                    <option value="">Select Fuel</option>
                                    @foreach ($fuels as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="form-label" for="grade">Grade</label>
                                <select name="grade" id="grade" class="form-control select2 !bg-[#000f21]"
                                    style="outline: none !important; border: 1px solid #e5e7eb30; border-radius: 4px;">
                                    <option value="">Select Grade</option>
                                    @foreach ($grades as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="form-label" for="mileage_range"
                                    style="font-weight:600;color:#f3f4f6;">Mileage</label>
                                <select name="mileage_range" id="mileage_range" class="form-control !bg-[#000f21] "
                                    style="outline: none !important; border: 1px solid #e5e7eb30; border-radius: 4px;">
                                    <option value="">Select Mileage Range</option>
                                    <option value="0-5000">0 - 5,000</option>
                                    <option value="5001-10000">5,001 - 10,000</option>
                                    <option value="10001-20000">10,001 - 20,000</option>
                                    <option value="20001-30000">20,001 - 30,000</option>
                                    <option value="30001-50000">30,001 - 50,000</option>
                                    <option value="50001-75000">50,001 - 75,000</option>
                                    <option value="75001-100000">75,001 - 100,000</option>
                                    <option value="100001-150000">100,001 - 150,000</option>
                                    <option value="150001-200000">150,001 - 200,000</option>
                                    <option value="200001-300000">200,001 - 300,000</option>
                                    <option value="300001-400000">300,001 - 400,000</option>
                                    <option value="400001-500000">400,001 - 500,000</option>
                                </select>
                            </div>
                            <div class="col-span-3">
                                <label class="form-label" for="platform_id" style="">Auction House</label>
                                <select name="platform_id[]" id="platform_id" class="form-control platformhouse select2 "
                                    multiple="multiple"
                                    style="width: 100%; padding: 0.4rem; background: transparent !important; color:#f3f4f6; outline: none !important; border: 1px solid #e5e7eb30 !important; border-radius: 4px !important;"
                                    required>
                                </select>
                            </div>
                            <div class="flex justify-end items-end">
                                <button type="button" id="searchBtn"
                                    class="btn btn-primary d-flex align-items-center justify-content-center"
                                    style="font-size: 14px; border-radius: 6px; gap: 6px;">
                                    <i class="fas fa-search"></i> Search
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container relative overflow-hidden">
            <div class="table-section" style="position: relative; padding: 0px !important;">
                <div class="flex items-center justify-between py-5">
                    <button class="w-8 h-8 bg-[#0080ff] rounded-full flex items-center justify-center gap-x-2"
                        id="prev-btn" onclick="scrollTable(-200)">
                        <span class="material-symbols-outlined text-sm -mr-1">arrow_back_ios</span></button>
                    <button class="w-8 h-8 bg-[#0080ff] rounded-full flex items-center justify-center gap-x-2"
                        id="next-btn" onclick="scrollTable(200)">
                        <span class="material-symbols-outlined text-sm">arrow_forward_ios</span></button>
                </div>
                <div class="table-container" id="table-scroll-container">
                    <table class="comparison-table">
                        <thead>
                            <tr id="comparison-head"></tr>
                        </thead>
                        <tbody id="comparison-body"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        const filterToggle = document.getElementById('filterToggle');
        const filterSection = document.getElementById('filterSection');
        const filterIcon = document.getElementById('filterIcon');

        filterToggle.addEventListener('click', () => {
            // Toggle visibility of filter section
            filterSection.classList.toggle('hidden');

            // Toggle rotation of icon
            filterIcon.classList.toggle('rotate-180');
        });


        const container = document.getElementById('table-scroll-container');
        const prevBtn = document.getElementById('prev-btn');
        const nextBtn = document.getElementById('next-btn');

        function scrollTable(distance) {
            const container = document.getElementById('table-scroll-container');
            container.scrollBy({
                left: distance,
                behavior: 'smooth'
            });
        }


        const slider = document.getElementById('mileageSlider');
        const mileageValue = document.getElementById('mileageValue');

        function formatNumber(num) {
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        slider.addEventListener('input', () => {
            mileageValue.textContent = `${formatNumber(slider.value)} km`;
        });
    </script>
    @include('user.compare.script')
@endsection
