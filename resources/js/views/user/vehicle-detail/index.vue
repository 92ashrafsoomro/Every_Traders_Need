<template>
    <v-container fluid class="pa-0">

        <v-row v-if="loading" dense>
            <v-col cols="12">
                <p class="text-center">Loading..</p>
            </v-col>
        </v-row>

        <v-row v-else-if="!vehicleStore.v" dense>
            <v-col cols="12">
                <p class="text-center">No Data</p>
            </v-col>
        </v-row>
        <v-row v-else dense>

        <v-col cols="12" class="pt-10" >
                <div class="d-flex">
                    <div class="sidebar" >
                          <RelativeVehicle />
                    </div>
                    <div class="content" >
                            <v-row dense>
                                <v-col cols="12"
                                    class="d-flex flex-column flex-sm-row align-end align-lg-start justify-normal ga-5">
                                    <v-btn-toggle v-model="vehicleStore.vehichleDetail.tab" class="w-100" color="primary" mandatory>
                                        <v-btn value="details">Vehicle Details</v-btn>
                                        <v-btn value="valuation">Vehicle Valuation</v-btn>
                                    </v-btn-toggle>
                                    <v-btn color="primary" class="mb-4"
                                        @click="vehicleStore.vehichleDetail.sidebar = !vehicleStore.vehichleDetail.sidebar"
                                        append-icon="mdi-backburger">
                                        {{ vehicleStore.vehichleDetail.sidebar ? 'Hide Menu' : 'Show Menu' }}
                                    </v-btn>
                                </v-col>
                                <v-col cols="12">
                                    <template v-if="vehicleStore.vehichleDetail.tab === 'details'">
                                        <DetailTab />
                                    </template>
                                    <template v-if="vehicleStore.vehichleDetail.tab === 'valuation'">
                                        <ValuationTab />
                                    </template>
                                </v-col>
                            </v-row>
                    </div>
                </div>
            </v-col>
        </v-row>
    </v-container>
</template>
<script>
import { useVehicleStore } from '@/stores/vehicleStore';
import { toRaw } from 'vue';

import DetailTab from './DetailTab.vue';
import ValuationTab from './ValuationTab.vue';
import RelativeVehicle from './RelativeVehicle.vue';


export default {
    components: {
        RelativeVehicle,
        DetailTab,
        ValuationTab,
    },
    data() {
        return {
            vehicleStore: useVehicleStore(),
            loading: false,
        };
    },
    mounted() {

        this.loadVehicle()
        this.$themeStore.menuType = "collapsed";
    },

    beforeUnmount() {

    },
    methods: {

        loadVehicle() {
            this.loading = true;
            this.vehicleStore.getVehicleDetail({ id: this.$route.params.id })
                .then((data) => {
                    this.vehicleStore.v = data.data;
                    this.loading = false;
                    console.log(toRaw(this.vehicleStore.v));
                }).catch(() => {
                    this.loading = false;
                    this.vehicleStore.v = false;
                    this.$router.replace("/user/dashboard");
                });
        },

    },

};
</script>

<style scoped>

    .sidebar{
        max-width: 300px;
        
    }


    @media (max-width: 992px) {
        .sidebar{
            position: absolute;
        }
    }


    /* Vuetify’s internal wrapper override */
    ::-webkit-scrollbar {
        display: none;
    }

    .mobile-panel {
        max-width: 280px;
        height: 100vh; 
        z-index: 11;

    
    }


</style>