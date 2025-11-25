<template>
    <v-container fluid>

        <v-row v-if="loading" >
            <v-col cols="12">
                <p class="text-center">Loading..</p>
            </v-col>
        </v-row>
        <v-row v-else-if="!vehicleStore.isVehicle" >
            <v-col cols="12">
                <p class="text-center">No Data</p>
            </v-col>
        </v-row>
        <v-row v-else >
            <v-col cols="12">
                    <div class="d-flex">
                        <div class="sidebar" :class="{
                            'sidebar--open': vehicleStore.sidebar,
                            'sidebar--mobile': vehicleStore.isMobile
                        }">
                            <template v-if="vehicleStore.sidebar"> 
                                <VehicleSidebar />
                            </template>
                        </div>

                        <div class="content " :class="{ 'content--collapsed': !vehicleStore.sidebar }">

                            <div class="main-layout">   
                                    <v-row no-gutters>
                                        <v-col cols="12"
                                            class="d-flex flex-column flex-sm-row align-end align-lg-start justify-normal">
                                            <v-btn-toggle>
                                                <v-btn size="small" color="primary"
                                                    @click="vehicleStore.sidebar = !vehicleStore.sidebar">
                                                    <v-icon size="large">mdi-menu</v-icon>
                                                </v-btn>
                                            </v-btn-toggle>
                                            <v-btn-toggle v-model="vehicleStore.tab" class="w-100" color="primary"
                                                mandatory>
                                                <v-btn value="details">Vehicle Details</v-btn>
                                                <v-btn value="valuation">Vehicle Valuation</v-btn>
                                            </v-btn-toggle>
                                        </v-col>
                                        <v-col cols="12">
                                               <component :is="currentComponent" />

                                        </v-col>
                                </v-row>

                            </div>
                            

                        </div>
                    </div>
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
    mounted() {

        // const width = window.innerWidth;
        // if (width <= 1440) {
        //     this.vehicleStore.vehichleDetail.sidebar = false;
        // } else {
        //     this.vehicleStore.vehichleDetail.sidebar = true;
        // }

        this.checkDeviceMode();
        window.addEventListener("resize", this.checkDeviceMode);
        this.loadVehicle();
        this.$themeStore.menuType = "collapsed";
    },
    beforeUnmount() {
        window.removeEventListener("resize", this.checkDeviceMode);
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


        checkDeviceMode() {
            const width = window.innerWidth;

            if (width > 1440) {
                this.vehicleStore.vehichleDetail.isMobile = false;
                this.vehicleStore.vehichleDetail.sidebar = true;
            }
            else {
                this.vehicleStore.vehichleDetail.isMobile = true;
                this.vehicleStore.vehichleDetail.sidebar = false;
            }
        },

    },

};
</script>

<style scoped>
.sidebar {
    max-width: 300px;
    height: 100vh;
    position: fixed;
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

.content--collapsed {
    margin-left: 0px;
    width: 100%;
}

::-webkit-scrollbar {
    display: none;
}

.mobile-panel {
    max-width: 280px;
    height: 100vh;
    z-index: 11;
}

.main-layout{
    max-width: 1300px;
    margin: auto;
}


@media (max-width: 1440px) {
    .content {
        margin-left: 0;
    }

    .content--collapsed {
        margin-left: 0px;
        width: 100%;
    }

}

@media (max-width: 1440px) {
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
}


</style>