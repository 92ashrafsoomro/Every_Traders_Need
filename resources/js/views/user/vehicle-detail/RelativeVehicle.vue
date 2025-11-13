<template>
    <v-card color="transparent" flat class="h-100">
            <v-row justify="space-between ps-2 pe-2">
                <v-col cols="4">
                    <div class="text-overline mb-2">Filters</div>
                </v-col>
                <v-col cols="4">
                    <v-btn size="small" color="primary"> 18</v-btn>
                </v-col>
                <v-col cols="4"> Clear All </v-col>
            </v-row>
            <v-row class="ps-2 pe-2">
                <v-col cols="6">
                    <v-select color="primary" label="All" density="compact" variant="outlined"></v-select>
                </v-col>
                <v-col cols="6">
                    <v-select color="primary" label="Select Platform" density="compact"
                        variant="outlined"></v-select>
                </v-col>
            </v-row>
            <v-expansion-panels class="overflow-y-auto" style="max-height: 79vh;">
                <v-expansion-panel v-for="n in 20" :key="n">
                    <v-expansion-panel-title class="rounded-0">
                        <div class="d-flex align-center w-100">
                            <img src="https://www1.bcaimage.com/Document?DocType=VehicleImage&width=300&docId=613522131" class="rounded mr-3 object-fit" width="50px" height="50px" />
                            <div class="flex-grow-1">
                                <div class="text-subtitle-1 font-weight-medium">BMW 3 Series</div>
                                <div class="text-body-2 text-grey-lighten-1">£18,900</div>
                            </div>
                        </div>
                    </v-expansion-panel-title>
                    <v-expansion-panel-text>
                        <v-btn density="comfortable" variant="outlined" color="primary">
                            Auction House
                        </v-btn>
                        <div class="d-flex justify-normal align-center ga-2 mt-2">
                            <p>11-11-2025</p>
                            <p>Leeds</p>
                        </div>
                    </v-expansion-panel-text>
                </v-expansion-panel>
            </v-expansion-panels>
    </v-card>
</template>

<script>
import { useVehicleStore } from '@/stores/vehicleStore';


export default {
    components: {
 
    },
    data() {
        return {
            vehicleStore:useVehicleStore(),
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
    /* Vuetify’s internal wrapper override */
    ::-webkit-scrollbar {
        display: none;
    }

    .mobile-panel {
        max-width: 280px;
    }
</style>