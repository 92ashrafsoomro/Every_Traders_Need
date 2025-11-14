<template>
    <div v-for="item in auctionStore.makes" :key="item.id">
           <v-checkbox 
             v-model="auctionStore.filter.make" 
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
            
            this.auctionStore.filter.model = [];
            this.auctionStore.filter.variant = [];
            this.auctionStore.variants = [];
            this.auctionStore.getModels();
            this.auctionStore.getAuctionList();

        }
    },
    computed: {
      
    },
};

</script>