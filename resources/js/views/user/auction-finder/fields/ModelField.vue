<template>
    <div v-for="item in auctionStore.models" :key="item.id">
           <v-checkbox 
             v-model="auctionStore.filter.model" 
             :label="item.label"
             @change="handleChange" 
             :value="item.id" />
    </div>
</template>

<script>

import { useAuctionStore } from "@/stores/auctionStore";

export default {
    components: {
    },
    data() {
        return {
            auctionStore:useAuctionStore(),
        }
    },
    methods: {
        handleChange(e) {

            this.auctionStore.getAuctionList();
            this.auctionStore.getVariants();
             
        }
    },
    computed: {
      
    },
};

</script>