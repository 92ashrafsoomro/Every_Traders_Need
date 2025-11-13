<template>
    <v-row dense>
        <v-col cols="12" class="mt-4">
            <v-card class="pa-5">
                <v-row>
                    <v-col cols="12" lg="6" md="6" sm="12" class="d-flex flex-column justify-start">
                        <CarSlider />
                    </v-col>
                    <v-col cols="12" lg="6" md="6" sm="12" class="ps-5 pr-5">
                        <h1 class="text-h5 text-lg-h3  font-weight-bold"> {{ vehicleStore.v.vehicle.title }}</h1>
                        <v-row class="mt-2 bg-background">
                            <v-col cols="6" sm="3">
                                <v-card flat color="transparent">
                                    <v-card-title class="text-caption">Mileage</v-card-title>
                                    <v-card-subtitle class="text-medium-emphasis mt-n2"> {{
                                        vehicleStore.v.vehicle.mileage }}
                                    </v-card-subtitle>
                                </v-card>
                            </v-col>
                            <v-col cols="6" sm="3">
                                <v-card flat color="transparent">
                                    <v-card-title class="text-caption">Grade</v-card-title>
                                    <v-card-subtitle class="text-medium-emphasis mt-n2">{{ vehicleStore.v.vehicle.grade
                                        }}</v-card-subtitle>
                                </v-card>
                            </v-col>
                            <v-col cols="6" sm="3">
                                <v-card flat color="transparent">
                                    <v-card-title class="text-caption">Inspection</v-card-title>
                                    <v-btn density="compact" color="primary" class="ml-4 text-caption">Report</v-btn>
                                </v-card>
                            </v-col>
                            <v-col cols="6" sm="3">
                                <v-card flat color="transparent">
                                    <v-card-title class="text-caption">Reg</v-card-title>
                                    <v-btn density="compact"
                                        class="bg-white ml-4 text-caption border-s-xl font-weight-medium border-primary">{{
                                        vehicleStore.v.vehicle.reg }}
                                    </v-btn>
                                </v-card>
                            </v-col>
                        </v-row>
                        <v-row class="mt-5 bg-background" style="border-left: 4px solid var(--primary-color);">
                            <v-col cols="6" sm="3">
                                <v-card flat color="transparent">
                                    <v-card-title class="text-caption">Auction House</v-card-title>
                                    <v-card-subtitle
                                        class="text-medium-emphasis mt-n2 font-weight-medium text-primary text-wrap text-caption">
                                        {{ vehicleStore.v.vehicle.platform_name }}</v-card-subtitle>
                                </v-card>
                            </v-col>
                            <v-col cols="6" sm="3">
                                <v-card flat color="transparent">
                                    <v-card-title class="text-caption">Auction Center</v-card-title>
                                    <v-card-subtitle class="text-medium-emphasis mt-n2">{{
                                        vehicleStore.v.vehicle.center_name }}</v-card-subtitle>
                                </v-card>
                            </v-col>
                            <v-col cols="6" sm="3">
                                <v-card flat color="transparent">
                                    <v-card-title class="text-caption">Date / Time / End</v-card-title>
                                    <v-card-subtitle class="text-medium-emphasis mt-n2">{{
                                        vehicleStore.v.vehicle.auction_date }}</v-card-subtitle>
                                </v-card>
                            </v-col>
                            <v-col cols="6" sm="3">
                                <v-card flat color="transparent">
                                    <v-card-title class="text-caption">Lot</v-card-title>
                                    <v-card-subtitle class="text-medium-emphasis mt-n2">{{
                                        vehicleStore.v.vehicle.lot}}</v-card-subtitle>
                                </v-card>
                            </v-col>
                            <v-divider class="ms-5 me-5 mb-n1"></v-divider>
                            <v-col cols="6" sm="3">
                                <v-card flat color="transparent">
                                    <v-card-title class="text-caption">Auction Status</v-card-title>
                                    <v-card-subtitle class="text-medium-emphasis mt-n2">{{
                                        vehicleStore.v.vehicle.bidding_status}}</v-card-subtitle>
                                </v-card>
                            </v-col>
                            <v-col cols="6" sm="3">
                                <v-card flat color="transparent">
                                    <v-card-title class="text-caption">Previous Auc</v-card-title>
                                    <v-btn density="compact" color="primary" class="ml-4 text-caption ps-2 pe-2">View
                                        Details</v-btn>
                                </v-card>
                            </v-col>
                            <v-col cols="6" sm="3">
                                <v-card flat color="transparent">
                                    <v-card-title class="text-caption">Auc Type</v-card-title>
                                    <v-card-subtitle class="text-medium-emphasis mt-n2">Online
                                        Auction</v-card-subtitle>
                                </v-card>
                            </v-col>
                        </v-row>
                        <v-row class="mt-5 bg-background" style="border-left: 4px solid var(--danger-color);">
                            <v-col cols="12">
                                <v-card flat color="transparent" class="mt-n2">
                                    <v-card-title>Disclaimer</v-card-title>
                                    <v-card-subtitle class="text-medium-emphasis text-wrap">
                                        AUTOBILI LTD aggregates vehicle auction data from third-party
                                        sources providing it 'as-is' to help users make informed
                                        decisions,
                                        without guaranteeing data accuracy or completeness. <span
                                            class="text-primary">learn more</span>
                                    </v-card-subtitle>
                                </v-card>
                            </v-col>
                        </v-row>
                    </v-col>
                </v-row>
            </v-card>
        </v-col>
    </v-row>

    <v-row class="d-flex align-center justify-center ga-1 bg-surface border-t border-b pt-8 pb-8">
        <v-col cols="6" lg="2" md="2" sm="3" class="d-flex align-center flex-column flex-sm-row ga-2">
            <v-card class="bg-shadow pa-1 pa-lg-3 rounded-lg">
                <v-icon color="primary">mdi-car</v-icon>
            </v-card>
            <div class="d-flex flex-column ga-1">
                <p class="text-caption">{{ vehicleStore.v.vehicle.reg }}</p>
                <p class="text-caption mt-n1">Reg</p>
            </div>
        </v-col>
        <v-col cols="6" lg="2" md="2" sm="3" class="d-flex align-center flex-column flex-sm-row ga-2">
            <v-card class="bg-shadow pa-1 pa-lg-3 rounded-lg">
                <v-icon color="primary">mdi-calendar</v-icon>
            </v-card>
            <div class="d-flex flex-column ga-1">
                <p class="text-caption">{{ vehicleStore.v.vehicle.dor }}</p>
                <p class="text-caption mt-n1">DOR</p>
            </div>
        </v-col>
        <v-col cols="6" lg="2" md="2" sm="3" class="d-flex align-center flex-column flex-sm-row ga-2">
            <v-card class="bg-shadow pa-1 pa-lg-3 rounded-lg">
                <v-icon color="primary">mdi-speedometer-medium</v-icon>
            </v-card>
            <div class="d-flex flex-column ga-1">
                <p class="text-caption">{{ vehicleStore.v.vehicle.mileage }}</p>
                <p class="text-caption mt-n1">Mileage</p>
            </div>
        </v-col>
        <v-col cols="6" lg="2" md="2" sm="3" class="d-flex align-center flex-column flex-sm-row ga-2">
            <v-card class="bg-shadow pa-1 pa-lg-3 rounded-lg">
                <v-icon color="primary">mdi-creation-outline</v-icon>
            </v-card>
            <div class="d-flex flex-column ga-1">
                <p class="text-caption">{{ vehicleStore.v.vehicle.grade }}</p>
                <p class="text-caption mt-n1">Grade</p>
            </div>
        </v-col>
        <v-col cols="6" lg="2" md="2" sm="3" class="d-flex align-center flex-column flex-sm-row ga-2">
            <v-card class="bg-shadow pa-1 pa-lg-3 rounded-lg">
                <v-icon color="primary">mdi-file-document</v-icon>
            </v-card>
            <div class="d-flex flex-column ga-1">
                <p class="text-caption">{{ vehicleStore.v.vehicle.v5 }}</p>
                <p class="text-caption mt-n1">V5</p>
            </div>
        </v-col>
    </v-row>


    <v-row class="mt-8">
        <v-col cols="12" md="8">
            <v-card flat color="transparent" class="pa-1 pa-lg-5">
                <v-container>
                    <v-row>
                        <v-card-title class="text-h4 font-weight-medium">
                            Overview
                        </v-card-title>
                    </v-row>
                    <v-row>
                        <v-col cols="6" sm="3">
                            <v-card flat color="transparent">
                                <v-card-title class="text-overline">Vehicle Type</v-card-title>
                                <div class="d-flex align-center ga-2">
                                    <v-icon>mdi-car</v-icon>
                                    <p class="text-caption">Car</p>
                                </div>
                            </v-card>
                        </v-col>
                        <v-col cols="6" sm="3">
                            <v-card flat color="transparent">
                                <v-card-title class="text-overline">Make</v-card-title>
                                <div class="d-flex align-center ga-2">
                                    <v-icon>mdi-steering</v-icon>
                                    <p class="text-caption">BMW</p>
                                </div>
                            </v-card>
                        </v-col>
                        <v-col cols="6" sm="3">
                            <v-card flat color="transparent">
                                <v-card-title class="text-overline">Model</v-card-title>
                                <div class="d-flex align-center ga-2">
                                    <v-icon>mdi-car-cog</v-icon>
                                    <p class="text-caption">3 Series</p>
                                </div>
                            </v-card>
                        </v-col>
                        <v-col cols="6" sm="3">
                            <v-card flat color="transparent">
                                <v-card-title class="text-overline">Variant</v-card-title>
                                <div class="d-flex align-center ga-2">
                                    <v-icon>mdi-cards</v-icon>
                                    <p class="text-caption">330e</p>
                                </div>
                            </v-card>
                        </v-col>
                        <v-col cols="6" sm="3">
                            <v-card flat color="transparent">
                                <v-card-title class="text-overline">CC</v-card-title>
                                <div class="d-flex align-center ga-2">
                                    <v-icon>mdi-speedometer-medium</v-icon>
                                    <p class="text-caption">2.0</p>
                                </div>
                            </v-card>
                        </v-col>
                        <v-col cols="6" sm="3">
                            <v-card flat color="transparent">
                                <v-card-title class="text-overline">Year</v-card-title>
                                <div class="d-flex align-center ga-2">
                                    <v-icon>mdi-calendar</v-icon>
                                    <p class="text-caption">2022</p>
                                </div>
                            </v-card>
                        </v-col>
                        <v-col cols="6" sm="3">
                            <v-card flat color="transparent">
                                <v-card-title class="text-overline">Color</v-card-title>
                                <div class="d-flex align-center ga-2">
                                    <v-icon>mdi-palette</v-icon>
                                    <p class="text-caption"></p>
                                </div>
                            </v-card>
                        </v-col>
                        <v-col cols="6" sm="3">
                            <v-card flat color="transparent">
                                <v-card-title class="text-overline">Fuel Type</v-card-title>
                                <div class="d-flex align-center ga-2">
                                    <v-icon>mdi-gas-station</v-icon>
                                    <p class="text-caption">Hybrid</p>
                                </div>
                            </v-card>
                        </v-col>
                        <v-col cols="6" sm="3">
                            <v-card flat color="transparent">
                                <v-card-title class="text-overline">Transmission</v-card-title>
                                <div class="d-flex align-center ga-2">
                                    <v-icon>mdi-cogs</v-icon>
                                    <p class="text-caption">Automatic</p>
                                </div>
                            </v-card>
                        </v-col>
                        <v-col cols="6" sm="3">
                            <v-card flat color="transparent">
                                <v-card-title class="text-overline">Keys</v-card-title>
                                <div class="d-flex align-center ga-2">
                                    <v-icon>mdi-key</v-icon>
                                    <p class="text-caption">2</p>
                                </div>
                            </v-card>
                        </v-col>
                        <v-col cols="6" sm="3">
                            <v-card flat color="transparent">
                                <v-card-title class="text-overline">Doors</v-card-title>
                                <div class="d-flex align-center ga-2">
                                    <v-icon>mdi-door</v-icon>
                                    <p class="text-caption">4</p>
                                </div>
                            </v-card>
                        </v-col>
                        <v-col cols="6" sm="3">
                            <v-card flat color="transparent">
                                <v-card-title class="text-overline">Seats</v-card-title>
                                <div class="d-flex align-center ga-2">
                                    <v-icon>mdi-seat-passenger</v-icon>
                                    <p class="text-caption">4</p>
                                </div>
                            </v-card>
                        </v-col>
                    </v-row>
                </v-container>
            </v-card>

        </v-col>
        <v-col cols="12" md="3">
            <v-card flat class="pa-5">
                <v-card-title class="text-h5 font-weight-medium">Service History</v-card-title>
                <v-row>
                    <v-col cols="12" sm="6">
                        <div class="mb-2">
                            <p class="text-caption">Service Report</p>
                            <p>ECU held Service History</p>
                        </div>
                        <div class="mb-2">
                            <p class="text-caption">Last Service</p>
                            <p>2025-04-15</p>
                        </div>
                        <div class="mb-2">
                            <p class="text-caption">DVSA Mileage</p>
                            <p>na</p>
                        </div>
                        <div class="mb-2">
                            <p class="text-caption">MOT Expiry Date</p>
                            <p>2025-07-28</p>
                        </div>
                    </v-col>
                    <v-col cols="12" md="6">
                        <div class="mb-2">
                            <p class="text-caption">No of Services</p>
                            <p>2</p>
                        </div>
                        <div class="mb-2">
                            <p class="text-caption">Last Service Mileage</p>
                            <p>44812</p>
                        </div>
                        <div class="mb-2">
                            <p class="text-caption">Service Notes</p>
                            <p></p>
                        </div>
                        <div class="mb-2">
                            <p class="text-caption">MOT Due</p>
                            <p></p>
                        </div>
                    </v-col>
                </v-row>
            </v-card>
        </v-col>
    </v-row>

    <v-row>
        <v-col cols="12" md="8">
            <v-card flat color="transparent" class="pa-5">
                <v-container>
                    <v-row>
                        <v-card-title class="text-h4 font-weight-medium">
                            Additional Information

                        </v-card-title>
                    </v-row>
                    <v-row>
                        <v-col cols="6" sm="3">
                            <v-card flat color="transparent">
                                <v-card-title class="text-overline">Former Keepers</v-card-title>
                                <div class="d-flex align-center ga-2">
                                    <v-icon>mdi-account-group</v-icon>
                                    <p class="text-caption">1</p>
                                </div>
                            </v-card>
                        </v-col>
                        <v-col cols="6" sm="3">
                            <v-card flat color="transparent">
                                <v-card-title class="text-overline">Vendors</v-card-title>
                                <div class="d-flex align-center ga-2">
                                    <v-icon>mdi-arrow-u-left-top</v-icon>
                                    <p class="text-caption"></p>
                                </div>
                            </v-card>
                        </v-col>
                        <v-col cols="6" sm="3">
                            <v-card flat color="transparent">
                                <v-card-title class="text-overline">Registration</v-card-title>
                                <div class="d-flex align-center ga-2">
                                    <v-icon>mdi-file-account-outline</v-icon>
                                    <p class="text-caption">DF22 HVR</p>
                                </div>
                            </v-card>
                        </v-col>
                        <v-col cols="6" sm="3">
                            <v-card flat color="transparent">
                                <v-card-title class="text-overline">VAT Type</v-card-title>
                                <div class="d-flex align-center ga-2">
                                    <v-icon>mdi-ticket-percent</v-icon>
                                    <p class="text-caption"></p>
                                </div>
                            </v-card>
                        </v-col>
                        <v-col cols="6" sm="3">
                            <v-card flat color="transparent">
                                <v-card-title class="text-overline">Euro Status</v-card-title>
                                <div class="d-flex align-center ga-2">
                                    <v-icon>mdi-leaf</v-icon>
                                    <p class="text-caption"></p>
                                </div>
                            </v-card>
                        </v-col>
                        <v-col cols="6" sm="3">
                            <v-card flat color="transparent">
                                <v-card-title class="text-overline">Engine Runs</v-card-title>
                                <div class="d-flex align-center ga-2">
                                    <v-icon>mdi-car-wrench</v-icon>
                                    <p class="text-caption">No</p>
                                </div>
                            </v-card>
                        </v-col>
                    </v-row>
                </v-container>
            </v-card>

        </v-col>
    </v-row>


    <v-row>
        <v-col cols="12" md="6">
            <v-card flat color="transparent">
                <v-card-title class="text-h4 font-weight-medium">Features</v-card-title>
            </v-card>
        </v-col>
        <v-col cols="12" md="5">
            <v-card flat color="transparent">
                <v-card-title class="text-h4 font-weight-medium">Equipment</v-card-title>
                <v-row dense>
                    <v-col cols="6" sm="4" class="text-caption">
                        Charge Cable - 3 Pin
                    </v-col>
                    <v-col cols="6" sm="4" class="text-caption">
                        Charge Cable - Type 2
                    </v-col>
                    <v-col cols="6" sm="4" class="text-caption">
                        Hi-Fi Speaker System - 10
                    </v-col>
                    <v-col cols="6" sm="4" class="text-caption">
                        Navigation HDD
                    </v-col>
                    <v-col cols="6" sm="4" class="text-caption">
                        Parking Assistance Pack
                    </v-col>
                    <v-col cols="6" sm="4" class="text-caption">
                        Climate Control
                    </v-col>
                    <v-col cols="6" sm="4" class="text-caption">
                        Parking Sensor(s)
                    </v-col>
                    <v-col cols="6" sm="4" class="text-caption">
                        Cloth Trim - Anthracite
                    </v-col>
                    <v-col cols="6" sm="4" class="text-caption">
                        Tyre Repair Kit
                    </v-col>
                    <v-col cols="6" sm="4" class="text-caption">
                        17" Alloy Wheels
                    </v-col>
                    <v-col cols="6" sm="4" class="text-caption">
                        LED Headlights - Adaptive
                    </v-col>
                    <v-col cols="6" sm="4" class="text-caption">
                        Metallic Paint - Sunset Orange
                    </v-col>
                </v-row>
            </v-card>
        </v-col>
    </v-row>
</template>

<script>
import { useVehicleStore } from '@/stores/vehicleStore';
import CarSlider from './CarSlider.vue';


export default {
    components: {
        CarSlider
    },
    data() {
        return {
            vehicleStore: useVehicleStore(),
            loading: false,
        };
    },
    mounted() {


    },

    beforeUnmount() {

    },
    methods: {


    },

};
</script>

<style scoped>
/* Vuetify’s internal wrapper override */
::-webkit-scrollbar {
    display: none;
}

.mobile-panel {
    max-width: 280px;
}
</style>