<template>
    <main>
        <TitleBar title="Auction Scheduler"
            subtitle="Manage and view platform auctions across all centers in one place.">
            <div class="d-flex ga-2 w-100 w-md-75 w-lg-50 align-start align-sm-center">
                <ComoboxInput color="primary" density="compact" />

                <ComoboxInput color="primary" density="compact" />
                <v-switch v-model="isToggleEnabled" color="primary" density="compact" size="small" hide-details
                    @change="handleToggleChange" class="ml-3" />

            </div>
            <div class="scheduleContainer pt-4 d-flex align-center ga-4
            flex-wrap ml-auto mr-auto
            ">
                <div class="scheduleDiv border border-[#2b3b4f] rounded-md bg-backgound2 pa-3 ps-5
                d-flex flex-column mb-3
                ">
                    <div
                        class="text-white text-caption d-flex align-center justify-center border-b border-[#2b3b4f] pa-3">
                        Today</div>
                    <div class="lowerSection text-[#cccccc] mt-2 d-flex justify-space-between">
                        <div class="flex align-center 
                        text-[#00bad1] text-overline">
                            <small><i class="fa-solid fa-gavel"></i></small>
                            <span class="text-caption 
                            text-[#cccccc]">0</span>
                        </div>
                        <div>
                            <small> <i class="fa-solid fa-car"></i></small>
                            <span>0</span>
                        </div>
                        <div>
                            <small><i class="fa-solid fa-heart"></i></small>
                            <span>0</span>
                        </div>
                    </div>
                </div>
                <div class="scheduleDiv border border-[#2b3b4f] rounded-md bg-backgound2 pa-3 ps-5
                d-flex flex-column mb-3
                ">
                    <div
                        class="upperSection text-white text-caption d-flex align-center justify-center border-b border-[#2b3b4f] pa-3">
                        Today</div>
                    <div class="lowerSection mt-2 d-flex justify-space-between">
                        <div class="flex align-center 
                        text-[#00bad1] text-overline">
                            <small><i class="fa-solid fa-gavel"></i></small>
                            <span class="text-caption 
                            text-[#cccccc]">0</span>
                        </div>
                        <div>
                            <small> <i class="fa-solid fa-car"></i></small>
                            <span>0</span>
                        </div>
                        <div>
                            <small><i class="fa-solid fa-heart"></i></small>
                            <span>0</span>
                        </div>
                    </div>
                </div>
                <div class="scheduleDiv border border-[#2b3b4f] rounded-md bg-backgound2 pa-3 ps-5
                d-flex flex-column mb-3
                ">
                    <div
                        class="upperSection text-white text-caption d-flex align-center justify-center border-b border-[#2b3b4f] pa-3">
                        Today</div>
                    <div class="lowerSection mt-2 d-flex justify-space-between">
                        <div class="flex align-center 
                        text-[#00bad1] text-overline">
                            <small><i class="fa-solid fa-gavel"></i></small>
                            <span class="text-caption 
                            text-[#cccccc]">0</span>
                        </div>
                        <div>
                            <small> <i class="fa-solid fa-car"></i></small>
                            <span>0</span>
                        </div>
                        <div>
                            <small><i class="fa-solid fa-heart"></i></small>
                            <span>0</span>
                        </div>
                    </div>
                </div>
                <div class="scheduleDiv border border-[#2b3b4f] rounded-md bg-backgound2 pa-3 ps-5
                d-flex flex-column mb-3
                ">
                    <div
                        class="upperSection text-white text-caption d-flex align-center justify-center border-b border-[#2b3b4f] pa-3">
                        Today</div>
                    <div class="lowerSection mt-2 d-flex justify-space-between">
                        <div class="flex align-center 
                        text-[#00bad1] text-overline">
                            <small><i class="fa-solid fa-gavel"></i></small>
                            <span class="text-caption 
                            text-[#cccccc]">0</span>
                        </div>
                        <div>
                            <small> <i class="fa-solid fa-car"></i></small>
                            <span>0</span>
                        </div>
                        <div>
                            <small><i class="fa-solid fa-heart"></i></small>
                            <span>0</span>
                        </div>
                    </div>
                </div>
                <div class="scheduleDiv border border-[#2b3b4f] rounded-md bg-backgound2 pa-3 ps-5
                d-flex flex-column mb-3
                ">
                    <div
                        class="upperSection text-white text-caption d-flex align-center justify-center border-b border-[#2b3b4f] pa-3">
                        Today</div>
                    <div class="lowerSection mt-2 d-flex justify-space-between">
                        <div class="flex align-center 
                        text-[#00bad1] text-overline">
                            <small><i class="fa-solid fa-gavel"></i></small>
                            <span class="text-caption 
                            text-[#cccccc]">0</span>
                        </div>
                        <div>
                            <small> <i class="fa-solid fa-car"></i></small>
                            <span>0</span>
                        </div>
                        <div>
                            <small><i class="fa-solid fa-heart"></i></small>
                            <span>0</span>
                        </div>
                    </div>
                </div>
                <div class="scheduleDiv border border-[#2b3b4f] rounded-md bg-backgound2 pa-3 ps-5
                d-flex flex-column mb-3
                ">
                    <div
                        class="upperSection text-white text-caption d-flex align-center justify-center border-b border-[#2b3b4f] pa-3">
                        Today</div>
                    <div class="lowerSection mt-2 d-flex justify-space-between">
                        <div class="flex align-center 
                        text-[#00bad1] text-overline">
                            <small><i class="fa-solid fa-gavel"></i></small>
                            <span class="text-caption 
                            text-[#cccccc]">0</span>
                        </div>
                        <div>
                            <small> <i class="fa-solid fa-car"></i></small>
                            <span>0</span>
                        </div>
                        <div>
                            <small><i class="fa-solid fa-heart"></i></small>
                            <span>0</span>
                        </div>
                    </div>
                </div>
                <div class="scheduleDiv border border-[#2b3b4f] rounded-md bg-backgound2 pa-3 ps-5
                d-flex flex-column mb-3
                ">
                    <div
                        class="upperSection text-white text-caption d-flex align-center justify-center border-b border-[#2b3b4f] pa-3">
                        Today</div>
                    <div class="lowerSection mt-2 d-flex justify-space-between">
                        <div class="flex align-center 
                        text-[#00bad1] text-overline">
                            <small><i class="fa-solid fa-gavel"></i></small>
                            <span class="text-caption 
                            text-[#cccccc]">0</span>
                        </div>
                        <div>
                            <small> <i class="fa-solid fa-car"></i></small>
                            <span>0</span>
                        </div>
                        <div>
                            <small><i class="fa-solid fa-heart"></i></small>
                            <span>0</span>
                        </div>
                    </div>
                </div>
            </div>
        </TitleBar>
        <div class="mainContent">
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
.mainContent {
    max-width: 1536px;
    padding: 0 24px;
    margin-left: auto;
    margin-right: auto;
}


.scheduleDiv {
    height: 95px;
    width: 195px;
}

.upperSection {
    color: white;
    font-size: 15px;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
    border-bottom: 1px solid #2b3b4f;
    padding: 10px;
}

.lowerSection div span {
    font-size: 11px;
    font-weight: 600;
    color: #cccccc;
    margin-left: 4px;
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

    .upperSection {
        padding: 6px;
    }
}

@media (max-width: 375px) {
    .scheduleDiv {
        height: auto;
        width: 160px;
    }
}

@media (max-width: 320px) {
    .scheduleDiv {
        height: auto;
        width: 130px;
    }
}
</style>
