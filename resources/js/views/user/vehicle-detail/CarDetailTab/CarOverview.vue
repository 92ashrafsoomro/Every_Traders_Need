<template>
    <custom-card title="Overview" >
        <v-container fluid>
            <!-- <v-row>
                <v-card-title class="text-h4 font-weight-medium">Overview</v-card-title>
            </v-row> -->
            <v-row class="mt-2">
                <v-col v-for="item in items" cols="6" sm="4" lg="3" >
                    <p class="ml-2 text-body-2  text-capitalize text-light_text_on">{{ item.title }}</p>
                    <v-chip  variant="text" size="large" :prepend-icon="item.icon">
                            <template #prepend>
                            <v-icon color="primary">{{ item.icon }}</v-icon>
                        </template>
                        <span class="text-body-1">
                        {{ item.value }}</span></v-chip>
                            
                </v-col>
            </v-row>
         
        </v-container> 
        
       
    </custom-card>
   
</template>

<script>
import { useVehicleStore } from '@/stores/vehicleStore';
import Equipment from './Equipment.vue';
import Features from './Features.vue';
export default {
    components: {
        Equipment,
        Features
    },
    data() {
        return {
            vehicleStore: useVehicleStore(),
        };
    },
    computed:{
        items() {

            return [
                {
                    title: 'Vehicle Type',
                    value: this.vehicleStore.vehicle?.vehicleType?.name,
                    icon: 'mdi-car',
                    color:'red',
                },
                {
                    title: 'Make',
                    value: this.vehicleStore.vehicle?.make?.name,
                    icon: ' mdi-car-cog',
                    color:'primary',
                },
                {
                    title: 'Model',
                    value: this.vehicleStore.vehicle?.model?.name,
                    icon:'mdi-steering',
                },
                {
                    title: 'Variant',
                    value: this.vehicleStore.vehicle?.variant?.name,
                    icon:'mdi-cards',
                },
                {
                    title: 'CC',
                    value: this.vehicleStore.vehicle.cc,
                    icon:'mdi-speedometer-medium',
                },
                {
                    title: 'Year',
                    value: this.vehicleStore.vehicle.year,
                    icon:'mdi-calendar',
                },
                {
                    title: 'Color',
                    value: this.vehicleStore.vehicle?.color?.name,
                    icon:'mdi-water',
                },
                {
                    title: 'Fuel Type',
                    value: this.vehicleStore.vehicle.fuel_type,
                    icon:'mdi-gas-station',
                },
                {
                    title: 'Transmission',
                    value: this.vehicleStore.vehicle.transmission,
                    icon:'mdi-cogs',
                },
                {
                    title: 'Keys',
                    value: this.vehicleStore.vehicle.keys,
                    icon:'mdi-key',
                },
                {
                    title: 'Doors',
                    value: this.vehicleStore.vehicle.doors,
                    icon:'mdi-car-door',
                },
                {
                    title: 'Seats',
                    value: this.vehicleStore.vehicle.seats,
                    icon:'mdi-car-seat',
                },
                {
                    title: 'Former Keepers',
                    value: this.vehicleStore.vehicle.former_keepers,
                    icon:'mdi-account-group',
                },
                {
                    title: 'Vendors',
                    value: this.vehicleStore.vehicle.seats,
                    icon:'mdi-file-account-outline',
                },
                {
                    title: 'VAT Type',
                    value: this.vehicleStore.vehicle.vat_status,
                    icon:'mdi-ticket-percent',
                },
                {
                    title: 'Euro Status',
                    value: this.vehicleStore.vehicle.euro_status,
                    icon:'mdi-hexagram',
                },
                {
                    title: 'Non Runner',
                    value: this.vehicleStore.vehicle.engine_runs,
                    icon:'mdi-engine',
                }
            ]
        }
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