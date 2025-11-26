<template>
    <v-row class="mt-5 ">
        <v-col cols="12" md="4" class="">
            <custom-card title="Vehicle Values" class="h-100">
                <v-container>
                    <div class="mb-8 text-capitalize">
                        <div class=" mb-4  text-capitalize">Trade Values</div>
                        <v-row align="center">
                            <v-col cols="6">
                                <div class="text-body-2 text-grey-lighten-1 mb-1">Autotrader</div>
                                <div class="text-body-2 text-white  mt-2">£14,000</div>
                            </v-col>
                            <v-col cols="6">
                                <div class="text-body-2 text-light mb-1">CAP</div>
                                <div class="text-body-2 ">£14,000</div>
                            </v-col>
                        </v-row>

                        <v-divider class="my-6 border-opacity-50" color="grey-lighten-1" />
                    </div>

                    <!-- Retail Values -->
                    <div>
                        <div class="mb-4 text-capitalize">Retail Values</div>
                         <v-row align="center">
                            <v-col cols="6">
                                <div class="text-body-2 text-grey-lighten-1 mb-1">Autotrader</div>
                                <div class="text-body-2 text-white  mt-2">£14,000</div>
                            </v-col>
                            <v-col cols="6">
                                <div class="text-body-2 text-light mb-1">CAP</div>
                                <div class="text-body-2 ">£14,000</div>
                            </v-col>
                        </v-row>
                    </div>
                </v-container>
            </custom-card>
        </v-col>
        <v-col cols="12" md="4" class="">
                <custom-card class="h-100">
                    <v-container>
                        <!-- Top Row: Reg + New Report Button -->
                        <div class="d-flex align-center justify-space-between mb-3">
                            <div class="text-body-1 text-white font-weight-bold">OV21 FFE</div>
                            <v-btn color="primary" variant="flat" size="small" >New Report</v-btn>
                        </div>

                        <!-- Car Details -->
                        <div class="text-body-2 text-light mb-4">
                            BMW - 3 Series - 330e - CC - 2021
                        </div>

                        <!-- Auction Info + Status -->
                        <div class="mb-4 d-flex justify-space-between">
                            <div>
                                <div class="text-body-2 text-light">Auction House</div>
                                <div class="text-body-2">Wolverhampton</div>
                            </div>
                            <div>
                                <div class="text-body-2 text-light">Date/End</div>
                                <div class="text-body-2 ">28/10/2025 19:30</div>
                            </div>
                            <div>
                                <div class="text-body-2 text-light">Status</div>
                                <div class="text-body-2 ">Sold</div>
                            </div>
                        </div>
                        <div>
                            <div>
                                <v-img :src="vehicleStore.overView.images[0]" 
                                alt="OV21 FFE"
                                class="rounded-lg"
                                cover /> 
                            </div>                            
                        </div>
                    </v-container>
                </custom-card>
        </v-col>
        <v-col cols="12" md="4" class="">
            <custom-card >
                <v-container class="px-3">
                    <div class="text-body-2 text-capitalize text-light d-flex justify-space-between mb-3">
                        <p class="">CAP</p>
                        <p class="">90%</p>
                    </div>
                    <div class="text-body-2 text-capitalize text-light d-flex justify-space-between">
                        <p class="">AUTOTRADER</p>
                        <p class="">90%</p>
                    </div>
                </v-container> 
            </custom-card> 
            <custom-card  class="mt-5">
                <v-container class="px-3">
                    <h3 class="text-body-1 pb-5">Auction Results</h3>
                    <div class="text-body-2 text-capitalize text-light d-flex justify-space-between mb-3">
                        <p class="">Auction Status</p>
                        <p class="">90%</p>
                    </div>
                    <div class="text-body-2 text-capitalize text-light d-flex justify-space-between mb-3">
                        <p class="text-body-2">Win Bid / Last Bid</p>
                        <p class="text-body-2">90%</p>
                    </div>
                    <div class="text-body-2 text-capitalize text-light d-flex justify-space-between">
                        <p class="">No. of Bids</p>
                        <p class="">90%</p>
                    </div>

                    <h3 class="text-body-1 text-light pt-6 pb-3">Auc Bid History</h3>
                    <p class="text-body-2" >£18, 100, £18, 000, £17, 900, £17, 800, £17, 700, £17, 600, £17, 500, £17, 400, £17, 300, £17, 200, £17, 100, £17, 000, £16, 900, £16, 800, £16, 700, £16, 600, £16, 500, £16, 400, £16, 300, £16, 200</p>
                </v-container>        
            </custom-card> 
        </v-col>
    </v-row>

    <v-row class="">
        <v-col cols="12" md="8">
            <TradeHistory/>
        </v-col>
    </v-row>

</template>

<script>

import { useVehicleStore } from '@/stores/vehicleStore';
import TradeHistory from './TradeHistory.vue';

export default {
    components: {
        TradeHistory,
        
    },
    data(){
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