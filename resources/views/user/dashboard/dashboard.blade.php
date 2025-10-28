@extends('user.partial.app')
@push('title')
    Dashboard
@endpush
@section('css')
    @include('user.dashboard.dashboardStyle')
    <style>
        @media (max-width: 425px) {
            .tab-pane {
                padding: 1rem 1rem !important;
            }
        }
    </style>
@endsection
@section('content')
    <div style="background:var(--bs-navbar-bg);" class="dashbord">
        <div class=""
            style="padding: 60px 60px; background-image: url({{ asset('/public/themeadmin/images/backgrounds/Dots.png') }})">

            <div class=" text-white mb-6">
                <div class="row g-4" style="margin-bottom:50px ;">
                    <!-- Left: Welcome + Tabs -->
                    <div class="col-lg-8 align-self-end">
                        <div class="d-flex align-items-center ">

                            <h6 class=" fw-semibold ">
                                Welcome back, <h5 class="text-primary fw-bold ms-3 mt-1">Mr
                                    {{ auth()->user()->firstName ?? 'User' }}!</h5>
                            </h6>
                        </div>

                        <p class="mt-2 p-3 rounded text-white-50 w-75"
                            style="backdrop-filter: blur(5px); background-color: var(--tra-primary-colr)!important; ">
                            Choose the best plan for your needs.
                            <i class="hgi hgi-stroke hgi-sharp hgi-arrow-up-01"></i>
                        </p>

                        <!-- Tabs -->
                        {{-- <ul class="nav nav-tabs mt-4 border-bottom border-secondary">
                            <li class="nav-item">
                              <a class="nav-link active text-white border-bottom border-primary" href="#">Overview</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link text-white-50" href="#">My Interest</a>
                            </li>
                        </ul> --}}

                        <ul class="nav nav-tabs mt-5" id="myTab" role="tablist"
                            style="border-bottom: 1px solid var(--bs-border-color)!important ; padding-top: 10px ">

                            <li class="nav-item" role="presentation">
                                <button class="d-block nav-link active"
                                    style="font-size: var(--font-p1); font-weight: var(--font-weight-semibold); margin-bottom: -10px !important"
                                    id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab"
                                    aria-controls="home" aria-selected="true">
                                    <span class="d-block ">Overview</span>
                                    <span class="borders mt-0"></span>
                                </button>

                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="d-block nav-link"
                                    style="font-size: var(--font-p1); font-weight: var(--font-weight-semibold)  ; margin-bottom: -10px !important"
                                    id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                                    role="tab" aria-controls="profile" aria-selected="false">
                                    <span class="d-block">Intrest</span>
                                    <span class="borders mt-0" style=""></span>
                                </button>
                            </li>

                            {{-- <li class="nav-item" role="presentation">
                              <button class="d-block nav-link" style="font-size: var(--font-p1); font-weight: var(--font-weight-semibold)  ; margin-bottom: -10px !important"  id="alter-tab" data-bs-toggle="tab" data-bs-target="#alter" type="button" role="tab" aria-controls="alter" aria-selected="false">
                                  <span class="d-block" >Alert</span> 
                                 <span class="borders mt-0" style="" ></span>
                                </button>
                            </li>
                             --}}
                        </ul>
                    </div>

                    <!-- Right: Refer & Earn Card -->
                    <div class="col-lg-4">

                        <div class="text-white d-flex align-items-center"
                            style="
                                  background-color:var(--bs-primary);
                                  padding: 36px 50px;
                                  border-radius: 16px !important;
                               ">
                            <div class="">
                                <h5 class="mb-0 " style="font-weight: 700">Refer & Earn</h5>
                                <p class="text-black" style="font-weight: 800">
                                    Use Refer & Earn modal to encourage your exiting
                                    customers refer their friends & colleague.
                                </p>
                            </div>
                            <div class="dot-box"
                                style="width: 100px; height: 50px; background-color: rgba(0, 0, 0, 0.466); border-radius: 8px;display: flex;align-items: center;justify-content: center;margin-left: 10px; ">
                                <div class="dot"
                                    style=" width: 30px;  height: 30px; background-color: black;  border-radius: 4px;">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>


    <div style="background-color: #0F1C2C; ">

        <div class="tab-content " id="myTabContent">
            <div class="tab-pane fade show active " id="home" role="tabpanel" aria-labelledby="home-tab"
                style="padding: 0rem 4rem; ">@include('user.dashboard.overview')</div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                @include('user.dashboard.intrest')</div>
        </div>

    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

    <!-- ✅ Chart.js Data Labels plugin -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0"></script>
    <script>
        let path = "{{ url('/') }}";
        let totalVehicles = "{{ $totalVehicles }}";
    </script>
    <script src="{{ asset('/public/themeadmin/js/dashboard.js') }}"></script>
    <script src="{{ asset('/public/themeadmin/js/dashboardintrest.js') }}"></script>
@endsection
