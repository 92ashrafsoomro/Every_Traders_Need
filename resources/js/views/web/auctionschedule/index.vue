<template>
    <user-title-bar title="Auction Schedule" style="z-index: 1;"
        subtitle="Manage and view platform auctions across all centers in one place." class="pt-16 pa-16">
        <div class="d-flex flex-wrap ga-2 mt-10 ">
            <div style="width: 200px;">
                <PlateformDropdown label="Select Platform" variant="outlined" :model-value="options.platform_id"
                    @update:modelValue="handleInput($event, 'platform_id')" clearable />
            </div>
            <div style="width: 200px;">
                <CenterDropdown label="Select Center" variant="outlined" :model-value="options.center_id"
                    @update:modelValue="handleInput($event, 'center_id')" clearable />
            </div>

            <div class="d-flex">
                <v-switch :model-value="options.enableCurrent" color="primary" density="compact" hide-details
                    @change="handleInput($event, 'enableCurrent')" class="ml-3" />

                <span class="mt-5 ml-3">In Progress</span>
            </div>
        </div>
        <div class="pt-4 d-flex flex-wrap align-center  justify-start  ga-3 ml-auto mr-auto mt-4">
            <div v-for="(value, key, index) in days" :key="index" :class="['day-card', { active: options.day == key }]"
                class="border rounded bg-surface-variant-1 pa-3 d-flex flex-column mb-3 cursor-pointer"
                @click="handleTab(key)">

                <div class="text-capitalize d-flex align-center justify-center  pb-2  text-wrap"
                    style="white-space: wrap !important; border-bottom: 1px solid #343E4B ;">
                    {{ key }}
                </div>
                <div class="lowerSection d-flex justify-space-between mt-2">
                    <div class="d-flex align-center ">
                        <svg width="15" height="15" viewBox="0 0 512 512" class="text-primary auction-svg"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill="currentColor"
                                d="M504.971 199.362l-22.627-22.627c-9.373-9.373-24.569-9.373-33.941 0l-5.657 5.657L329.608 69.255l5.657-5.657c9.373-9.373 9.373-24.569 0-33.941L312.638 7.029c-9.373-9.373-24.569-9.373-33.941 0L154.246 131.48c-9.373 9.373-9.373 24.569 0 33.941l22.627 22.627c9.373 9.373 24.569 9.373 33.941 0l5.657-5.657 39.598 39.598-81.04 81.04-5.657-5.657c-12.497-12.497-32.758-12.497-45.255 0L9.373 412.118c-12.497 12.497-12.497 32.758 0 45.255l45.255 45.255c12.497 12.497 32.758 12.497 45.255 0l114.745-114.745c12.497-12.497 12.497-32.758 0-45.255l-5.657-5.657 81.04-81.04 39.598 39.598-5.657 5.657c-9.373 9.373-9.373 24.569 0 33.941l22.627 22.627c9.373 9.373 24.569 9.373 33.941 0l124.451-124.451c9.372-9.372 9.372-24.568 0-33.941z" />
                        </svg>

                        <span class="pl-1 mt-1 text-body-2">
                            {{ value.auction }}
                        </span>
                    </div>

                    <div class="d-flex align-center">
                        <small class=" icon"><v-icon color="primary" icon="mdi-car" size="20"></v-icon></small>
                        <span class="pl-1 mt-1 text-body-2 ">{{ value.car }}</span>
                    </div>
                </div>
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