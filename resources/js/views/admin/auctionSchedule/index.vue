<template>
    <user-title-bar title="Auction Schedular List"
   >
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
                        <div class="d-flex flex-wrap ga-2 " >
                                <v-text-field 
                                 density="comfortable" 
                                 variant="outlined" 
                                 clearable
                                 v-model="filter.table_id" 
                                 label="Id" 
                                 min-width="130px"
                                 max-width="130px" />

                                <PlateformDropdown min-width="250px" max-width="274px" v-model="filter.platform"  label="Auction House" clearable variant="outlined"
                                    base-color="white" density="comfortable" />

                                <!-- <v-text-field density="comfortable" variant="outlined" clearable v-model="filter.name"
                                    label="Auction Name " /> -->
                                <AuctionTypeDropdown min-width="190px" max-width="274px" v-model="filter.auction_type"  label="Auction Type"
                                    variant="outlined" base-color="white" clearable density="comfortable" 
                                    />
                            
                                    <!-- item-title="title"
                                    item-value="id" -->
                                
                                <!-- <StatusDropdown label="Status "
                                    variant="outlined"   density="comfortable"
                                    min-width="190px" max-width="274px" /> -->
                               
                                    <StatusDropdown
                                    v-model="filter.status"
                                    label="Status "
                                    item-title="title"
                                    item-value="id"
                                    clearable
                                    variant="outlined"
                                    density="comfortable"
                                    min-width="190px" max-width="274px" 
                                    />
                                    <!-- item-title="name"
                                    item-value="id" -->

                                <!-- <v-select min-width="190px" max-width="274px" density="comfortable" variant="outlined" :items="['Draft', 'Planed']"
                                     clearable v-model="filter.status" label="Status " /> -->
                                    
                                    <v-text-field density="comfortable" variant="outlined" min-width="340px" max-width="274px" type="date"
                                        v-model="filter.auction_date" label="Auction Date" />
                            <div class="">
                                    <v-btn style="height: 47px; ;" variant="outlined"
                                        @click="loadItems(true)" class="mr-2">
                                        <v-icon icon="mdi-magnify"></v-icon>
                                    </v-btn>
                                
                            </div>
                        </div>
                    </v-container>
                </div>
            </v-expand-transition>
        </div>
    </user-title-bar>

    <v-container max-width="1400px">
        <v-row no-gutters class="mt-3">
            <v-col cols="12">
                <div class="d-flex justify-space-between d-md-flex py-4">
                    <!-- <div class="d-flex align-center pb-2 pb-lg-0 pb-md-0">
                        <v-select v-model="filter.length" :items="[10, 25, 50, 100]" density="compact"
                            variant="outlined" max-width="150px" class="mr-2" />
                        <div class="align-self-center pl-2">{{ filter.offset }} - {{ Math.min(filter.length, total) }}
                            of {{ total }} Records </div>
                    </div> -->

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
                        hover item-value="id" @update:options="loadItems" :lastPage="last_page" style="height: 500px !important;">
                        
                        <template #item.name="{ item }" style="width: 100px; ba">
                            <span >
                                {{ item.name }}
                            </span>
                        </template>

                        <template #item.auction_date="{ item }">
                            <span >
                                {{ formatDate(item.auction_date) }}
                            </span>
                        </template>

                        <template #item.auction_status.title="{item}" >
                            <v-chip
                                :color="statusColor(item.auction_status.title)"
                                small
                                dark
                            >
                                {{ item.auction_status.title }}
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
import AuctionSchedule from '@/models/auctionSchedule.model';
import StatusDropdown from '@/components/StatusDropdown.vue';
export default {

    components: {
        PlateformDropdown,
        AuctionTypeDropdown,
        StatusDropdown
    },
    data() {
        return {
            showFilters: true,
            // Auction,
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
                { title: "Auction Schedular Type", value: "auctionSchedular_type.title" },
                { title: "Auction Schedular platform", value: "auctionSchedularPlatform.name" },
                { title: "Auction Schedular Name", value: "auctionSchedularName" },
                { title: "Created At", value: "created_date" },
                {title : "Auction Time", value : "auction_time"},
                {title : "Pak Time", value : "pak_time"},
                {title : "Lots", value : "lots"},
                {title : "Src Lots", value : "src_lots"},
                { title: "Status", value: "auction_schedule.title" },
                // { title: "Start Date", value: "auction_date" },
                // { title: "End Date", value: "end_date" },
                // { title: "Action", key: "action" },
            ],
        };
    },
    mounted() {
        this.loadItems()
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
        'filter.table_id'(newVal , oldVal){
            this.loadItems()
        },
        'filter.name'(newVal , oldVal){
            this.loadItems()
        },'filter.auction_type'(newVal , oldVal){
            this.loadItems()
        },
        'filter.platform'(newVal , oldVal){
            this.loadItems()
        },
        'filter.status'(newVal , oldVal){
            this.loadItems()
        },
        'filter.auction_date'(newVal , oldVal){
            this.loadItems()
        }
    },
    methods: {
     statusColor(auction_status){
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

                let res = await AuctionSchedule.all(this.filter);
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
                const res = await AuctionSchedule.delete(id);
                this.$alertStore.add(res.message || "BodyType deleted", "success");
                this.loadItems();

            } catch (error) {
                console.error(error);
                this.$alertStore.add(error.message || "Delete failed", "error");
                this.loading = false;
            }
        }
    }



}

</script>

<style scoped></style>