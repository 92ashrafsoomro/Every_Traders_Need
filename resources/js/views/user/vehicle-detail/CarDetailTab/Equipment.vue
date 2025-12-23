<template>

    <custom-card title="Equipments">

        <v-container>
            <v-row dense class="mt-2">
                <v-col v-for="value in equipments" :key="value" cols="6" sm="4" class="text-caption">
                    <v-chip variant="text" prepend-icon="mdi-circle-small">{{ value }}</v-chip>
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
        equipments() {

            let equipments = this.vehicleStore.vehicle?.equipment?.split(",") || [];            
            return equipments;

        },  
    },
    mounted() {
        
    },
    beforeUnmount() {

    },
    methods: {

    },
};

</script>