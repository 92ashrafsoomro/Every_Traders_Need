<!-- ========= VEHICLE BASIC INFO ========= -->

<style>
    .tags span {
        padding: 10px;
        background-color: transparent;
        border: 1px solid #0080ff !important;
        gap: 1px;
        margin: 4px 0px;
        border-radius: 16px;
        cursor: pointer;
        font-size: 12px;
        font-weight: 400;
    }

    a.see-more-makes.text-primary {
        font-size: small;
        text-align: center !important;
        margin: 20px;
    }

    .accordion-button {
        color: white !important;
        font-weight: 600 !important;
    }
</style>




<!-- Vehicle Type Filter -->
<div class="accordion-item">
    <h2 class="accordion-header" id="headingVehicleType">
        <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseVehicleType" aria-expanded="false" aria-controls="collapseVehicleType">
            Vehicle Type
        </button>
    </h2>
    <div id="collapseVehicleType" class="accordion-collapse collapse show" aria-labelledby="headingVehicleType"
        data-bs-parent="#filterAccordion"></div>
    <div class="tags tags-type"></div>
</div>

<!-- Make Filter -->
<div class="accordion-item  ">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseVehiclemake" aria-expanded="false" aria-controls="collapseVehiclemake">
            Make
        </button>
    </h2>
    <div id="collapseVehiclemake" class="accordion-collapse collapse" data-bs-parent="#filterAccordion"></div>
    <div class="tags tags-make"></div>
</div>

<!-- Model Filter -->
<div class="accordion-item" disbale>
    <h2 class="accordion-header">
        <button class="accordion-button collapsed py-2" id="modelAccordionBtn" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseVehiclemodel" aria-expanded="false" aria-controls="collapseVehiclemodel"
            style="opacity: 0.5">
            Model
        </button>
    </h2>
    <div id="collapseVehiclemodel" class="accordion-collapse collapse" data-bs-parent="#filterAccordion"></div>
    <div class="tags tags-model"></div>
</div>

<!-- Variant Filter -->
<div class="accordion-item  ">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed py-2" id="model_variantAccordionBtn" type="button"
            data-bs-toggle="collapse" data-bs-target="#collapseVehiclevariant" aria-expanded="false"
            aria-controls="collapseVehiclevariant" style="opacity: 0.5">
            Model Variant
        </button>
    </h2>
    <div id="collapseVehiclevariant" class="accordion-collapse collapse" data-bs-parent="#filterAccordion"></div>
    <div class="tags tags-variant"></div>
</div>

<hr class="my-2">

<div class="accordion-item">
    <h2 class="accordion-header" id="headingAuctionDate">
        <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseAuctionDate" aria-expanded="false" aria-controls="collapseAuctionDate">
            Auction Date
        </button>
    </h2>

    <div id="collapseAuctionDate" class="accordion-collapse collapse" aria-labelledby="headingAuctionDate"
        data-bs-parent="#filterAccordion">

        <div id="dateFilterContainer" class="p-3 text-light">
            <div class="text-center py-2 text-muted small">Loading...</div>
        </div>

    </div>
    <div class="tags tags-auction_date"></div>
</div>


<!-- Auction House -->
<div class="accordion-item">
    <h2 class="accordion-header" id="headingAuctionHouse">
        <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseAuctionHouse" aria-expanded="false" aria-controls="collapseAuctionHouse">
            Auction House
        </button>
    </h2>
    <div id="collapseAuctionHouse" class="accordion-collapse collapse" aria-labelledby="headingAuctionHouse"
        data-bs-parent="#filterAccordion">
    </div>
    <div class="tags tags-auction_house"></div>
</div>

<!-- Auction Center -->
<div class="accordion-item">
    <h2 class="accordion-header" id="headingAuctionCenter">
        <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseAuctionCenter" aria-expanded="false" aria-controls="collapseAuctionCenter">
            Auction Center
        </button>
    </h2>
    <div id="collapseAuctionCenter" class="accordion-collapse collapse" aria-labelledby="headingAuctionCenter"
        data-bs-parent="#filterAccordion">
    </div>
    <div class="tags tags-auction_center"></div>
</div>




<hr class="my-2">

<!-- Year -->
<div class="accordion-item  ">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseVehicleyear" aria-expanded="false" aria-controls="collapseVehicleyear">
            Years
        </button>
    </h2>
    <div id="collapseVehicleyear" class="accordion-collapse collapse" data-bs-parent="#filterAccordion"></div>
    <div class="tags tags-year"></div>
</div>

<!-- Transmission -->
<div class="accordion-item  ">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseTransmission" aria-expanded="false" aria-controls="collapseTransmission">
            Transmission
        </button>
    </h2>
    <div id="collapseTransmission" class="accordion-collapse collapse" data-bs-parent="#filterAccordion"></div>
    <div class="tags tags-transmission"></div>
</div>

<!-- Fuel Type -->
<div class="accordion-item  ">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapsefuel" aria-expanded="false" aria-controls="collapsefuel">
            Fuel Type
        </button>
    </h2>
    <div id="collapsefuel" class="accordion-collapse collapse" data-bs-parent="#filterAccordion"></div>
    <div class="tags tags-fuel_type"></div>
</div>

<!-- Color -->
{{-- <div class="accordion-item  ">
   <h2 class="accordion-header">
      <button class="accordion-button collapsed py-2" type="button"
         data-bs-toggle="collapse" data-bs-target="#collapseVehiclecolor"
         aria-expanded="false" aria-controls="collapseVehiclecolor">
         Color
      </button>
   </h2>
   <div id="collapseVehiclecolor" class="accordion-collapse collapse"
      data-bs-parent="#filterAccordion"></div>
   <div class="tags tags-color"></div>
</div> --}}



<!-- doors -->
<div class="accordion-item  ">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapsedoors" aria-expanded="false" aria-controls="collapsedoors">
            Doors
        </button>
    </h2>
    <div id="collapsedoors" class="accordion-collapse collapse" data-bs-parent="#filterAccordion"></div>
    <div class="tags tags-doors"></div>
</div>

<!-- Seats -->
<div class="accordion-item  ">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseseats" aria-expanded="false" aria-controls="collapseseats">
            Seats
        </button>
    </h2>
    <div id="collapseseats" class="accordion-collapse collapse" data-bs-parent="#filterAccordion"></div>
    <div class="tags tags-seat"></div>
</div>

<!-- Grade -->
<div class="accordion-item  ">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapsegrade" aria-expanded="false" aria-controls="collapsegrade">
            Grade
        </button>
    </h2>
    <div id="collapsegrade" class="accordion-collapse collapse" data-bs-parent="#filterAccordion"></div>
    <div class="tags tags-grade"></div>
</div>




<!-- V5 -->
<div class="accordion-item  ">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapsev5" aria-expanded="false" aria-controls="collapsev5">
            V5
        </button>
    </h2>
    <div id="collapsev5" class="accordion-collapse collapse" data-bs-parent="#filterAccordion"></div>
    <div class="tags tags-v5"></div>
</div>

<!-- Engine Size -->
<div class="accordion-item  ">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapsecc" aria-expanded="false" aria-controls="collapsecc">
            Engine Size (CC)
        </button>
    </h2>
    <div id="collapsecc" class="accordion-collapse collapse" data-bs-parent="#filterAccordion"></div>
    <div class="tags tags-cc"></div>
</div>

<!-- Former Keepers -->
<div class="accordion-item  ">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseformer_keepers" aria-expanded="false" aria-controls="collapseformer_keepers">
            Former Keepers
        </button>
    </h2>
    <div id="collapseformer_keepers" class="accordion-collapse collapse" data-bs-parent="#filterAccordion"></div>
    <div class="tags tags-former_keeper"></div>
</div>

<!-- No. of Services -->
<div class="accordion-item  ">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapsenumber_of_services" aria-expanded="false"
            aria-controls="collapsenumber_of_services">
            No. of Services
        </button>
    </h2>
    <div id="collapsenumber_of_services" class="accordion-collapse collapse" data-bs-parent="#filterAccordion"></div>
    <div class="tags tags-no_of_service"></div>
</div>




<div class="accordion-item  ">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseMileage" aria-expanded="false" aria-controls="collapseMileage">
            Mileage
        </button>
    </h2>
    <div id="collapseMileage" class="accordion-collapse collapse" aria-labelledby="headingMileage"
        data-bs-parent="#filterAccordion">
        <div class="accordion-body py-1">
            <div class="row">
                <div class="col-6">
                    <select class="form-select" id="mileage_from">
                        <option value="">From</option>
                        <option value="0">0</option>
                        <option value="10000">10,000</option>
                        <option value="20000">20,000</option>
                        <option value="30000">30,000</option>
                        <option value="40000">40,000</option>
                        <option value="50000">50,000</option>
                    </select>
                </div>
                <div class="col-6">
                    <select class="form-select" id="mileage_to">
                        <option value="">To</option>
                        <option value="10000">10,000</option>
                        <option value="20000">20,000</option>
                        <option value="30000">30,000</option>
                        <option value="40000">40,000</option>
                        <option value="50000">50,000</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="tags tags-mileage_range"></div>
</div>
