<template>
    <div class="bg-surface rounded border pa-4">
        <v-table>
            <thead>
                <tr>
                    <th class="text-left">Vehicle</th>
                    <th class="text-left">Grade</th>
                    <th class="text-left">Cap Clean</th>
                    <th class="text-left">Cap Average</th>
                    <th class="text-left">Cap Below</th>
                    <th class="text-left">Autotrader Retail</th>
                    <th class="text-left">Date Time</th>
                    <th class="text-left">Autoboli</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="auctionStore.loading">
                    <td colspan="8" class="text-center" >Loading..</td>
                </tr>
                <tr v-if="auctionStore.data" v-for="item in auctionStore.data" :key="item.id">
                    <td>{{ item.make_name }} {{ item.model_name }} {{ item.variant_name }} </td>
                    <td>{{ item.grade}}</td>
                    <td>{{ item.cap_clean }}</td>
                    <td>{{ item.cap_average }}</td>
                    <td>{{ item.cap_below }}</td>
                    <td>{{ item.autotrader_retail_value }}</td>
                    <td>{{ item.auction_date }} {{ item.auction_time }}</td>
                    <td>0</td>
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

