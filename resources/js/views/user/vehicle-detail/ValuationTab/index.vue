<template>
    <v-container fluid style="max-width: 1400px; " class="justify-center ">
        <v-row>

        </v-row>
        <v-row class="">

            <!-- Left Column -->

            <v-col cols="12" lg="9">
                <v-row class="  pa-0 ga-4 ">
                    <!-- First -->

                    <v-col sm="12" md="8" lg="5" class="pa-0 rounded-lg order-2 order-lg-1">

                        <custom-card title="Trade Values    ">

                            <v-container class="px-6 pb-0">
                                <v-row>
                                    <v-col cols="6">
                                        <div class="text-body-2  mb-1">Autotrader</div>
                                        <div class="text-h6 font-weight-bold ">£{{
                                            vehicleStore.vehicle.autotrader_trade_value }}</div>
                                        <div class="d-lg-flex mt-2">
                                            <v-chip color="danger" small label class=" text-whiteLite pa-1 py-0    "
                                                style="font-size: 10px; ">
                                                <span class="text-whiteLite">↑ 5.6%</span>
                                            </v-chip>
                                            <p class="ml-lg-2 mt-1 mt-lg-0 text-caption d-flex align-center  ">From last
                                                month</p>
                                        </div>
                                    </v-col>
                                    <v-col cols="6">
                                        <div class="text-body-2  mb-1">CAP Clean</div>
                                        <div class="text-h6 font-weight-bold ">£{{ vehicleStore.vehicle.cap_retail }}
                                        </div>
                                        <div class="d-lg-flex mt-2">
                                            <v-chip color="danger" small label class=" text-whiteLite pa-1 py-0    "
                                                style="font-size: 10px;">
                                                <span class="text-whiteLite">↑ 5.6%</span>
                                            </v-chip>
                                            <p class="ml-lg-2 mt-1 mt-lg-0 text-caption d-flex align-center ">From last
                                                month</p>
                                        </div>
                                    </v-col><v-col cols="6">
                                        <div class="text-body-2  mb-1">CAP Average</div>
                                        <div class="text-h6 font-weight-bold ">£{{
                                            vehicleStore.vehicle.autotrader_trade_value }}</div>
                                        <div class="d-lg-flex mt-2">
                                            <v-chip color="danger" small label class=" text-whiteLite pa-1 py-0    "
                                                style="font-size: 10px;">
                                                <span class="text-whiteLite">↑ 5.6%</span>
                                            </v-chip>
                                            <p class="ml-lg-2 mt-1 mt-lg-0 text-caption d-flex align-center ">From last
                                                month</p>
                                        </div>
                                    </v-col>
                                    <v-col cols="6">
                                        <div class="text-body-2  mb-1">CAP Blow</div>
                                        <div class="text-h6 font-weight-bold ">£{{ vehicleStore.vehicle.cap_retail }}
                                        </div>
                                        <div class="d-lg-flex mt-2">
                                            <v-chip color="danger" small label class=" text-whiteLite pa-1 py-0    "
                                                style="font-size: 10px;">
                                                <span class="text-whiteLite">↑ 5.6%</span>
                                            </v-chip>
                                            <p class="ml-lg-2 mt-1 mt-lg-0 text-caption d-flex align-center ">From last
                                                month</p>
                                        </div>
                                    </v-col>
                                </v-row>
                            </v-container>



                            <custom-card title="Retail Values" class="mt-4 rounded-none">
                                <v-container class="px-6 ">
                                    <v-row>
                                        <v-col cols="6">
                                            <div class="text-body-2  mb-1">Autotrader</div>
                                            <div class="text-h6 font-weight-bold ">£{{ vehicleStore.vehicle.cap_retail
                                            }}
                                            </div>
                                            <div class="d-lg-flex mt-2">
                                                <v-chip color="danger" small label class=" text-whiteLite pa-1 py-0    "
                                                    style="font-size: 10px;">
                                                    <span class="text-whiteLite">↑ 5.6%</span>
                                                </v-chip>
                                                <p class="ml-lg-2 mt-1 mt-lg-0 text-caption d-flex align-center ">From
                                                    last month</p>
                                            </div>
                                        </v-col>
                                        <v-col cols="6">
                                            <div class="text-body-2  mb-1">CAP</div>
                                            <div class="text-h6 font-weight-bold ">£{{ vehicleStore.vehicle.cap_retail
                                            }}
                                            </div>
                                            <div class="d-lg-flex mt-2">
                                                <v-chip color="danger" small label class=" text-whiteLite pa-1 py-0    "
                                                    style="font-size: 10px;">
                                                    <span class="text-whiteLite">↑ 5.6%</span>
                                                </v-chip>
                                                <p class="ml-lg-2 mt-1 mt-lg-0 text-caption d-flex align-center ">From
                                                    last month</p>
                                            </div>
                                        </v-col>
                                    </v-row></v-container>
                            </custom-card>
                        </custom-card>
                    </v-col>



                    <!-- Second -->
                    <v-col class="border rounded-lg bg-surface order-1 order-lg-2 ">
                        <div class="pa-4">


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
                                <v-img :src="image" class="rounded-lg h-100 cursor-pointer" @click="dialog = true"
                                    cover />
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
                    <!-- third -->
                    <v-col cols="12" class="pa-0">
                        <!-- <TradeHistory /> -->

                        <!-- 

                <Trade/>
            </custom-card> -->
                    </v-col>
                </v-row>
            </v-col>


            <!-- Right Column -->
            <v-col cols="12" lg="3">

                <v-row class="ml-lg-1 ml-md-3  mt-1 mt-lg-n3 mt-md-0">
                    <v-col class="bg-surface   pa-0  border rounded-lg" cols="12">
                        <custom-card title="Accuracy %">
                            <v-container class="px-6 pb-6">
                                <div class="">


                                    <div class="d-flex justify-space-between  pb-2 pt-2">
                                        <div class="text-body-2">CAP</div>

                                        <div class="text-body-2">{{ vehicleStore.vehicle.cap_average }}%</div>

                                    </div>
                                    <v-progress-linear model-value="20" color="primary"></v-progress-linear>
                                    <div class="d-flex justify-space-between mt-8 mb-3">
                                        <div class="text-body-2">AUTOTRADER</div>
                                        <div class="text-body-2">{{ vehicleStore.vehicle.autotrader_trade_value }}%
                                        </div>
                                    </div>
                                    <v-progress-linear model-value="20" color="primary"></v-progress-linear>
                                </div>
                            </v-container>
                        </custom-card>
                    </v-col>

                    <v-col class="bg-surface mt-4 pa-0  border rounded-lg" cols="12">
                        <custom-card title="Auction Results">
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
                        </custom-card>
                    </v-col>
                    <v-col class="bg-surface mt-4 pa-0 border rounded-lg" cols="12">
                        <custom-card title="Pre Vehicles">


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



                        </custom-card>
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
</style>