<template>
    <user-title-bar style="padding-top: 0 !important; margin-top: 0 !important;">
        <div>
            <v-card-title class="d-flex cursor-pointer w-100" @click="showFilters = !showFilters">
            <div class="d-flex justify-space-between w-100">
            <h1 class="text-lg-h5 text-md-h3 text-h4 mb-2 font-weight-bold">Auction List</h1>
                <span class="text-h6">
                    Filters
                </span>
            </div>
                <v-icon color="primary">
                    {{ showFilters ? 'mdi-chevron-up' : 'mdi-chevron-down' }}
                </v-icon>
            </v-card-title>

            <v-expand-transition>
                <div v-show="showFilters">
                    <v-container fluid>
                        <div class="d-flex justify flex-wrap ga-2 ">
                            <v-text-field density="comfortable" variant="outlined" clearable v-model="filter.table_id"
                                label="Id" min-width="130px" max-width="130px" />

                            <PlateformDropdown min-width="350px" max-width="374px" v-model="filter.platform"
                                label="Auction House" clearable variant="outlined" base-color="white"
                                density="comfortable" />
                                
                            <AuctionTypeDropdown min-width="350px" max-width="374px" v-model="filter.auction_type"
                                label="Auction Type" variant="outlined" base-color="white" clearable
                                density="comfortable" />

                            <v-text-field density="comfortable" variant="outlined" min-width="350px" max-width="374px"
                                type="date" v-model="filter.auction_date" label="Auction Date" />
                            <div class="">
                                <v-btn style="height: 47px; ;" variant="outlined" @click="loadItems(true)" class="mr-2">
                                    <v-icon icon="mdi-magnify"></v-icon>
                                </v-btn>

                            </div>
                        </div>
          
                    </v-container>
     

                    <div class="content-scroll d-flex mt-6 w-100 ga-3">
                    <div 
                        v-for="item in items_status" 
                        :key="item.id"
                        class="status-card cursor-pointer"
                        @click="filter.status = item.id"
                        :class="{ 'status-selected': Number(filter.status) === item.id }"
                    >
                        <div class="d-flex justify-space-between">
                            <div class="d-flex align-center">
                                <small>{{ item.name }}</small>
                            </div>
                            <div class="d-flex align-center">
                                <svg width="15" height="15" viewBox="0 0 512 512" class="text-primary auction-svg" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="currentColor" d="M504.971 199.362l-22.627-22.627c-9.373-9.373-24.569-9.373-33.941 0l-5.657 5.657L329.608 69.255l5.657-5.657c9.373-9.373 9.373-24.569 0-33.941L312.638 7.029c-9.373-9.373-24.569-9.373-33.941 0L154.246 131.48c-9.373 9.373-9.373 24.569 0 33.941l22.627 22.627c9.373 9.373 24.569 9.373 33.941 0l5.657-5.657 39.598 39.598-81.04 81.04-5.657-5.657c-12.497-12.497-32.758-12.497-45.255 0L9.373 412.118c-12.497 12.497-12.497 32.758 0 45.255l45.255 45.255c12.497 12.497 32.758 12.497 45.255 0l114.745-114.745c12.497-12.497 12.497-32.758 0-45.255l-5.657-5.657 81.04-81.04 39.598 39.598-5.657 5.657c-9.373 9.373-9.373 24.569 0 33.941l22.627 22.627c9.373 9.373 24.569 9.373 33.941 0l124.451-124.451c9.372-9.372 9.372-24.568 0-33.941z"/>
                                </svg>
                                <span class="ml-1">{{ item.count ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                    </div>



                </div>

            </v-expand-transition>

        </div>
    </user-title-bar>

    <v-container max-width="1400px">
        <v-row no-gutters class="">
            <v-col cols="12">


            </v-col>
            <v-col cols="12" class="mt-2">
                <div class="border">
                    <v-data-table-server  :loading="loading" :headers="headers" :items="items" :items-length="total"
                        hover item-value="id" @update:options="loadItems" :lastPage="last_page"
                        style="height: 600px !important;">

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
                            <v-select
                                :items="status"
                                item-title="title"
                                item-value="id"
                                :model-value="item.auction_status?.id"
                                density="compact"
                                variant="outlined"
                                class="min-select"
                                @update:model-value="onStatusChange(item.id, $event)"
                            >
                                <template #selection="{ item: sel }">
                                <span
                                    :style="{ color: statusColor(sel.raw.title), fontWeight: '600' }"
                                >
                                    {{ sel.raw.title }}
                                </span>
                                </template>

                                <template #item="{ item: opt, props }">
                                <v-list-item
                                    v-bind="props"
                                    :style="{ color: statusColor(opt.raw.title) }"
                                />
                                </template>
                            </v-select>
                            </template>



                        <template #item.action="{ item }">
                            <router-link :to="'/admin/auction/vehicle/'+item.id" target="_blank">
                                <v-icon class="editIconHover pa-4" color="primary">mdi-eye</v-icon>
                            </router-link>

                            <router-link :to="'/admin/auction/edit/' + item.id">
                                <v-icon color="primary" class="editIconHover pa-4">mdi-pencil</v-icon>
                            </router-link>
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
            status: [],

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
            items_status:[],
            total: 0,
            loading: true,
            headers: [
                { title: "ID", value: "id", sortable: false },
                { title: "Auc Id", value: "table_id", sortable: false },
                { title: "Name", value: "name" },
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
        this.auctionStatus()
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
                case 'Cancel':
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
                    return '#ffffff';
            }
        },
        formatDate(date) {
        if (!date) return '-'

        const d = new Date(date)

        return d.toLocaleString("en-GB", {
            day: "2-digit",
            month: "2-digit",
            year: "numeric",
            hour: "2-digit",
            minute: "2-digit",
            hour12: false
        })
        },
        async loadItems() {

            this.loading = true;
            try {

                let res = await Auction.all(this.filter);
                this.items = res.data;
                this.items_status = res.status_counts;
                
                // this.filter.page = Number(res.page)
                this.last_page = Number(res.last_page);

                this.total = res.recordsTotal;

            } catch (error) {
                alert(error);
            } finally {
                this.loading = false;
            }
        },

        async auctionStatus(){
            try {
            const order = [1, 2, 3, 4, 5, 6]
            let statusData = await General.get("/api/cruds/auctionStatus");
            this.status = statusData.data.sort((a, b) => {
                return order.indexOf(a.id) - order.indexOf(b.id)
            })
            } catch (error) {
                alert(error);
            }
        },

        async deleteItem(id) {

            if (!confirm("Are you sure you want to delete this item?")) return;
            this.loading = true;

            try {
                const res = await Auction.delete(id);
                this.$alertStore.add(res.message || "Auction deleted", "success");
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

        async onStatusChange(auctionId, statusId) {
            try {

                const options = {
                    status_id: statusId
                };

                let res = await General.post(`/api/cruds/auctions/updatestatus/${auctionId}`, options);
                this.$alertStore.add(res.message || "Auction Status Update", "success");
                this.loadItems();

            } catch (error) {
                console.error(error)
                this.$alertStore.add(error.message || "Delete failed", "error");
            }
        },



    }



}

</script>

<style scoped>
:deep(th) {
  white-space: nowrap !important;
}

.min-select {
  min-width: 150px;
}

.status-card {
  border-radius: 6px;
  padding: 12px;
  width: 15.5%;
  background-color:rgb(15, 28, 43);
  transition: all 0.2s ease;
}

.status-card:hover {
  border-color: #0080FF;
}

.status-selected {
  border: 2px solid #0080FF;
 
}

</style>