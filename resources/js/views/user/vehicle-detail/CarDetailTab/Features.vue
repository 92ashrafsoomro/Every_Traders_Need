<template>
      <v-card flat color="transparent" class="pa-5">
                <v-card-title class="text-h4 font-weight-medium">Features</v-card-title>
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