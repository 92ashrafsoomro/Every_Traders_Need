<template>
    <user-title-bar title="Auction List">

        <div>
            <v-card-title class="d-flex cursor-pointer " @click="showFilters = !showFilters">
                <span class="text-h6">
                    Filters
                </span>

                <v-icon color="primary">
                    {{ showFilters ? 'mdi-chevron-up' : 'mdi-chevron-down' }}
                </v-icon>
            </v-card-title>

            <v-expand-transition>
                <div v-show="showFilters">
                    <v-container fluid>
                        <div class="d-flex flex-wrap ga-2 ">
                            <v-text-field density="comfortable" variant="outlined" clearable v-model="filter.table_id"
                                label="Id" min-width="130px" max-width="130px" />

                            <PlateformDropdown min-width="250px" max-width="274px" v-model="filter.platform"
                                label="Auction House" clearable variant="outlined" base-color="white"
                                density="comfortable" />

                            <!-- <v-text-field density="comfortable" variant="outlined" clearable v-model="filter.name"
                                    label="Auction Name " /> -->
                            <AuctionTypeDropdown min-width="190px" max-width="274px" v-model="filter.auction_type"
                                label="Auction Type" variant="outlined" base-color="white" clearable
                                density="comfortable" />

                            <!-- item-title="title"
                                    item-value="id" -->

                            <!-- <StatusDropdown label="Status "
                                    variant="outlined"   density="comfortable"
                                    min-width="190px" max-width="274px" /> -->

                            <!-- <StatusDropdown
                                        v-model="filter.status"
                                        label="Status "
                                        item-title="title"
                                        item-value="id"
                                        clearable
                                        variant="outlined"
                                        density="comfortable"
                                        min-width="190px" max-width="274px" 
                                    /> -->
                            <!-- item-title="name"
                                    item-value="id" -->

                            <!-- <v-select min-width="190px" max-width="274px" density="comfortable" variant="outlined" :items="['Draft', 'Planed']"
                                     clearable v-model="filter.status" label="Status " /> -->

                            <v-text-field density="comfortable" variant="outlined" min-width="340px" max-width="274px"
                                type="date" v-model="filter.auction_date" label="Auction Date" />
                            <div class="">
                                <v-btn style="height: 47px; ;" variant="outlined" @click="loadItems(true)" class="mr-2">
                                    <v-icon icon="mdi-magnify"></v-icon>
                                </v-btn>

                            </div>
                        </div>
                        <!-- <AuctionWeek/> -->
                    </v-container>
                    <div style="max-width: 1400px;" class="mx-auto pa-2">
                        <v-row no-gutters="" class="ga-2">
                            <!-- Total Auctions -->


                            <!-- Total Auctions -->
                            <v-col cols="12" sm="6" md="" lg="" class="">

                                <v-card class="border-bottom border border-sm">
                                    <v-container>

                                        <div class="d-flex h-6">
                                            <div style="background: #0080ff38; border-radius: 22px; width: 40px; height: 40px;"
                                                class="circle d-flex justify-center align-center">
                                                <v-icon size="22" color="primary">mdi-store-clock</v-icon>
                                            </div>

                                            <span class="text-h4 px-3">{{ auctionCounter.total_auctions }}</span>
                                        </div>


                                        <div class="pt-3 text-body-1 text-whiteLite ">Total Auctions</div>
                                        <div class="pt-2 d-flex">
                                            <div class="text-body-2 pr-2">
                                                <span class="white">Live Auctions: </span>
                                                <span class=""
                                                    style="background-color: rgba(var(--v-theme-background)); padding: 8px; border-radius: 4px; ">
                                                    {{ auctionCounter.live_auctions }}</span>
                                            </div>
                                            <div class=" text-body-2 pl-2">
                                                <span class="white">Time Auctions: </span>
                                                <span class=""
                                                    style="background-color: rgba(var(--v-theme-background)); padding: 8px; border-radius: 4px; ">
                                                    {{
                                                        auctionCounter.time_auctions }}</span>
                                            </div>
                                        </div>


                                    </v-container>
                                </v-card>
                            </v-col>
                            <!-- Total Auctions -->
                            <v-col cols="12" sm="6" md="" lg="" class="">

                                <v-card class="border-bottom-inprogress w-100 border border-sm">
                                    <v-chip text-color="white" size="small"
                                        class="bg-danger position-absolute mt-5 right-0  "
                                        style="border-radius: 3px 0 0 3px;" label>
                                        <v-icon size="10" color="white" class="mr-2">
                                            mdi-circle
                                        </v-icon> Live
                                    </v-chip>
                                    <v-container>
                                        <div class="d-flex h-6">
                                            <div class=" bg-danger-lite d-flex justify-center align-center live-circle"
                                                style="border-radius: 22px; width: 40px; height: 40px;">
                                                <v-icon size="32" color="danger" class="">
                                                    mdi-radiobox-marked
                                                </v-icon>
                                            </div>

                                            <span class="text-h4 px-3">{{ auctionCounter.in_progressAuctions }}</span>
                                        </div>

                                        <div class="pt-3 text-body-1 text-whiteLite ">Inprogress Auctions</div>
                                        <div class="pt-2 d-flex justify-space-between">
                                            <div class="text-body-2 pr-2">
                                                <span class="white">Vehicles:</span>
                                                <span class=""
                                                    style="background-color: rgba(var(--v-theme-background)); padding: 8px; border-radius: 4px; ">
                                                    {{ auctionCounter.vehicles_in_progress_auctions }}</span>
                                            </div>
                                            <div class="text-body-2">View</div>

                                        </div>


                                    </v-container>
                                </v-card>
                            </v-col>
                            <!-- Total Auctions -->
                            <v-col cols="12" sm="6" md="" lg="" class="">

                                <v-card class="border-bottom  border border-sm">
                                    <v-container>

                                        <div class="d-flex h-6">
                                            <div style="background: #0080ff38; border-radius: 22px; width: 40px; height: 40px;"
                                                class="circle d-flex justify-center align-center">
                                                <v-icon size="32" color="primary">mdi-bash</v-icon>
                                            </div>
                                            <span class="text-h4 px-3">{{ auctionCounter.total_vehicles }}</span>
                                        </div>

                                        <div class="pt-3 text-body-1 text-whiteLite ">Total Vehicles</div>
                                        <div class="pt-2 d-flex">
                                            <div class="text-body-2 pr-2">
                                                <span class="white">Sold:</span>
                                                <span class=""
                                                    style="background-color: rgba(var(--v-theme-background)); padding: 8px; border-radius: 4px; ">
                                                    {{ auctionCounter.sold_vehicles }}</span>
                                            </div>
                                        </div>


                                    </v-container>
                                </v-card>
                            </v-col>

                            <v-col cols="12" sm="6" md="" lg="" class="">

                                <v-card class="border-bottom  border border-sm">
                                    <v-container>
                                        <div class="d-flex h-6">
                                            <div style="background: #0080ff38; border-radius: 22px; width: 40px; height: 40px;"
                                                class="circle d-flex justify-center align-center">
                                                <v-icon size="32" color="primary">mdi-repeat-variant</v-icon>
                                            </div>
                                            <span class="text-h4 px-3">{{ auctionCounter.vehicles_in_reauction }}</span>
                                        </div>

                                        <div class="pt-3 text-body-1 text-whiteLite ">Vehicle in reauctions</div>
                                        <div class="pt-2 d-flex">
                                            <div class="text-body-2 pr-2">
                                                <span class="white">Remaining:</span>
                                                <span class=""
                                                    style="background-color: rgba(var(--v-theme-background)); padding: 8px; border-radius: 4px; ">
                                                    {{ auctionCounter.remaining }}</span>
                                            </div>

                                        </div>


                                    </v-container>
                                </v-card>
                            </v-col>
                        </v-row>
                    </div>

                    <div class="content-scroll d-flex mt-6 w-100 ga-3">
                        <div v-for="item in status" :key="item.value"
                            class="border rounded bg-surface-variant-1 pa-3 cursor-pointer" style="width:13.5%"
                            @click="filter.status = item.value"
                            :class="{ 'bg-primary text-white': filter.status === item.value }">
                            <div class="d-flex justify-space-between ">
                                <div class="d-flex align-center">
                                    <small> {{ item.title }}</small>
                                </div>
                                <div class="d-flex align-center"> <svg width="15" height="15" viewBox="0 0 512 512"
                                        class="text-primary auction-svg" xmlns="http://www.w3.org/2000/svg">
                                        <path fill="currentColor"
                                            d="M504.971 199.362l-22.627-22.627c-9.373-9.373-24.569-9.373-33.941 0l-5.657 5.657L329.608 69.255l5.657-5.657c9.373-9.373 9.373-24.569 0-33.941L312.638 7.029c-9.373-9.373-24.569-9.373-33.941 0L154.246 131.48c-9.373 9.373-9.373 24.569 0 33.941l22.627 22.627c9.373 9.373 24.569 9.373 33.941 0l5.657-5.657 39.598 39.598-81.04 81.04-5.657-5.657c-12.497-12.497-32.758-12.497-45.255 0L9.373 412.118c-12.497 12.497-12.497 32.758 0 45.255l45.255 45.255c12.497 12.497 32.758 12.497 45.255 0l114.745-114.745c12.497-12.497 12.497-32.758 0-45.255l-5.657-5.657 81.04-81.04 39.598 39.598-5.657 5.657c-9.373 9.373-9.373 24.569 0 33.941l22.627 22.627c9.373 9.373 24.569 9.373 33.941 0l124.451-124.451c9.372-9.372 9.372-24.568 0-33.941z" />
                                    </svg> <span class="ml-1">0</span> </div>
                            </div>
                        </div>

                        <!-- Optional: Clear filter -->

                    </div>


                </div>

            </v-expand-transition>

        </div>
    </user-title-bar>

    <v-container max-width="1400px">
        <v-row no-gutters class="mt-3">
            <v-col cols="12">

                <div class="d-flex justify-space-between d-md-flex py-4">
                    <div class="d-flex align-center pb-2 pb-lg-0 pb-md-0">
                        <v-select v-model="filter.length" :items="[10, 25, 50, 100]" density="compact"
                            variant="outlined" max-width="150px" class="mr-2" />
                        <div class="align-self-center pl-2">{{ filter.offset }} - {{ Math.min(filter.length, total) }}
                            of {{ total }} Records </div>
                    </div>

                    <!-- <div class="d-flex w-lg-75 justify-end pb-2 pb-lg-0 pb-md-0  "> -->
                    <!-- <v-text-field v-model="filter.search" label="Search..." variant="outlined" density="compact"
                            max-width="400px" clearable />
                        <div class="pl-2"> -->
                    <!-- <v-btn base-color="#bdbdbd" style="height: 44px;" variant="outlined" @click="loadItems">
                                <v-icon icon="mdi-magnify"></v-icon>
                            </v-btn> -->
                    <!-- </div> -->
                    <!-- </div> -->
                    <!-- <div class="pl-lg-2 pt-lg-0 pt-md-0">
                        <v-btn to="/admin/auction/create" color="primary" style="height: 44px;" variant="flat"
                            @click="loadItems">
                            <v-icon icon="mdi-plus"></v-icon>
                        </v-btn>
                    </div> -->
                </div>
            </v-col>
            <v-col cols="12" class="mt-2">
                <div class="border">
                    <v-data-table-server :loading="loading" :headers="headers" :items="items" :items-length="total"
                        hover item-value="id" @update:options="loadItems" :lastPage="last_page"
                        style="height: 500px !important;">

                        <template #item.name="{ item }" style="width: 100px; ba">
                            <span>
                                {{ item.name }}
                            </span>
                        </template>

                        <template #item.auction_date="{ item }">
                            <span>
                                {{ formatDate(item.auction_date) }}
                            </span>
                        </template>

                        <template #item.auction_status.title="{ item }">
                            <v-chip :color="statusColor(item.auction_status?.title)" small dark>
                                {{ item.auction_status?.title }}
                            </v-chip>
                        </template>



                        <template #item.action="{ item }">
                            <router-link :to="'/admin/auction/edit/' + item.id">
                                <v-icon color="primary" class="editIconHover pa-4">mdi-pencil</v-icon>
                            </router-link>

                            <!-- <router-link :to="'/admin/auction/csv/'+item.id">
                                    <v-icon color="light">mdi-file</v-icon>
                                </router-link> -->
                            <v-icon @click="deleteItem(item.id)" color="danger" small
                                class="clickable-icon pa-4">mdi-delete</v-icon>
                        </template>

                        <template v-slot:bottom>
                            <div class="py-2 d-flex justify-end border-t">
                                <custom-pagination :loading="loading" v-model:page="filter.page" :lastPage="last_page"
                                    @page-changed="loadItems" />
                            </div>
                        </template>
                    </v-data-table-server>
                </div>
            </v-col>
        </v-row>
    </v-container>

</template>

<script>

import PlateformDropdown from '@/components/PlateformDropdown.vue';
import AuctionTypeDropdown from '@/components/AuctionTypeDropdown.vue';
import Auction from '@/models/auction.model';
import { useTaskManagementStore } from "@/stores/taskManagementStore";
import StatusDropdown from '@/components/StatusDropdown.vue';
import AuctionWeek from './auctionWeek.vue';
import General from '@/models/general.model';
export default {

    components: {
        PlateformDropdown,
        AuctionTypeDropdown,
        StatusDropdown,
        AuctionWeek
    },
    data() {
        return {
            status: [
                { value: '1', title: 'Draft' },
                { value: '2', title: 'Planned' },
                { value: '3', title: 'Confirm' },
                { value: '4', title: 'In Progress' },
                { value: '5', title: 'Done' },
                { value: '6', title: 'Cancel' },
                // { value: 'confirm', title: 'Confirm' },
                // { value: 'done', title: 'Done' },
            ],

            showFilters: true,
            Auction,
            auctionCounter: {
                isLoading: false,
                total_auctions: 0,
                live_auctions: 0,
                time_auctions: 0,
                in_progressAuctions: 0,
                vehicles_in_progress_auctions: 0,
                totalVehiclesInProgress: 0,
                remaining: 0,
                total_vehicles: 0,
                sold_vehicles: 0,
                unsold_vehicles: 0,
                vehicles_in_reauction: 0,
                remaining: 0,
            },
            filter: {
                table_id: "",
                name: "",
                auction_type: null,
                platform: null,
                status: null,
                auction_date: "",
                search: '',
                length: 50,
                page: 1,
                offset: 0,
            },
            last_page: 1,
            items: [],
            total: 0,
            loading: true,
            headers: [
                { title: "ID", value: "id", sortable: false },
                { title: "Auction Id", value: "table_id", sortable: false },
                { title: "Name", value: "name" },
                { title: "Type", value: "auction_type.title" },
                { title: "Au House", value: "platform.name" },
                { title: "Status", value: "auction_status.title" },
                { title: "Start Date", value: "auction_date" },
                { title: "End Date", value: "end_date" },
                { title: "Created At", value: "created_date" },
                { title: "Action", key: "action" },
            ],
        };
    },
    mounted() {
        this.loadItems()
        this.getCountData()
        this.$themeStore.menuType = 'collapsed';
    },
    computed: {

    },
    watch: {
        'filter.length'(newVal, oldVal) {
            this.filter.page = 1;
            this.loadItems()
        },
        'filter.page'(newVal, oldVal) {
            this.loadItems()
        },
        'filter.table_id'(newVal, oldVal) {
            this.loadItems()
        },
        'filter.name'(newVal, oldVal) {
            this.loadItems()
        }, 'filter.auction_type'(newVal, oldVal) {
            this.loadItems()
        },
        'filter.platform'(newVal, oldVal) {
            this.loadItems()
        },
        'filter.status'(newVal, oldVal) {
            this.loadItems()
        },
        'filter.auction_date'(newVal, oldVal) {
            this.loadItems()
        }
    },
    methods: {
        statusColor(auction_status) {
            switch (auction_status) {
                case 'Cancle':
                    return '#e51f1f';
                case 'Done':
                    return '#f2ce02';
                case 'Confirm':
                    return '#96761a';
                case 'Draft':
                    return '#ebff0a';
                case 'In Progress':
                    return '#85e62c';
                default:
                    return '#fff';
            }
        },
        formatDate(date) {
            if (!date) return ''
            return date.split('T')[0].split(' ')[0]
        },
        async loadItems() {

            this.loading = true;
            try {

                let res = await Auction.all(this.filter);
                this.items = res.data;
                // this.filter.page = Number(res.page)
                this.last_page = Number(res.last_page);

                this.total = res.recordsTotal;

            } catch (error) {
                alert(error);
            } finally {
                this.loading = false;
            }
        },

        async deleteItem(id) {

            if (!confirm("Are you sure you want to delete this item?")) return;
            this.loading = true;

            try {
                const res = await Auction.delete(id);
                this.$alertStore.add(res.message || "BodyType deleted", "success");
                this.loadItems();

            } catch (error) {
                console.error(error);
                this.$alertStore.add(error.message || "Delete failed", "error");
                this.loading = false;
            }
        },
        async getCountData() {
            this.auctionCounter.isLoading = true;
            try {
                let res = await General.get("/api/user/dashboard/counters");
                //   const counters = res.data.data;
                this.auctionCounter.total_auctions = res.data.total_auctions;
                this.auctionCounter.live_auctions = res.data.live_auctions;
                this.auctionCounter.time_auctions = res.data.time_auctions;
                this.auctionCounter.in_progressAuctions = res.data.in_progressAuctions;
                this.auctionCounter.vehicles_in_progress_auctions = res.data.vehicles_in_progress_auctions;
                this.auctionCounter.totalVehiclesInProgress = res.data.totalVehiclesInProgress;
                this.auctionCounter.total_vehicles = res.data.total_vehicles;
                this.auctionCounter.sold_vehicles = res.data.sold_vehicles;
                this.auctionCounter.unsold_vehicles = res.data.unsold_vehicles;
                this.auctionCounter.vehicles_in_reauction = res.data.vehicles_in_reauction;
            } catch (error) {
                this.auctionCounter.isLoading = false;
                console.error(error.message, "counters Api error");
            }
        },

    }



}

</script>

<style scoped></style>