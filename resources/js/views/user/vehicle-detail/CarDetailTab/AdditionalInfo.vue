<template>
    <v-card flat color="transparent" class="pa-5">
        <v-container>
            <v-row>
                <v-card-title class="text-h4 font-weight-medium">
                    Additional Information
                </v-card-title>
            </v-row>
            <v-row>
                <v-col cols="6" sm="3">
                    <v-card flat color="transparent">
                        <v-card-title class="text-overline">Former Keepers</v-card-title>
                        <div class="d-flex align-center ga-2">
                            <v-icon>mdi-account-group</v-icon>
                            <p class="text-caption">1</p>
                        </div>
                    </v-card>
                </v-col>
                <v-col cols="6" sm="3">
                    <v-card flat color="transparent">
                        <v-card-title class="text-overline">Vendors</v-card-title>
                        <div class="d-flex align-center ga-2">
                            <v-icon>mdi-arrow-u-left-top</v-icon>
                            <p class="text-caption"></p>
                        </div>
                    </v-card>
                </v-col>
                <v-col cols="6" sm="3">
                    <v-card flat color="transparent">
                        <v-card-title class="text-overline">Registration</v-card-title>
                        <div class="d-flex align-center ga-2">
                            <v-icon>mdi-file-account-outline</v-icon>
                            <p class="text-caption">DF22 HVR</p>
                        </div>
                    </v-card>
                </v-col>
                <v-col cols="6" sm="3">
                    <v-card flat color="transparent">
                        <v-card-title class="text-overline">VAT Type</v-card-title>
                        <div class="d-flex align-center ga-2">
                            <v-icon>mdi-ticket-percent</v-icon>
                            <p class="text-caption"></p>
                        </div>
                    </v-card>
                </v-col>
                <v-col cols="6" sm="3">
                    <v-card flat color="transparent">
                        <v-card-title class="text-overline">Euro Status</v-card-title>
                        <div class="d-flex align-center ga-2">
                            <v-icon>mdi-leaf</v-icon>
                            <p class="text-caption"></p>
                        </div>
                    </v-card>
                </v-col>
                <v-col cols="6" sm="3">
                    <v-card flat color="transparent">
                        <v-card-title class="text-overline">Engine Runs</v-card-title>
                        <div class="d-flex align-center ga-2">
                            <v-icon>mdi-car-wrench</v-icon>
                            <p class="text-caption">No</p>
                        </div>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
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