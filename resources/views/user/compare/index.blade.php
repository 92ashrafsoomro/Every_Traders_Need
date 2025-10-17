@extends('user.partial.app')
@push('title')
    Compare
@endpush
@section('css')
    <style>
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
            border: 1px solid #d1d5db;
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
                <h1 class="text-5xl font-bold text-white mb-4 text-left">Compare Before You Bid</h1>
                <p class="text-lg text-gray-300 mx-auto text-left">
                    Review multiple auctions side by side to spot the best deal..
                </p>
            </div>

            <div class="container">
                <div class="relative z-10">
                    <button id="filterToggle" class="flex items-center text-white/70 hover:text-white focus:outline-none">
                        <span class="mr-2 text-lg">Filters</span>
                        <svg id="filterIcon" class="w-4 h-4 transform transition-transform duration-200" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                </div>
                <div id="filterSection" class="relative z-10">
                    <div class="rounded border border-[#d1d5db] bg-[#000f21] mb-4 ">

                        <div class="p-5 grid grid-cols-1 lg:grid-cols-4 gap-5 !items-center">
                            <div>
                                <label class="form-label required" for="make_id">Make</label>
                                <select name="make_id" id="make_id" class="form-control make select2" required>
                                    <option value="">Select Make</option>
                                </select>
                            </div>
                            <div>
                                <label class="form-label required" for="model_id">Model</label>
                                <select name="model_id" id="model_id" class="form-control model select2" required>
                                    <option value="">Select Model</option>
                                </select>
                            </div>
                            <div>
                                <label class="form-label" for="variant_id">Variant</label>
                                <select name="variant_id" id="variant_id" class="form-control variants select2">
                                    <option value="">Select Variant</option>
                                </select>
                            </div>
                            <div>
                                <label class="form-label" for="year">Year</label>
                                <select name="year" id="year" class="form-control select2">
                                    <option value="">Select Year</option>
                                    @foreach ($years as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>

                                <label class="form-label" for="transmission">Transmission</label>
                                <select name="transmission" id="transmission" class="form-control select2">
                                    <option value="">Select Transmission</option>
                                    @foreach ($transmissions as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div>
                                <label class="form-label" for="fuel">Fuel</label>
                                <select name="fuel" id="fuel" class="form-control select2">
                                    <option value="">Select Fuel</option>
                                    @foreach ($fuels as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="form-label" for="grade">Grade</label>
                                <select name="grade" id="grade" class="form-control select2">
                                    <option value="">Select Grade</option>
                                    @foreach ($grades as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="form-label" for="platform_id" style="">Auction House</label>
                                <select name="platform_id[]" id="platform_id" class="form-control platformhouse select2"
                                    multiple="multiple"
                                    style="width: 100%; padding: 0.4rem; border-radius: 0.5rem; border: 1px solid #d1d5db; background:#1f2937; color:#f3f4f6;"
                                    required>
                                </select>
                            </div>
                            <div>
                                <label class="form-label" for="mileage_range"
                                    style="font-weight:600;color:#f3f4f6;">Mileage</label>
                                <select name="mileage_range" id="mileage_rangeMax" class="form-control select2">
                                    <option value="">Max</option>
                                </select>
                            </div>
                            <div class="col-span-3 flex justify-end items-end">
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

        <div class="relative p-5">
            <div class="table-section">
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

        {{-- <div class="relative p-5">
            <div class="rounded border border-[#d1d5db] bg-[#000f21] compare_data h-auto">
                <div class="border-b border-b-[#d1d5db] p-5">
                    Compare
                </div>
                
            </div>
        </div> --}}
    </section>





    {{-- <div class="container-fluid container-p-y">
        <div class="row g-6">
            <div class="col-md-12">



                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif


                <div class="card">
                    <div class="card-header border-bottom">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="card-title ">Compare</h5>
                            </div>
                        </div>
                    </div>


                    <div class="container" style="width: 100%; max-width: 100%; padding: 0;">
                        <div class="table-section" style="width: 100%;">
                            <div class="table-container" style="width: 100%; overflow-x: auto;">
                                <table class="comparison-table" style="width: 100%; border-collapse: collapse;">
                                    <thead>
                                        <tr id="comparison-head"></tr>
                                    </thead>
                                    <tbody id="comparison-body"></tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div> --}}
@endsection

@section('js')
    <script>
        const mileageSelectMax = document.getElementById('mileage_rangeMax');
        for (let i = 100000; i <= 1000000; i += 100000) {
            const option = document.createElement('option');
            option.value = i;
            option.textContent = i.toLocaleString() + ' km';
            mileageSelectMax.appendChild(option);
        }


        const filterToggle = document.getElementById('filterToggle');
        const filterSection = document.getElementById('filterSection');
        const filterIcon = document.getElementById('filterIcon');

        filterToggle.addEventListener('click', () => {
            // Toggle visibility of filter section
            filterSection.classList.toggle('hidden');

            // Toggle rotation of icon
            filterIcon.classList.toggle('rotate-180');
        });


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
