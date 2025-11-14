<template>
    <div v-for="item in auctionStore.variants" :key="item.id">
           <v-checkbox 
             v-model="auctionStore.filter.variant" 
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
        }
    },
    computed: {
      
    },
};

</script>