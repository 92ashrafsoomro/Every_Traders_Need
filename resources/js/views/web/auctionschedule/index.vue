<template>
    <user-title-bar title="Auction Schedule" class="pt-16 pa-6"
        subtitle="Manage and view platform auctions across all centers in one place.">
        <!-- Filters -->
        <div class="d-flex flex-wrap ga-2 mt-10">
            <div style="width: 200px;">
                <PlateformDropdown label="Select Platform" variant="outlined" :model-value="options.platform_id"
                    @update:modelValue="handleInput($event, 'platform_id')" clearable />
            </div>
            <div style="width: 200px;">
                <CenterDropdown label="Select Center" variant="outlined" :model-value="options.center_id"
                    @update:modelValue="handleInput($event, 'center_id')" clearable />
            </div>

            <div class="d-flex align-center ml-3">
                <v-switch :model-value="options.enableCurrent" color="primary" density="compact" hide-details
                    @change="handleInput($event, 'enableCurrent')" />
                <span class="ml-3">In Progress</span>
            </div>
        </div>

   
        <div class="pt-4 mt-4 ">
            <!-- Small screens: carousel -->
            <v-slide-group v-if="isMobile" show-arrows v-model="options.day" class="pa-2">
                <v-slide-item v-for="(value, key) in days" :key="key" :value="key">
                    <div :elevation="options.day === key ? 6 : 1" class="bg-white pa-3 mr-3" @click="handleTab(key)"
                        style=" height: 95px; width: 93.5%;">
                        <div class="text-center text-subtitle-2 pb-2">{{ key }}</div>
                        <div class="d-flex justify-space-between mt-2">
                            <div class="d-flex align-center">
                                <v-icon color="primary" size="20">mdi-gavel</v-icon>
                                <span class="ml-1 text-body-2">{{ value.auction }}</span>
                            </div>
                            <div class="d-flex align-center">
                                <v-icon color="primary" size="20">mdi-car</v-icon>
                                <span class="ml-1 text-body-2">{{ value.car }}</span>
                            </div>
                        </div>
                    </div>
                </v-slide-item>
            </v-slide-group>


            <!-- Medium+ screens: normal grid -->
            <div v-else class="d-flex flex-wrap align-center justify-start ga-3 ">
                <v-card v-for="(value, key) in days" :key="key" :elevation="options.day === key ? 6 : 1"
                    class="pa-3 mb-3 bg-white" @click="handleTab(key)" style="  ">
                    <div class="text-center text-subtitle-2 pb-2">{{ key }}</div>
                    <div class="d-flex justify-space-between mt-2">
                        <div class="d-flex align-center">
                            <v-icon color="primary" size="20">mdi-gavel</v-icon>
                            <span class="ml-1 text-body-2">{{ value.auction }}</span>
                        </div>
                        <div class="d-flex align-center">
                            <v-icon color="primary" size="20">mdi-car</v-icon>
                            <span class="ml-1 text-body-2">{{ value.car }}</span>
                        </div>
                    </div>
                </v-card>
            </div>

        </div>
    </user-title-bar>



    <v-container class="mx-auto  " style="padding:0 0 100px 0; max-width: 1400px;">
        <div class="mt-10 mb-10 w-100 ">
            <v-table fixed-header class="rounded-lg">
                <thead>
                    <tr>
                        <th class="text-left text-subtitle-1">
                            Auction house
                        </th>

                        <th class="text-left text-subtitle-1">
                            Center
                        </th>

                        <th class="text-left text-subtitle-1">
                            Auction Name
                        </th>
                        <th class="text-left text-subtitle-1">
                            Total Vahicls
                        </th>

                        <th class="text-left text-subtitle-1">
                            time
                        </th>

                        <th class="text-left text-subtitle-1">
                            Status
                        </th>

                    </tr>
                </thead>
                <tbody>

                    <tr v-for="value in [1, 2, 3, 4, 5]">
                        <td>
                            <p class="text-primary">BCA</p>
                        </td>
                        <td>Birmingham, Bristol, Thurleigh </td>
                        <td>Abc</td>
                        <td>225</td>
                        <td>

                            <span class="rounded h-50 pa-2 pa-lg-0 d-flex justify-center align-center"
                                style=" background-color: rgba(var(--v-theme-background));">10:00</span>
                        </td>
                        <td>
                            <div class="rounded h-50  d-flex justify-center align-center"
                                style="width:100px ; background-color: rgba(var(--v-theme-primary),0.10);">
                                In Progress
                            </div>
                        </td>

                    </tr>

                </tbody>
            </v-table>
        </div>
    </v-container>



</template>

<script>


import { auctionSheldulerList } from '@/services/pageService';
import CenterDropdown from '@/components/CenterDropdown.vue';
import PlateformDropdown from '@/components/PlateformDropdown.vue';
import { useDisplay } from 'vuetify'
export default {
    name: "auctionsolution",
    components: {
        CenterDropdown,
        PlateformDropdown

    },
    data() {
        return {
            center: null,
            platforms: [],
            dropdown: null,
            enableCurrent: false,
            days: {
                today: {
                    auction: 0,
                    car: 10,
                },
                mon: {
                    auction: 0,
                    car: 10,
                },
                tue: {
                    auction: 6,
                    car: 10,
                },
                wed: {
                    auction: 0,
                    car: 10,
                },
                thu: {
                    auction: 9,
                    car: 10,
                },
                fri: {
                    auction: 0,
                    car: 10,
                },
                sat: {
                    auction: 10,
                    car: 10,
                },

            },
            options: {
                length: 10,
                page: 1,
                last_page: 1,
                offset: 0,
                platform_id: null,
                center_id: null,
                day: 'today',
                enableCurrent: false,
                date: '',
                data: [],
                total: 0,
                loading: false,
            },
        }
    },
    methods: {
        async handleInput(value, field) {

            switch (field) {
                case 'platform_id':
                    this.options.platform_id = value;
                    break;
                case 'center_id':
                    this.options.center_id = value;
                    break;
                case 'enableCurrent':
                    console.log(value.target.checked);
                    if (value.target.checked) {
                        this.options.day = 'today';
                    }
                    this.options.enableCurrent = value.target.checked;

                    break;

                default:
                    break;
            }

            this.getRecords();
        },
        handleTab(key) {

            if (this.options.enableCurrent) {

            } else {
                this.options.day = key;
            }

            this.getRecords();
        },
        async getRecords() {

            try {

                let res = await auctionSheldulerList(this.options);
                this.data = res.data;
                this.total = res.recordsTotal;
                this.options.page = Number(res.page);
                this.options.offset = res.offset;
                this.options.last_page = res.last_page
            } catch (error) {
                this.alertStore.add(error.message, 'error');
                this.data = [];
                this.total = 0;
                this.options.page = 1;
                this.options.last_page = 1;
            }
        }

    },
    computed: {
        isMobile() {
            const display = useDisplay()
            return display.smAndDown
        }
    }
}

</script>
<style scoped>
.icon {
    font-size: 10px;
    color: #00bad1;
}

.active {
    border-color: rgb(var(--v-theme-primary)) !important;
}

.day-card {
    width: 80%;
}

@media (min-width: 600px) {
    .day-card {
        width: calc(50% - 12px);
    }
}

/* MD → 3 cards per row */
@media (min-width: 960px) {
    .day-card {
        width: calc(33.333% - 12px);
    }
}

/* LG → all in one line */
@media (min-width: 1280px) {
    .day-card {
        width: calc(14.28% - 12px);
        /* 7 days */
    }
}

</style>