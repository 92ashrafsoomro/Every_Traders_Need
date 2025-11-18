<template>
    <div>
        <div class="" >
            <div class=""  >
                <v-select
                    v-model="auctionStore.filter.mileageFrom"
                     :menu-props="{
                        location: 'bottom',
                        offset: 4,
                        activator: 'parent',
                        closeOnContentClick: false,
                        autoPosition: true,
                        absolute: true
                    }"
                    item-title="label"
                    item-value="id"
                    :items="mileageFrom"
                     />
            </div>
            <div class="w-100">
                 <v-select
                 
                    v-model="auctionStore.filter.mileageTo"
                   :menu-props="{ attach: 'body', eager: true }"
                    item-title="label"
                    item-value="id"
                    :items="mileageTo"
                     />
            </div>
        </div>
    </div>
</template>

<script>

import { useAuctionStore } from "@/stores/auctionStore";
import { useMasterStore } from "@/stores/masterStore";

export default {
   
    data() {
        
        return {
            auctionStore: useAuctionStore(),
            masterStore: useMasterStore(),
            mileageFrom: [
                { label: '10,000', id: 10000 },
                { label: '20,000', id: 20000 },
                { label: '30,000', id: 30000 },
                { label: '40,000', id: 40000 },
                { label: '50,000', id: 50000 },
            ],
            mileageTo: [
                { label: '10,000', id: 10000 },
                { label: '20,000', id: 20000 },
                { label: '30,000', id: 30000 },
                { label: '40,000', id: 40000 },
                { label: '50,000', id: 50000 },
            ]
        }
    },
    methods: {
         handleChange(e) {
            this.auctionStore.getAuctionList();
        }
    },
   
};

</script>