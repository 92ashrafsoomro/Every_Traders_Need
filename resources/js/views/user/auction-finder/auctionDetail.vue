    <template>
        <div class="bg-surface rounded border ">
            <v-data-table-server :headers="headers" :items="auctionStore.data" :items-length="auctionStore.total"
                :loading="auctionStore.loading" item-value="id" hover>


                <template v-slot:bottom>
                      <div class="py-2 d-flex justify-end border-t ma-2">
                    <custom-pagination :loading="auctionStore.loading" v-model:page="auctionStore.filter.page"
                        :lastPage="auctionStore.last_page" @page-changed="auctionStore.getAuctionList" />
               </div> </template>


                <!-- expentTable Code -->


                <template #item="{ item, columns }">

                    <!-- MAIN ROW -->
                    <tr @mouseenter="hoveredRowId = item.id">
                        <td > <v-btn variant="plain" :to="'/user/vehicle-detail/' + item.id">{{ item.make_name }} {{
                            item.model_name
                                }}
                                {{ item.variant_name }}</v-btn></td>
                        <td><span>{{ item.year }}</span> - <span>{{ item.cc }}</span></td>
                        <td>{{ item.mileage }}</td>
                        <td>{{ item.transmission }}</td>
                        <td>
                            <span :style="{
                                backgroundColor:
                                    item.grade == 5 ? '#e51f1f' :
                                        item.grade == 4 ? '#f2ce02' :
                                            item.grade == 3 ? '#ebff0a' :
                                                item.grade == 2 ? '#85e62c' :
                                                    '#02de0a',
                                width: '30px',
                                height: '30px',
                                display: 'inline-flex',
                                alignItems: 'center',
                                justifyContent: 'center',
                                borderRadius: '50%',
                                color: '#000',
                                fontWeight: '600'
                            }">
                                {{ item.grade }}
                            </span>

                        </td>
                        <td>{{ item.auction_date }} <br> {{ item.auction_time }}</td>
                        <td>
                            <span class="auction-badge">{{ item.auction_name }}</span>
                        </td>
                    </tr>

                    <!-- HOVER ROW -->
                    <tr v-if="hoveredRowId === item.id" class="hover-row">
                        <td :colspan="columns.length">
                            <div class="d-flex align-center justify-space-between px-4"
                                @mouseenter="hoveredRowId = item.id" @mouseleave="handleHoverLeave">

                                <!-- Images -->
                                <div class="d-flex ga-2">
                                    <v-dialog v-for="(img, i) in item.images.slice(0, 4)" :key="i" max-width="900">
                                        <template #activator="{ props }">
                                            <img v-bind="props" :src="img" width="45" height="45"
                                                class="rounded cursor-pointer" @click.stop />
                                        </template>

                                        <template #default="{ isActive }">
                                            <v-card class="pa-2">
                                                <div class="d-flex justify-end">
                                                    <v-btn icon variant="text" @click="isActive.value = false">
                                                        <v-icon>mdi-close</v-icon>
                                                    </v-btn>
                                                </div>
                                                <v-img :src="img" contain max-height="80vh" />
                                            </v-card>
                                        </template>
                                    </v-dialog>
                                </div>

                                <!-- Report -->
                                <div class="w-25 text-center">
                                    <v-btn size="small" color="primary" variant="flat" :href="item.inspection_report"
                                        target="_blank">
                                        View Report
                                    </v-btn>
                                </div>

                            </div>
                        </td>
                    </tr>



                </template>


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
            hoveredRowId: null,
            hoverTimeout: null,
            // imageDialog:false,
            // previewImage:null,
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
            ],

        }
    },
    computed: {

        methods: {
            handleHoverLeave() {
                this.hoverTimeout = setTimeout(() => {
                    this.hoveredRowId = null
                }, 200)
            }

        },

    },
};

</script>

<style scoped>
.hover-row {
    animation: fadeIn 0.2s ease-in-out;
}


@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-3px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
