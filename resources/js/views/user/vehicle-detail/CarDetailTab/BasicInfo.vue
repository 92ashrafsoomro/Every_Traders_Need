<template>

    <h1 class="text-h5 font-weight-bold"> {{ vehicleStore.vehicle?.make?.name }} {{ vehicleStore.vehicle?.model?.name }}
        {{ vehicleStore.vehicle?.variant?.name }}</h1>
    <v-row class="mt-4 bg-background pl-2  pr-2 rounded-sm ">
        <v-col cols="6" sm="3" >
            <p class="textSizes text-capitalize mb-1">Mileage</p>
            <span class="text-subtitle-2 " style="border-bottom: 1px solid rgb(var(--v-theme-primary)); padding: 5px ; " >{{ vehicleStore.vehicle.mileage }}</span>
        </v-col>
        <v-col cols="6" sm="3">
            <p class="textSizes text-capitalize">Grade</p>
            <v-chip variant="flat"   class="d-flex pa-2 text-dark mt-2" :style="{
                backgroundColor:
                    vehicleStore.vehicle.grade == 5 ? '#e51f1f' :
                        vehicleStore.vehicle.grade == 4 ? '#f2ce02' :
                            vehicleStore.vehicle.grade == 3 ? '#ebff0a' :
                                vehicleStore.vehicle.grade == 2 ? '#85e62c' :
                                    '#02de0a',
                width: '30px',
                height: '30px',
                display: 'inline-flex',
                alignItems: 'center',
                justifyContent: 'center',
                borderRadius: '50%',
                color: '#000',
                fontWeight: '600'
            }">
                {{ vehicleStore.vehicle.grade }}

            </v-chip>
        </v-col>
        <v-col cols="6" sm="3">
            <p class="textSizes  text-capitalize">Report</p>
            <div class="mt-2">

                <span
                    style="background-color: rgb(var(--v-theme-primary),0.3); border-radius: 5px ; padding: 5px 10px 5px 10px;"
                    class="text-body-2">
                    Report
                </span>

            </div>
        </v-col>
        <v-col cols="6" sm="3">
            <p class="textSizes  text-capitalize">Reg</p>
            <div class="mt-2">

                <span
                    style="border-left: 5px solid rgb(var(--v-theme-primary)); border-radius: 5px; background-color: #ffff ;  padding: 5px; padding-right: 5px;"
                    class="text-body-2 text-black font-weight-bold">
                    {{ vehicleStore.vehicle.reg }}
                </span>

            </div>
        </v-col>
    </v-row>

    <v-row class="mt-8 bg-background pa-2 " style="border-left: 4px solid var(--primary-color);">
        <v-col cols="6" sm="3">
            <p class="  text-capitalize" style="font-size: 13px;">Auction House</p>
            <p class="text-body-2 mt-2 pl-3  "   style="background-color: rgb(var(--v-theme-primary),0.2); border-radius: 5px ; padding: 5px 10px 5px 10px;"
                >{{
                vehicleStore.vehicle?.auction?.name }}</p>
        </v-col>
        <v-col cols="6" sm="3">
            <p class="textSizes text-light text-capitalize">Auction Center</p>
            <p class="text-body-2 mt-2 ">{{ vehicleStore.vehicle?.center?.name }}</p>
        </v-col>
        <v-col cols="6" sm="3">
            <p class="textSizes text-light text-capitalize width: 110px;  ">Date</p>
            <p class="text-body-2 mt-2 ">{{ vehicleStore.vehicle.auction_date }}</p>
        </v-col>

        <v-col cols="6" sm="3">
            <p class="textSizes text-light text-capitalize width: 110px;  ">Time</p>
            <p class="text-body-2 mt-2 ">{{ vehicleStore.vehicle.auction_date }}</p>
        </v-col>
        <v-col cols="6" sm="3">
            <p class="textSizes text-light text-capitalize">Auc Type</p>
            <p class="text-body-2 mt-2 ">{{ vehicleStore.vehicle?.auction?.auction_type }}</p>
        </v-col>
        <v-col cols="6" sm="3" class="pl-6">
            <p class="textSizes text-light text-capitalize ">Lot</p>
            <p class="text-body-2 mt-2 ">{{ vehicleStore.vehicle.lot }}</p>
        </v-col>
        <v-col cols="6" sm="3">
            <p class="textSizes text-light text-capitalize">Auction Status</p>
            <p class="text-body-2 mt-2 ">{{ vehicleStore.vehicle.bidding_status }}</p>
        </v-col>
        <v-col cols="6" sm="3">
            <p class="textSizes text-light text-capitalize">Previous Auc</p>
            <div class="mt-2">
                <span
                    style="background-color: rgb(var(--v-theme-danger),0.2); border-radius: 5px ; padding: 5px 10px 5px 10px;"
                    class="text-body-2 ">
                    View Detail
                </span>
            </div>
        </v-col>

    </v-row>

   <v-row
  class="mt-8 mb-2"
  style="background-color: rgb(var(--v-theme-danger),0.2);"
>
  <v-col cols="12">

    <!-- HEADER + ICON -->
    <div class="d-flex align-center justify-space-between px-2">
      <v-card-title class="pa-0">Disclaimer</v-card-title>

      <v-icon
        color="error"
        class="cursor-pointer"
        @click="showDisclaimer = !showDisclaimer"
      >
        mdi-information-outline
      </v-icon>
    </div>

    <!-- CONTENT (same width, same place) -->
    <v-expand-transition>
      <div v-show="showDisclaimer">
        <v-card flat color="transparent" class="pa-2 border-none">
          <div class="text-subtitle-2 text-light_text_on">
            <span class="text-body-1 text-white">AUTOBILI LTD</span>
            aggregates vehicle auction data from third-party sources providing
            it as-is to help users make informed decisions, without guaranteeing
            data accuracy or completeness.
            <span class="text-primary"> learn more</span>
          </div>
        </v-card>
      </div>
    </v-expand-transition>

  </v-col>
</v-row>


</template>
<script>

import { useVehicleStore } from '@/stores/vehicleStore';

export default {
    components: {

    },
    data() {
        return {
            vehicleStore: useVehicleStore(),
            showDisclaimer: false,
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
.textSizes {
    font-size: 13px;
}
</style>