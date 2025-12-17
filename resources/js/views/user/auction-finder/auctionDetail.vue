    <template>
        <div class="bg-surface rounded border ">
            <v-data-table-server :headers="headers" :items="auctionStore.data" :items-length="auctionStore.total"
                :loading="auctionStore.loading" item-value="id" >


                <template v-slot:bottom>
                    <div class="py-2 d-flex justify-end border-t ma-2">
                        <custom-pagination :loading="auctionStore.loading" v-model:page="auctionStore.filter.page"
                            :lastPage="auctionStore.last_page" @page-changed="auctionStore.getAuctionList" />
                    </div>
                </template>


                <!-- expentTable Code -->


                <template #item="{ item, columns }">

                    <!-- MAIN ROW -->
                    <tr @mouseover="hoveredRowId = item.id" class="mainTdBorder" >
                        <td>
                            <!-- <v-btn variant="plain" :to="'/user/vehicle-detail/' + item.id"> -->
                            <span style="color: white;">{{ item.make_name }} {{ item.model_name }} {{ item.variant_name
                                }}
                            </span>
                            <!-- </v-btn> -->
                        </td>
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
                            <span style="background-color: #0080ff50; padding: 7px ; border-radius: 3px;">
                                <span class="auction-badge">{{ item.auction_name }}</span></span>
                        </td>
                    </tr>

                    <!-- HOVER ROW -->
                    <tr v-if="hoveredRowId === item.id" class="openRow hover-row ">
                        <td :colspan="columns.length">
                            <div class="d-flex align-center justify-space-between px-4"
                                @mouseenter="hoveredRowId = item.id" @mouseleave="handleHoverLeave">

                                <!-- Images -->
                                <!-- Images thumbnails (same as before, sirf click handler add) -->
                                <div class="d-flex ga-2">
                                    <img v-for="(img, i) in item.images.slice(0, 4)" :key="i" :src="img" width="45"
                                        height="45" class="rounded cursor-pointer"
                                        @click="openViewer(item.images, i)" />
                                </div>

                                <!-- IMAGE VIEWER -->
                                <v-dialog v-model="imageDialog" fullscreen>
                                    <v-card color="black">
                                        <!-- Top bar -->
                                        <v-toolbar density="compact" color="black">
                                            <v-spacer />
                                            <v-btn icon @click="imageDialog = false">
                                                <v-icon color="white">mdi-close</v-icon>
                                            </v-btn>
                                        </v-toolbar>

                                        <!-- Content -->
                                        <v-card-text class="d-flex align-center justify-space-between">
                                            <!-- Previous -->
                                            <v-btn icon @click="prevImage">
                                                <v-icon color="white" size="36">mdi-chevron-left</v-icon>
                                            </v-btn>

                                            <!-- Image -->
                                            <v-img :src="currentImages[currentIndex]" max-height="85vh" contain />

                                            <!-- Next -->
                                            <v-btn icon @click="nextImage">
                                                <v-icon color="white" size="36">mdi-chevron-right</v-icon>
                                            </v-btn>
                                        </v-card-text>
                                    </v-card>
                                </v-dialog>


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
export default {
    data() {
        return {
            auctionStore: useAuctionStore(),
            hoveredRowId: null,

            imageDialog: false,
            currentImages: [],
            currentIndex: 0,

            headers: [
                { title: "Vehicle", key: "make_name", sortable: false },
                { title: "Year / CC", key: "cc" },
                { title: "Mileage", key: "mileage" },
                { title: "Transmission", key: "transmission" },
                { title: "Grade", key: "grade" },
                { title: "Date Time", key: "date" },
                { title: "Auction House", key: "auction_name" },
            ],
        }
    },

    methods: {
        handleHoverLeave() {
            this.hoverTimeout = setTimeout(() => {
                this.hoveredRowId = null
            }, 200)
        },

        openViewer(images, index) {
            this.currentImages = images
            this.currentIndex = index
            this.imageDialog = true
        },

        nextImage() {
            if (!this.currentImages.length) return
            this.currentIndex =
                (this.currentIndex + 1) % this.currentImages.length
        },

        prevImage() {
            if (!this.currentImages.length) return
            this.currentIndex =
                (this.currentIndex - 1 + this.currentImages.length) %
                this.currentImages.length
        },
    }
}

</script>

<style scoped>
:deep(.mainTdBorder td) {
  border-bottom: 0 !important;
  border-top: 1px solid rgb(var(--v-theme-border));
    background-color: rgb(var(--v-theme-surface));

}

.openRow:hover {
    background-color: rgb(var(--v-theme-surface));
}

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
