<template>
    <v-container fluid class="pa-0">
        <v-row dense>
            <v-col v-if="isPanelOpen" class="bg-background border-e pt-5 mt-2 position-fixed left-5 overflow-y-auto "
                cols="12" md="2"
                :class="isMobile ? 'mobile-panel position-fixed left-0 top-5 bg-surface w-100' : 'desktop-panel'"
                style="height: 100vh; z-index: 11;">
                <v-card color="transparent" flat class="h-100">
                    <v-row justify="space-between ps-2 pe-2">
                        <v-col cols="4">
                            <div class="text-overline mb-2">Filters</div>
                        </v-col>
                        <v-col cols="4">
                            <v-btn size="small" color="primary"> 18</v-btn>
                        </v-col>
                        <v-col cols="4">
                            Clear All
                        </v-col>
                    </v-row>
                    <v-row class="ps-2 pe-2">
                        <v-col cols="6">
                            <v-select color="primary" label="All" density="compact" variant="outlined"></v-select>
                        </v-col>
                        <v-col cols="6">
                            <v-select color="primary" label="Select Platform" density="compact"
                                variant="outlined"></v-select>
                        </v-col>
                    </v-row>
                    <v-expansion-panels class="overflow-y-auto" style="max-height: 79vh;">
                        <v-expansion-panel v-for="n in 20" :key="n">
                            <v-expansion-panel-title class="rounded-0">
                                <div class="d-flex align-center w-100">
                                    <img src="https://www1.bcaimage.com/Document?DocType=VehicleImage&width=300&docId=613522131"
                                        class="rounded mr-3 object-fit" width="50px" height="50px" />

                                    <div class="flex-grow-1">
                                        <div class="text-subtitle-1 font-weight-medium">BMW 3 Series</div>
                                        <div class="text-body-2 text-grey-lighten-1">£18,900</div>
                                    </div>
                                </div>
                            </v-expansion-panel-title>

                            <v-expansion-panel-text>
                                <v-btn density="comfortable" variant="outlined" color="primary">
                                    Auction House
                                </v-btn>
                                <div class="d-flex justify-normal align-center ga-2 mt-2">
                                    <p>11-11-2025</p>
                                    <p>Leeds</p>
                                </div>
                            </v-expansion-panel-text>
                        </v-expansion-panel>
                    </v-expansion-panels>
                </v-card>
            </v-col>

            <v-col cols="12" md="2" class="d-none d-lg-block pa-10" v-if="isPanelOpen"></v-col>
            <v-col cols="12" :md="isPanelOpen && !isMobile ? 9 : 12" class="pa-5">
                <v-row dense>
                    <v-col cols="12"
                        class="d-flex flex-column flex-sm-row align-end align-lg-start justify-normal ga-5">
                        <v-btn-toggle v-model="activeTab" class="w-100" color="primary" mandatory>
                            <v-btn value="details">Vehicle Details</v-btn>
                            <v-btn value="valuation">Vehicle Valuation</v-btn>
                        </v-btn-toggle>
                        <v-btn color="primary" class="mb-4" @click="togglePanel" append-icon="mdi-backburger">
                            {{ isPanelOpen ? 'Hide Menu' : 'Show Menu' }}
                        </v-btn>
                    </v-col>
                </v-row>
            </v-col>
            <template v-if="activeTab === 'details'">
                <v-col cols="12" md="2" class="d-none d-lg-block pa-10" v-if="isPanelOpen"></v-col>
                <v-col cols="12" :md="isPanelOpen && !isMobile ? 9 : 12" class="pa-5">
                    <v-row dense>
                        <v-col cols="12" class="mt-4">
                            <v-card class="pa-5">
                                <v-row>
                                    <v-col cols="12" lg="6" md="6" sm="12" class="d-flex flex-column justify-start">
                                        <v-img
                                            src="https://www1.bcaimage.com/Document?DocType=VehicleImage&width=600&docId=613522131"
                                            class="rounded-lg" />
                                        <v-row class="ga-2 pa-5">
                                            <v-img
                                                src="https://www1.bcaimage.com/Document?DocType=VehicleImage&width=600&docId=613522131"
                                                class="rounded" />
                                            <v-img
                                                src="https://www1.bcaimage.com/Document?DocType=VehicleImage&width=600&docId=613522131"
                                                class="rounded" />
                                            <v-img
                                                src="https://www1.bcaimage.com/Document?DocType=VehicleImage&width=600&docId=613522131"
                                                class="rounded" />
                                            <v-img
                                                src="https://www1.bcaimage.com/Document?DocType=VehicleImage&width=600&docId=613522131"
                                                class="rounded" />
                                            <v-img
                                                src="https://www1.bcaimage.com/Document?DocType=VehicleImage&width=600&docId=613522131"
                                                class="rounded" />
                                            <v-img
                                                src="https://www1.bcaimage.com/Document?DocType=VehicleImage&width=600&docId=613522131"
                                                class="rounded" />
                                        </v-row>
                                    </v-col>
                                    <v-col cols="12" lg="6" md="6" sm="12" class="ps-5 pr-5">
                                        <h1 class="text-h5 text-lg-h3  font-weight-bold">2021 BMW 3 Series – 330e
                                        </h1>
                                        <v-row class="mt-2 bg-background">
                                            <v-col cols="6" sm="3">
                                                <v-card flat color="transparent">
                                                    <v-card-title class="text-caption">Mileage</v-card-title>
                                                    <v-card-subtitle class="text-medium-emphasis mt-n2">60,016
                                                    </v-card-subtitle>
                                                </v-card>
                                            </v-col>
                                            <v-col cols="6" sm="3">
                                                <v-card flat color="transparent">
                                                    <v-card-title class="text-caption">Grade</v-card-title>
                                                    <v-card-subtitle
                                                        class="text-medium-emphasis mt-n2">2</v-card-subtitle>
                                                </v-card>
                                            </v-col>
                                            <v-col cols="6" sm="3">
                                                <v-card flat color="transparent">
                                                    <v-card-title class="text-caption">Inspection</v-card-title>
                                                    <v-btn density="compact" color="primary"
                                                        class="ml-4 text-caption">Report</v-btn>
                                                </v-card>
                                            </v-col>
                                            <v-col cols="6" sm="3">
                                                <v-card flat color="transparent">
                                                    <v-card-title class="text-caption">Reg</v-card-title>
                                                    <v-btn density="compact"
                                                        class="bg-white ml-4 text-caption border-s-xl font-weight-medium border-primary">
                                                        OV21 FFE

                                                    </v-btn>

                                                </v-card>
                                            </v-col>
                                        </v-row>
                                        <v-row class="mt-5 bg-background"
                                            style="border-left: 4px solid var(--primary-color);">
                                            <v-col cols="6" sm="3">
                                                <v-card flat color="transparent">
                                                    <v-card-title class="text-caption">Auction House</v-card-title>
                                                    <v-card-subtitle
                                                        class="text-medium-emphasis mt-n2 font-weight-medium text-primary text-wrap text-caption">
                                                        Bridlington Motor Auction</v-card-subtitle>
                                                </v-card>
                                            </v-col>
                                            <v-col cols="6" sm="3">
                                                <v-card flat color="transparent">
                                                    <v-card-title class="text-caption">Auction Center</v-card-title>
                                                    <v-card-subtitle
                                                        class="text-medium-emphasis mt-n2">N/A</v-card-subtitle>
                                                </v-card>
                                            </v-col>
                                            <v-col cols="6" sm="3">
                                                <v-card flat color="transparent">
                                                    <v-card-title class="text-caption">Date / Time / End</v-card-title>
                                                    <v-card-subtitle
                                                        class="text-medium-emphasis mt-n2">N/A</v-card-subtitle>
                                                </v-card>
                                            </v-col>
                                            <v-col cols="6" sm="3">
                                                <v-card flat color="transparent">
                                                    <v-card-title class="text-caption">Lot</v-card-title>
                                                    <v-card-subtitle
                                                        class="text-medium-emphasis mt-n2">OSB023</v-card-subtitle>
                                                </v-card>
                                            </v-col>
                                            <v-divider class="ms-5 me-5 mb-n1"></v-divider>
                                            <v-col cols="6" sm="3">
                                                <v-card flat color="transparent">
                                                    <v-card-title class="text-caption">Auction Status</v-card-title>
                                                    <v-card-subtitle
                                                        class="text-medium-emphasis mt-n2">Sold</v-card-subtitle>
                                                </v-card>
                                            </v-col>
                                            <v-col cols="6" sm="3">
                                                <v-card flat color="transparent">
                                                    <v-card-title class="text-caption">Previous Auc</v-card-title>
                                                    <v-btn density="compact" color="primary"
                                                        class="ml-4 text-caption ps-2 pe-2">View
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
                                        <v-row class="mt-5 bg-background"
                                            style="border-left: 4px solid var(--danger-color);">
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
                </v-col>
                <v-col cols="12" md="2" class="d-none d-lg-block pa-10" v-if="isPanelOpen"></v-col>
                <v-col cols="12" :md="isPanelOpen && !isMobile ? 10 : 12" class="mt-8 pa-0 pa-lg-5 ">
                    <v-row class="d-flex align-center justify-center ga-1 bg-surface border-t border-b pt-8 pb-8">
                        <v-col cols="6" lg="2" md="2" sm="3" class="d-flex align-center flex-column flex-sm-row ga-2">
                            <v-card class="bg-shadow pa-1 pa-lg-3 rounded-lg">
                                <v-icon color="primary">mdi-car</v-icon>
                            </v-card>
                            <div class="d-flex flex-column ga-1">
                                <p class="text-caption">DF22 HVR</p>
                                <p class="text-caption mt-n1">Reg</p>
                            </div>
                        </v-col>
                        <v-col cols="6" lg="2" md="2" sm="3" class="d-flex align-center flex-column flex-sm-row ga-2">
                            <v-card class="bg-shadow pa-1 pa-lg-3 rounded-lg">
                                <v-icon color="primary">mdi-calendar</v-icon>
                            </v-card>
                            <div class="d-flex flex-column ga-1">
                                <p class="text-caption">2022 (22 reg)</p>
                                <p class="text-caption mt-n1">DOR</p>
                            </div>
                        </v-col>
                        <v-col cols="6" lg="2" md="2" sm="3" class="d-flex align-center flex-column flex-sm-row ga-2">
                            <v-card class="bg-shadow pa-1 pa-lg-3 rounded-lg">
                                <v-icon color="primary">mdi-speedometer-medium</v-icon>
                            </v-card>
                            <div class="d-flex flex-column ga-1">
                                <p class="text-caption">48403</p>
                                <p class="text-caption mt-n1">Mileage</p>
                            </div>
                        </v-col>
                        <v-col cols="6" lg="2" md="2" sm="3" class="d-flex align-center flex-column flex-sm-row ga-2">
                            <v-card class="bg-shadow pa-1 pa-lg-3 rounded-lg">
                                <v-icon color="primary">mdi-creation-outline</v-icon>
                            </v-card>
                            <div class="d-flex flex-column ga-1">
                                <p class="text-caption">2</p>
                                <p class="text-caption mt-n1">Grade</p>
                            </div>
                        </v-col>
                        <v-col cols="6" lg="2" md="2" sm="3" class="d-flex align-center flex-column flex-sm-row ga-2">
                            <v-card class="bg-shadow pa-1 pa-lg-3 rounded-lg">
                                <v-icon color="primary">mdi-file-document</v-icon>
                            </v-card>
                            <div class="d-flex flex-column ga-1">
                                <p class="text-caption">Not Present</p>
                                <p class="text-caption mt-n1">V5</p>
                            </div>
                        </v-col>

                    </v-row>
                </v-col>
                <v-col cols="12" md="2" class="d-none d-md-block pa-10" v-if="isPanelOpen"></v-col>
                <v-col cols="12" :md="isPanelOpen && !isMobile ? 9 : 12" class="pa-5" style="z-index: 1;">
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
                </v-col>
                <v-col cols="12" md="2" class="d-none d-md-block pa-10" v-if="isPanelOpen"></v-col>
                <v-col cols="12" :md="isPanelOpen && !isMobile ? 9 : 12" class="pa-5" style="z-index: 1;">
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
                </v-col>
                <v-col cols="12" md="2" class="d-none d-md-block pa-10" v-if="isPanelOpen"></v-col>
                <v-col cols="12" :md="isPanelOpen && !isMobile ? 9 : 12" class="pa-5" style="z-index: 1;">
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
                </v-col>
            </template>
            <template v-if="activeTab === 'valuation'">
                <v-col cols="12" md="2" class="d-none d-lg-block pa-10" v-if="isPanelOpen"></v-col>
                <v-col cols="12" :md="isPanelOpen && !isMobile ? 10 : 12" class="pa-5">
                    <v-col class="mr-auto ml-auto" cols="10">
                        <v-row>
                            <v-col cols="12" md="4">
                                <v-card flat color="primary" class="rounded-lg d-flex flex-column ga-4 pb-0">
                                    <v-card-title class="text-h6 font-weight-medium ps-3 pe-3">AUTOBOLI
                                        SUGGESTION</v-card-title>
                                    <div class="d-flex align-center mt-n8 pa-5">
                                        <div class="d-flex align-center justify-start ga-2">
                                            <p class="text-h4 font-weight-medium">£14.000</p>
                                            <div class="d-flex align-center ga-2">
                                                <v-btn size="small" color="success" variant="flat"
                                                    class="ps-1 pe-1">+5.6%</v-btn>
                                                <p class="text-caption font-weight-light">From last month</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-caption pa-3" style="background-color: #011e3d;">
                                        Our price estimates use historical auction data and market trends to suggest
                                        likely values. Learn more
                                    </div>
                                </v-card>
                                <v-card flat color="surface"
                                    class="border rounded-lg d-flex flex-column ga-4 pa-4 pb-5 mt-4">
                                    <v-card-title class="text-subtitle-1 font-weight-medium ps-3 pe-3">Vehicle
                                        Values
                                    </v-card-title>
                                    <div class="text-subtitle-1 font-weight-medium ps-3 pe-3 mt-3"
                                        style="border-left: 3px solid red;">Trade Values</div>
                                    <v-row class="mt-5 mb-5">
                                        <v-col cols="12" sm="6">
                                            <v-card flat color="transparent">
                                                <p class="text-overline">Autotrader</p>
                                                <p class="text-h6 font-weight-bold mb-2 mt-n1">£14,000</p>
                                                <div class="d-flex align-center ga-2">
                                                    <v-btn prepend-icon="mdi-arrow-up" size="small" color="danger"
                                                        variant="flat" class="ps-2 pe-2">5.6%</v-btn>
                                                    <p class="text-caption font-weight-light">From last month</p>
                                                </div>
                                            </v-card>
                                        </v-col>
                                        <v-col cols="12" sm="6">
                                            <v-card flat color="transparent">
                                                <p class="text-overline">CAP</p>
                                                <p class="text-h6 font-weight-bold mb-2 mt-n1">£14,000</p>
                                                <div class="d-flex align-center ga-2">
                                                    <v-btn prepend-icon="mdi-arrow-up" size="small" color="danger"
                                                        variant="flat" class="ps-2 pe-2">5.6%</v-btn>
                                                    <p class="text-caption font-weight-light">From last month</p>
                                                </div>
                                            </v-card>
                                        </v-col>
                                        <v-col cols="12" sm="6">
                                            <v-card flat color="transparent">
                                                <p class="text-overline">Autotrader</p>
                                                <p class="text-h6 font-weight-bold mb-2 mt-n1">£14,000</p>
                                                <div class="d-flex align-center ga-2">
                                                    <v-btn prepend-icon="mdi-arrow-up" size="small" color="danger"
                                                        variant="flat" class="ps-2 pe-2">5.6%</v-btn>
                                                    <p class="text-caption font-weight-light">From last month</p>
                                                </div>
                                            </v-card>
                                        </v-col>
                                        <v-col cols="12" sm="6">
                                            <v-card flat color="transparent">
                                                <p class="text-overline">CAP</p>
                                                <p class="text-h6 font-weight-bold mb-2 mt-n1">£14,000</p>
                                                <div class="d-flex align-center ga-2">
                                                    <v-btn prepend-icon="mdi-arrow-up" size="small" color="danger"
                                                        variant="flat" class="ps-2 pe-2">5.6%</v-btn>
                                                    <p class="text-caption font-weight-light">From last month</p>
                                                </div>
                                            </v-card>
                                        </v-col>
                                    </v-row>
                                    <v-divider></v-divider>
                                    <div class="text-subtitle-1 font-weight-medium ps-3 pe-3 mt-3"
                                        style="border-left: 3px solid red;">Retail Values</div>
                                    <v-row class="mt-5 pb-4">
                                        <v-col cols="12" sm="6">
                                            <v-card flat color="transparent">
                                                <p class="text-overline">Autotrader</p>
                                                <p class="text-h6 font-weight-bold mb-2 mt-n1">£14,000</p>
                                                <div class="d-flex align-center ga-2">
                                                    <v-btn prepend-icon="mdi-arrow-up" size="small" color="danger"
                                                        variant="flat" class="ps-2 pe-2">5.6%</v-btn>
                                                    <p class="text-caption font-weight-light">From last month</p>
                                                </div>
                                            </v-card>
                                        </v-col>
                                        <v-col cols="12" sm="6">
                                            <v-card flat color="transparent">
                                                <p class="text-overline">CAP</p>
                                                <p class="text-h6 font-weight-bold mb-2 mt-n1">£14,000</p>
                                                <div class="d-flex align-center ga-2">
                                                    <v-btn prepend-icon="mdi-arrow-up" size="small" color="danger"
                                                        variant="flat" class="ps-2 pe-2">5.6%</v-btn>
                                                    <p class="text-caption font-weight-light">From last month</p>
                                                </div>
                                            </v-card>
                                        </v-col>
                                    </v-row>
                                </v-card>
                            </v-col>
                            <v-col cols="12" md="4">
                                <v-card flat color="surface" class="rounded-lg border ps-5 pe-5 pt-5 pb-5">
                                    <div class="d-flex justify-space-between align-center">
                                        <v-btn density="compact"
                                            class="bg-white ml-4 text-caption font-weight-medium pt-2 pb-6"
                                            style="border-left: 4px solid #0080ff;">DF22
                                            HVR</v-btn>
                                        <v-btn density="compact" color="primary"
                                            class="ml-4 text-caption pt-2 pb-6">Inspection
                                            Report</v-btn>
                                    </div>
                                    <v-card-title class="text-h6">BMW - 3 Series - 330e - CC - 2022</v-card-title>
                                    <div class="ps-3 pe-3 bg-shadow" style="border-left: 4px solid #0080ff;">
                                        <v-row class="mt-5 bg-background"
                                            style="border-left: 4px solid var(--primary-color);">
                                            <v-col cols="6" sm="4">
                                                <v-card flat color="transparent">
                                                    <v-card-title class="text-caption">Auction House</v-card-title>
                                                    <v-card-subtitle
                                                        class="text-medium-emphasis mt-n2 font-weight-medium text-primary text-wrap text-caption">Wolverhampton</v-card-subtitle>
                                                </v-card>
                                            </v-col>
                                            <v-col cols="6" sm="4">
                                                <v-card flat color="transparent">
                                                    <v-card-title class="text-caption">Date/End</v-card-title>
                                                    <v-card-subtitle class="text-medium-emphasis mt-n2">28/10/2025
                                                        06:30</v-card-subtitle>
                                                </v-card>
                                            </v-col>
                                            <v-col cols="6" sm="4">
                                                <v-card flat color="transparent">
                                                    <v-card-title class="text-caption">Status</v-card-title>
                                                    <v-card-subtitle
                                                        class="text-medium-emphasis mt-n2">Sold</v-card-subtitle>
                                                </v-card>
                                            </v-col>
                                        </v-row>
                                    </div>
                                    <v-img
                                        src="https://bcamediaprod.blob.core.windows.net/public/images/vehicle/GB/DF22HVR/612584678/600"
                                        alt="" class="mt-6" />
                                </v-card>
                            </v-col>
                            <v-col cols="12" md="4">
                                THis div
                            </v-col>
                        </v-row>
                    </v-col>
                </v-col>
            </template>
        </v-row>
    </v-container>
</template>

<script>
import { useThemeStore } from "@/stores/themeStore";

export default {
    data() {
        return {
            themeStore: useThemeStore(),
            isPanelOpen: true,
            isMobile: false,
            windowWidth: window.innerWidth,
            activeTab: 'details',
        };
    },
    mounted() {
        this.themeStore.menuType = "collapsed";
        this.checkDevice();
        window.addEventListener("resize", this.handleResize);
    },
    beforeUnmount() {
        window.removeEventListener("resize", this.handleResize);
    },
    methods: {
        togglePanel() {
            this.isPanelOpen = !this.isPanelOpen;
        },
        handleResize() {
            this.windowWidth = window.innerWidth;
            this.checkDevice();
        },
        checkDevice() {
            this.isMobile = this.windowWidth <= 1280;
            if (this.isMobile) {
                this.isPanelOpen = false;
            } else {
                this.isPanelOpen = true;
            }
        },
    },
    watch: {
        activeTab(newVal) {
            if (this.isMobile && newVal === 'valuation') {
                this.isPanelOpen = false;
            }
        }
    },
};
</script>

<style scoped>
::-webkit-scrollbar {
    display: none;
}

.mobile-panel {
    max-width: 280px;
}
</style>