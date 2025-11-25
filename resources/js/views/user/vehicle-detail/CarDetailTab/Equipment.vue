<template>
    <v-card flat color="transparent">
        <v-card-title class="text-h4 font-weight-medium">Equipment</v-card-title>
        <v-row dense>
            <v-col cols="6" sm="4" class="text-caption">
                Charge Cable - 3 Pin
            </v-col>
            <v-col cols="6" sm="4" class="text-caption">
                Charge Cable - Type 2
            </v-col>
            <v-col cols="6" sm="4" class="text-caption">
                Hi-Fi Speaker System - 10
            </v-col>
            <v-col cols="6" sm="4" class="text-caption">
                Navigation HDD
            </v-col>
            <v-col cols="6" sm="4" class="text-caption">
                Parking Assistance Pack
            </v-col>
            <v-col cols="6" sm="4" class="text-caption">
                Climate Control
            </v-col>
            <v-col cols="6" sm="4" class="text-caption">
                Parking Sensor(s)
            </v-col>
            <v-col cols="6" sm="4" class="text-caption">
                Cloth Trim - Anthracite
            </v-col>
            <v-col cols="6" sm="4" class="text-caption">
                Tyre Repair Kit
            </v-col>
            <v-col cols="6" sm="4" class="text-caption">
                17" Alloy Wheels
            </v-col>
            <v-col cols="6" sm="4" class="text-caption">
                LED Headlights - Adaptive
            </v-col>
            <v-col cols="6" sm="4" class="text-caption">
                Metallic Paint - Sunset Orange
            </v-col>
        </v-row>
    </v-card>
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