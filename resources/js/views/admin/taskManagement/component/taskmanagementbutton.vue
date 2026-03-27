<template>
    <user-title-bar title="Task Management">
        <v-row no-gutters="" class="ga-4">
            <!-- Total Task -->
            <v-col cols="12" sm="6" md="3" lg="" class="">
                <v-card class="border-bottom border border-sm">
                    <v-container>

                        <div class="d-flex h-6">
                            <div style="background: #0080ff38; border-radius: 22px; width: 40px; height: 40px;"
                                class="circle d-flex justify-center align-center">
                                <v-icon size="22" color="primary">mdi-store-clock</v-icon>
                            </div>

                            <span class="text-h4 px-3">  {{ taskManagementStore.totalTask }}</span>
                        </div>


                        <div class="pt-3 text-body-1 text-whiteLite ">Total Task</div>
                        <div class="pt-2 d-flex">
                            <div class="text-body-2 pr-2">
                                <span class="white">Live Auctions: </span>
                                <span class="" style="background-color: rgba(var(--v-theme-background)); padding: 8px; border-radius: 4px; ">
                                    {{ taskManagementStore.totalLive }}</span> </div>
                            <div class=" text-body-2 pl-2">
                                <span class="white">Time Auctions: </span>
                                <span class=""
                                    style="background-color: rgba(var(--v-theme-background)); padding: 8px; border-radius: 4px; ">
                                     {{ taskManagementStore.totalTime }}</span>
                            </div>
                        </div>


                    </v-container>
                </v-card>
            </v-col>
            <!-- Pending Task -->
            <v-col cols="12" sm="6" md="3" lg="" class="">

                <v-card class="border-bottom-inprogress w-100 border border-sm">
                    <v-container>
                        <div class="d-flex h-6">
                            <div class=" bg-danger-lite d-flex justify-center align-center live-circle"
                                style="border-radius: 22px; width: 40px; height: 40px;">
                                <v-icon size="32" color="danger" class="">
                                    mdi-radiobox-marked
                                </v-icon>
                            </div>

                            <span class="text-h4 px-3">{{ taskManagementStore.pendingTask }}</span>
                        </div>

                        <div class="pt-3 text-body-1 text-whiteLite ">Pending Task</div>
                       <div class="pt-2 d-flex">
                            <div class="text-body-2 pr-2">
                                <span class="white">Live Auctions: </span>
                                <span class="" style="background-color: rgba(var(--v-theme-background)); padding: 8px; border-radius: 4px; ">
                                    {{ taskManagementStore.pendingLive }}</span> </div>
                            <div class=" text-body-2 pl-2">
                                <span class="white">Time Auctions: </span>
                                <span class=""
                                    style="background-color: rgba(var(--v-theme-background)); padding: 8px; border-radius: 4px; ">
                                     {{ taskManagementStore.pendingTime }}</span>
                            </div>
                        </div>


                    </v-container>
                </v-card>
            </v-col>
            <!-- Confirm  Task -->
            <v-col cols="12" sm="6" md="3" lg="" class="">

                <v-card class="border-bottom  border border-sm">
                    <v-container>

                        <div class="d-flex h-6">
                            <div style="background: #0080ff38; border-radius: 22px; width: 40px; height: 40px;"
                                class="circle d-flex justify-center align-center">
                                <v-icon size="32" color="primary">mdi-bash</v-icon>
                            </div>
                            <span class="text-h4 px-3">{{ taskManagementStore.totalConfirmTask }}</span>
                        </div>


                        <div class="pt-3 text-body-1 text-whiteLite ">Confirm Task</div>
                        <div class="pt-2 d-flex">
                            <div class="text-body-2 pr-2">
                                <span class="white">Processing: </span>
                                <span class=""
                                    style="background-color: rgba(var(--v-theme-background)); padding: 8px; border-radius: 4px; ">{{ taskManagementStore.processing }}</span>
                            </div>
                            <div class=" text-body-2 pl-2">
                                <span class="white">Done: </span>
                                <span class=""
                                    style="background-color: rgba(var(--v-theme-background)); padding: 8px; border-radius: 4px; ">
                                    {{ taskManagementStore.done }}</span>
                            </div>
                        </div>


                    </v-container>
                </v-card>
            </v-col>
            <!-- Publish  Task -->
            <v-col cols="12" sm="6" md="3" lg=""  class="">

                <v-card class="border-bottom  border border-sm">
                    <v-container>
                        <div class="d-flex h-6">
                            <div style="background: #0080ff38; border-radius: 22px; width: 40px; height: 40px;"
                                class="circle d-flex justify-center align-center">
                                <v-icon size="32" color="primary">mdi-repeat-variant</v-icon>
                            </div>
                            <span class="text-h4 px-3">{{ taskManagementStore.publishAuction }}</span>
                        </div>

                        <div class="pt-3 text-body-1 text-whiteLite ">Publish Auction</div>
                        <div class="pt-2 d-flex ga-3">
                            <div class="text-body-2 pr-2">
                                <span class="white">Lots : </span>
                                <span class=""
                                    style="background-color: rgba(var(--v-theme-background)); padding: 8px; border-radius: 4px; ">{{ taskManagementStore.totaLots || 0}}</span>
                            </div>
                            <div class=" text-body-2 pl-2">
                                <span class="white">Publish: </span>
                                <span class=""
                                    style="background-color: rgba(var(--v-theme-background)); padding: 8px; border-radius: 4px; ">
                                    {{ taskManagementStore.publishLots || 0}}</span>
                            </div>
                        </div>

                    </v-container>
                </v-card>
            </v-col>
        </v-row>


        <div class="content-scroll d-flex  mt-6  ga-3">
            <div v-for="item in taskManagementStore.taskPages" :key="item.path"
                class="border rounded bg-surface-variant-1 pa-3 cursor-pointer " style="width:189px !important"
               @click="changeTab(item)"

               :class="{ active: $route.path === item.path }"
>
                <div class="d-flex justify-space-between " style="width:150px !important">
                    <div class="d-flex align-center">
                        <small> {{ item.title }}</small>
                    </div>
                    <div class="d-flex align-center">
                       <HamerIcon/>
                        <span class="ml-1">{{ item.count }}</span>
                    </div>

                </div>
            </div>


        </div>
    </user-title-bar>

    <v-row class=" mx-auto mt-2" style="max-width: 1400px;" align="center">

        <!-- Left side -->
        <v-col cols="12" md="6" lg="" class="d-flex align-center">
            <v-select v-model="taskManagementStore.filter.length" :items="[10, 25, 50, 100]" density="compact"
                variant="outlined" max-width="150" class="mr-2" />
            {{ taskManagementStore.filter.offset }} total
            {{ Math.min(taskManagementStore.filter.length, taskManagementStore.total) }}
            of {{ taskManagementStore.total }} Records
        </v-col>


        <v-col cols="12" md="6" class="d-flex justify-end align-center ga-2">
            <AuctionTypeDropdown label="Auction Type" v-model="taskManagementStore.filter.auction_type"
                variant="outlined" clearable density="compact" />

            <PlateformDropdown v-model="taskManagementStore.filter.platform" label="Auction House" variant="outlined"
                clearable density="compact" />
            <v-select v-model="taskManagementStore.filter.status" label="Status" :items="taskManagementStore.status"
                item-title="title" item-value="value" variant="outlined" density="compact" clearable />

            <v-btn to="/admin/taskManagement/create" color="primary" height="40" variant="flat">
                <v-icon icon="mdi-plus" />
            </v-btn>
        </v-col>

    </v-row>

</template>

<script>
import AuctionTypeDropdown from '@/components/AuctionTypeDropdown.vue';
import PlateformDropdown from '@/components/PlateformDropdown.vue';
import { useTaskManagementStore } from '@/stores/taskManagementStore';
import HamerIcon from './Icon.vue'
export default {
    name: 'taskNav',
    components: {
        AuctionTypeDropdown,
        PlateformDropdown,
        HamerIcon
    },
    data() {
        return {
            taskManagementStore: useTaskManagementStore()
        }
    },
    methods: {
        changeTab(item) {
        this.taskManagementStore.selectTaskTab(item.value)
        this.$router.push(item.path)
        },
        
    },
    mounted(){
        this.taskManagementStore.getTaskCount()
    }

}


</script>
<style scoped>
.inactive-btn {
    background-color: rgba(var(--v-theme-background), 0.4) !important;
}

.master-btn {
    transition: background-color 0.2s ease;
}

.active {
    border: 1px solid rgb(var(--v-theme-primary)) !important;
}

.cursor-pointer {
    cursor: pointer;
}
</style>