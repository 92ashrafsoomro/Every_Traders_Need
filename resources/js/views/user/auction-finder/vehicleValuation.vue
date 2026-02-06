<template>
    <div class="bg-surface rounded border">
        <v-data-table-server class="dataTable rounded" :headers="headers" :items="auctionStore.data"
            :items-length="auctionStore.total" :loading="auctionStore.loading" item-value="id"
            @update:options="auctionStore.getAuctionList">
            <!-- CUSTOM ROW -->
            <template #item="{ item, columns }">
                <!-- MAIN ROW -->
                <tr class="main-row" @mouseenter="hoveredRowId = item.id" 
                    :class="{ 'hovered-main-row': hoveredRowId === item.id }">
                    <td>
                     <router-link  style="text-decoration: none; color: rgb(var(--v-theme-whiteLight)); " :to="'/user/vehicle-detail/'+ item.id" class="vehicleName pa-2 rounded-sm " target="_blank">
                            <span>   {{ item.make_name }} {{ item.model_name }} {{item.variant_name }} </span>
                        </router-link>
                    </td>

                    <td>{{ item.grade }}</td>
                    <td>{{ item.cap_clean }}</td>
                    <td>{{ item.cap_average }}</td>
                    <td>{{ item.cap_below }}</td>
                    <td>{{ item.autotrader_retail_value }}</td>

                    <td>
                        {{ item.auction_date }} <br />
                        {{ item.auction_time }}
                    </td>
                        <td class="d-none d-lg-block pt-lg-4 d-md-block pt-md-4">  <span class="auction-badge">{{
                        item.auction_name }}</span> </td>
                </tr>

                <!-- DETAIL ROW (HOVER) -->
                <tr v-if="hoveredRowId === item.id" class="detail-row"
                    :class="{ 'hovered-detail-row': hoveredRowId === item.id }">
                    <td>
                        <div class="detail-content pa-4 d-flex align-center justify-space-between"
                            @mouseenter="hoveredRowId = item.id">
                            <div class="d-flex ga-3">
                                <v-img v-for="(img, i) in item.images.slice(0, 4)" :key="i" :src="img" width="60"
                                    height="60" class="rounded-lg cursor-pointer elevation-2" cover
                                    @click="openImage(item.images, i)" />


                                <v-dialog v-model="dialog" class=" w-lg-50 w-md-50 w-100 "  >
                                    <v-card elevation="0"></v-card>
                                        <!-- Close Button -->
                                        <v-btn icon="mdi-close"  class="position-absolute "
                                            style="top: 10px; right: 10px; z-index: 10;"    color="primary" @click="dialog = false" />

                                        <!-- Left Arrow -->
                                        <v-btn icon="mdi-chevron-left" class="position-absolute d-lg-block d-md-block d-none"
                                            style="top: 50%; left: 10px; transform: translateY(-50%); z-index: 10"
                                            :disabled="currentIndex === 0" @click="prevImage"  color="primary" />

                                        <!-- Right Arrow -->
                                        <v-btn icon="mdi-chevron-right" class="position-absolute d-lg-block d-md-block d-none"
                                            style="top: 50%; right: 10px; transform: translateY(-50%); z-index: 10"
                                            :disabled="currentIndex === currentImages.length - 1" @click="nextImage" color="primary" />

                                        <!-- Image -->
                                        <v-img :src="currentImages[currentIndex]" max-height="500" cover
                                            class="rounded" style="border: none !important;" />
                                
                                       <div class="d-flex mt-10 mt-lg-0 mt-md-0 justify-space-between" >
                                         <v-btn icon="mdi-chevron-left" class="d-flex d-lg-none d-md-none" color="primary"
                                            style="transform: translateY(-50%);"
                                            :disabled="currentIndex === 0" @click="prevImage" />

                                        <!-- Right Arrow -->
                                        <v-btn icon="mdi-chevron-right" class="  d-flex d-lg-none d-md-none"
                                         color="primary"
                                            style=" transform: translateY(-50%);"
                                            :disabled="currentIndex === currentImages.length - 1" @click="nextImage" />
                                       </div>    
                                </v-dialog>
                                


                            </div>
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    
                <td></td>
                    <td> <v-btn color="primary" variant="flat" size="small" :href="item.inspection_report"
                            target="_blank" @click.stop>
                            View Report
                        </v-btn></td>
                </tr>
            </template>

            <!-- PAGINATION -->
            <template #bottom>
                <div class="py-2 d-flex justify-end border-t">
                    <custom-pagination :loading="auctionStore.loading" v-model:page="auctionStore.filter.page"
                        :lastPage="auctionStore.last_page" @page-changed="auctionStore.getAuctionList" />
                </div>
            </template>
        </v-data-table-server>
    </div>
</template>


<script>
import { useAuctionStore } from "@/stores/auctionStore";
import ImagePreviewCarousel from "./sidebar/fields/ImagePreviewCarousel.vue";

export default {
    components: {
        ImagePreviewCarousel
    },
    data() {
        return {
            auctionStore: useAuctionStore(),
            hoveredRowId: null,
            currentImages: [],
            showPreview: false,
            dialog: false, image: '',
            currentIndex: 0,
            headers: [
                { title: "Vehicle", key: "vehicle", sortable: false },
                { title: "Grade", key: "grade" },
                { title: "Cap Clean", key: "cap_clean" },
                { title: "Cap Average", key: "cap_average" },
                { title: "Cap Below", key: "cap_below" },
                { title: "Autotrader Retail", key: "autotrader_retail_value" },
                { title: "Date Time", key: "date" },
                 { title: "Auction House", key: "auction_name" },
            ],
        };
    },
    methods:{
        openImage(images , index){
            this.currentImages = images
            this.currentIndex = index
            this.dialog = true
        },
        nextImage(){
            if(this.currentIndex < this.currentImages.length -1){
                this.currentIndex++
            }
        },
        prevImage(){
            if(this.currentIndex > 0){
                this.currentIndex--
            }
        },
         handleHoverLeave() {
            this.hoverTimeout = setTimeout(() => {
                this.hoveredRowId = null
            }, 200)
        },
        getGradeColor(grade){
            switch (grad) {
                case 5:
                    return '#e51f1f'
                case 4:
                    return '#f2ce02'
                case 3:
                    return '#ebff0a'
                case 2:
                    return '#85e62c'
                default:
                    return '#02de0a'
            }
        },
        openPreview(images, index) {
            this.currentImages = images
            this.currentIndex = index
            this.showPreview = true
        },

        nextImage() {
            if (!this.currentImages.length) return
            this.currentIndex =
                (this.currentIndex + 1) % this.currentImages.length
        },
    }
};
</script>
<style scoped>
.hovered-main-row,
.hovered-detail-row {
    background-color: rgba(var(--v-theme-background)) !important;
    transition: background-color 0.25s ease;
}

.main-row,
.detail-row {
    background-color: transparent;
    transition: background-color 0.25s ease;
}

.hovered-main-row td {
    border-bottom: none !important;
}

.hovered-detail-row td {
    border-top: none !important;
}

.detail-row {
    animation: slideDown 0.3s ease-out;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.auction-badge {
    background-color: #0080ff50;
    padding: 6px 12px;
    border-radius: 4px;
    width: 150px;
    font-size: 0.875rem;
}

.vehicleName:hover{
    background-color: rgb(var(--v-theme-primary),0.3);
    transition: 0.2s ease-in-out;
}
</style>
