<template>
    <custom-card title="Equipments">
        <v-container>
            <v-row dense>
                <v-col v-for="value in vehicleStore.overView.equipments" :key="value" cols="6" sm="4" class="text-caption">

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