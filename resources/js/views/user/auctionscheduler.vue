<template>
    <user-title-bar title="Auction Scheduler"
        subtitle="Manage and view platform auctions across all centers in one place.">
        <div
            class="d-flex flex-column flex-sm-row ga-2 w-100 w-md-75 w-lg-50 justify-center justify-sm-start align-start pr-5 pr-sm-0 mt-10">

            <PlateformDropdown label="Select Platform" variant="outlined" :model-value="options.platform_id"
                @update:modelValue="handleInput($event, 'platform_id')" clearable />

            <CenterDropdown label="Select Center" variant="outlined" :model-value="options.center_id"
                @update:modelValue="handleInput($event, 'center_id')" clearable />

            <div>
                <v-switch :model-value="options.enableCurrent" color="primary"  density="compact" hide-details
                    @change="handleInput($event, 'enableCurrent')" class="ml-3" />

                <span class="mt-2 ml-2">In Progress</span>
            </div>
        </div>
        <div class="pt-4 d-flex align-center ga-3 flex-wrap ml-auto mr-auto mt-4">
            <div v-for="(value, key, index) in days" :key="index" :class="{ 'active': options.day == key }"
                class="border rounded bg-surface-variant-1 pa-3 d-flex flex-column mb-3"
                style=" height: 95px; width: 185px;" @click="handleTab(key)">
                <div class="text-capitalize d-flex align-center justify-center  pb-2  text-wrap"
                    style="white-space: wrap !important; border-bottom: 1px solid #343E4B ;">
                    {{ key }}
                </div>
                <div class="lowerSection d-flex justify-space-between mt-2">
                    <div class="d-flex align-center ">
                        <svg width="15" height="15" viewBox="0 0 512 512" class="text-primary auction-svg"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill="currentColor"
                                d="M504.971 199.362l-22.627-22.627c-9.373-9.373-24.569-9.373-33.941 0l-5.657 5.657L329.608 69.255l5.657-5.657c9.373-9.373 9.373-24.569 0-33.941L312.638 7.029c-9.373-9.373-24.569-9.373-33.941 0L154.246 131.48c-9.373 9.373-9.373 24.569 0 33.941l22.627 22.627c9.373 9.373 24.569 9.373 33.941 0l5.657-5.657 39.598 39.598-81.04 81.04-5.657-5.657c-12.497-12.497-32.758-12.497-45.255 0L9.373 412.118c-12.497 12.497-12.497 32.758 0 45.255l45.255 45.255c12.497 12.497 32.758 12.497 45.255 0l114.745-114.745c12.497-12.497 12.497-32.758 0-45.255l-5.657-5.657 81.04-81.04 39.598 39.598-5.657 5.657c-9.373 9.373-9.373 24.569 0 33.941l22.627 22.627c9.373 9.373 24.569 9.373 33.941 0l124.451-124.451c9.372-9.372 9.372-24.568 0-33.941z" />
                        </svg>

                        <span class="pl-1 mt-1 text-body-2">
                            {{ value.auction }}
                        </span>
                    </div>

                    <div class="d-flex align-center">
                        <small class=" icon"><v-icon color="primary" icon="mdi-car" size="20"></v-icon></small>
                        <span class="pl-1 mt-1 text-body-2 ">{{ value.car }}</span>
                    </div>
                </div>
            </div>
        </div>
    </user-title-bar>

    <v-container fluid style="max-width: 1400px;">
        <v-row class="mt-3">
            <v-col cols="12">
                <v-card class="border-sm border-white">
                    <v-data-table-server :headers="headers" :items="data" :items-length="total" :loading="loading" hover
                        item-value="id" @update:options="getRecords">

                        <template #item.action="{ item }">
                            <div class="d-flex">
                                <v-icon class="eyeIcon" size="20">mdi-eye-outline</v-icon>
                                <v-icon class="NotifyIcon ml-2 " size="20"> mdi-bell-outline</v-icon>
                            </div>
                        </template>
                        <template #item.center_name="{ item }">
                            <div class="" style="max-width: 700px; ">

                                <div class="center_name_width">
                                    <span>{{ item.center_names }}</span>
                                </div>

                            </div>

                        </template>

                        <template v-slot:bottom>
                            <div class="py-2 d-flex justify-end border-t">
                                <custom-pagination :loading="loading" v-model:page="options.page"
                                    :lastPage="options.last_page" @page-changed="getRecords" />
                            </div>
                        </template>

                    </v-data-table-server>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>

import { auctionSheldulerList } from '@/services/pageService';
import { usePageStore } from '@/stores/pageStore';

import PlateformDropdown from '@/components/PlateformDropdown.vue';
import CenterDropdown from '@/components/CenterDropdown.vue';

export default {
    props: {

    },
    components: {
        PlateformDropdown,
        CenterDropdown
    },
    data() {
        return {
            pageStore: usePageStore(),
            platforms: [],
            centers: [],
            days: {
                today: {
                    auction: 0,
                    car: 10,
                },
                mon: {
                    auction: 0,
                    car: 10,
                },
                tue: {
                    auction: 6,
                    car: 10,
                },
                wed: {
                    auction: 0,
                    car: 10,
                },
                thu: {
                    auction: 9,
                    car: 10,
                },
                fri: {
                    auction: 0,
                    car: 10,
                },
                sat: {
                    auction: 10,
                    car: 10,
                },
            },
            options: {
                length: 10,
                page: 1,
                last_page: 1,
                offset: 0,
                platform_id: null,
                center_id: null,
                day: 'today',
                enableCurrent: false,
                date: '',
            },
            data: [],
            total: 0,
            loading: false,
            headers: [
                { title: "Platform", key: "platform_name", sortable: false },
                { title: "Center", value: "center_name" },
                { title: "Total Vehicles", value: "car_count" },
                { title: "Time", value: "time" },
                { title: "Status", value: "status" },
                { title: "Action", key: "action", sortable: false },
            ],
        };
    },
    async mounted() {


    },
    methods: {
        async handleInput(value, field) {

            switch (field) {
                case 'platform_id':
                    this.options.platform_id = value;
                    break;
                case 'center_id':
                    this.options.center_id = value;
                    break;
                case 'enableCurrent':
                    console.log(value.target.checked);
                    if (value.target.checked) {
                        this.options.day = 'today';
                    }
                    this.options.enableCurrent = value.target.checked;

                    break;

                default:
                    break;
            }

            this.getRecords();
        },
        handleTab(key) {

            if (this.options.enableCurrent) {

            } else {
                this.options.day = key;
            }

            this.getRecords();
        },
        async getRecords() {

            try {

                let res = await auctionSheldulerList(this.options);
                this.data = res.data;
                this.total = res.recordsTotal;
                this.options.page = Number(res.page);
                this.options.offset = res.offset;
                this.options.last_page = res.last_page
            } catch (error) {
                this.alertStore.add(error.message, 'error');
                this.data = [];
                this.total = 0;
                this.options.page = 1;
                this.options.last_page = 1;
            }
        }

    },
};
</script>

<style scoped>
.icon {
    font-size: 10px;
    color: #00bad1;
}

.active {
    border-color: rgb(var(--v-theme-primary)) !important;
}

.center_name_width {
    max-width: 1000px;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
    /* padding: 10px;  */
    max-height: 48px;
    transition:
        max-width 1s ease,
        max-height 1s ease,
        background-color 1s ease;
}

.center_name_width:hover {
    max-width: 900px;
    max-height: 200px;
    background-color: rgba(255, 255, 255, 0.04);
    -webkit-line-clamp: 6;
}

.eyeIcon:hover {
    color: rgb(var(--v-theme-primary));
    cursor: pointer;
}

.NotifyIcon:hover {
    color: rgb(var(--v-theme-primary));
    cursor: pointer;
}
</style>
