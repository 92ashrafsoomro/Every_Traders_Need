<template>
    <v-card flat class="pa-5">
        <v-card-title class="text-h5 font-weight-medium">Service History</v-card-title>
        <v-row>
            <v-col cols="12" sm="6">
                <div class="mb-2">
                    <p class="text-caption">Service Report</p>
                    <p>ECU held Service History</p>
                </div>
                <div class="mb-2">
                    <p class="text-caption">Last Service</p>
                    <p>2025-04-15</p>
                </div>
                <div class="mb-2">
                    <p class="text-caption">DVSA Mileage</p>
                    <p>na</p>
                </div>
                <div class="mb-2">
                    <p class="text-caption">MOT Expiry Date</p>
                    <p>2025-07-28</p>
                </div>
            </v-col>
            <v-col cols="12" md="6">
                <div class="mb-2">
                    <p class="text-caption">No of Services</p>
                    <p>2</p>
                </div>
                <div class="mb-2">
                    <p class="text-caption">Last Service Mileage</p>
                    <p>44812</p>
                </div>
                <div class="mb-2">
                    <p class="text-caption">Service Notes</p>
                    <p></p>
                </div>
                <div class="mb-2">
                    <p class="text-caption">MOT Due</p>
                    <p></p>
                </div>
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