<template>
   



</template>
<script>
import { useVehicleStore } from '@/stores/vehicleStore';

export default {

    data() {
        return {
            vehicle:{},
            isMobile: false,
            vehicleStore: useVehicleStore(),
        };
    },
    mounted() {

        this.vehicle = this.vehicleStore.vehichleDetail
        // this.checkDevice();
        // window.addEventListener("resize", this.handleResize);
    },

    beforeUnmount() {
        // window.removeEventListener("resize", this.handleResize);
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