<template>

    <v-col cols="12" >

           <v-row class="pt-3" >
                <v-col cols="12" >
                    <div class="d-flex justify-md-space-between flex-wrap ">            
                        <div class="d-flex flex-wrap">
                                <div class="px-2" >
                                    <v-select 
                                        label="Length"
                                        v-model="filter.length"
                                        :items="[10,20,30]" 
                                        @update:model-value="handleInput"
                                        variant="outlined"
                                        color="primary" 
                                        width="120" 
                                        density="compact" 
                                        />
                                </div>
                                <div class="px-2" >
                                    <v-select 
                                        label="All Years"
                                        v-model="filter.year"
                                        :items="masterStore.years.data" 
                                        @update:model-value="handleInput"
                                        item-title="label"
                                        item-value="id" 
                                        variant="outlined"
                                        color="primary" 
                                        width="150" 
                                        density="compact" 
                                        clearable />
                                </div>
                        </div>
                        <div class="d-flex flex-wrap">

                            <div class="px-2" >
                                <v-text-field 
                                    prepend-inner-icon="mdi-magnify"
                                    label="Reg No" 
                                    v-model="filter.reg"
                                    @update:model-value="handleInput"
                                    variant="outlined"
                                    color="primary" 
                                    width="200" 
                                    density="compact" 
                                    clearable />
                            </div>

                            <div class="px-2" >
                                <v-select 
                                    label="Select Make" 
                                    v-model="filter.make"
                                    @update:model-value="handleMake"
                                    :items="masterStore.makes.data"
                                    item-title="label"
                                    item-value="id" 
                                    variant="outlined"
                                    color="primary" 
                                    width="200" 
                                    density="compact" 
                                    clearable />
                            </div>
                            
                            <div class="px-2" >
                                <v-select 
                                    label="Select Model"
                                    v-model="filter.model"
                                    @update:model-value="handleInput"
                                    :items="masterStore.models.data" 
                                    item-title="label"
                                    item-value="id" 
                                    variant="outlined"
                                    color="primary" 
                                    width="240" 
                                    density="compact" 
                                    clearable />
                            </div>
                        
                        </div>
                    </div>
                </v-col>

                <v-col cols="12" class="" >
                    <div class="bg-surface rounded border pa-4">
                        <v-data-table-server class="" 
                            :headers="headers" 
                            :items="items"
                            :items-length="totalItems" 
                            :loading="loading" 
                            item-value="id" 
                            @update:options="loadItems">
                        
                            <template #item.view="{ item }">
                                <v-btn :to="'/user/vehicle-detail/'+item.id"> <v-icon>mdi-eye</v-icon></v-btn>
                            </template>

                            <template #item.autoboli="{ item }">
                                -
                            </template>

                            <template v-slot:bottom>
                                <div class="pt-2" >
                                    <custom-pagination
                                    :loading="loading"
                                    v-model:page="filter.page" 
                                    :lastPage="last_page"
                                    @page-changed="loadItems"
                                    />
                                </div>
                            </template>
                        </v-data-table-server>
                    </div>
                </v-col>
            </v-row>
           

    </v-col>
 
  
</template>

<script>

import { useMasterStore } from "@/stores/masterStore";
import { useVehicleStore } from "@/stores/vehicleStore";

export default {
    name: "Watchlist",
    components: {
     
    },
    data() {
        return {
            filter: {
                make: null,
                model: null,
                reg: '',
                year: null,
                length: 10,
                page: 1,
                offset:0,
            },
            last_page:1,
            vehicleStore: useVehicleStore(),
            masterStore: useMasterStore(),
            items: [],
            totalItems: 0,
            loading: false,
            headers: [
                { title: "", key:'view',sortable:false },
                { title: "VEHICLE", value: "vehicle" },
                { title: "REG", value: "reg" },
                { title: "CLEAN", value: "cap_clean" },
                { title: "AVERAGE", value: "cap_average" },
                { title: "BELOW", value: "cap_below" },
                { title: "AUTOTRADER", value: "autotrader_retail_value" },
                { title: "AUCTION", value: "platform_title" },
                { title: "LAST BID", value: "last_bid" },
                { title: "AUTOBOLI",key: "autoboli",sortable:false },
            ],
        }
    },
    mounted() {

        this.masterStore.getYears();
        this.masterStore.getMakes();

        this.loadItems();
    },
    methods: {
        async loadItems(){

            this.loading = true;
            try {

                const res = await this.vehicleStore.getWatchList(this.filter);
                this.items = res.data || [];
                this.totalItems = res.recordsTotal;
                this.filter.offset = res.offset;
                this.filter.page = res.page;
                this.last_page = res.last_page;

            } catch (error) {
                console.error("Error fetching userWatchList:", error);
                this.totalItems = 0;
                this.items = [];
            } finally {
                this.loading = false;
            }

        },

        handleMake(e) {
            if (e) {
                 this.masterStore.getModels({ make: e });
            } else {
                this.filter.model = null;
                this.masterStore.models.data = [];
            }

            this.loadItems();
        },
        handleInput(e) {

            this.loadItems();
        },

    },
};
</script>

<style></style>
