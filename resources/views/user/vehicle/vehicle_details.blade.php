<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<style>
    .dotstats {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: transparent;
    }

    /* Animation CSS */

    .info-tile {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px 10px;
        border-radius: 6px;
        transition: background-color 0.3s;
        cursor: pointer;
    }

    .info-tile:hover {
        background-color: rgba(255, 255, 255, 0.05);
        /* subtle background on hover */
    }

    .info-icon {
        font-size: 32px;
        color: white;
        transition: transform 0.3s;
    }

    .info-label {
        opacity: 0;
        transform: translateY(10px);
        transition: opacity 0.3s, transform 0.3s;
        color: white;
        font-size: 14px;
        margin-top: 6px;
        text-align: center;
        pointer-events: none;
    }

    .info-tile:hover .info-label {
        opacity: 1;
        transform: translateY(0);
    }

    .info-value {
        font-size: 14px;
        color: white;
        margin-top: 4px;
        text-align: center;
    }

    .TestingDiv div {
        white-space: nowrap !important;
    }

    .dataDiv {
        margin-top: 5px !important;
    }

    .vehicle-spec-tile {
        display: flex;
        flex-direction: column;
        margin-bottom: 25px;
    }

    .vehicle-spec-label {
        color: #9FB3C8;
        font-size: 14px;
        margin-bottom: 6px;
        white-space: nowrap;
    }

    .vehicle-spec-content {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .vehicle-spec-icon {
        font-size: 24px;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 6px;
        background-color: rgba(255, 255, 255, 0.1);
    }

    .vehicle-spec-value {
        color: white;
        font-size: 15px;
        line-height: 1.4;
        word-break: break-word;
    }

    @media (max-width: 768px) {

        .col-md-3,
        .col {
            flex: 0 0 50%;
            max-width: 50%;
        }
    }

    .serviceHistory {
        border-radius: 10px;
        box-shadow: 10px;
        box-shadow:
            0 6px 20px rgba(0, 0, 0, 0.5),
            inset 0 2px 6px rgba(255, 255, 255, 0.05),
            inset 0 -2px 6px rgba(0, 0, 0, 0.4);
    }


    .serviceHistory .row {
        padding: 20px;
        /* width: 427px !important; */
    }

    .serviceHistory .row h5 {
        font-weight: 400 !important;
    }

    .service-title {
        font-weight: 400;
    }
</style>


<div class="p-4">
    <div class="row "
        style="padding: 28px 18px; border-radius: 4px; background-color: var(--bs-navbar-bg) !important; margin: 0px 40px">
        <div class="col-md-6">

            <!-- Main Image Swiper -->
            @if ($vehicle->getImages())
                <img src="{{ $vehicle->getImages()[0] }}" id="mainImage" class="  border mb-3 w-100"
                    style="height: 25rem;  object-fit: cover; cursor: pointer; border-radius: 10px"
                    alt="Vehicle Main Image" data-bs-toggle="modal" data-bs-target="#imageModal">
            @endif

            <div class="d-flex flex-wrap justify-content-left gap-2">
                <div class="swiper mySwiper" style="width: 100%; overflow: hidden;">
                    <div class="swiper-wrapper" style="display: flex;">
                        @foreach ($vehicle->getImages() as $index => $item)
                            <div class="swiper-slide" style="flex-shrink: 0; width: auto;">
                                <img src="{{ $item }}" class="img-thumbnail"
                                    style="cursor: pointer; width: 100px; height: 60px; border-radius: 10%; object-fit: cover;"
                                    onclick="setMainImage('{{ $item }}')">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content bg-white border-0 rounded">
                        <div class="modal-body p-0">
                            <img id="modalImage" src="" class="img-fluid rounded w-100"
                                style="object-fit: contain; max-height: 90vh;">
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Right Column: Info --}}
        <div class="col-md-6" style="background-color: none !important;">
            <h3 style="font-weight: 600;">{{ $vehicle->year }} {{ $vehicle->make->name ?? ' ' }}
                {{ $vehicle->model->name ?? ' ' }} –
                {{ $vehicle->variant->name ?? ' ' }}</h3>

            <section>
                <div style="max-width:920px;">
                    <div
                        style="background: #0f1c2c;
                        border-radius: 2px;
                        color: #e6edf3;
                        padding: 20px;
                        margin-bottom: 10px;">

                        <div class="row gx-3 gy-2 align-items-center text-center text-md-start">

                            {{-- Mileage --}}
                            <div class="col-6 col-md-3">
                                <div
                                    style="font-size:11px;letter-spacing:.03em;color:#9fb3c8;text-transform:uppercase;">
                                    Mileage</div>
                                <div style="font-size:18px;color:#fff;font-weight:600;" class="dataDiv">
                                    {{ number_format($vehicle->mileage ?? 0) }}
                                </div>
                            </div>

                            {{-- Grade --}}
                            <div class="col-6 col-md-3">
                                <div
                                    style="font-size:11px;letter-spacing:.03em;color:#9fb3c8;text-transform:uppercase;">
                                    Grade</div>
                                <span class="dataDiv"
                                    style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:50%;background:#1ed760;color:#063a1f;font-weight:700;font-size:15px;">
                                    {{ $vehicle->grade ?? '-' }}
                                </span>
                            </div>

                            {{-- Inspection --}}
                            <div class="col-6 col-md-3">
                                <div
                                    style="font-size:11px;letter-spacing:.03em;color:#9fb3c8;text-transform:uppercase;">
                                    Inspection</div>
                                @if (!empty($vehicle->inspection_report))
                                    <a class="dataDiv" href="{{ $vehicle->inspection_report }}" target="_blank"
                                        style="display:inline-block;background:#0080ff;color:#ffff;border:none;border-radius:2px;font-weight:600;font-size:12px;padding:4px 10px;text-decoration:none;box-shadow:inset 0 0 0 1px rgba(255,255,255,0.06);">
                                        Report
                                    </a>
                                @else
                                    <span class="dataDiv" style="font-size:13px;color:#777;">N/A</span>
                                @endif
                            </div>

                            {{-- Registration --}}
                            <div class="col-6 col-md-3">
                                <div style="font-size:11px;letter-spacing:.03em;color:#9fb3c8;text-transform:uppercase;"
                                    class="dataDiv">
                                    Reg</div>
                                <span class="dataDiv"
                                    style="display:inline-block;background:#fff;color:#0b2131;border-radius:2px;padding:4px 8px;font-weight:700;font-size:13px;letter-spacing:.04em;box-shadow:0 1px 0 rgba(0,0,0,0.15); border-left: solid 4px #0080ff;">
                                    {{ strtoupper($vehicle->reg ?? 'N/A') }}
                                </span>
                            </div>

                        </div>
                    </div>
                </div>
            </section>

            <div style=" background-color:#0f1c2c;
                    border-left:4px solid #0080ff;border-radius:2px;padding:20px;"
                class="TestingDiv">

                <!-- Top Grid -->
                <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:15px;margin-bottom:20px;align-items:center;"
                    class="testingDiv">

                    <!-- Auction House -->
                    <div style="display:flex;flex-direction:column;gap:4px;">
                        <span
                            style="font-size:11px;color:#a0a0a0;text-transform:uppercase;
                                letter-spacing:0.5px;font-weight:600; color:#9fb3c8;">Auction
                            House</span>
                        <span style="font-size:14px;color:#0080ff;font-weight:600;">
                            {{ $vehicle->auction->platform->name ?? 'N/A' }}
                        </span>
                    </div>

                    <!-- Auction Center -->
                    <div style="display:flex;flex-direction:column;gap:4px;">
                        <span
                            style="font-size:11px;color:#a0a0a0;text-transform:uppercase;
                                letter-spacing:0.5px;font-weight:600; color:#9fb3c8;">Auction
                            Center</span>
                        <span style="font-size:14px;color:#ffffff;font-weight:500;">
                            {{ $vehicle->auction->center->name ?? 'N/A' }}
                        </span>
                    </div>

                    <!-- Date / Time / End -->
                    <div style="display:flex;flex-direction:column;gap:4px;">
                        <span
                            style="font-size:11px;color:#a0a0a0;text-transform:uppercase;
                                letter-spacing:0.5px;font-weight:600; color:#9fb3c8;">Date
                            / Time / End</span>
                        <span style="font-size:14px;color:#ffffff;font-weight:500;">
                            {{ optional($vehicle->auction->auction_date)->format('d/m/Y H:i') ?? 'N/A' }}
                            @if ($vehicle->auction->end_date)
                                - {{ \Carbon\Carbon::parse($vehicle->auction->end_date)->format('H:i') }}
                            @endif
                        </span>
                    </div>

                    <!-- Lot -->
                    <div style="display:flex;flex-direction:column;gap:4px;">
                        <span
                            style="font-size:11px;color:#a0a0a0;text-transform:uppercase;
                                letter-spacing:0.5px;font-weight:600; color:#9fb3c8;">Lot</span>
                        <span style="font-size:14px;color:#ffffff;font-weight:500;">
                            {{ $vehicle->lot ?? 'N/A' }}
                        </span>
                    </div>
                </div>

                <!-- Bottom Grid -->
                <div
                    style="display:grid;grid-template-columns:repeat(4,1fr);gap:15px;
                        padding-top:20px;border-top:1px solid rgba(255,255,255,0.1);align-items:center;">

                    <!-- Auction Status -->
                    <div style="display:flex;flex-direction:column;gap:4px;">
                        <span
                            style="font-size:11px;color:#a0a0a0;text-transform:uppercase;
                                letter-spacing:0.5px;font-weight:600; color:#9fb3c8;">Auction
                            Status</span>
                        <span style="font-size:14px;color:#ffffff;font-weight:500;">
                            {{ ucfirst($vehicle->bidding_status ?? 'Planned') }}
                        </span>
                    </div>

                    <!-- Previous Auction -->
                    <div style="display:flex;flex-direction:column;gap:4px;">
                        <span
                            style="font-size:11px;color:#a0a0a0;text-transform:uppercase;
                                letter-spacing:0.5px;font-weight:600; color:#9fb3c8;">Previous
                            Auc</span>
                        <button id="prvactionspopup" data-vehid="{{ $vehicle->id }}"
                            data-regnum="{{ $vehicle->reg }}"
                            style="background-color:#0080ff;color:white;border:none;padding:5px;border-radius:2px;font-size:11px;font-weight:600;cursor:pointer; width: 80px; text-align: cenetr; display: flex; align-items: center; justify-content: center;">
                            View Details
                        </button>

                    </div>

                    <!-- Auction Type -->
                    <div style="display:flex;flex-direction:column;gap:4px;">
                        <span
                            style="font-size:11px;color:#a0a0a0;text-transform:uppercase;
                                letter-spacing:0.5px;font-weight:600; color:#9fb3c8;">Auc
                            Type</span>
                        <span style="font-size:14px;color:#ffffff;font-weight:500;">
                            {{ ucfirst($vehicle->auction->auction_type ?? 'N/A') }}
                        </span>
                    </div>

                    <!-- Reserve -->
                    <div style="display:flex;flex-direction:column;gap:4px;">
                        {{-- <span style="font-size:11px;color:#a0a0a0;text-transform:uppercase;
                                letter-spacing:0.5px;font-weight:600;">Reserve</span>
                    <span style="font-size:14px;color:#ffffff;font-weight:500;">
                        {{ $vehicle->reserve ?? 'Yes' }} --}}
                        </span>
                    </div>

                </div>
            </div>



            <div
                style="margin-top: 10px; background-color:#0f1c2c;border-left:5px solid red;padding:20px;border-radius:2px;width:100%;box-shadow:0 4px 6px rgba(0,0,0,0.3);">
                <h6
                    style="color: #ffffff;
                    font-weight: 600;
                    margin-bottom: 12px;
                    letter-spacing: 0.5px;
                    padding: 0px !important;
                    line-height: 1;">
                    Disclaimer</h6>
                <p style="color:#9FB3C8;font-size:14px;line-height:1.6;margin:0;">
                    AUTOBILI LTD aggregates vehicle auction data from third-party sources providing it 'as-is' to help
                    users make informed decisions, without guaranteeing data accuracy or completeness.
                    <a href="#" data-bs-toggle="modal" data-bs-target="#disclaimerModal"
                        style="color:#0ea5e9;text-decoration:none;cursor:pointer;font-weight:500;transition:color 0.3s ease;">learn
                        more</a>
                </p>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="disclaimerModal" tabindex="-1" aria-labelledby="disclaimerModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" style="background-color:#1a1f2e;border:1px solid #2d3748;">
                        <div class="modal-header" style="border-bottom:1px solid #2d3748;">
                            <h5 class="modal-title" id="disclaimerModalLabel" style="color:#ffffff;font-weight:600;">
                                Full Disclaimer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                style="filter:brightness(0) invert(1);"></button>
                        </div>
                        <div class="modal-body" style="color:#b0b8c1;line-height:1.6;">
                            <p><strong>AUTOBILI LTD Disclaimer:</strong></p>
                            <p>AUTOBILI LTD aggregates vehicle auction data from third-party sources and provides this
                                information on an 'as-is' basis to help users make informed decisions about vehicle
                                purchases and auctions.</p>
                            <p><strong>Data Accuracy:</strong> While we strive to provide accurate and up-to-date
                                information, we do not guarantee the accuracy, completeness, or reliability of any data
                                presented on our platform. Vehicle specifications, pricing, auction dates, and other
                                details may change without notice.</p>
                            <p><strong>Third-Party Sources:</strong> Our data is sourced from multiple third-party
                                providers. We are not responsible for any errors, omissions, or inaccuracies in the
                                original data provided by these sources.</p>
                            <p><strong>User Responsibility:</strong> Users are responsible for conducting their own due
                                diligence and verification of any information before making purchasing decisions. We
                                recommend independent inspection and verification of vehicles before participation in
                                auctions.</p>
                            <p><strong>Limitation of Liability:</strong> AUTOBILI LTD shall not be liable for any
                                direct, indirect, incidental, special, or consequential damages arising from the use of
                                our platform or reliance on the information provided.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


{{-- Quick Stats --}}
<div class="row text-start mb-5"
    style="margin-top: 50px; padding: 40px; background-color: #000f21; border-top: 1px solid var(--bs-border-color); border-bottom: 1px solid var(--bs-border-color)">
    @php
        $fields = [
            ['label' => 'Reg', 'value' => $vehicle->reg, 'icon' => 'directions_car'],
            ['label' => 'DOR', 'value' => $vehicle->dor, 'icon' => 'calendar_today'],
            ['label' => 'Mileage', 'value' => $vehicle->mileage, 'icon' => 'speed'],
            ['label' => 'Grade', 'value' => $vehicle->grade, 'icon' => 'star'],
            ['label' => 'V5', 'value' => $vehicle->v5_status ? 'Present' : 'Not Present', 'icon' => 'description'],
        ];
    @endphp

    @foreach ($fields as $field)
        <div class="col">
            <div style="display: flex; align-items: center; gap: 8px;">
                <div class="dotstats-box"
                    style="background-color: #2b589430 !important; display:flex; align-items: center; justify-content: center; margin: 5px;">
                    <div class="dotstats" style="background-color: none !important;">
                        <span class="material-icons" style="font-size: 20px; color: #0080ff;">
                            {{ $field['icon'] }}
                        </span>
                    </div>
                </div>
                <div>
                    <div style="color: white; display: flex; align-items: center;">
                        {{ $field['value'] }}
                    </div>
                    <div style="color: #9FB3C8; font-size: 14px;">{{ $field['label'] }}</div>
                </div>
            </div>
        </div>
    @endforeach

</div>

{{-- End Quick Stat --}}



{{-- Overview --}}

<div class="row " style="background: #0f1c2c; margin-bottom: 12px; margin-top: 60px;">
    {{-- Left Column (Overview, Additional Info, Features) --}}
    <div class="col-md-8 sider" style="padding-left: 60px;">
        <div class="row" style="padding: 50px;">
            <h4 class="pt-4">Overview</h4>
            @php
                $fields = [
                    [
                        'label' => 'Vehicle Type',
                        'value' => $vehicle->vehicle_type->name ?? '',
                        'icon' => 'directions_car',
                    ],
                    [
                        'label' => 'Make',
                        'value' => $vehicle->make->name ?? '',
                        'icon' => 'warehouse',
                    ],
                    ['label' => 'Model', 'value' => $vehicle->model->name ?? '', 'icon' => 'directions_car_filled'],
                    ['label' => 'Variant', 'value' => $vehicle->variant->name ?? '', 'icon' => 'style'],
                    ['label' => 'CC', 'value' => $vehicle->cc ?? '', 'icon' => 'speed'],
                    ['label' => 'Year', 'value' => $vehicle->year ?? '', 'icon' => 'calendar_today'],
                    ['label' => 'Color', 'value' => $vehicle->color->name ?? '', 'icon' => 'palette'],
                    ['label' => 'Fuel Type', 'value' => $vehicle->fuel_type ?? '', 'icon' => 'local_gas_station'],
                    ['label' => 'Transmission', 'value' => $vehicle->transmission ?? '', 'icon' => 'settings'],
                    ['label' => 'Keys', 'value' => $vehicle->keys ?? '', 'icon' => 'vpn_key'],
                    ['label' => 'Doors', 'value' => $vehicle->doors ?? '', 'icon' => 'door_front'],
                    ['label' => 'Seats', 'value' => $vehicle->seats ?? '', 'icon' => 'event_seat'],
                ];
            @endphp

            @foreach ($fields as $field)
                <div class="col-md-3 col vehicle-spec-tile">
                    <div class="vehicle-spec-label" style="font-size: 14px; margin-bottom: 10px;">
                        {{ $field['label'] }}
                        {{-- <div style="border-bottom: solid 1px #0080ff80; width: 20%;"></div> --}}
                    </div>
                    <div class="vehicle-spec-content">
                        <div class="">
                            <span class="material-icons">{{ $field['icon'] }}</span>
                        </div>
                        <div class="vehicle-spec-value">{{ $field['value'] }}</div>
                    </div>
                </div>
            @endforeach
        </div>



        {{-- Additional Information --}}
        <div class="row" style="padding: 50px;">
            <h4 class="mt-4">Additional Information</h4>

            @php
                $moreFields = [
                    ['label' => 'Former Keepers', 'value' => $vehicle->former_keepers ?? '', 'icon' => 'people'],
                    ['label' => 'Vendors', 'value' => $vehicle->vendor ?? '', 'icon' => 'store'],
                    ['label' => 'Registration', 'value' => $vehicle->reg ?? '', 'icon' => 'confirmation_number'],
                    ['label' => 'VAT Type', 'value' => $vehicle->vat_status ?? '', 'icon' => 'receipt'],
                    ['label' => 'Euro Status', 'value' => $vehicle->euro_status ?? '', 'icon' => 'eco'],
                    ['label' => 'Engine Runs', 'value' => $vehicle->engine_runs ?? '', 'icon' => 'build_circle'],
                ];
            @endphp

            <div class="row mt-4">
                @foreach ($moreFields as $field)
                    <div class="col-md-3 col vehicle-spec-tile">
                        <div class="vehicle-spec-label" style="font-size: 14px; margin-bottom: 10px;">
                            {{ $field['label'] }}
                            {{-- <div style="border-bottom: solid 1px #0080ff80; width: 20%;"></div> --}}
                        </div>
                        <div class="vehicle-spec-content">
                            <div class="">
                                <span class="material-icons">{{ $field['icon'] }}</span>
                            </div>
                            <div class="vehicle-spec-value">{{ $field['value'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    <div class="col-md-3">
        <div class="sider p-3 serviceHistory" style="background-color: var(--bs-navbar-bg) !important;">
            <div class="row">
                <h5>Service History</h5>
                <!-- Column 1 -->
                <div class="col-md-6">

                    <ul class="service-list">
                        <div class="service-title">Service Report</div>
                        <li class="d-flex align-items-center mb-2 mt-2">
                            {{-- <div class="dot-box">
                                <div class="dot"></div>
                            </div> --}}
                            <span class="disc">{{ $vehicle->service_history }}</span>
                        </li>
                    </ul>

                    <ul class="service-list">
                        <div class="service-title">Last Service</div>
                        <li class="d-flex align-items-center mb-2 mt-2">
                            {{-- <div class="dot-box">
                                <div class="dot"></div>
                            </div> --}}
                            <span class="disc">{{ $vehicle->last_service }}</span>
                        </li>
                    </ul>

                    <ul class="service-list">
                        <div class="service-title">DVSA Mileage</div>
                        <li class="d-flex align-items-start ixed mb-2 mt-2">
                            {{-- <div class="dot-box ">
                                <div class="dot p-2 m-2"></div>
                            </div> --}}
                            <span class="disc">{{ $vehicle->dvsa_mileage }}</span>
                        </li>
                    </ul>

                    <ul class="service-list">
                        <div class="service-title">MOT Expiry Date</div>
                        <li class="d-flex align-items-center mb-2 mt-2">
                            {{-- <div class="dot-box">
                                <div class="dot"></div>
                            </div> --}}
                            <span class="disc">{{ $vehicle->mot_expiry_date }}</span>
                        </li>
                    </ul>

                </div>
                <!-- Column 2 -->
                <div class="col-md-6 ps-4">

                    <ul class="service-list">
                        <div class="service-title">No of Services</div>
                        <li class="d-flex align-items-center mb-2 mt-2">
                            {{-- <div class="dot-box">
                                <div class="dot"></div>
                            </div> --}}
                            <span class="disc">{{ $vehicle->no_of_services }}</span>
                        </li>
                    </ul>

                    <ul class="service-list">
                        <div class="service-title">Last Service Mileage</div>
                        <li class="d-flex align-items-center mb-2 mt-2">
                            {{-- <div class="dot-box">
                                <div class="dot"></div>
                            </div> --}}
                            <span class="disc">{{ $vehicle->last_service_mileage }}</span>
                        </li>
                    </ul>

                    <ul class="service-list">
                        <div class="service-title">Service Notes</div>
                        <li class="d-flex align-items-center mb-2 mt-2">
                            {{-- <div class="dot-box">
                                <div class="dot"></div>
                            </div> --}}
                            <span class="disc">{{ $vehicle->service_notes }}</span>
                        </li>
                    </ul>

                    <ul class="service-list">
                        <div class="service-title">MOT Due</div>
                        <li class="d-flex align-items-center mb-2 mt-2">
                            {{-- <div class="dot-box">
                                <div class="dot"></div>
                            </div> --}}
                            <span class="disc">{{ $vehicle->mot_due }}</span>
                        </li>
                    </ul>

                </div>

            </div>
        </div>
    </div>
</div>

<div class="row">
    {{-- Left Column (Overview, Additional Info, Features) --}}
    <div class="col-md-5" style="padding-left: 60px;">
        <h4 class="mt-4">Features</h4>
        <div class="row">
            <div>
                <ul class="row" style="list-style: none; padding-left: 0;">
                    @foreach (explode(',', $vehicle->features) as $item)
                        <li class="col-4 mb-2">{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    {{-- <div class="col-1"></div>row text-start mb-4 --}}
    <div class="col-md-5" style="padding-left: 60px;">
        <h4 class="mt-4">Equipment</h4>
        <div class="row">
            <div class="col-md-12">
                <ul class="row" style="list-style: none; padding-left: 0;">
                    @foreach (explode(',', $vehicle->equipment) as $item)
                        <li class="col-4 mb-2">{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
