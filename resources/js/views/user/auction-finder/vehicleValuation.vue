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
                        <v-btn variant="plain" :to="'/user/vehicle-detail/' + item.id">
                            <span class="text-whiteLight"> {{ item.make_name }} {{ item.model_name }} {{
                                item.variant_name }} </span>
                        </v-btn>
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

                    <td>
                        <v-btn size="small" variant="flat" color="primary">
                            Autoboli
                        </v-btn>
                    </td>
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


                                <v-dialog v-model="dialog" max-width="60%">
                                    <v-card class="position-relative pa-4">

                                        <!-- Close Button -->
                                        <v-btn icon="mdi-close" class="position-absolute"
                                            style="top: 10px; right: 10px; z-index: 10" @click="dialog = false" />

                                        <!-- Left Arrow -->
                                        <v-btn icon="mdi-chevron-left" class="position-absolute"
                                            style="top: 50%; left: 10px; transform: translateY(-50%); z-index: 10"
                                            :disabled="currentIndex === 0" @click="prevImage" />

                                        <!-- Right Arrow -->
                                        <v-btn icon="mdi-chevron-right" class="position-absolute"
                                            style="top: 50%; right: 10px; transform: translateY(-50%); z-index: 10"
                                            :disabled="currentIndex === currentImages.length - 1" @click="nextImage" />

                                        <!-- Image -->
                                        <v-img :src="currentImages[currentIndex]" max-height="500" cover
                                            class="rounded" />
                                    </v-card>
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
                    <td>
                        <v-btn color="primary" variant="flat" size="small" :href="item.inspection_report"
                            target="_blank" @click.stop>
                            View Report
                        </v-btn>
                    </td>
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

export default {
    data() {
        return {
            auctionStore: useAuctionStore(),
            hoveredRowId: null,
            headers: [
                { title: "Vehicle", key: "vehicle", sortable: false },
                { title: "Grade", key: "grade" },
                { title: "Cap Clean", key: "cap_clean" },
                { title: "Cap Average", key: "cap_average" },
                { title: "Cap Below", key: "cap_below" },
                { title: "Autotrader Retail", key: "autotrader_retail_value" },
                { title: "Date Time", key: "date" },
                { title: "Autoboli", key: "autoboli" },
            ],
        };
    },
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
</style>
