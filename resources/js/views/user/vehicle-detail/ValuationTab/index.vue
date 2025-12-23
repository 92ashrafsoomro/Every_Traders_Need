<template>
    <v-container fluid style="max-width: 1400px; " class="justify-center ">
        <v-row>
            <v-col>
                <div class=" d-flex  justify-end mr-12">
                    <v-btn color="danger" class="text-capitalize">Reauction Detacted</v-btn>
                    <v-icon class="ml-3 text-primary">mdi-bell-outline</v-icon>
                </div>
            </v-col>
        </v-row>
        <v-row class="">

            <!-- Left Column -->

            <v-col cols="12" lg="8">
                <v-row class="d-flex flex-wrap  pa-0 ga-4" style="max-width: 1000px; ">
                    <!-- First -->
                    <v-col sm="12" md="8" lg="6" class="pa-0 rounded-lg ">

                        <custom-card title="Trade Values">

                            <v-container fluid>
                                <v-row>
                                    <v-col cols="6">
                                        <div class="text-subtitle-2  mb-1">Autotrader</div>
                                        <div class="text-h6 font-weight-bold ">£{{
                                            vehicleStore.vehicle.autotrader_trade_value }}</div>
                                        <div class="d-flex mt-2">
                                            <v-chip color="danger" small label class=" text-white pa-1 py-0    "
                                                style="font-size: 10px; ">
                                                <span class="text-white">↑ 5.6%</span>
                                            </v-chip>
                                            <p class="ml-2 text-caption d-flex align-center ">From last month</p>
                                        </div>
                                    </v-col>
                                    <v-col cols="6">
                                        <div class="text-subtitle-2  mb-1">CAP</div>
                                        <div class="text-h6 font-weight-bold ">£{{ vehicleStore.vehicle.cap_retail }}
                                        </div>
                                        <div class="d-flex mt-2">
                                            <v-chip color="danger" small label class=" text-white pa-1 py-0    "
                                                style="font-size: 10px;">
                                                <span class="text-white">↑ 5.6%</span>
                                            </v-chip>
                                            <p class="ml-2 text-caption d-flex align-center ">From last month</p>
                                        </div>
                                    </v-col><v-col cols="6">
                                        <div class="text-subtitle-2  mb-1">CAP</div>
                                        <div class="text-h6 font-weight-bold ">£{{
                                            vehicleStore.vehicle.autotrader_trade_value }}</div>
                                        <div class="d-flex mt-2">
                                            <v-chip color="danger" small label class=" text-white pa-1 py-0    "
                                                style="font-size: 10px;">
                                                <span class="text-white">↑ 5.6%</span>
                                            </v-chip>
                                            <p class="ml-2 text-caption d-flex align-center ">From last month</p>
                                        </div>
                                    </v-col>
                                    <v-col cols="6">
                                        <div class="text-subtitle-2  mb-1">CAP</div>
                                        <div class="text-h6 font-weight-bold ">£{{ vehicleStore.vehicle.cap_retail }}
                                        </div>
                                        <div class="d-flex mt-2">
                                            <v-chip color="danger" small label class=" text-white pa-1 py-0    "
                                                style="font-size: 10px;">
                                                <span class="text-white">↑ 5.6%</span>
                                            </v-chip>
                                            <p class="ml-2 text-caption d-flex align-center ">From last month</p>
                                        </div>
                                    </v-col>
                                </v-row>
                            </v-container>

                        </custom-card>

                        <custom-card title="Retail Values" class="mt-4">
                            <v-container fluid>
                                <v-row>
                                    <v-col cols="6">
                                        <div class="text-subtitle-2  mb-1">Autotrader</div>
                                        <div class="text-h6 font-weight-bold ">£{{ vehicleStore.vehicle.cap_retail }}
                                        </div>
                                        <div class="d-flex mt-2">
                                            <v-chip color="danger" small label class=" text-white pa-1 py-0    "
                                                style="font-size: 10px;">
                                                <span class="text-white">↑ 5.6%</span>
                                            </v-chip>
                                            <p class="ml-2 text-caption d-flex align-center ">From last month</p>
                                        </div>
                                    </v-col>
                                    <v-col cols="6">
                                        <div class="text-subtitle-2  mb-1">CAP</div>
                                        <div class="text-h6 font-weight-bold ">£{{ vehicleStore.vehicle.cap_retail }}
                                        </div>
                                        <div class="d-flex mt-2">
                                            <v-chip color="danger" small label class=" text-white pa-1 py-0    "
                                                style="font-size: 10px;">
                                                <span class="text-white">↑ 5.6%</span>
                                            </v-chip>
                                            <p class="ml-2 text-caption d-flex align-center ">From last month</p>
                                        </div>
                                    </v-col>
                                </v-row></v-container>
                        </custom-card>

                    </v-col>



                    <!-- Second -->
                    <v-col class="border rounded-lg bg-surface ">
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
                                <div class="text-h6 mt-3 text-light font-weight-bold mb-4">{{ vehicleStore.vehicle.title
                                    }}</div>

                            </div>


                            <div class="pa-4">
                                <v-row class=" d-flex flex-wrap bg-background  "
                                    style="border-left: 4px solid var(--primary-color);">
                                    <v-col>
                                        <p class="  text-capitalize" style="font-size: 13px;">Auction House</p>
                                        <p class="text-body-2 mt-2 pl-3  "
                                            style="background-color: rgb(var(--v-theme-primary),0.2); border-radius: 5px ; padding: 5px 10px 5px 10px;">
                                            {{
                                                vehicleStore.vehicle?.auction?.name }}</p>
                                    </v-col>


                                    <v-col>
                                        <p cl3ass="textSizes text-light text-capitalize width: 110px;  ">Time</p>
                                        <p class="text-body-2 mt-2 ">{{ vehicleStore.vehicle.auction_date }}</p>
                                    </v-col>

                                    <v-col>
                                        <p class="textSizes text-light text-capitalize">Auction Status</p>
                                        <p class="text-body-2 mt-2 ">{{ vehicleStore.vehicle.bidding_status }}</p>
                                    </v-col>


                                </v-row>
                            </div>

                            <v-col class="pa-1 mt-6" style="height: 240px;">
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
                        <TradeHistory />

                        <!-- <custom-card>

                <Trade/>
            </custom-card> -->
                    </v-col>
                </v-row>
            </v-col>


            <!-- Right Column -->
            <v-col style="max-width: 400px;" cols="12" lg="4">

                <v-row class="ml-lg-1 ml-md-3  mt-1 mt-lg-n3 mt-md-0">
                    <v-col class="bg-surface  pa-0  border rounded-lg" cols="12">
                        <custom-card title="Autoboli Predicted">
                            <v-container fluid>
                                <div class="">


                                    <div class="d-flex justify-space-between pb-2 pt-2">
                                        <div>CAP</div>
                                        <div>{{ vehicleStore.vehicle.cap_average }}%</div>
                                    </div>
                                    <div class="d-flex justify-space-between">
                                        <div>AUTOTRADER</div>
                                        <div>{{ vehicleStore.vehicle.autotrader_trade_value }}%</div>
                                    </div>
                                </div>
                            </v-container>
                        </custom-card>
                    </v-col>

                    <v-col class="bg-surface mt-3 pa-0  border rounded-lg" cols="12">
                        <custom-card title="Auction Results">
                            <v-container fluid>

                                <div class="">
                                    <div class="d-flex justify-space-between pb-2 pt-2">
                                        <div class="text-body-2">Auc Status</div>
                                        <div style="background-color: rgb(var(--v-theme-primary),0.2) ; padding: 1px 9px  ;"
                                            class="rounded-sm">{{ vehicleStore.vehicle.sold || "Sold" }}</div>
                                    </div>
                                    <div class="d-flex justify-space-between pb-2 pt-2">
                                        <div class="text-body-2">Win bid/Last Bid</div>
                                        <div><span class="text-warning">{{ vehicleStore.vehicle.win_bid || "5"
                                        }}%</span> £{{
                                                    vehicleStore.vehicle.last_bid }}</div>
                                    </div>
                                    <div class="d-flex justify-space-between pb-2 pt-2">
                                        <div class="text-body-2">No of bids</div>
                                        <div>{{ vehicleStore.vehicle.no_of_bid || 0 }}</div>
                                    </div>
                                    <v-divider class="mt-2"></v-divider>
                                </div>
                                <div class="justify-space-between mt-3">
                                    <div class="text-body-2 pb-2">Auc Status</div>
                                    <div>{{ vehicleStore.vehicle.auction_status || "£19,850, £19,950," }}</div>
                                </div>
                            </v-container>
                        </custom-card>
                    </v-col>

                    <v-col class="bg-surface mt-3 pa-0  border rounded-lg" cols="12">
                        <custom-card title="Pre Vahicls">
                            <v-container fluid>
                                <div>
                                    <div class="today">
                                        <h4 class="">Today</h4>
                                        <div class="d-flex justify-space-between mt-2">
                                            <div class="left d-flex  ">
                                                <img :src="image" class="rounded-lg cursor-pointer"
                                                    @click="dialog = true" height="40" cover />

                                                <v-dialog v-model="dialog" max-width="50%">
                                                    <v-card>
                                                        <v-img :src="image" contain></v-img>
                                                    </v-card>
                                                </v-dialog>

                                                <div class="d-flex  align-center">
                                                    <h4 class="mx-2 text-light_text_on">ABC</h4>
                                                    <h4 class="mx-2 text-light_text_on">123</h4>
                                                    <div style="background-color: rgb(var(--v-theme-primary),0.2) ; padding: 1px 9px  ;"
                                                        class="rounded-sm">{{ vehicleStore.vehicle.sold || "Sold" }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="right d-flex align-center text-light_text_on">
                                                <h3>£{{ vehicleStore.vehicle.auction_id }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="yesterday mt-4">
                                        <h4 class="">Yesterday</h4>
                                        <div class="d-flex justify-space-between mt-2 pb-2 " v-for="value in [1, 2, 3]">
                                            <div class="left d-flex  ">
                                                <img :src="image" class="rounded-lg cursor-pointer" height="40" cover
                                                    @click="dialog = true" />

                                                <v-dialog v-model="dialog" max-width="50%">
                                                    <v-card>
                                                        <v-img :src="image" contain></v-img>
                                                    </v-card>
                                                </v-dialog>
                                                <div class="d-flex  align-center">
                                                    <h4 class="mx-2 text-light_text_on">ABC</h4>
                                                    <h4 class="mx-2 text-light_text_on">123</h4>
                                                    <div style="background-color: rgb(var(--v-theme-primary),0.2) ; padding: 1px 9px  ;"
                                                        class="rounded-sm">{{ vehicleStore.vehicle.sold || "Sold" }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="right d-flex align-center text-light_text_on">
                                                <h3>£{{ vehicleStore.vehicle.auction_id }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </v-container>


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
            dialog: false
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
</style>