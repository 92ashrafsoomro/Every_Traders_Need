<template>

    <div v-for="(item, index)  in masterStore.formerKeepers.data" :key="item.id" class="d-flex align-center justify-space-between" >
           <v-checkbox 
            v-if="showAll || index <= 10"
             v-model="auctionStore.filter.formerKeeper" 
             :label="item.label" 
             :value="item.id"
             @change="handleChange"
             />
            <div  v-if="showAll || index <= 10" class=" d-flex ml-2 align-center px-2 rounded-lg text-body-1 text-whiteLite ml-2 mb-2" style="border: 1px solid rgba(var(--v-theme-primary),0.3);">
                <p>
                    {{ item.count }}
                </p>
            </div>
    </div>

    <div class="py-4">
          <p style="text-decoration: underline ; cursor: pointer;" @click="showAll = !showAll" v-if="masterStore.formerKeepers.data.length > 10">
             {{ showAll ? 'Show Less' : 'Show More' }}
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
            this.auctionStore.getAuctionList();        
        },
     
    },
    computed: {
      
    },
};

</script>