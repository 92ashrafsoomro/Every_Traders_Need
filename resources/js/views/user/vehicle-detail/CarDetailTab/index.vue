<template>
    <v-row no-gutters >
        <v-col cols="12" class="mt-4 ">
            <custom-card>
                <div class="pa-5" >
                    <v-row>
                        <v-col cols="12" lg="6" md="6" sm="12" class="d-flex flex-column justify-start">
                            <CarSlider />
                        </v-col>
                        <v-col cols="12" lg="6" md="6" sm="12" class="ps-5 pr-5">
                            <BasicInfo/>
                        </v-col>
                    </v-row>
                </div>
            </custom-card>
        </v-col>
    </v-row>

    <Counter/>

    <v-row no-gutters class="mt-8 ps-10 pe-10">
        <v-col cols="12" md="8">
             <CarOverview/>
        </v-col>
        <v-col cols="12" md="3">
            <Service/>
        </v-col>
    </v-row>
    <v-row no-gutters class="ps-10 pe-10">
        <v-col cols="12" md="8">
            <AdditionalInfo/>
        </v-col>
    </v-row>
    <v-row no-gutters class="ps-10 pe-10 pb-10">
        <v-col cols="12" md="6">
            <Features/>
        </v-col>
        <v-col cols="12" md="5">
            <Equipment/>
        </v-col>
    </v-row>
</template>

<script>

import { useVehicleStore } from '@/stores/vehicleStore';
import CarSlider from './CarSlider.vue';
import CarOverview from './CarOverview.vue';
import BasicInfo from './BasicInfo.vue';
import Counter from './Counter.vue';
import AdditionalInfo from './AdditionalInfo.vue';
import Features from './Features.vue';
import Equipment from './Equipment.vue';
import Service from './Service.vue';


export default {
    components: {
        CarSlider,
        CarOverview,
        BasicInfo,
        Counter,
        AdditionalInfo,
        Features,
        Equipment,
        Service
    },
    data() {
        return {
            vehicleStore: useVehicleStore(),
            loading: false,
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