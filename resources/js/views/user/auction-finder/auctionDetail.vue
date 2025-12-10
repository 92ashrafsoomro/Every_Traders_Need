<template>
    <div class="bg-surface rounded border pa-4">
        <v-data-table-server class="dataTable rounded" :headers="headers" :items="auctionStore.data"
            :items-length="auctionStore.total" :loading="auctionStore.loading" item-value="id"
            @update:options="auctionStore.getAuctionList">
            <template #item.make_name="{ item }">
                <v-btn variant="plain" :to="'/user/vehicle-detail/' + item.id">{{ item.make_name }} {{ item.model_name
                }}
                    {{ item.variant_name }}</v-btn>

            </template>
            <template #item.date="{ item }">
                {{ item.auction_date }} {{ item.auction_time }}
            </template>
            <template v-slot:bottom>
                <custom-pagination :loading="auctionStore.loading" v-model:page="auctionStore.filter.page"
                    :lastPage="auctionStore.last_page" @page-changed="auctionStore.getAuctionList" />
            </template>


            <!-- expentTable Code -->

            <template #item.action="{ item, internalItem, isExpanded, toggleExpand }">
                <v-btn icon color="primary" variant="text" @click="toggleExpand(internalItem)">
                    <v-icon>
                        {{ isExpanded(internalItem) ? 'mdi-chevron-up' : 'mdi-information-outline' }}
                    </v-icon>
                </v-btn>
            </template>

        <template #expanded-row="{ columns, item }">
  <tr>
    <td colspan="1">
      <img :src="item.image1" alt="" style="max-width:80px;">
      <img :src="item.image2" alt="" style="max-width:80px;">
      <img :src="item.image3" alt="" style="max-width:80px;">
    </td>
    <td colspan="5">
      <v-checkbox :label="item.color || 'Color'"></v-checkbox>
    </td>
    <td colspan="2">
      <v-btn variant="flat" color="primary" ><a :href="item.inspection_report" target="_blank" class="text-capitalize text-white" style="text-decoration: none;">View Report</a></v-btn>
    </td>
  </tr>
</template>



            <!-- Expend table code end -->

        </v-data-table-server>
    </div>

</template>

<script>

import { useAuctionStore } from "@/stores/auctionStore";
// import carImage from ""
export default {
    components: {
    },
    data() {
        return {
            auctionStore: useAuctionStore(),
            headers: [
                {
                    title: "Vehicle",
                    key: "make_name",
                    sortable: false
                },
                {
                    title: "Year / CC",
                    key: "cc"
                },
                {
                    title: "Mileage",
                    key: "mileage"
                },
                {
                    title: "Transmission",
                    key: "transmission"
                },
                {
                    title: "Grade",
                    key: "grade"
                },
                {
                    title: "Date Time",
                    key: "date"
                },
                {
                    title: "Auction House",
                    key: "auction_name"
                },
                {
                    title: "More Info",
                    key: "action",
                    sortable: false
                }
            ],

        }
    },
    computed: {

        methods: {

        },

    },
};

</script>


<style scoped></style>
