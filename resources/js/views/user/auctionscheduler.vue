<template>
    <user-title-bar title="Auction Scheduler" subtitle="Manage and view platform auctions across all centers in one place.">
            <div
                class="d-flex flex-column flex-sm-row ga-2 w-100 w-md-75 w-lg-50 justify-center justify-sm-start align-start pr-5 pr-sm-0">
                
                <v-select label="Select Platform"
                    :items="this.makes" 
                    variant="outlined"
                    v-model="pageStore.auctionShedule.make"
                    item-value="id"
                    item-title="label"
                    color="primary" 
                    density="compact"
                    @update:model-value="handleMake"
                    class="w-100 w-sm-auto" clearable />

                 <v-select label="Select Model"
                    :items="this.models" 
                    variant="outlined"
                    v-model="pageStore.auctionShedule.model"
                    @update:model-value="handleInput"
                    item-value="id"
                    item-title="label"
                    color="primary" 
                    density="compact" 
                    class="w-100 w-sm-auto" clearable />

                 <v-switch 
                    v-model="pageStore.auctionShedule.enableCurrent" 
                    color="primary"
                    density="compact"  
                    hide-details
                    @change="handleInput" 
                    class="ml-3" /> 
            </div>

            <div class="pt-4 d-flex align-center ga-4 flex-wrap ml-auto mr-auto">

                <div v-for="(value, key, index) in pageStore.auctionShedule.months" :key="index" :class="{ 'active': pageStore.auctionShedule.month == key}"
                    class="border rounded bg-surface-variant-1 pa-3 ps-5 d-flex flex-column mb-3"
                    style=" height: 95px; width: 195px;" @click="handleTab(key)" >

                    <div class="text-caption d-flex align-center justify-center border-b border-border pb-2 pt-2 text-wrap"
                        style="white-space: wrap !important;">
                        {{ key.toUpperCase() }}
                    </div>

                    <div class="lowerSection d-flex justify-space-between mt-2">
                        <div class="d-flex align-center">
                            <small><v-icon color="primary" icon="mdi-hammer" size="small"></v-icon></small>
                            <span class="pl-1 text-caption ">{{ value.auction }}</span>
                        </div>
                        
                        <div class="d-flex align-center" >
                            <small class=" icon"><v-icon color="#00bad1" icon="mdi-car" size="small"></v-icon></small>
                            <span class="pl-1 text-caption ">{{ value.car }}</span>
                        </div>

                   
                    </div>
                </div>

            </div>

    </user-title-bar>

    <v-container fluid>
        <v-row>
            <v-col cols="12" >
                    <custom-card>
                        <v-data-table-server 
                        :headers="pageStore.auctionShedule.headers" 
                        :items="pageStore.auctionShedule.data" 
                        :items-length="pageStore.auctionShedule.total"
                        :loading="pageStore.auctionShedule.loading" 
                        item-value="id" 
                        @update:options="pageStore.getreAuctionList">

                            <template #item.action="{ item }">
                                <v-btn > <v-icon>mdi-eye</v-icon></v-btn>
                            </template>
                            <template v-slot:bottom>
                                <div class="py-2" >
                                    <custom-pagination
                                    :loading="pageStore.auctionShedule.loading"
                                    v-model:page="pageStore.auctionShedule.page" 
                                    :lastPage="pageStore.auctionShedule.last_page"
                                    @page-changed="pageStore.getreAuctionList"
                                    />
                                </div>
                            </template>

                        </v-data-table-server>
                </custom-card>        
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import masterService from '@/services/masterService';
import { usePageStore } from '@/stores/pageStore';




export default {
    props: {

    },
    components: {

    },
    data() {
        return {
            pageStore:usePageStore(),
            isToggleEnabled: false,
            makes: [],
            models:[],
        };
    },
    async mounted() {

        let response = await masterService.getMakes();
        this.makes = response.data;
        
    },
    methods: {
        async handleMake(id) {
            let response = await masterService.getModels({ makes: [id] });
            this.models = response.data;
        },
        async handleInput() {

            console.log('Record Fetch');
            
        },
        handleTab(key) {
            this.pageStore.auctionShedule.month = key;
        },
    },
};
</script>

<style scoped>

.icon{
    font-size: 10px; 
    color: #00bad1;
}

.active{
    border-color: rgb(var(--v-theme-primary))!important;
}


</style>
