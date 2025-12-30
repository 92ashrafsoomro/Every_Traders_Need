<template>
    <div class="bg-surface rounded border ">
          <v-data-table-server class="dataTable rounded " 
            :headers="headers" 
            :items="auctionStore.data"
            :items-length="auctionStore.total" 
            :loading="auctionStore.loading"
            item-value="id"   
            @update:options="auctionStore.getAuctionList">
                <template #item.vehicle="{ item }" >
                    <span class="ml-4 text-light_text_on text-body-2">
                    {{ item.make_name }} {{ item.model_name }} {{ item.variant_name }}
                </span></template>

                <template #item.date="{ item }">
                    {{ item.auction_date }} {{ item.auction_time }}
                </template>

                 <template #item.autoboli="{ item }">
                    
                </template>

                <template v-slot:bottom>
                     <div  class="py-2 d-flex justify-end border-t" >
                                   
                    <custom-pagination
                      :loading="auctionStore.loading"
                      v-model:page="auctionStore.filter.page" 
                      :lastPage="auctionStore.last_page"
                      @page-changed="auctionStore.getAuctionList"
                      />
                      </div>
                </template>
        </v-data-table-server>
    </div>

</template>

<script>

import { useAuctionStore } from "@/stores/auctionStore";


export default {
    components: {
    },
    data() {
        return {
            auctionStore: useAuctionStore(),
            headers: [
                {
                    title: "Vehicle",
                    key: "vehicle",
                    sortable: false
                },
                {
                    title: "Grade",
                    key: "grade"
                },
                {
                    title: "Cap Clean",
                    key: "cap_clean"
                },
                {
                    title: "Cap Average",
                    key: "cap_average"
                },
                {
                    title: "Cap Below",
                    key: "cap_below"
                },
                {
                    title: "Autotrader Retail",
                    key: "autotrader_retail_value"
                },
                {
                    title: "Date Time",
                    key: "date"
                },
                {
                    title: "Autoboli",
                    key: "autoboli"
                },
            ],
         
        }
    },
    methods: {
       
    },
    computed: {
      
    },
};

</script>

