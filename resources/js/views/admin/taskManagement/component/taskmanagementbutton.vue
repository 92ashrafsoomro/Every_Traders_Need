<template>
    <user-title-bar title="Task Management">
        <v-row no-gutters="" class="ga-2">
            <v-col cols="12" sm="6" md="3" lg="" class="">

                <v-card class="border-bottom border border-sm">
                    <v-container>

                        <div class="d-flex h-6">
                            <div style="background: #0080ff38; border-radius: 22px; width: 40px; height: 40px;"
                                class="circle d-flex justify-center align-center">
                                <v-icon size="22" color="primary">mdi-store-clock</v-icon>
                            </div>

                            <span class="text-h4 px-3">0</span>
                        </div>


                        <div class="pt-3 text-body-1 text-whiteLite ">Total Auctions</div>
                        <div class="pt-2 d-flex">
                            <div class="text-body-2 pr-2">
                                <span class="white">Live Auctions: </span>
                                <span class=""
                                    style="background-color: rgba(var(--v-theme-background)); padding: 8px; border-radius: 4px; ">0</span>
                            </div>
                            <div class=" text-body-2 pl-2">
                                <span class="white">Time Auctions: </span>
                                <span class=""
                                    style="background-color: rgba(var(--v-theme-background)); padding: 8px; border-radius: 4px; ">
                                    0</span>
                            </div>
                        </div>


                    </v-container>
                </v-card>
            </v-col>
            <!-- Total Auctions -->
            <v-col cols="12" sm="6" md="3" lg="" class="">

                <v-card class="border-bottom-inprogress w-100 border border-sm">
                    <v-chip text-color="white" size="small" class="bg-danger position-absolute mt-5 right-0  "
                        style="border-radius: 3px 0 0 3px;" label>
                        <v-icon size="10" color="white" class="mr-2">
                            mdi-circle
                        </v-icon> Live
                    </v-chip>
                    <v-container>
                        <div class="d-flex h-6">
                            <div class=" bg-danger-lite d-flex justify-center align-center live-circle"
                                style="border-radius: 22px; width: 40px; height: 40px;">
                                <v-icon size="32" color="danger" class="">
                                    mdi-radiobox-marked
                                </v-icon>
                            </div>

                            <span class="text-h4 px-3">0</span>
                        </div>

                        <div class="pt-3 text-body-1 text-whiteLite ">Inprogress Auctions</div>
                        <div class="pt-2 d-flex justify-space-between">
                            <div class="text-body-2 pr-2">
                                <span class="white">Inprogress Auctions: </span>
                                <span class=""
                                    style="background-color: rgba(var(--v-theme-background)); padding: 8px; border-radius: 4px; ">0</span>
                            </div>
                            <div class="text-body-2">View</div>

                        </div>


                    </v-container>
                </v-card>
            </v-col>
            <!-- Total Auctions -->
            <v-col cols="12" sm="6" md="3" lg="" class="">

                <v-card class="border-bottom  border border-sm">
                    <v-container>

                        <div class="d-flex h-6">
                            <div style="background: #0080ff38; border-radius: 22px; width: 40px; height: 40px;"
                                class="circle d-flex justify-center align-center">
                                <v-icon size="32" color="primary">mdi-bash</v-icon>
                            </div>
                            <span class="text-h4 px-3">0</span>
                        </div>

                        <div class="pt-3 text-body-1 text-whiteLite ">Total Vehicles</div>
                        <div class="pt-2 d-flex">
                            <div class="text-body-2 pr-2">
                                <span class="white">Total Vehicles:</span>
                                <span class=""
                                    style="background-color: rgba(var(--v-theme-background)); padding: 8px; border-radius: 4px; ">0</span>
                            </div>
                        </div>


                    </v-container>
                </v-card>
            </v-col>

            <v-col cols="12" sm="6" md="3" lg="" class="">

                <v-card class="border-bottom  border border-sm">
                    <v-container>
                        <div class="d-flex h-6">
                            <div style="background: #0080ff38; border-radius: 22px; width: 40px; height: 40px;"
                                class="circle d-flex justify-center align-center">
                                <v-icon size="32" color="primary">mdi-repeat-variant</v-icon>
                            </div>
                            <span class="text-h4 px-3">0</span>
                        </div>

                        <div class="pt-3 text-body-1 text-whiteLite ">Vehicle in reauctions</div>
                        <div class="pt-2 d-flex">
                            <div class="text-body-2 pr-2">
                                <span class="white">Vehicles:</span>
                                <span class=""
                                    style="background-color: rgba(var(--v-theme-background)); padding: 8px; border-radius: 4px; ">0</span>
                            </div>

                        </div>


                    </v-container>
                </v-card>
            </v-col></v-row>
        <div class="content-scroll d-flex mt-6 w-100 ga-3">
            <div v-for="item in items" :key="item.path" class="border rounded bg-surface-variant-1 pa-3 cursor-pointer"
                style="width:13.5%" @click="$router.push(item.path)" :class="{ active: $route.path === item.path }">
                <div class="d-flex justify-space-between ">
                    <div class="d-flex align-center">
                        <small> {{ item.title }}</small>
                    </div>
                    <div class="d-flex align-center">
                        <svg width="15" height="15" viewBox="0 0 512 512" class="text-primary auction-svg"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill="currentColor"
                                d="M504.971 199.362l-22.627-22.627c-9.373-9.373-24.569-9.373-33.941 0l-5.657 5.657L329.608 69.255l5.657-5.657c9.373-9.373 9.373-24.569 0-33.941L312.638 7.029c-9.373-9.373-24.569-9.373-33.941 0L154.246 131.48c-9.373 9.373-9.373 24.569 0 33.941l22.627 22.627c9.373 9.373 24.569 9.373 33.941 0l5.657-5.657 39.598 39.598-81.04 81.04-5.657-5.657c-12.497-12.497-32.758-12.497-45.255 0L9.373 412.118c-12.497 12.497-12.497 32.758 0 45.255l45.255 45.255c12.497 12.497 32.758 12.497 45.255 0l114.745-114.745c12.497-12.497 12.497-32.758 0-45.255l-5.657-5.657 81.04-81.04 39.598 39.598-5.657 5.657c-9.373 9.373-9.373 24.569 0 33.941l22.627 22.627c9.373 9.373 24.569 9.373 33.941 0l124.451-124.451c9.372-9.372 9.372-24.568 0-33.941z" />
                        </svg>
                        <span class="ml-1">0</span>
                    </div>

                </div>
            </div>


        </div>
    </user-title-bar>
</template>

<script>
export default {
    name: 'taskNav',
    data() {

        return {

            items: [
                {
                    title: 'Up Coming',
                    path: '/admin/taskManagement/upComing'
                },
                {
                    title: 'Up Grade',
                    path: '/admin/taskManagement/upGrade'
                },
                {
                    title: 'Final',
                    path: '/admin/taskManagement/final'
                },
                {
                    title: 'Time Auction',
                    path: '/admin/taskManagement/timeAuction'
                },
            ]

        }

    },
    computed: {

    },
    methods: {

        getVariant(item) {

            return this.$route.path.startsWith('/admin/bodyType') === item.path ? 'tonal' : 'outlined';
        }

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