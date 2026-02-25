<template>
    <user-title-bar
        v-if="userStore.user.role !== 'Subscriber' || (userStore.user.plan && userStore.user.plan.plan_id !== 1)"
        title="Identify Repeat Auction Vehicles"
        subtitle="Detect vehicles returning to auction, review past results, and spot price drops before others do.">

        <div class="contentArea d-flex align-center justify-start pb-0 ga-6 pa-3 mb-n5"
            style="position: relative;  top: 10px; left:-10px; " fluid="">
            <div style="background-color: rgb(var(--v-theme-danger),0.4); " class="pb-0 text-center d-flex">
                <div class="px-2 pb-4 pt-2 ">
                    <h3 class="text-h4 font-weight-bold ">{{ pageStore.reauction.total }}</h3>
                    <p class="text-body-2">Today</p>
                </div>
            </div>
            <div class=" ">

                <div class="d-flex mt-2 mb-0 align-center">
                    <div style="min-width:120px">
                        <h3 class="mb-2 text-body-2">Auction house :</h3>
                    </div>

                    <div class="scrollSec">
                        <div>
                            <span v-for="item in pageStore.reauction.platform"
                                class="ml-2 px-2 rounded-lg text-body-1 text-whiteLite mb-2"
                                style="border: 1px solid rgba(var(--v-theme-danger),0.3);">
                                {{ item }}
                            </span>
                        </div>
                    </div>
                </div>



                <div class="d-flex mt-2 mb-0 ">
                    <div style="width: 120px !important;">
                        <h3 class="mb-2 text-body-2 mr-2  d-flex items-center align-center">Center:</h3>
                    </div>
                    <div class="scrollSec">

                        <div class="d-flex ">
                            <div v-for="(item, key) in pageStore.reauction.center"
                                class=" d-flex ml-2 align-center px-2 rounded-lg text-body-1 text-whiteLite ml-2 mb-2"
                                style="border: 1px solid rgba(var(--v-theme-primary),0.3);">
                                {{ item }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </user-title-bar>
    <div v-else class="center-wrapper">
        <div class=" pa-4 box">
            <p>Upgrade to Your Plan The Current plan not supported this page..</p>
            <router-link to="/settings/billing" style="text-decoration: none; color: white;">
                <v-btn color="primary" size="large" class="text-capitalize mt-5">
                    Upgrade Plan
                </v-btn>
            </router-link>
        </div>
    </div>
    <div style="max-width: 1400px;" class="mx-auto"
        v-if="userStore.user.role !== 'Subscriber' || (userStore.user.plan && userStore.user.plan.plan_id !== 1)">
        <div no-gutters="" class="">
            <!-- <v-col cols="12">
                <div class="d-lg-none d-md-none align-self-center pl-2">
                    {{ pageStore.reauction.offset }} - {{ (pageStore.reauction.offset +
                        pageStore.reauction.length) }} of {{ pageStore.reauction.total }} Vehicles
                </div>
                <div class="pt-5 d-flex justify-md-space-between flex-wrap  ">

                    <div class="d-flex flex-wrap">
                        <div class="px-lg-2 px-md-2">
                            <v-select label="Length" v-model="pageStore.reauction.length"
                                :items="[10, 20, 50, 100, 200, 500]" @update:model-value="handleInput"
                                variant="outlined" color="primary" width="120" density="compact" />
                        </div>
                        <div class="align-self-center pl-2 d-none d-0=lg-block d-md-block">
                            {{ pageStore.reauction.offset }} - {{ (pageStore.reauction.offset +
                                pageStore.reauction.length) }} of {{ pageStore.reauction.total }} Vehicles
                        </div>

                    </div>
                    <div class="d-flex flex-wrap">
                        <div class="px-lg-2 px-md-2  px-2">
                            <v-text-field prepend-inner-icon="mdi-magnify" label="Reg No"
                                v-model="pageStore.reauction.reg" @update:model-value="handleInput" variant="outlined"
                                color="primary" width="200" density="compact" clearable class="" />
                        </div>
                    </div>
                </div>
            </v-col> -->

            <v-col cols="12 " class="mt-4 mb-5">
                <v-card class="border-sm border-white ">
                    <div class="bg-surface">
                        <v-data-table-server hover :headers="headers" :items="pageStore.reauction.data"
                            :items-length="pageStore.reauction.total" :loading="pageStore.reauction.loading"
                            item-value="id" hide-default-footer="">

                            <template #item.title="{ item }"> {{ item.make_name }} {{ item.model_name }}
                                {{ item.variant_name }} </template>
                            <template #item.action="{ item }">
                                <v-btn :to="'/user/vehicle-detail/' + item.id"> <v-icon>mdi-eye</v-icon></v-btn>
                            </template>
                            <template #item.auction_date="{ item }">
                                <span>{{ dateFormate(auction_date) }}</span>
                            </template>

                            <!-- <template v-slot:bottom>
                                <div class="py-2 d-flex justify-end border-t">
                                    <custom-pagination :loading="pageStore.reauction.loading"
                                        v-model:page="pageStore.reauction.page"
                                        :lastPage="pageStore.reauction.last_page"
                                        @page-changed="pageStore.getreAuctionList" />
                                </div>
                            </template> -->

                        </v-data-table-server>
                    </div>
                </v-card>
            </v-col>
        </div>
    </div>
</template>
<script>


import { usePageStore } from "@/stores/pageStore";
import { useUserStore } from "@/stores/userStore";
import Restriction from "./layout/Restriction.vue";
export default {
    props: {},
    components: {
        Restriction
    },
    data() {

        return {
            centerName: [],
            platformName: [],
            userStore: useUserStore(),
            pageStore: usePageStore(),
            headers: [

                // { title: "view", key: 'view', sortable: false },
                { title: "Reg", value: "reg" },
                { title: "Vehicle", value: "vehicle" },
                { title: "Year", value: "year" },
                { title: "CC", value: "cc" },
                { title: "Milage", value: "mileage" },
                { title: "Transmission", value: "transmission" },
                { title: "Auction House", value: "platform_title" },
                { title: "Date Time", value: "autotrader_retail_value" },

            ],
        }
    },
    async mounted() {
        // this.getCenter();
        // this.getPlatform();
        this.pageStore.getreAuctionList()
    },
    methods: {
        // handleInput(e) {
        //     this.pageStore.getreAuctionList();
        // },
        dateFormate(date) {
            if (!date) return ""
            return date?.split('T')[0].split(' ')[0]
        },
        //    async getCenter(){
        //     try {
        //         const res = await General.get("api/cruds/center");
        //         this.centerName = res.data.slice(0 , 4).map(center => center.name) 
        //     } catch (e) {
        //         throw await errorHandler(e);
        //     }
        //     },
        //    async getPlatform(){
        //     try {
        //         const res = await General.get("api/cruds/platform");
        //         this.platformName = res.data.slice(0 , 4).map(platform => platform.name)
        //     } catch (e) {
        //         throw await errorHandler(e);
        //     }
        //     }

    },
};
</script>

<style scoped>
.scrollSec {
    flex: 1;
    overflow-x: auto;
    overflow-y: hidden;
}

.scrollSec>div {
    display: flex;
    flex-wrap: nowrap;
    white-space: nowrap;
}

@media (max-width: 720px) {
    .scrollSec {
        max-width: calc(100vw - 250px);
    }
}

.center-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    height: 80vh;
}
</style>
