<template>
  <v-card flat color="transparent" class="pa-1 pa-lg-5">
        <v-container>
            <v-row>
                <v-card-title class="text-h4 font-weight-medium">Overview</v-card-title>
            </v-row>
            <v-row>
                <v-col cols="6" sm="3">
                    <v-card flat color="transparent">
                        <v-card-title class="text-overline">Vehicle Type</v-card-title>
                        <div class="d-flex align-center ga-2">
                            <v-icon>mdi-car</v-icon>
                            <p class="text-caption">{{ vehicleStore.overView.vehicleType }}</p>
                        </div>
                    </v-card>
                </v-col>
                <v-col cols="6" sm="3">
                    <v-card flat color="transparent">
                        <v-card-title class="text-overline">Make</v-card-title>
                        <div class="d-flex align-center ga-2">
                            <v-icon>mdi-steering</v-icon>
                            <p class="text-caption">{{ vehicleStore.overView.make}}</p>
                        </div>
                    </v-card>
                </v-col>
                <v-col cols="6" sm="3">
                    <v-card flat color="transparent">
                        <v-card-title class="text-overline">Model</v-card-title>
                        <div class="d-flex align-center ga-2">
                            <v-icon>mdi-car-cog</v-icon>
                            <p class="text-caption">{{ vehicleStore.overView.model}}</p>
                        </div>
                    </v-card>
                </v-col>
                <v-col cols="6" sm="3">
                    <v-card flat color="transparent">
                        <v-card-title class="text-overline">Variant</v-card-title>
                        <div class="d-flex align-center ga-2">
                            <v-icon>mdi-cards</v-icon>
                            <p class="text-caption">{{ vehicleStore.overView.variant}}</p>
                        </div>
                    </v-card>
                </v-col>
                <v-col cols="6" sm="3">
                    <v-card flat color="transparent">
                        <v-card-title class="text-overline">CC</v-card-title>
                        <div class="d-flex align-center ga-2">
                            <v-icon>mdi-speedometer-medium</v-icon>
                            <p class="text-caption">{{ vehicleStore.overView.cc}}</p>
                        </div>
                    </v-card>
                </v-col>
                <v-col cols="6" sm="3">
                    <v-card flat color="transparent">
                        <v-card-title class="text-overline">Year</v-card-title>
                        <div class="d-flex align-center ga-2">
                            <v-icon>mdi-calendar</v-icon>
                            <p class="text-caption">{{ vehicleStore.overView.year}}</p>
                        </div>
                    </v-card>
                </v-col>
                <v-col cols="6" sm="3">
                    <v-card flat color="transparent">
                        <v-card-title class="text-overline">Color</v-card-title>
                        <div class="d-flex align-center ga-2">
                            <v-icon>mdi-palette</v-icon>
                            <p class="text-caption">{{ vehicleStore.overView.color}}</p>
                        </div>
                    </v-card>
                </v-col>
                <v-col cols="6" sm="3">
                    <v-card flat color="transparent">
                        <v-card-title class="text-overline">Fuel Type</v-card-title>
                        <div class="d-flex align-center ga-2">
                            <v-icon>mdi-gas-station</v-icon>
                            <p class="text-caption">{{ vehicleStore.overView.fuelType}}</p>
                        </div>
                    </v-card>
                </v-col>
                <v-col cols="6" sm="3">
                    <v-card flat color="transparent">
                        <v-card-title class="text-overline">Transmission</v-card-title>
                        <div class="d-flex align-center ga-2">
                            <v-icon>mdi-cogs</v-icon>
                            <p class="text-caption">{{ vehicleStore.overView.transmission}}</p>
                        </div>
                    </v-card>
                </v-col>
                <v-col cols="6" sm="3">
                    <v-card flat color="transparent">
                        <v-card-title class="text-overline">Keys</v-card-title>
                        <div class="d-flex align-center ga-2">
                            <v-icon>mdi-key</v-icon>
                            <p class="text-caption">{{ vehicleStore.overView.keys}}</p>
                        </div>
                    </v-card>
                </v-col>
                <v-col cols="6" sm="3">
                    <v-card flat color="transparent">
                        <v-card-title class="text-overline">Doors</v-card-title>
                        <div class="d-flex align-center ga-2">
                            <v-icon>mdi-door</v-icon>
                            <p class="text-caption">{{ vehicleStore.overView.doors}}</p>
                        </div>
                    </v-card>
                </v-col>
                <v-col cols="6" sm="3">
                    <v-card flat color="transparent">
                        <v-card-title class="text-overline">Seats</v-card-title>
                        <div class="d-flex align-center ga-2">
                            <v-icon>mdi-seat-passenger</v-icon>
                            <p class="text-caption">{{ vehicleStore.overView.seats}}</p>
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

<style scoped>

</style>