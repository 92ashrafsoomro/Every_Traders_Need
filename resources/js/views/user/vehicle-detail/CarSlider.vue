<template>
    <div v-if="vehicleStore.v.vehicle.images" >
        <v-img :src="vehicleStore.v.vehicle.images.split(',')[0]" class="rounded-lg" />
        <v-row class="ga-2 pa-5">
            <v-img v-for="image in vehicleStore.v.vehicle.images.split(',')" :src="image" class="rounded" />
        </v-row>
    </div>
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