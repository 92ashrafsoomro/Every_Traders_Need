<template>
    <v-row no-gutters class="d-flex align-center justify-center ga-1 bg-surface border-t border-b pt-8 pb-8 ">
        <v-col cols="6" lg="2" md="2" sm="3"
            class="d-flex align-center flex-column flex-sm-row ga-2">
            <v-card class="bg-shadow pa-1 pa-lg-3 rounded-lg">
                <v-icon color="primary">mdi-car</v-icon>
            </v-card>
            <div class="d-flex flex-column ga-1">
                <p class="text-caption">{{ vehicleStore.overView.reg }}</p>
                <p class="text-caption mt-n1">Reg</p>
            </div>
        </v-col>
        <v-col cols="6" lg="2" md="2" sm="3"
            class="d-flex align-center flex-column flex-sm-row ga-2">
            <v-card class="bg-shadow pa-1 pa-lg-3 rounded-lg">
                <v-icon color="primary">mdi-calendar</v-icon>
            </v-card>
            <div class="d-flex flex-column ga-1">
                <p class="text-caption">{{ vehicleStore.overView.dor }}</p>
                <p class="text-caption mt-n1">DOR</p>
            </div>
        </v-col>
        <v-col cols="6" lg="2" md="2" sm="3"
            class="d-flex align-center flex-column flex-sm-row ga-2">
            <v-card class="bg-shadow pa-1 pa-lg-3 rounded-lg">
                <v-icon color="primary">mdi-speedometer-medium</v-icon>
            </v-card>
            <div class="d-flex flex-column ga-1">
                <p class="text-caption">{{ vehicleStore.overView.mileage }}</p>
                <p class="text-caption mt-n1">Mileage</p>
            </div>
        </v-col>
        <v-col cols="6" lg="2" md="2" sm="3"
            class="d-flex align-center flex-column flex-sm-row ga-2">
            <v-card class="bg-shadow pa-1 pa-lg-3 rounded-lg">
                <v-icon color="primary">mdi-creation-outline</v-icon>
            </v-card>
            <div class="d-flex flex-column ga-1">
                <p class="text-caption">{{ vehicleStore.overView.grade }}</p>
                <p class="text-caption mt-n1">Grade</p>
            </div>
        </v-col>
        <v-col cols="6" lg="2" md="2" sm="3"
            class="d-flex align-center flex-column flex-sm-row ga-2">
            <v-card class="bg-shadow pa-1 pa-lg-3 rounded-lg">
                <v-icon color="primary">mdi-file-document</v-icon>
            </v-card>
            <div class="d-flex flex-column ga-1">
                <p class="text-caption">{{ vehicleStore.overView.v5 }}</p>
                <p class="text-caption mt-n1">V5</p>
            </div>
        </v-col>
    </v-row>

</template>

<script>
    import {
        useVehicleStore
    } from '@/stores/vehicleStore';


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
