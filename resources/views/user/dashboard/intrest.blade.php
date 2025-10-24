<style>
.small-select {
    height: 30px;    
    font-size: 12px;  
    padding: 2px 6px;  
}
#yearFilter,
#gradeFilter {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background: url('data:image/svg+xml;utf8,<svg fill="black" height="12" viewBox="0 0 24 24" width="12" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/></svg>') no-repeat right 10px center;
    border-radius: 5px;
    width: 70px;
}


</style>
<div class=" p-4 d-flex align-items-center justify-content-start gap-3 mx-0 pl-4"
    style="background-color: #006aee; margin-top: -60px;" id="interest-buttons-container">

<div class=" "style=" color: black; margin-left: 40px;">
    Select all Intrest
    </div>


    <div class="d-flex align-items-center gap-3 overflow-x-auto flex-nowrap" id="interest-buttons-wrapper"
        style="max-width: 620px; color: black;">
        <span class=" small fw-medium me-2 flex-shrink-0">Select Interest</span>
        <button class="btn btn-primary rounded-3 fw-medium border-solid interest-button active flex-shrink-0"
            style="color: rgb(236, 229, 229) !important;">Toyota Prius I </button>
    </div>


    <a href="{{ url('/interest/create') }}"
        class="btn  fw-medium  d-flex align-items-center interest-button "
        style= "border-left: 1px solid var(--bs-b-color); border-radius:0%"
        
        id="add-interest-button">
        <svg  class="text-secondary text-white" style="width: 16px; height: 16px;" fill="none" stroke="currentColor"
            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4
            
            ">
            </path>
        </svg>
        <span class="ms-1" style="border: none; color: white; ">Add</span>
    </a>

</div>

<div class=" p-4 d-flex align-items-center justify-content-start gap-3 mb-5 mx-0 pl-4"
    style="background-color: #000f21; color: white;" >

<div class="d-flex " style="color:rgba(255, 255, 255, 0.829); margin-left: 40px;">
   Vehicle : 
   <div id="veh_name" class=" " style="margin-left:8px; margin-right:8px;">
    
   </div>
<div class="filters d-flex gap-2">

    <select id="yearFilter" class="form-select small-select">
        
    </select>


    <select id="gradeFilter" class="form-select small-select">
     
    </select>


    {{-- <select id="mileageFilter" class="form-select small-select">
        
    </select> --}}
</div>





</div>


   



</div>


<div class=" " style="padding: 0rem 4rem;">
    <div class="col-md-12">

        @include('user.dashboard.infointrestcard')

        <br><br>
        <div class="d-flex gap-4 mt-n4 h-auto" style="align-items: stretch;">

            <!-- Left: Auction Chart -->
            <div class="flex" style="width: 40%">
                <div id="stockAuctionHouse" class="card text-white rounded-4 shadow-sm h-100" 
                    style="padding: 25px; background-color: #0f172a; min-height: 420px;">
                    
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="fw-semibold mb-0">Stock in Auction House</h5>
                       
                        </div>
                    </div>

                    <div class="row h-100">
                        <div class=" d-flex align-items-center">
                            <div style="width:100%; height:auto;">
                                <canvas class="chart"></canvas>
                            </div>
                        </div>
                        <div class=" d-flex align-items-center">
                            <div style="width:100%; height:auto;" id="chats_color">
                                
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>

                <!-- Right: Valuation -->
                <div style="flex: 1; width: 60%">
                    <div class="getValuation card text-white rounded-4 shadow-sm h-100 valuesation" 
                        style="background-color: #0f172a; min-height: 420px;">
                        <div class="card-header border-0 bg-transparent">
                            <div class="row">
                                <div class="col-md-4">
                                    <h5 class="mb-0">Valuation</h5>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control platforms" name="platform_ids[]" multiple>
                                        <option value="">Select</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control centersid" name="centers_id[]" multiple>
                                        <option value="">Select</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="container mt-3 p-0">
                                {{-- <div class="valuation-header text-dark rounded-2 mx-2" 
                                    style="background-color: #006aee !important;">
                                    <div class="d-flex align-items-center justify-content-between p-3">
                                      
                                    
                                        <div class="d-flex align-items-center gap-2" style="margin-left: 50px;">
                                            <div style="background-color: black;padding: 12px;border-radius: 9px;">

                                                <img src="{{ asset('/public/themeadmin/autobolidp.png') }}" 
                                                alt="" width="35" height="35" />
                                            </div>
                                            <div class=" text-black px-4 py-2 fw-semibold fs-5 d-inline-block" id="overAllavg"
                                                style=" letter-spacing: 0.5px;">
                                           
                                            <small class="d-block fs-6 fw-medium opacity-75 mt-1">Over All</small>
                                            </div>


                                        </div>
                                    </div>
                                </div> --}}

                                <div class="rows px-3 py-2">
                                   <div style=" border-radius:8px; padding:20px; overflow-x:auto;">
                                       <table style="width:100%; margin-bottom:0; border-collapse:collapse;">
                                            <thead style="border-bottom:1px solid #ffffff;">
                                                <tr>
                                                    <th style="font-weight:600; font-size:13px; padding:16px 12px; text-align:left;">Auc House</th>
                                                    <th style="font-weight:600; font-size:13px; padding:16px 12px; text-align:left;">Center</th>
                                                    <th style="font-weight:600; font-size:13px; padding:16px 12px; text-align:left;">Previous Week</th>
                                                    <th style="font-weight:600; font-size:13px; padding:16px 12px; text-align:left;">CAP C</th>
                                                    <th style="font-weight:600; font-size:13px; padding:16px 12px; text-align:left;">CAP Avg</th>
                                                    <th style="font-weight:600; font-size:13px; padding:16px 12px; text-align:left;">Trade</th>
                                                </tr>
                                            </thead>
                                            <tbody id="valuationTableBody">
                                                <!-- Dynamic rows appear here -->
                                            </tbody>
                                        </table>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <!-- Left Side: Stats -->

        {{-- <br><br>
        <div class="row" style="margin-top: -20px;">


            <!-- Left Side: Stats -->
            <div class="col-md-7 previousLots">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title m-0 me-2">Previous Lots</h5>
                        <div class="col-md-4">
                            <select class="form-control platform" name="platform_ids[]" multiple>
                                <option value="">Select</option>
                                <!-- Populate options dynamically via backend -->
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-borderless border-top">
                            <thead class="border-bottom">
                                <tr>
                                    <th style="font-size: var(--font-p2) !important;">Platform</th>
                                    <th style="font-size: var(--font-p2) !important;">Auction Type</th>
                                    <th style="font-size: var(--font-p2) !important;">Sold</th>
                                    <th style="font-size: var(--font-p2) !important;">Provisional</th>
                                    <th style="font-size: var(--font-p2) !important;">Not Sold</th>
                                </tr>
                            </thead>
                            <tbody class="rows tb-data-fonts">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-5 upComingVehicles">
                <div class="card h-100">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="card-title m-0 me-2">Upcoming Vehicles</h5>
                                <span class="vehicles_count">0 Vehicles</span>
                            </div>
                            <div class="col-md-6 text-end">
                                <a href="{{ url('/auctionfinder') }}" target="_blank">View All</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-borderless border-top" id="">
                            <thead class="border-bottom">
                                <tr>
                                    <th style="font-size: var(--font-p2) !important;">Vehicle</th>
                                    <th style="font-size: var(--font-p2) !important;">Mileage</th>
                                    <th style="font-size: var(--font-p2) !important;">Report</th>
                                    <th style="font-size: var(--font-p2) !important;">Autoboli</th>
                                </tr>
                            </thead>
                            <tbody class="rows">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>

@include('user.dashboard.createyourinterest')

