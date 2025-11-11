<template>
    <main>
        <TitleBar title="Auction Scheduler"
            subtitle="Manage and view platform auctions across all centers in one place.">
            <div
                class="d-flex flex-column flex-sm-row ga-2 w-100 w-md-75 w-lg-50 justify-center justify-sm-start align-start pr-5 pr-sm-0">
                <ComoboxInput color="primary" density="compact" class="w-100 w-sm-auto" />
                <ComoboxInput color="primary" density="compact" class="w-100 w-sm-auto" />
                <v-switch v-model="isToggleEnabled" color="primary" density="compact" size="small" hide-details
                    @change="handleToggleChange" class="ml-3" />
            </div>
            <div class=" pt-4 d-flex align-center ga-4
            flex-wrap ml-auto mr-auto
            ">
                <div v-for="(item, index) in scheduleItems" :key="index"
                    class="scheduleDiv border border-border rounded-md bg-surface-variant-1 pa-3 ps-5 d-flex flex-column mb-3"
                    style=" height: 95px; width: 195px;">
                    <div class="text-caption d-flex align-center justify-center border-b border-border pb-2 pt-2 text-wrap"
                        style="white-space: wrap !important;">
                        {{ item.title }}
                    </div>
                    <div class="lowerSection d-flex justify-space-between mt-2">
                        <div class="d-flex align-center text-primary">
                            <small><v-icon icon="mdi-hammer" size="small"></v-icon></small>
                            <span class="text-caption text-[#cccccc]">{{ item.auctions }}</span>
                        </div>
                        <div class="d-flex align-center" style=" font-size: 10px; color: #00bad1;">
                            <small><v-icon icon="mdi-car" size="small"></v-icon></small>
                            <span class="text-caption text-[#cccccc]">{{ item.cars }}</span>
                        </div>
                        <div class="d-flex align-center text-danger" style="font-size: 10px;">
                            <small><v-icon icon="mdi-charity" size="small"></v-icon></small>
                            <span class="text-caption text-[#cccccc]">{{ item.favorites }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </TitleBar>
        <div class="mainContent ps-2 ps-sm-6 mr-auto ml-auto">
            <DataTable class="rounded-lg mt-5" />
        </div>
    </main>
</template>

<script>
import TitleBar from "./../component/TitleBar.vue";
import CustomSelect from "./../component/Select.vue";
import DataTable from "./../component/dataTable.vue";
import ComoboxInput from "./../component/ComoboxInput.vue";

export default {
    props: {},
    components: {
        TitleBar,
        CustomSelect,
        DataTable,
        ComoboxInput,
    },
    data() {
        return {
            isToggleEnabled: false,
            scheduleItems: [
                { title: 'Today', auctions: 0, cars: 0, favorites: 0 },
                { title: 'Tomorrow', auctions: 0, cars: 0, favorites: 0 },
                { title: 'This Week', auctions: 0, cars: 0, favorites: 0 },
                { title: 'Next Week', auctions: 0, cars: 0, favorites: 0 },
                { title: 'This Month', auctions: 0, cars: 0, favorites: 0 },
                { title: 'Next Month', auctions: 0, cars: 0, favorites: 0 },
                { title: 'This Year', auctions: 0, cars: 0, favorites: 0 }
            ]
        };
    },
    methods: {
        handleToggleChange(value) {
            console.log('Toggle changed:', value);
            if (value) {
                this.enableFeature();
            } else {
                this.disableFeature();
            }
        },
        enableFeature() {
            console.log('Feature enabled');
        },
        disableFeature() {
            console.log('Feature disabled');
        },
    },
};
</script>

<style scoped></style>
