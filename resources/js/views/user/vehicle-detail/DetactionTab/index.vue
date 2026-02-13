<template>
    <div class="bg-surface border rounded-sm " >
  
 <div v-if="vehicleStore && vehicleStore.reauction">
    <div class="pa-7 d-flex  flex-wrap flex-wrap align-start justify-space-between">

        <!-- LEFT -->
        <div class="pr-lg-4 " style="width: 500px;">
            <div class="mt-2 ">
                <span class="text-body-2 pa-1 " style="border-left:5px solid rgb(var(--v-theme-primary));
                border-radius:5px;
                background:#fff;
                color:rgb(var(--v-theme-light_text_on));">
                    {{ vehicleStore.reauction.reg }}
                </span>

                <div>
                    <div class="text-h6 mt-2  font-weight-bold">
                        {{ vehicleStore.reauction?.make?.name }} {{ vehicleStore.reauction?.model?.name }}
                        {{ vehicleStore.reauction?.variant?.name }} 
                            <v-btn
                                :href="`${vehicleStore.reauction?.inspection_report}`"
                                target="_blank"
                                class="text-body-2 pa-1 rounded-sm"
                                style="background:rgb(var(--v-theme-primary));"
                                >
                                Report
                            </v-btn>
                  
                    </div>

                </div>
            </div>

            <div class="ma-4 ml-0 pa-4 w-lg-75 w-100  text-lg-h6 rounded-sm"
                style="background:rgb(var(--v-theme-danger),0.3);">
                <div class="text-lg-h5 text-md-h5 text-h6 text-danger font-weight-bold"
                    style="color: rgb(var(--v-theme-danger),0.6);">Not Recommended</div>
                <div class=" mt-3 text-body-1 font-weight-bold"><span
                        class="bg-danger px-4 py-1 rounded-sm ">75%</span> Risk ratio</div>
            </div>
        </div>

        <!-- RIGHT -->
        <div class="mt-2  pl-4 bg-background pa-3"
            style="width: 800px; border-left:3px solid rgb(var(--v-theme-primary));">

            <div class="d-flex flex-wrap ga-7 ga-lg-0 ga-md-0 mb-6 justify-space-between">
                <div>
                    <div class="text-body-2 text-light_text_on">Auction House</div>
                    <v-chip label color="primary" class="mt-2">{{
                        vehicleStore.reauction?.auction?.name }}</v-chip>
                </div>
                <div>
                    <div class=" text-body-2 text-light_text_on">Date Time/ End</div>
                    <div class="mt-2">{{ vehicleStore.reauction.auction_date }}</div>
                </div>
                <div>
                    <div class="text-body-2 text-light_text_on">Auction Status</div>
                    <div class="mt-2">{{ vehicleStore.reauction.auction_status || "?" }}</div>
                </div>
                <div>
                    <div class="text-body-2 text-light_text_on">Previous Auction</div>
                    <div class="mt-2"> <span
                            style="background-color: rgb(var(--v-theme-danger),0.2); border-radius: 5px ; padding: 5px 10px 5px 10px;"
                            class="text-body-2 ">
                            View Detail
                        </span></div>
                </div>
            </div>

            <v-divider />

            <div class="d-flex flex-wrap ga-7 ga-lg-0 ga-md-0 mt-6 justify-space-between">
                <div class="mb-5 mb-lg-0 mb-md-0">
                    <div class="text-body-2 text-light_text_on">Mileage</div>
                    <div class="mt-2">{{ vehicleStore.reauction.mileage }} <span class="text-danger px-1 rounded-sm"
                            style="background-color: rgb(var(--v-theme-danger),0.2);">+{{ mileageDiff }}</span></div>
                </div>
                <div class="mb-5 mb-lg-0 mb-md-0">
                    <p class="text-body-2 text-capitalize">Grade</p>
                    <p class="pa-2 text-dark grade-circle mt-2" :style="getGradeStyle(vehicleStore.vehicle.grade)">
                        {{ vehicleStore.reauction.grade }}
                    </p>



                </div>
                <div class="mb-5 mb-lg-0 mb-md-0">
                    <div class="text-body-2">Last Service</div>
                    <div class="mt-2">{{ vehicleStore.reauction.last_service || "------" }}</div>
                </div>
                <div>
                    <div class="text-body-2">MOT Expiry</div>
                    <div class="mt-2">{{ vehicleStore.reauction.mot_expiry_date || "------" }}</div>
                </div>
            </div>

        </div>
    </div>

    <custom-card title="Auction History" class="mt-5">
        <div class="pa-7">
            <h6 class="text-h6 font-weight-bold"> </h6>
            <div class=" d-flex ga-lg-0 ga-4 flex-wrap mt-4 justify-space-between  ">
                <div>
                    <div class="mt-2">Autotrader Trad Value</div>
                    <div class="text-h6  font-weight-bold">£{{ vehicleStore.reauction.autotrader_trade_value || "?" }}
                    </div>
                    <div class="d-flex flex-wrap mt-2">
                                <span
                                class="mr-2 d-flex flex-wrap"
                                :class="capCompare.autotrader.up ? 'text-success' : 'text-danger'"
                                >
                                <v-icon size="23">
                                    {{ capCompare.autotrader.up ? 'mdi-menu-up' : 'mdi-menu-down' }}
                                </v-icon>
                                {{ capCompare.autotrader.percent }}%
                                </span>

                                <span class="text-body-2 mt-1 text-light_text_on">
                                From current vehicle
                                </span>
                            </div>
                        </div>
                <v-divider vertical class="d-lg-block d-md-block d-none" />
                <v-divider horizaontal class="d-block d-lg-none d-md-none" />



                <div>
                <div class="mt-2">CAP Clean</div>

                <div class="text-h6 font-weight-bold">
                    £{{ vehicleStore.reauction.cap_clean }}
                </div>

                <div class="d-flex flex-wrap mt-2">
                    <span
                    class="mr-2 d-flex flex-wrap"
                    :class="capCompare.clean.up ? 'text-success' : 'text-error'"
                    >
                    <v-icon size="23">
                        {{ capCompare.clean.up ? 'mdi-menu-up' : 'mdi-menu-down' }}
                    </v-icon>
                    {{ capCompare.clean.percent }}%
                    </span>

                    <span class="text-body-2 mt-1 text-light_text_on">
                    From current vehicle
                    </span>
                </div>
                </div>

                <v-divider vertical class="d-lg-block d-md-block d-none" />
                <v-divider horizaontal class="d-block d-lg-none d-md-none" />
                    <div>
                    <div class="mt-2">CAP Average</div>

                    <div class="text-h6 font-weight-bold">
                        £{{ vehicleStore.reauction.cap_average }}
                    </div>

                    <div class="d-flex flex-wrap mt-2">
                        <span
                        class="mr-2 d-flex flex-wrap"
                        :class="capCompare.average.up ? 'text-success' : 'text-danger'"
                        >
                        <v-icon size="23">
                            {{ capCompare.average.up ? 'mdi-menu-up' : 'mdi-menu-down' }}
                        </v-icon>
                        {{ capCompare.average.percent }}%
                        </span>

                        <span class="text-body-2 mt-1 text-light_text_on">
                        From current vehicle
                        </span>
                    </div>
                    </div>

                <v-divider vertical class="d-lg-block d-md-block d-none" />
                <v-divider horizaontal class="d-block d-lg-none d-md-none" />

                <div>
                <div class="mt-2">CAP Below</div>

                <div class="text-h6 font-weight-bold">
                    £{{ vehicleStore.reauction.cap_below }}
                </div>

                <div class="d-flex flex-wrap mt-2">
                    <span
                    class="mr-2 d-flex flex-wrap"
                    :class="capCompare.below.up ? 'text-success' : 'text-danger'"
                    >
                    <v-icon size="23">
                        {{ capCompare.below.up ? 'mdi-menu-up' : 'mdi-menu-down' }}
                    </v-icon>
                    {{ capCompare.below.percent }}%
                    </span>

                    <span class="text-body-2 mt-1 text-light_text_on">
                    From current vehicle
                    </span>
                </div>
                </div>

            </div>
        </div>
    </custom-card>
    <div class="bg-surface  mt-5 border mb-5">
        <div class="text-h6 font-weight-bold px-7 py-4"> Auction History</div>

        <v-data-table-server class="rounded " striped="even" :headers="preAucHeaders" hide-default-footer
            :items="[vehicleStore.vehicle]" item-key="id">
            <!-- Date -->
            <template #item.auction_date="{ item }">
                {{ item.auction?.auction_date || '-' }}
            </template>
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
        </v-data-table-server>
    </div>
</div>
<div v-else>
     <div class="pa-7 d-flex  flex-wrap flex-wrap align-start justify-space-between">
         <p class="text-red">Not found in reauction this vehicle!</p>
        </div>
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
          capCompare() {
            const current = this.vehicleStore.vehicle || {}
            const re = this.vehicleStore.reauction || {}

            const calc = (currentVal, reVal) => {
            if (!currentVal || !reVal) {
                return { percent: 0, up: false }
            }

            const diff = ((reVal - currentVal) / currentVal) * 100
            return {
                percent: Math.abs(diff).toFixed(2),
                up: diff > 0
            }
            }

            return {
            clean: calc(current.cap_clean, re.cap_clean),
            autotrader: calc(current.autotrader_trade_value, re.autotrader_trade_value),
            average: calc(current.cap_average, re.cap_average),
            below: calc(current.cap_below, re.cap_below),
            }
        },
          mileageDiff() {
            const current = this.vehicleStore.vehicle?.mileage || 0
            const re = this.vehicleStore.reauction?.mileage || 0

            if (!current || !re) return 0

            // return re > current ? re - current : 0
            return current > re ? current - re : 0
        }
                
    },
    methods: {
        getGradeStyle(grade) {
            switch (grade) {
                case 5:
                    return {
                        backgroundColor: '#e51f1f'
                    };
                case 4:
                    return {
                        backgroundColor: '#f2ce02'
                    };
                case 3:
                    return {
                        backgroundColor: '#ebff0a'
                    };
                case 2:
                    return {
                        backgroundColor: '#85e62c'
                    };
                default:
                    return {
                        backgroundColor: '#02de0a'
                    };
            }
        }
    }
}
</script>

<style scoped>
.grade-circle {
    width: 30px;
    color: black;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
}
</style>