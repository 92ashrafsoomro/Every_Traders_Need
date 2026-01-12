<template>
    <user-title-bar title="Import CSV Data"
        subtitle="Filter, compare, and uncover vehicles that match your profit goals.">

        <div>
            <v-card-title class="d-flex cursor-pointer " @click="showFilters = !showFilters">
                <span class="text-h6 font-weight-bold ">
                    Filters
                </span>

                <v-icon color="primary">
                    {{ showFilters ? 'mdi-chevron-up' : 'mdi-chevron-down' }}
                </v-icon>
            </v-card-title>

            <v-expand-transition>
                <div v-show="showFilters">
                    <v-container fluid>
                        <v-row>
                            <v-col class="mt-1 text-center content-scroll" align="center">
                                <v-text-field density="comfortable" variant="outlined" clearable
                                    v-model="filter.table_id" label="Auction Id" />
                            </v-col>
                            <v-col>
                                <PlateformDropdown v-model="filter.platform" label="Auction House" variant="outlined"
                                    base-color="white" density="compact" />
                                <!-- <v-text-field density="comfortable" variant="outlined" clearable v-model="filter.name"
                                    label="Auction Name " /> -->
                            </v-col>
                            <v-col>

                                <AuctionTypeDropdown v-model="filter.auction_type" label="Auction Type" variant="outlined"
                                    base-color="white" density="compact" />
                            </v-col>
                        </v-row>
                        <v-row class="mt-1 text-center content-scroll" align="center">


                            <v-col>
                                <v-select density="comfortable" variant="outlined" :items="['Draft', 'Planed']"
                                    hide-details clearable v-model="filter.status" label="Status " />
                            </v-col>
                            <v-col>
                                <div class="d-flex">
                                    <v-text-field density="comfortable" variant="outlined" type="datetime-local"
                                        v-model="filter.auction_date" label="Auction Date" />



                                    <v-btn style="height: 44px; margin-left: 10px;" variant="outlined"
                                        @click="loadItems(true)" class="mr-2">
                                        <v-icon icon="mdi-magnify"></v-icon>
                                    </v-btn>
                                </div>
                            </v-col>
                        </v-row>
                    </v-container>
                </div>
            </v-expand-transition>
        </div>
    </user-title-bar>

    <v-container max-width="1400px">
        <v-row no-gutters class="mt-3">
            <v-col cols="12">
                <div class="d-lg-flex d-md-flex py-4">
                    <div class="d-flex align-center pb-2 pb-lg-0 pb-md-0">
                        <v-select v-model="filter.length" :items="[10, 25, 50, 100]" density="compact"
                            variant="outlined" max-width="150px" class="mr-2" />
                        <div class="align-self-center pl-2">{{ filter.offset }} - {{ Math.min(filter.length, total) }}
                            of {{ total }} Records </div>
                    </div>

                    <div class="d-flex w-lg-75 justify-end pb-2 pb-lg-0 pb-md-0  ">
                        <v-text-field v-model="filter.search" label="Search..." variant="outlined" density="compact"
                            max-width="400px" clearable />
                        <div class="pl-2">
                            <v-btn base-color="#bdbdbd" style="height: 44px;" variant="outlined" @click="loadItems">
                                <v-icon icon="mdi-magnify"></v-icon>
                            </v-btn>
                        </div>
                    </div>
                    <div class="pl-lg-2 pt-2  pt-lg-0 pt-md-0">
                        <v-btn to="/admin/auction/create" color="primary" style="height: 44px;" variant="flat"
                            @click="loadItems">
                            <v-icon icon="mdi-plus"></v-icon>
                        </v-btn>
                    </div>
                </div>
            </v-col>
            <v-col cols="12" class="mt-2">
                <div class="border">
                    <v-data-table-server :loading="loading" :headers="headers" :items="items" :items-length="total"
                        hover item-value="id" @update:options="loadItems" :lastPage="last_page">

                        <template #item.action="{ item }">
                            <router-link :to="'/admin/auction/edit/' + item.id">
                                <v-icon color="primary" class="editIconHover pa-4">mdi-pencil</v-icon>
                            </router-link>
                            <span class="px-2"></span>

                            <!-- <router-link :to="'/admin/auction/csv/'+item.id">
                                    <v-icon color="light">mdi-file</v-icon>
                                </router-link> -->
                            <span class="px-2"></span>
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

export default {

    components: {
        PlateformDropdown,
        AuctionTypeDropdown
    },
    data() {
        return {
            showFilters: true,
            Auction,
            filter: {
                table_id: "",
                name: "",
                action_type: "",
                platform: "",
                status: "Draft",
                auction_date: "",
                search: '',
                length: 10,
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
                { title: "Type", value: "action_type.title" },
                { title: "Au House", value: "platform.name" },
                { title: "Status", value: "status" },
                { title: "Start Date", value: "auction_date" },
                { title: "End Date", value: "end_date" },
                { title: "Created At", value: "created_date" },
                { title: "Action", key: "action" },
            ],
        };
    },
    mounted() {
        this.loadItems()
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
    },
    methods: {

        async loadItems() {

            this.loading = true;
            try {

                let res = await Auction.all(this.filter);
                this.items = res.data;
                this.filter.page = Number(res.page)
                
                this.total = res.recordsTotal;
                this.last_page = Number(res.last_page);
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
        }
    }



}

</script>

<style scoped></style>