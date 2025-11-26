<template>
    <custom-card title="Overview" >
        <v-container fluid>
            <!-- <v-row>
                <v-card-title class="text-h4 font-weight-medium">Overview</v-card-title>
            </v-row> -->
            <v-row>
                <v-col v-for="item in items" cols="6" sm="4" lg="3" >
                    <p class="ml-2 text-body-1 text-light text-overline text-capitalize">{{ item.title }}</p>
                    <v-chip  variant="text" size="large" :prepend-icon="item.icon">
                            <template #prepend>
                            <v-icon color="primary">{{ item.icon }}</v-icon>
                        </template>
                        {{ item.value }}</v-chip>
                            
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
    computed:{
        items() {

            return [
                {
                    title: 'Vehicle Type',
                    value: this.vehicleStore.overView.vehicleType,
                    icon: 'mdi-car',
                    color:'red',
                },
                {
                    title: 'Make',
                    value: this.vehicleStore.overView.make,
                    icon: 'mdi-steering',
                    color:'primary',
                },
                {
                    title: 'Model',
                    value: this.vehicleStore.overView.model,
                    icon:'mdi-car-cog',
                },
                {
                    title: 'Variant',
                    value: this.vehicleStore.overView.variant, 
                    icon:'mdi-cards',
                },
                {
                    title: 'CC',
                    value: this.vehicleStore.overView.cc,
                    icon:'mdi-speedometer-medium',
                },
                {
                    title: 'Year',
                    value: this.vehicleStore.overView.year,
                    icon:'mdi-calendar',
                },
                {
                    title: 'Color',
                    value: this.vehicleStore.overView.color,
                    icon:'mdi-palette',
                },
                {
                    title: 'Fuel Type',
                    value: this.vehicleStore.overView.fuelType,
                    icon:'mdi-gas-station',
                },
                {
                    title: 'Transmission',
                    value: this.vehicleStore.overView.transmission,
                    icon:'mdi-cogs',
                },
                {
                    title: 'Keys',
                    value: this.vehicleStore.overView.keys,
                    icon:'mdi-key',
                },
                {
                    title: 'Doors',
                    value: this.vehicleStore.overView.doors,
                    icon:'mdi-door',
                },
                {
                    title: 'Seats',
                    value: this.vehicleStore.overView.seats,
                    icon:'mdi-seat-passenger',
                },
                {
                    title: 'Former Keepers',
                    value: this.vehicleStore.overView.seats,
                    icon:'mdi-account-group',
                },
                {
                    title: 'Vendors',
                    value: this.vehicleStore.overView.seats,
                    icon:'mdi-file-account-outline',
                },
                {
                    title: 'VAT Type',
                    value: this.vehicleStore.overView.vatType,
                    icon:'mdi-ticket-percent',
                },
                {
                    title: 'Euro Status',
                    value: this.vehicleStore.overView.euroStatus,
                    icon:'mdi-leaf',
                },
                {
                    title: 'Engine Runs',
                    value: this.vehicleStore.overView.engineRuns,
                    icon:'mdi-car-wrench',
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