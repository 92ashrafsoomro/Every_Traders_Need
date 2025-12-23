<template>
    <!-- TOP BACKGROUND -->
    <div class="w-100 bg-surface pb-8" style="position: absolute; height: 400px;">
        <div class="pattern-bg"></div>

        <div class="position-relative pt-5 mx-auto px-2 px-lg-4" style="max-width: 1400px; z-index: 10">
            <slot />
        </div>
    </div>


    <v-container fluid class="mt-10">

        <v-row justify="center">
            <v-col :style="$vuetify.display.lgAndUp ? sidebarStyle : sidebarResponsiveStyle"
                style="position: sticky; top: 40px; left: 0px;">
                <VehicleSidebar />
            </v-col>
            <v-col cols="12" style="max-width: 1400px">

                <v-row v-if="loading">
                    <v-col cols="12" class="text-center">
                        Loading..
                    </v-col>
                </v-row>


                <v-row v-else-if="!vehicleStore.isVehicle">
                    <v-col cols="12" class="text-center">
                        No Data
                    </v-col>
                </v-row>


                <v-row v-else>
                    <v-col cols="12">

                        <v-row style="position: relative;">





                            <v-col>
                                <v-row no-gutters>

                                    <v-col cols="12"
                                        class="d-flex flex-column flex-sm-row align-end align-lg-start ga-4 justify-normal">
                                        <v-btn-toggle style="overflow: hidden;"> <v-btn size="small" color="primary"
                                                @click="vehicleStore.sidebar = !vehicleStore.sidebar"> <v-icon
                                                    size="large">mdi-menu</v-icon> </v-btn> </v-btn-toggle>

                                        <v-btn-toggle v-model="vehicleStore.tab" class="w-100 d-flex ga-4"
                                            color="primary" mandatory>
                                            <v-btn value="details" height="50" class="text-capitalize text-body-1">
                                                Vehicle Details
                                            </v-btn>

                                            <v-btn value="valuation" height="50" class="text-capitalize text-body-1">
                                                Vehicle Valuation
                                            </v-btn>
                                        </v-btn-toggle>
                                       
                                    </v-col>


                                    <v-col cols="12">
                                        <component :is="currentComponent" />
                                    </v-col>
                                </v-row>
                            </v-col>
                        </v-row>

                    </v-col>
                </v-row>

            </v-col>
        </v-row>
    </v-container>
</template>

<script>

import { useVehicleStore } from '@/stores/vehicleStore';
import { toRaw } from 'vue';

import DetailTab from './CarDetailTab/index.vue';
import ValuationTab from './ValuationTab/index.vue';
import VehicleSidebar from './VehicleSidebar.vue';
import Vehicle from '@/models/vehicle.model';


export default {
    components: {
        DetailTab,
        ValuationTab,
        VehicleSidebar,
    },
    data() {
        return {
            vehicleStore: useVehicleStore(),
            loading: false,
        };
    },
    async mounted() {

        this.loadVehicle();
        this.$themeStore.menuType = "collapsed";
    },
    beforeUnmount() {

    },
    unmounted() {

        this.loading = false;
        this.vehicleStore.isVehicle = false;

    },
    computed: {
        currentComponent() {
            switch (this.vehicleStore.tab) {
                case "details":
                    return DetailTab
                default:
                    return ValuationTab
            }
        },
        sidebarStyle() {

            return {
                flexBasis: this.vehicleStore.sidebar ? '300px' : '0px',
                display: this.vehicleStore.sidebar ? 'block' : 'none',
                flexGrow: '0',
                height: '100%'
                // flexShrin: '0',
            }
        },
        sidebarResponsiveStyle() {
            return {
                width: '0px',
                display: 'none',

                // display: 'none',
                // flexGrow: '0',
                // flexShrin: '0',
            }
        },
        contentStyle() {
            return {
                maxWidth: '1300px',
                // width: this.vehicleStore.sidebar ? "calc(100% - 300px)" : "100%" ,
                // height: '100vh',
            }
        },
    },
    watch: {
        '$route.params.id': {
            immediate: true,
            handler(newId) {
                this.loadVehicle(newId);
            }
        }
    },
    methods: {
        loadVehicle() {

            this.loading = true;
            Vehicle.find(this.$route.params.id)
                .then((res) => {

                    this.vehicleStore.vehicle = res.data.vehicle;
                    this.loading = false;
                    this.vehicleStore.isVehicle = true;

                }).catch(() => {

                    this.loading = false;
                    this.vehicleStore.vehicle = {};
                    this.vehicleStore.isVehicle = false;
                    this.$router.replace("/user/dashboard");

                });
        },

    },
};
</script>

<style scoped>
.pattern-bg {
    position: absolute;
    inset: 0;
    background-image: radial-gradient(#0080ff 1.5px, transparent 1.2px);
    background-size: 16px 16px;
    background-repeat: repeat;
    opacity: 0.25;
    pointer-events: none;
    z-index: 0;
}

.sidebar--mobile {
    position: fixed;
    height: 100%;
    top: 10;
    left: 0;
    z-index: 999;
    transform: translateX(-100%);
    width: 280px;
    transition: transform .3s ease;
}

.sidebar--mobile.sidebar--open {
    transform: translateX(0);
}

.content {
    margin-left: 300px;
    transition: margin-left 0.25s ease-in-out;
    width: calc(100% - 300px);
}



::-webkit-scrollbar {
    display: none;
}


@media (max-width: 1440px) {}

@media (max-width: 1440px) {}
</style>