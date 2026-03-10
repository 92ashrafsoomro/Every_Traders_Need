<template>
    <user-title-bar title="Vehicle">
        <div>
            <v-card-title class="d-flex cursor-pointer widthstatic" @click="showFilters = !showFilters">
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
                            <v-col cols="12">
                                <v-row cols="12" class="mt-1 text-center">
                                    <v-col cols="4" sm="4" class="pl-2">
                                        <PlateformDropdown label="Select Platform" variant="outlined" color="primary"
                                            class="id-box" v-model="filter.platform" hide-details clearable
                                            density="comfortable" />
                                    </v-col>
                                    <v-col cols="4" sm="4" class="pl-2">
                                        <CenterDropdown label="Select Center" variant="outlined" color="primary"
                                            class="id-box" v-model="filter.center" hide-details clearable
                                            density="comfortable" />
                                    </v-col>
                                    <v-col cols="4" sm="4" class="pl-2">
                                        <AuctionTypeDropdown v-model="filter.vehicleType" label="Select Auction Type"
                                            variant="outlined" color="primary" class="id-box" hide-details clearable
                                            density="comfortable" />
                                    </v-col>


                                </v-row>
                                <v-row cols="12" class="mt-1 text-center">
                                    <v-col cols="4" sm="4" class="pl-2">
                                        <MakeDropdown label="Select Make" variant="outlined" color="primary"
                                            class="id-box" v-model="filter.make" item-title="name" item-value="id"
                                            hide-details density="compact" clearable />
                                    </v-col>

                                    <v-col cols="4" sm="4" class="pl-2">
                                        <ModelDropdown label="Select Model" variant="outlined" item-title="name"
                                            item-value="id" color="primary" class="id-box" v-model="filter.model"
                                            :make="filter.make" hide-details density="comfortable" clearable />
                                    </v-col>

                                    <v-col cols="4" sm="4" class="pl-2">
                                        <VariantDropdown label="Select Variant" variant="outlined" color="primary"
                                            class="id-box" v-model="filter.variant" :model-id="filter.model"
                                            hide-details density="comfortable" clearable />
                                    </v-col>
                                </v-row>

                                <v-row cols="12" class="mt-1 text-center">
                                    <v-col cols="12" sm="4" class="pl-2">
                                        <v-text-field v-model="filter.registration" label="Search Registration"
                                            variant="outlined" color="primary" density="comfortable" hide-details
                                            clearable />
                                    </v-col>
                                    <v-col cols="12" sm="4" class="pl-2">
                                        <v-text-field v-model="filter.tableid" label="Search Auction ID"
                                            variant="outlined" type="number" color="primary" density="comfortable"
                                            hide-details clearable />
                                    </v-col>
                                    <v-col cols="12" sm="2" class="pl-2 d-flex align-center">
                                        <v-btn color="primary" block class="mt-sm-0 mt-2" @click="loadItems">
                                            Search
                                        </v-btn>
                                    </v-col>
                                </v-row>


                            </v-col>

                        </v-row>
                    </v-container>
                </div>
            </v-expand-transition>
        </div>
    </user-title-bar>

    <v-container max-width="1500px">
        <v-row no-gutters class="mt-3">
            <v-col cols="12" v-if="!Auction.auction_date">
                <div class="d-flex flex-wrap ">
                    <div class="d-flex align-center">
                        <v-select v-model="filter.length" :items="[10, 100, 500, 1000]" density="compact"
                            variant="outlined" max-width="150px" class="mr-2" />
                        <div class="align-self-center pl-2">{{ filter.offset }} - {{ Math.min(filter.length, total) }}
                            of {{ total }} Records</div>
                    </div>

                    <v-spacer />
                </div>
            </v-col>

            <v-col cols="12" class="mt-2">
                <div class="border">
                    <vehicle-list :items="items" :total="total" :loading="loading" :headers="headers" :filter="filter"
                        :last_page="last_page" :auction-status="Auction.status" :auction-id="id"
                        @page-changed="loadItems" />
                </div>
            </v-col>
        </v-row>
    </v-container>

</template>

<script>
import Auction from "@/models/auction.model";
import Vehicle from '@/models/vehicle.model';
import CenterDropdown from "@components/CenterDropdown.vue"
import PlateformDropdown from "@components/PlateformDropdown.vue"
import MakeDropdown from "@components/MakeDropdown.vue"
import ModelDropdown from "@components/ModelDropdown.vue"
import VariantDropdown from "@components/VariantDropDown.vue"
import AuctionTypeDropdown from '@components/AuctionTypeDropdown.vue'

import vehicleList from "@/components/vehicleList.vue";
export default {

    components: {
        MakeDropdown,
        CenterDropdown,
        PlateformDropdown,
        ModelDropdown,
        VariantDropdown,
        AuctionTypeDropdown,
        vehicleList
    },

    data() {
        return {
            expanded: [],
            Auction: [],
            showFilters: false,
            filter: {
                search: '',
                length: 10,
                page: 1,
                offset: 0,
            },

            last_page: 1,
            items: [],
            link: null,
            total: 0,
            loading: true,
            headers: [
                { title: "Reg", value: "reg" },
                { title: "Title", value: "title" },
                // { title: "Center", value: "center_id" },
                { title: "Color", value: "color" },
                { title: "Year", value: "year" },
                { title: "Mileage", value: "mileage" },
                // { title: "Body", value: "body_id" },
                { title: "Fuel Type", value: "fuel_type" },
                { title: "Transmission", value: "transmission" },
                // { title: "CC", value: "cc" },
                { title: "Non Runner", value: "engine_runs" },
                { title: "Grade", value: "grade" },
                { title: "Date Time", value: "created_at" },
            ],
            id: this.$route.params.id,

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
        'filter.make'(val) {
            this.filter.model = null
            this.filter.variant = null
        },
        'filter.model'(val) {
            this.filter.variant = null
        }


    },

    methods: {
        dateFormate(date) {
            if (!date) return ""
            return date?.split('T')[0].split(' ')[0]
        },
        async loadItems() {
            this.loading = true;
            try {
                let res = [];
                res = await Vehicle.all(this.filter);
                this.items = res.data;
                this.items = res.data.map(i => ({
                    ...i,
                    created_at: this.dateFormate(i.created_at)
                }));
                this.total = res.recordsTotal;
                this.filter.page = Number(res.page);
                this.last_page = Number(res.last_page);
                this.loading = false

            } catch (error) {
                alert(error)
                this.loading = false
            }
        },
    }

};

</script>
