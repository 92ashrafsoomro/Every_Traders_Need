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
                    class="scheduleDiv border border-[#2b3b4f] rounded-md bg-backgound2 pa-3 ps-5 d-flex flex-column mb-3">
                    <div class="text-white text-caption d-flex align-center justify-center border-b border-[#2b3b4f] pb-2 pt-2 text-wrap"
                        style="white-space: wrap !important;">
                        {{ item.title }}
                    </div>
                    <div class="lowerSection text-[#cccccc] mt-2 d-flex justify-space-between">
                        <div class="flex align-center text-[#00bad1] text-overline">
                            <small><v-icon icon="mdi-hammer" size="small"></v-icon></small>
                            <span class="text-caption text-[#cccccc]">{{ item.auctions }}</span>
                        </div>
                        <div class="flex align-center text-[#00bad1] text-overline">
                            <small><v-icon icon="mdi-car" size="small"></v-icon></small>
                            <span class="text-caption text-[#cccccc]">{{ item.cars }}</span>
                        </div>
                        <div class="flex align-center text-[#ff4c51] text-overline">
                            <small><v-icon icon="mdi-charity" size="small"></v-icon></small>
                            <span class="text-caption text-[#cccccc]">{{ item.favorites }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </TitleBar>
        <div class="mainContent ps-2 ps-sm-6 mr-auto ml-auto">
            <DataTable />
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

<style scoped>
.scheduleDiv {
    height: 95px;
    width: 195px;
}


.lowerSection div:nth-child(1) {
    display: flex;
    align-items: center;
    color: #0080ff;
}

.lowerSection div:nth-child(2) {
    display: flex;
    align-items: center;
    color: #00bad1;
    font-size: 10px;
}

.lowerSection div:nth-child(3) {
    display: flex;
    align-items: center;
    color: #ff4c51;
    font-size: 10px;
}

@media (max-width: 768px) {
    .scheduleDiv {
        height: auto;
        width: 183px;
    }
}

@media (max-width: 425px) {
    .scheduleDiv {
        height: auto;
        width: 160px;
    }
}



@media (max-width: 375px) {
    .scheduleDiv {
        height: auto;
        width: 140px;
    }
}

@media (max-width: 320px) {
    .scheduleDiv {
        height: auto;
        width: 120px;
    }
}
</style>
