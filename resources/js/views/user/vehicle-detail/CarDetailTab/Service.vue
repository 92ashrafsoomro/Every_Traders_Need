<template>
    <custom-card title="Service History" class="h-100">
      <v-container>
        <v-row>
            <v-col v-for="(item,key) in items"  cols="12" sm="6" class="text-body-2">
                <div class="px-2">

                    <p class="text-light">{{item.label }} </p>
                    <div class="d-flex pt-2" >
                        <v-icon color="primary">{{ item.icon }}</v-icon>
                        <span class="pl-3 text-body-2" >{{ item.value }}</span>
                    </div>

                    <!-- <v-chip  class="my-chip" variant="text" size="large" :prepend-icon="item.icon">
                        <template #prepend> <v-icon color="primary">{{ item.icon }}</v-icon></template>
                        {{ item.value }}
                    </v-chip> -->
                </div>
            </v-col>     
        </v-row>
      </v-container>
    </custom-card>
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
    computed: {
        items() {

            return [
                {
                    "label": "Service History",
                    "value": "Service Book",
                    "icon": "mdi-book-open-page-variant",
                    "type": "title"
                },
                {
                    "label": "Number of services",
                    "value": "3 (0 main dealer)",
                    "icon": "mdi-wrench",
                    "highlight": true
                },
                {
                    "label": "Last Service",
                    "value": "08/05/2019",
                    "icon": "mdi-calendar"
                },
                {
                    "label": "Last service mileage",
                    "value": "35,443",
                    "icon": "mdi-speedometer",
                    "highlight": true
                },
                {
                    "label": "DVSA Mileage",
                    "value": "35k (06/04/2019), 50k (07/10/2020), 54k(06/02/2022), 58k(12/02/2023), 63k(18 /02 / 2024),66k(13/07/2025)",
                    "icon": "mdi-speedometer"
                },
                {
                    "label": "Additional service notes",
                    "value": "No notes recorded",
                    "icon": "mdi-note-text-outline"
                },
                {
                    "label": "MOT Expiry",
                    "value": "12/07/2026",
                    "icon": "mdi-calendar-alert"
                }
            ]
        }

    },
    methods: {


    }

};

</script>

<style scope >

.my-chip{
    max-width: auto !important;       /* remove default Vuetify max-width */
    min-width: auto !important;          /* allow small chips if needed */
    white-space: normal !important;   /* allow wrapping */
    overflow: visible !important;     /* prevent clipping */
}


</style>