<template>
   <div v-for="(item, index)  in masterStore.makes.data" :key="item.id" class="d-flex align-center justify-space-between" >
           <v-checkbox 
            v-if="showAll || index <= 7"
             v-model="auctionStore.filter.make" 
             :label="item.label" 
             :value="item.id"
             @change="handleChange"
             />
           <div v-if="showAll || index <= 7" class=" d-flex ml-2 align-center px-2 rounded-lg text-body-1 text-whiteLite ml-2 mb-2" style="border: 1px solid rgba(var(--v-theme-primary),0.3);">
                <p>
                    {{ item.count }}
                </p>
            </div>
    </div>

        <div class="py-4">
          <p style="text-decoration: underline ; cursor: pointer;" @click="showAll = !showAll" v-if="masterStore.makes.data.length > 7">
            {{ showAll ? "Show Less" : "Show All" }}
            </p>

        </div>
</template>

<script>

import { useAuctionStore } from "@/stores/auctionStore";
import { useMasterStore } from "@/stores/masterStore";

export default {
    components: {
    },
    data() {
        return {
            auctionStore: useAuctionStore(),
            masterStore:useMasterStore(),
            showAll : false
        }
    },
    methods: {
        handleChange(e) {
            
            this.auctionStore.filter.model = [];
            this.auctionStore.filter.variant = [];
            this.masterStore.variants.data = [];
            this.masterStore.getModels({
                make:this.auctionStore.filter.make,
            });
            
            this.auctionStore.getAuctionList();

        },
    },
    computed: {
      
    },
};

</script>