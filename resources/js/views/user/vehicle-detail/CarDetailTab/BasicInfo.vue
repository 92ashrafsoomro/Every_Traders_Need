<template>

    <h1 class="text-h4 font-weight-bold"> {{ vehicleStore.overView.title }}</h1>
    <v-row class="mt-2 bg-background">
        <v-col cols="6" sm="3">
                <p class="text-light text-caption text-capitalize">Mileage</p>
                <p class="text-subtitle-2" >{{vehicleStore.overView.mileage }}</p>
        </v-col>
        <v-col cols="6" sm="3">
                <p class="text-light text-caption text-capitalize">Grade</p>
                <v-chip variant="flat" color="success" class="text-dark" >
                {{ vehicleStore.overView.grade}}
                </v-chip>
        </v-col>
        <v-col cols="6" sm="3">
                <p class="text-caption text-light text-capitalize">Inspection</p>
                <div>
                     <v-btn density="compact" color="primary" class="text-caption">Report</v-btn>
                </div>
        </v-col>
        <v-col cols="6" sm="3">
                <p class="text-caption text-light text-capitalize">Reg</p>
                <div>
                     <v-btn density="compact" class="bg-white text-caption border-s-xl font-weight-bold border-primary">{{
                        vehicleStore.overView.reg }} </v-btn>
                </div>
        </v-col>
    </v-row>

    <v-row class="mt-5 bg-background" style="border-left: 4px solid var(--primary-color);">
        <v-col cols="6" sm="3">
                <p class="text-caption text-light text-capitalize">Auction House</p>
                <p class="text-body-2 ">{{ vehicleStore.overView.auction.title }}</p>
        </v-col>
        <v-col cols="6" sm="3">
            <p class="text-caption text-light text-capitalize">Auction Center</p>
            <p class="text-body-2 ">{{vehicleStore.overView.center.title }}</p>
        </v-col>
        <v-col cols="6" sm="3">
            <p class="text-caption text-light text-capitalize">Date / Time / End</p>
            <p class="text-body-2 ">{{vehicleStore.overView.dateTime }}</p>
        </v-col>
        <v-col cols="6" sm="3">
            <p class="text-caption text-light text-capitalize">Lot</p>
            <p class="text-body-2 ">{{vehicleStore.overView.lot }}</p>
        </v-col>
        <v-divider class="ms-5 me-5 mb-n1"></v-divider>
        <v-col cols="6" sm="3">
            <p class="text-caption text-light text-capitalize">Auction Status</p>
            <p class="text-body-2 ">{{vehicleStore.overView.biddingStatus }}</p>
        </v-col>
        <v-col cols="6" sm="3">
            <p class="text-caption text-light text-capitalize">Previous Auc</p>
             <v-btn density="compact" color="primary" class="text-caption ps-2 pe-2"
             >View Details</v-btn>
        </v-col>
        <v-col cols="6" sm="3">
            <p class="text-caption text-light text-capitalize">Auc Type</p>
            <p class="text-body-2 ">{{vehicleStore.overView.auctionType }}</p>
        </v-col>
    </v-row>

    <v-row class="mt-5 bg-background" style="border-left: 4px solid var(--danger-color);">
        <v-col cols="12">
            <v-card flat color="transparent" class="mt-n2">
                <v-card-title>Disclaimer</v-card-title>
                <v-card-subtitle class="text-medium-emphasis text-wrap">
                    {{ vehicleStore.overView.disclaimer }} <span class="text-primary">learn more</span>
                </v-card-subtitle>
            </v-card>
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