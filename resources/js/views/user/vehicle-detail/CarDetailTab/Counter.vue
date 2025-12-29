<template>
    <div  class="d-flex flex-wrap align-center justify-space-between pa-8 ga-lg-0 ga-10 border-t  pt-8 pb-8 ">
        <div
            class="d-flex align-center flex-column flex-sm-row ga-2">
            <v-btn color="primary" variant="tonal" icon="mdi-pound" ></v-btn>
            <div class="d-flex flex-column align-lg-start align-md-start align-center ga-1">
                <p class="text-body-1 ">{{ vehicleStore.vehicle.reg}}</p>
                <p class="text-body-2 text-light_text_on mt-n1">Reg</p>
            </div>
        </div>
        <div
            class="d-flex align-center flex-column flex-sm-row ga-2">
            <v-btn color="primary" variant="tonal" icon="mdi-calendar" ></v-btn>
            <div class="d-flex flex-column ga-1 align-lg-start align-md-start align-center">
                <p class="text-body-1 ">{{ vehicleStore.vehicle.dor || "-"}}</p>
                <p class="text-body-2 text-light_text_on mt-n1">DOR</p>
            </div>
        </div>
        <div
            class="d-flex align-center flex-column flex-sm-row ga-2">
            <v-btn color="primary" variant="tonal" icon="mdi-speedometer-medium" ></v-btn>
            <div class="d-flex flex-column ga-1 align-lg-start align-md-start align-center">
                <p class="text-body-1  ">{{ vehicleStore.vehicle.mileage }}</p>
                <p class="text-body-2 text-light_text_on mt-n1" >Mileage</p>
            </div>
        </div>
        <div
            class="d-flex align-center flex-column flex-sm-row ga-2">
            <v-btn color="primary" variant="tonal" icon="mdi-star" ></v-btn>
            <div class="d-flex flex-column ga-1 align-lg-start align-md-start align-center">
                <p class="text-body-1 ">{{ vehicleStore.vehicle.grade }}</p>
                <p class="text-body-2 text-light_text_on mt-n1">Grade</p>
            </div>
        </div>
        <div
            class="d-flex align-center flex-column flex-sm-row ga-2">
            <v-btn color="primary" variant="tonal" icon="mdi-file-document" ></v-btn>
            <div class="d-flex flex-column ga-1 align-lg-start align-md-start align-center">
                <p class="text-body-1 ">{{ vehicleStore.vehicle.v5 }}</p>
                <p class="text-body-2 text-light_text_on mt-n1">V5</p>
            </div>
        </div>
    </div>
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
