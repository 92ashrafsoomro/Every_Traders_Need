<template>
    <custom-card title="Features">
        <v-container>
            <v-row dense>
                <v-col v-for="value in [
                    'Charge Cable - 3 Pin',
                    'Charge Cable - Type 2',
                    'Navigation HDD',
                    'Parking Assistance Pack',
                    'Hi-Fi Speaker System - 10',
                    'Navigation HDD'
                    ,'Parking Assistance Pack', 'Climate Control', 'Cloth Trim - Anthracite', 'Tyre Repair Kit'
                ]" cols="6" sm="4" class="text-caption">
                    <v-chip variant="text" prepend-icon="mdi-circle-small" >{{ value }}</v-chip>
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
    mounted() {


    },

    beforeUnmount() {

    },
    methods: {


    },

};

</script>