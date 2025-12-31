<template>
    <div class="bg-surface border rounded-lg">

        <!-- Header Section -->
        <div class="pa-4 d-flex  flex-wrap flex-wrap align-start justify-space-between">

            <!-- LEFT -->
            <div class="pr-4" style="width: 500px;">
                <div class="mt-2 ">
                    <span class="text-body-2 pa-1 " style="border-left:5px solid rgb(var(--v-theme-primary));
                   border-radius:5px;
                   background:#fff;
                   color:rgb(var(--v-theme-surface));">
                        {{ vehicleStore.vehicle.reg }}
                    </span>

                    <div>
                        <div class="text-h6 mt-2  font-weight-bold">
                            {{ vehicleStore.vehicle?.make?.name }} {{ vehicleStore.vehicle?.model?.name }}
                            {{ vehicleStore.vehicle?.variant?.name }} <span class="text-body-2 pa-1" style="background:rgb(var(--v-theme-primary),0.3);
                     border-radius:5px;">
                                Report
                            </span>
                        </div>

                    </div>
                </div>

                <div class="ma-4 ml-0 pa-4 w-75  text-h6 rounded-sm" style="background:rgb(var(--v-theme-danger),0.3);">
                    <span class="text-h4 font-weight-bold" style="color: rgb(var(--v-theme-danger),0.6);">Not
                        Recommended</span><br />
                    <span class="text-h6 font-weight-bold"><span class="bg-danger px-4 py-1 rounded-lg">75%</span> Risk
                        ratio</span>
                </div>
            </div>

            <!-- RIGHT -->
            <div class="mt-2 pl-4 bg-background pa-3"
                style="width: 800px; border-left:3px solid rgb(var(--v-theme-primary));">

                <div class="d-flex  flex-wrap mb-3 justify-space-between">
                    <div>
                        <div class="text-body-2 text-light_text_on">Auction House</div>
                        <v-chip label color="primary">{{
                            vehicleStore.vehicle?.auction?.name }}</v-chip>
                    </div>
                    <div>
                        <div class=" text-body-2 text-light_text_on">Date Time/ End</div>
                        <div class="">{{ vehicleStore.vehicle.auction_date }}</div>
                    </div>
                    <div>
                        <div class="text-body-2 text-light_text_on">Auction Status</div>
                        <div class="">{{ vehicleStore.vehicle.auction_status || "?" }}</div>
                    </div>
                    <div>
                        <div class="text-body-2 text-light_text_on">Previous Auction</div>
                        <div class=""> <span
                                style="background-color: rgb(var(--v-theme-danger),0.2); border-radius: 5px ; padding: 5px 10px 5px 10px;"
                                class="text-body-2 ">
                                View Detail
                            </span></div>
                    </div>
                </div>

                <v-divider />

                <div class="d-flex  flex-wrap mt-3 justify-space-between">
                    <div>
                        <div class="text-body-2 text-light_text_on">Mileage</div>
                        <div class="">{{ vehicleStore.vehicle.mileage }} <span class="text-danger px-1 rounded-sm"
                                style="background-color: rgb(var(--v-theme-danger),0.2);">+216</span></div>
                    </div>
                    <div>
                        <p class="textSizes text-capitalize">Grade</p>
                        <p class="pa-2 text-dark" :style="{
                            backgroundColor:
                                vehicleStore.vehicle.grade == 5 ? '#e51f1f' :
                                    vehicleStore.vehicle.grade == 4 ? '#f2ce02' :
                                        vehicleStore.vehicle.grade == 3 ? '#ebff0a' :
                                            vehicleStore.vehicle.grade == 2 ? '#85e62c' :
                                                '#02de0a',
                            width: '30px',
                            height: '30px',
                            display: 'flex',
                            alignItems: 'center',
                            justifyContent: 'center',
                            borderRadius: '50%',
                            color: '#000',
                            fontWeight: '600',
                            margin: '0 auto'  
                        }">
                            {{ vehicleStore.vehicle.grade }}
                        </p>

                    </div>
                    <div>
                        <div class="">Last Service</div>
                        <div class="">{{ vehicleStore.vehicle.lastService || "------" }}</div>
                    </div>
                    <div>
                        <div class="">MOT Expiry</div>
                        <div class="">{{ vehicleStore.vehicle.motExpiryDate || "------" }}</div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Valuation Section -->
        <div class="pa-6 d-flex ga-lg-0 ga-4 flex-wrap justify-space-between ">
            <div>
                <div class="">Autotrader</div>
                <div class="text-h5  font-weight-bold">£{{ vehicleStore.vehicle.autotrader_trade_value || "?" }}</div>
                <div class="d-flex  flex-wrap mt-2"><span class="mr-2 text-warning d-flex  flex-wrap"><v-icon
                            size="23">mdi-information-outline</v-icon> %5.6</span> From previous value</div>
            </div>
            <v-divider vertical />
            <div>
                <div class="">CAP C</div>
                <div class="text-h5  font-weight-bold">£{{ vehicleStore.vehicle.cap_retail }}</div>
                <div class="d-flex  flex-wrap mt-2"><span class="mr-2 text-warning d-flex  flex-wrap"><v-icon
                            size="23">mdi-information-outline</v-icon> %5.6</span> From previous value</div>
            </div>
            <v-divider vertical />
            <div>
                <div class="">CAP Average</div>
                <div class="text-h5  font-weight-bold">£{{ vehicleStore.vehicle.cap_average }}</div>
                <div class="d-flex  flex-wrap mt-2"><span class="mr-2 text-warning d-flex  flex-wrap"><v-icon
                            size="23">mdi-information-outline</v-icon> %5.6</span> From previous value</div>
            </div>
            <v-divider vertical />
            <div>
                <div class="">CAP B</div>
                <div class="text-h5  font-weight-bold">£{{ vehicleStore.vehicle.cap_below }}</div>
                <div class="d-flex  flex-wrap mt-2"><span class="mr-2 text-warning d-flex  flex-wrap"><v-icon
                            size="23">mdi-information-outline</v-icon> %5.6</span> From previous value</div>
            </div>
        </div>

        <div class="bg-background border-t">
            <div class="text-h6 font-weight-bold pa-4">Pre Auc</div>

            <v-data-table class="rounded bg-background" striped="even" :headers="preAucHeaders" hide-default-footer
                :items="[vehicleStore.vehicle]" item-key="id">
                <!-- Date -->
                <template #item.auction_house="{ item }">
                    {{ item.auction?.name || '-' }}
                </template>
                <template #item.center="{ item }">
                    {{ item.center_name }}
                </template>

                <template #item.autotrader="{ item }">
                    {{ item.autotrader_trade_value || "?" }}
                </template>

                <template #item.cap_c="{ item }">
                    £{{ item.cap_retail }}
                </template>

                <template #item.cap_avg="{ item }">
                    £{{ item.cap_average }}
                </template>

                <template #item.cap_b="{ item }">
                    £{{ item.cap_below }}
                </template>

                <template #item.status="{ item }">
                    <v-chip size="small" :color="item.auction_status === 'Sold' ? 'red' : 'green'" variant="flat"
                        class="text-white">
                        {{ item.auction_status || '?' }}
                    </v-chip>
                </template>


                <!-- Empty state -->
                <template #no-data>
                    <div class="pa-4 text-center grey--text">
                        No Pre Auction Data Available
                    </div>
                </template>
            </v-data-table>
        </div>


    </div>
</template>


<script>
import { useVehicleStore } from '@/stores/vehicleStore';
export default {
    data() {
        return {
            vehicleStore: useVehicleStore(), showDisclaimer: false,
            preAucHeaders: [
                { title: 'Date', key: 'auction_date' },
                { title: 'Auc House', key: 'auction_house' },
                { title: 'Center', key: 'center' },
                { title: 'Autotrader', key: 'autotrader_trade_value' },
                { title: 'CAP C', key: 'cap_c' },
                { title: 'CAP Avg', key: 'cap_avg' },
                { title: 'CAP B', key: 'cap_b' },
                { title: 'Last Bid', key: 'last_bid' },
                { title: 'Status', key: 'status' },
            ]

        }
    },
    computed: {
        bidding_history() {
            let bidding_history = this.vehicleStore.vehicle?.bidding_history;

            bidding_history = bidding_history.replaceAll("[", "").replaceAll("]", "").replaceAll("'", "");

            bidding_history = bidding_history.split(", ") || [];

            return bidding_history;

        },
    }
}
</script>

<style scoped>
/* No custom CSS used – only Vuetify classes */
</style>