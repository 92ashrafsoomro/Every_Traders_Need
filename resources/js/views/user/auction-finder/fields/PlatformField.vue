<template>
    <div v-for="item in auctionStore.platforms" :key="item.id">
           <v-checkbox 
             v-model="auctionStore.filter.platform" 
             :label="item.label" 
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
       
    },
    computed: {
      
    },
};

</script>