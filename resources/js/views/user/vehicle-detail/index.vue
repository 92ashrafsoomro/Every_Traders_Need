<template>
    <!-- SIDEBAR OVERLAY -->
    <v-navigation-drawer v-model="vehicleStore.sidebar" location="left" temporary width="300" class="bg-surface">


        <VehicleSidebar />

    </v-navigation-drawer>
    <!-- TOP BACKGROUND -->
    <div class="w-100 bg-surface pb-8" style="position:absolute; height:280px;">
        <div class="pattern-bg"></div>

        <div class="position-relative pt-5 mx-auto px-2 px-lg-4" style="max-width:1400px; z-index:10">
            <slot />
        </div>
    </div>

    <v-container fluid class="mt-10 p-0 " style="max-width: 1400px">

        <v-row justify="center">



            <v-col cols="12">

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
                                    <!-- class="d-flex flex-column flex-sm-row align-end align-lg-start ga-4 justify-normal" -->

                                    <v-col cols="12" class="w-100 ">
                                        <div class="  d-flex  align-center  mb-6">
                                            <!-- Left group -->
                                            <div class="d-flex ga-3  w-sm-auto mb-3 mr-2 mb-sm-0">
                                                <v-btn value="details" height="50"
                                                    @click="vehicleStore.sidebar = !vehicleStore.sidebar"
                                                    class="bg-background text-capitalize text-body-1 border">
                                                    <v-icon>mdi-menu</v-icon>
                                                </v-btn>
                                            </div>
                                            <div class="d-flex btn-scroll-wrapper  justify-space-between w-100">

                                                <div class="d-flex ml-2 btn-scroll-inner">
                                                    <v-btn-toggle v-model="vehicleStore.tab" mandatory>
                                                        <v-btn value="details" height="50" variant="tonal"
                                                            class="buttonBorder text-none px-5 py-2 text-capitalize text-body-1"
                                                            :class="{ 'bg-primary text-white': vehicleStore.tab === 'details' }">
                                                            Vehicle Details
                                                        </v-btn>

                                                        <v-btn value="valuation" height="50" variant="tonal"
                                                            class="buttonBorder text-none px-5 py-2 ml-2 text-capitalize text-body-1"
                                                            :class="{ 'bg-primary text-white': vehicleStore.tab === 'valuation' }">
                                                            Vehicle Valuation
                                                        </v-btn>
                                                    </v-btn-toggle>
                                                </div>


                                                <div class="d-flex ga-3">
                                                    <v-btn-toggle class="detection-toggle" v-model="vehicleStore.tab"
                                                        mandatory>
                                                        <v-btn value="detection" height="50"
                                                            class="detection buttonBorder text-none px-5 py-2 text-capitalize text-body-1"
                                                            :class="{ 'bg-danger text-white': vehicleStore.tab === 'detection' }"
                                                            style="background-color: rgba(var(--v-theme-danger), 0.2);">
                                                            Reauction Detacted
                                                        </v-btn> </v-btn-toggle>


                                                </div>
                                            </div>
                                            <div class="d-flex ga-3  w-sm-auto mb-3 mb-sm-0 ml-2">
                                                <v-btn value="Reauction Detacted" height="50"
                                                    class="bell text-capitalize text-body-1 border"
                                                    :disabled="alertExists" @click="sendAlertdata" :style="{
                                                        backgroundColor: alertExists ? 'rgba(var(--v-theme-primary))'   : 'transparent',
                                                        
                                                        cursor: alertExists ? 'not-allowed' : 'pointer'
                                                    }">
  <v-icon :color="alertExists ? 'white' : 'primary'">mdi-bell-outline</v-icon>

                                                </v-btn>

                                            </div>
                                        </div>
                                    </v-col>



                                    <v-col cols="12" class="mt-4">
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
import DetailTab from './CarDetailTab/index.vue';
import ValuationTab from './ValuationTab/index.vue';
import Detaction from './DetactionTab/index.vue'
import VehicleSidebar from './VehicleSidebar.vue';
import Vehicle from '@/models/vehicle.model';
import General from '@/models/general.model';


export default {
    components: {
        DetailTab,
        ValuationTab,
        Detaction,
        VehicleSidebar,

    },
    data() {
        return {
            vehicleStore: useVehicleStore(),
            loading: false,
            alertExists: false,
            filter: {
                lenght: 1
            }
        };
    },
    async mounted() {

        this.loadVehicle();
        this.alertExist();
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
                case "detection":
                    return Detaction
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
                    this.vehicleStore.reauction = res.data.reauction || null;
                    this.loading = false;
                    this.vehicleStore.isVehicle = true;

                }).catch(() => {

                    this.loading = false;
                    this.vehicleStore.vehicle = {};
                    this.vehicleStore.isVehicle = false;
                    this.$router.replace("/user/dashboard");

                });
        },
        async alertExist() {
            const options = {
                vehicle_id: this.vehicleStore.vehicle.id,
                lenght: this.filter.lenght
            };

            try {
                let res = await General.get("/api/notifications/userAlertList", options);

                this.alertExists = res.data?.some(alert => alert.vehicle_id === this.vehicleStore.vehicle.id);

            } catch (e) {
                console.error(e);
            }
        }
        ,
        async sendAlertdata() {
            const options = { vehicle_id: this.vehicleStore.vehicle.id };

            try {
                let res = await General.post("/api/notifications/addInVehicleAlert", options);
                this.$alertStore.add("ALert Add Successfully" , "success")
                this.alertExists = true; 
            } catch (e) {
                console.error(e);
            }
        }


    }
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

.v-btn.bell:hover {
    background-color: rgb(var(--v-theme-primary), 0.2) !important;
}

.v-btn-toggle .v-btn--active {
    background-color: rgb(var(--v-theme-primary)) !important;
    color: white !important;
}

.detection-toggle .v-btn--active {
    background-color: rgb(var(--v-theme-danger)) !important;
    color: white !important;

}

.btn-scroll-wrapper {
    overflow-x: auto;
    padding-bottom: 8px;
    display: flex;
    gap: 10px;
}


@media (min-width: 601px) {
    .btn-scroll-wrapper {
        overflow-x: visible;
        padding-bottom: 0;
    }
}
</style>