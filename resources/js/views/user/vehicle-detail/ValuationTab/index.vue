<template>
    <v-container fluid style="max-width: 1400px; " class="justify-center ">
        <v-row align="stretch" no-gutters>

            <!-- Left Column -->


            <v-col cols="12" md="3" class="px-lg-2">

                <div class=" scrollbar bg-surface border rounded-lg ">
                    <div class="pa-4">
                        <h3 class="text-h5 ">Trade Values</h3>
                    </div>
                    <v-divider></v-divider>
                    <v-container fluid="" class="px-10 pb-0 ">
                        <v-row class="px-4 py-3">

                            <!-- Autotrader -->
                            <v-col cols="6">
                                <div class="text-body-2 mb-1">Autotrader</div>
                                <div class="text-h6 font-weight-bold" v-if="hasPlan && showPlan1">
                                    £{{ vehicleStore.vehicle.autotrader_trade_value }}
                                    <p class=" mt-1 mt-lg-0 text-caption d-flex align-center ">From
                                        last month</p>
                                </div>
                                    <p v-else style="font-size: 14px; " class="text-light_text_on">Upgrade Plan</p>
                            </v-col>

                            <!-- CAP Clean -->
                            <v-col cols="6">
                                <div class="text-body-2 mb-1">CAP Clean</div>
                                <div class="text-h6 font-weight-bold" v-if="hasPlan && showPlan1">
                                    £{{ vehicleStore.vehicle.cap_clean }}
                                    <p class=" mt-1 mt-lg-0 text-caption d-flex align-center ">From
                                        last month</p>
                                </div>
                                    <p v-else style="font-size: 14px; " class="text-light_text_on">Upgrade Plan</p>
                            </v-col>

                            <!-- CAP Average (Plan 2+) -->
                            <v-col cols="6">
                                <div class="text-body-2 mb-1">CAP Average</div>
                                <div class="text-h6 font-weight-bold" v-if="hasPlan && showPlan2">
                                    £{{ vehicleStore.vehicle.cap_average }}
                                    <p class=" mt-1 mt-lg-0 text-caption d-flex align-center ">From
                                        last month</p>
                                </div>
                                    <p v-else style="font-size: 14px; " class="text-light_text_on">Upgrade Plan</p>
                            </v-col>

                            <!-- CAP Blow (Plan 2+) -->
                            <v-col cols="6">
                                <div class="text-body-2 mb-1">CAP Blow</div>
                                <div class="text-h6 font-weight-bold" v-if="hasPlan && showPlan2">
                                    £{{ vehicleStore.vehicle.cap_below }}
                                    <p class=" mt-1 mt-lg-0 text-caption d-flex align-center ">From
                                        last month</p>
                                </div>
                                    <p v-else style="font-size: 14px; " class="text-light_text_on">Upgrade Plan</p>
                            </v-col>

                            
                            <v-col cols="6">
                                    <div class="text-body-2 mb-1">Autotrader Retail</div>
                                    <div class="text-h6 font-weight-bold" v-if="hasPlan && showPlan2">£{{
                                        vehicleStore.vehicle.cap_retail }} <p
                                            class=" mt-1 mt-lg-0 text-caption d-flex align-center ">From
                                            last month</p>
                                    </div>
                                        <p v-else style="font-size: 14px; " class="text-light_text_on">Upgrade Plan</p>
                                </v-col>

                                 <v-col cols="6" >
                                    <div class="text-body-2 mb-1">CAP Retail</div>
                                    <div class="text-h6 font-weight-bold" v-if="hasPlan && showPlan2">£{{
                                        vehicleStore.vehicle.cap_retail }} <p
                                            class=" mt-1 mt-lg-0 text-caption d-flex align-center ">From
                                            last month</p>
                                    </div>
                                    <p v-else style="font-size: 14px; " class="text-light_text_on">Upgrade Plan</p>
                                </v-col>
                        </v-row>

                      
                    </v-container>



                    <div title="Retail Values" class="mt-4 rounded-none">
                        <div class="pa-4">
                            <h3 class="text-h5 ">Retail Values</h3>
                        </div>
                        <v-container class="px-6 ">
                            <v-row class="px-4 py-3">
                                <v-col cols="6">
                                    <div class="text-body-2  mb-1">Autotrader</div>
                                    <div class="text-h6 font-weight-bold " v-if="hasPlan && showPlan2">£{{ vehicleStore.vehicle.cap_retail
                                        }}
                                         <p class=" mt-1 mt-lg-0 text-caption d-flex align-center ">From
                                            last month</p>
                                    </div>
                                           <p v-else style="font-size: 14px; " class="text-light_text_on">Upgrade Plan</p>
                                  
                                </v-col>
                                <v-col cols="6">
                                    <div class="text-body-2  mb-1">Cap Retail</div>
                                    <div class="text-h6 font-weight-bold " v-if="hasPlan && showPlan2" >£{{ vehicleStore.vehicle.cap_retail
                                        }}
                                         <p class=" mt-1 mt-lg-0 text-caption d-flex align-center ">From
                                            last month</p>
                                    </div>
                                           <p v-else style="font-size: 14px; " class="text-light_text_on">Upgrade Plan</p>
                                  
                                </v-col>
                            </v-row></v-container>
                    </div>
                </div>
            </v-col>
            <!-- Second -->
            <v-col cols="12" md="6" class="px-lg-2 pt-5 pt-lg-0">
                <div class="scrollbar bg-surface border rounded-lg pa-4">

                    <div class="d-flex justify-space-between">

                        <div style="border-left: 5px solid rgb(var(--v-theme-primary)); border-radius: 5px; background-color: #ffff ; color: rgb(var(--v-theme-surface)) ; padding: 5px; padding-right: 5px;"
                            class="text-body-2">
                            {{ vehicleStore.vehicle.reg }}
                        </div>
                        <div> <v-btn color="primary" variant="flat" size="small">New Report</v-btn>
                        </div>

                    </div>

                    <div class="d-flex align-center justify-space-between mt-2">


                        <!-- Car Details -->
                        <div class="text-h5 mt-3 font-weight-bold mb-4">{{ vehicleStore.vehicle.title
                            }}</div>

                    </div>


                    <div class="pa-4">
                        <v-row class="bg-background" style="border-left: 4px solid var(--primary-color);">
                            <v-col cols="12" md="4">
                                <p class="text-capitalize text-body-2">Auction House</p>
                                <p class="text-body-2 mt-2 pl-3" style="background-color: rgb(var(--v-theme-primary),0.2);
                                            border-radius: 5px;
                                            padding: 5px 10px;">
                                    {{ vehicleStore.vehicle?.auction?.name }}
                                </p>
                            </v-col>

                            <v-col cols="12" md="4">
                                <p class="text-capitalize text-body-2">Time</p>
                                <p class="text-body-2 mt-3">
                                    {{ vehicleStore.vehicle.auction_date }}
                                </p>
                            </v-col>

                            <v-col cols="12" md="4">
                                <p class="text-capitalize text-body-2">Auction Status</p>
                                <p class="text-body-2 mt-3">
                                    {{ vehicleStore.vehicle.bidding_status }}
                                </p>
                            </v-col>
                        </v-row>

                    </div>

                    <v-col class="pa-1 mt-6">
                        <v-img :src="image" class="rounded-lg h-100 cursor-pointer" @click="dialog = true" cover />
                        <v-dialog v-model="dialog" max-width="50%">
                            <v-card>
                                <v-img :src="image" />
                            </v-card>
                            <v-btn icon="mdi-close" class=" position-absolute  bg-primary ma-3"
                                style="right:-20px; top: -70px; z-index: 1000;" @click="dialog = false" />
                        </v-dialog>


                    </v-col>

                </div>


            </v-col>

            <!-- Right Column -->
            <v-col cols="12" md="3" class="px-lg-2 py-lg-0 py-5">
                <v-row dense>

                    <v-col cols="12" class="bg-surface   pa-0  border rounded-lg">

                        <div class="bg-surface border rounded-lg ">
                            <div class="pa-4">
                                <h3 class="text-h5 ">Accuracy %</h3>
                            </div>
                            <v-divider></v-divider>
                            <v-container class="px-6 pb-6">
                                <div class="">


                                    <div class="d-flex justify-space-between  pb-2 pt-2">
                                        <div class="text-body-2">CAP</div>

                                        <div class="text-body-2">{{ ((vehicleStore.vehicle.last_bid /
                                            vehicleStore.vehicle.cap_clean) * 100).toFixed(0) }}%</div>

                                    </div>
                                    <v-progress-linear
                                        :model-value="((vehicleStore.vehicle.last_bid / vehicleStore.vehicle.cap_clean) * 100)"
                                        color="primary"></v-progress-linear>
                                    <div class="d-flex justify-space-between mt-8 mb-3">
                                        <div class="text-body-2">AUTOTRADER</div>
                                        <div class="text-body-2">{{ vehicleStore.vehicle.autotrader_trade_value }}%
                                        </div>
                                    </div>
                                    <v-progress-linear model-value="20" color="primary"></v-progress-linear>
                                </div>
                            </v-container>
                        </div>
                    </v-col>

                    <v-col cols="12" class="bg-surface mt-4 pa-0  border rounded-lg">

                        <div class="bg-surface border rounded-lg ">
                            <div class="pa-4">
                                <h3 class="text-h5 ">Auction Results</h3>
                            </div>
                            <v-divider></v-divider>
                            <v-container class="px-6 pb-6">

                                <div class="">
                                    <div class="d-flex justify-space-between pb-2 pt-2">
                                        <div class="text-body-2">Auc Status</div>
                                        <div style="background-color: rgb(var(--v-theme-primary),0.2) ; padding: 1px 9px  ;"
                                            class="rounded-sm text-body-2">{{ vehicleStore.vehicle.sold || "Sold" }}
                                        </div>
                                    </div>
                                    <div class="d-flex justify-space-between pb-2 pt-2">
                                        <div class="text-body-2">Win bid/Last Bid</div>
                                        <div><span class="text-warning text-body-2">{{ vehicleStore.vehicle.win_bid ||
                                            "5"
                                                }}%</span> <span class="text-body-2"> £{{ vehicleStore.vehicle.last_bid
                                                }}</span></div>
                                    </div>
                                    <div class="d-flex justify-space-between pb-2 pt-2">
                                        <div class="text-body-2">No of bids</div>
                                        <div class="text-body-2">{{ vehicleStore.vehicle.no_of_bid || 0 }}</div>
                                    </div>
                                    <v-divider class="mt-2"></v-divider>
                                </div>
                                <div class="justify-space-between mt-3">
                                    <div class="text-body-2 pb-2">Auc Status</div>
                                    <div class="text-body-2">{{ vehicleStore.vehicle.auction_status }}</div>
                                </div>
                            </v-container>
                        </div>
                    </v-col>

                    <v-col cols="12" class="bg-surface mt-4 pa-0 border rounded-lg">
                        <div title="Pre Vehicles">


                            <!-- TODAY -->

                            <v-data-table-server class="rounded" :headers="headers" :items="[vehicleStore.vehicle]"
                                hide-default-footer hover striped="even">

                                <!-- Reg -->
                                <template #item.reg="{ item }">
                                    <span class="font-weight-medium text-whiteLite">
                                        {{ item.reg }}
                                    </span>
                                </template>

                                <!-- Status -->
                                <template #item.status="{ item }">
                                    <v-chip size="small" color="primary" variant="tonal">
                                        {{ item.sold || 'Sold' }}
                                    </v-chip>
                                </template>

                                <!-- Last Bid -->
                                <template #item.last_bid="{ item }">
                                    £{{ item.auction_id }}
                                </template>

                                <!-- No Data -->
                                <template #no-data>
                                    <div class="text-center  text-grey">
                                        No data available
                                    </div>
                                </template>

                            </v-data-table-server>



                            <!-- YESTERDAY -->



                        </div>
                    </v-col>

                </v-row>
            </v-col>

        </v-row>
    </v-container>
</template>

<script>

import { useVehicleStore } from '@/stores/vehicleStore';
import TradeHistory from './TradeHistory.vue';
// import Trade from './Trade.vue';
import { useUserStore } from '@/stores/userStore';


export default {
    components: {
        TradeHistory,
        // Trade
    },
    data() {
        return {
            vehicleStore: useVehicleStore(),
            loading: false,
            image: '',
            dialog: false,
            userStore: useUserStore(),
            headers: [
                { title: 'Reg', key: 'reg' },
                { title: 'Status', key: 'status' },
                { title: 'Last Bid', key: 'last_bid' },
            ],
        };
    },
    mounted() {

        this.image = this.vehicleStore.vehicle?.images?.split(",")[0];
        //  console.log(this.bidding_history);
    },
    beforeUnmount() {

    },
    computed: {
        bidding_history() {



            let bidding_history = this.vehicleStore.vehicle?.bidding_history;

            bidding_history = bidding_history.replaceAll("[", "").replaceAll("]", "").replaceAll("'", "");

            bidding_history = bidding_history.split(", ") || [];

            return bidding_history;

        },
     
  planId() {
    // NON-Subscriber (Admin / Owner) → full access
    if (this.userStore.user?.role !== 'Subscriber') {
      return 3; // max plan maan lo
    }

    // Subscriber
    return this.userStore.user?.plan?.plan_id || null;
  },

  hasPlan() {
    return !!this.planId;
  },

  showPlan1() {
    return this.planId >= 1;
  },

  showPlan2() {
    return this.planId >= 2;
  },

  showPlan3() {
    return this.planId >= 3;
  }

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

table {
    border-collapse: collapse;
}

th,
td {
    font-size: 14px;
}

.border-b {
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
}

.scrollbar {
    overflow-y: auto;
    min-height: 625px;
    max-height: 625px;
    /* Hide scrollbar - Chrome, Edge, Safari */
    scrollbar-width: none;
    /* Firefox */
    -ms-overflow-style: none;
}
</style>