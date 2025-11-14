<template>
    <div class="bg-surface rounded border pa-4">
        <v-table>
            <thead>
                <tr>
                    <th class="text-left">Vehicle</th>
                    <th class="text-left">Year / CC</th>
                    <th class="text-left">Mileage</th>
                    <th class="text-left">Transmission</th>
                    <th class="text-left">Grade</th>
                    <th class="text-left">Date Time</th>
                    <th class="text-left">Auction House</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="auctionStore.loading">
                    <td colspan="7" class="text-center" >Loading..</td>
                </tr>
                <tr v-else="auctionStore.data" v-for="item in auctionStore.data" :key="item.id">
                    <td>{{ item.make_name }} {{ item.model_name }} {{ item.variant_name }}</td>
                    <td>{{ item.year }} / {{ item.cc }}</td>
                    <td>{{ item.mileage }}</td>
                    <td>{{ item.transmission }}</td>
                    <td>{{ item.grade }}</td>
                    <td>{{ item.auction_date }} {{ item.auction_time }}</td>
                    <td>{{ item.auction_name }}</td>
                </tr>
            </tbody>
        </v-table>
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
