<template>
    <user-title-bar title="Auction Scheduler" subtitle="Manage and view platform auctions across all centers in one place.">
            <div
                class="d-flex flex-column flex-sm-row ga-2 w-100 w-md-75 w-lg-50 justify-center justify-sm-start align-start pr-5 pr-sm-0">
                <v-combobox label="Select Platform"
                    :items="['California', 'Colorado', 'Florida', 'Georgia', 'Texas', 'Wyoming']" variant="outlined"
                    color="primary" density="compact" class="w-100 w-sm-auto"></v-combobox>
                <v-combobox label="Select Center"
                    :items="['California', 'Colorado', 'Florida', 'Georgia', 'Texas', 'Wyoming']" variant="outlined"
                    color="primary" density="compact" class="w-100 w-sm-auto"></v-combobox>
                <v-switch v-model="pageStore.auctionShedule.enableCurrent" color="primary" density="compact" size="small" hide-details
                    @change="handleToggleChange" class="ml-3" />
            </div>

            <div class=" pt-4 d-flex align-center ga-4 flex-wrap ml-auto mr-auto">
                <div v-for="(value, key, index) in pageStore.auctionShedule.months" :key="index"
                    class="scheduleDiv border border-border rounded-md bg-surface-variant-1 pa-3 ps-5 d-flex flex-column mb-3"
                    style=" height: 95px; width: 195px;">
                    <div class="text-caption d-flex align-center justify-center border-b border-border pb-2 pt-2 text-wrap"
                        style="white-space: wrap !important;">
                        {{ key.toUpperCase() }}
                    </div>
                    <div class="lowerSection d-flex justify-space-between mt-2">
                        <div class="d-flex align-center text-primary">
                            <small><v-icon icon="mdi-hammer" size="small"></v-icon></small>
                            <span class="text-caption text-[#cccccc]">{{ value.auction }}</span>
                        </div>
                        <div class="d-flex align-center" style=" font-size: 10px; color: #00bad1;">
                            <small><v-icon icon="mdi-car" size="small"></v-icon></small>
                            <span class="text-caption text-[#cccccc]">{{ value.car }}</span>
                        </div>

                        <!-- <div class="d-flex align-center text-danger" style="font-size: 10px;">
                            <small><v-icon icon="mdi-charity" size="small"></v-icon></small>
                            <span class="text-caption text-[#cccccc]">{{ item.favorites }}</span>
                        </div> -->
                    </div>
                </div>
            </div>

    </user-title-bar>

    <v-container fluid>
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
                            <v-btn :to="'/user/vehicle-detail/'+item.id"> <v-icon>mdi-eye</v-icon></v-btn>
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
    </v-container>
</template>

<script>
import { usePageStore } from '@/stores/pageStore';



export default {
    props: {},
    components: {
    },
    data() {
        return {
            pageStore:usePageStore(),
            isToggleEnabled: false,
        };
    },
    methods: {
        handleToggleChange() {
           
        },
    },
};
</script>

<style scoped></style>
