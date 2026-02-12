<template>
    <user-title-bar title="Auction Schedule" style="z-index: 1;"
        subtitle="Manage and view platform auctions across all centers in one place." class="pt-16">
        <div class="d-flex flex-wrap ga-2 mt-10 ">
            <div style="width: 200px;">
                <PlateformDropdown label="Select Platform" variant="outlined" :model-value="options.platform_id"
                    @update:modelValue="handleInput($event, 'platform_id')" clearable />
            </div>
            <div style="width: 200px;">
                <CenterDropdown label="Select Center" variant="outlined" :model-value="options.center_id"
                    @update:modelValue="handleInput($event, 'center_id')" clearable />
            </div>

             <div class="d-none d-lg-flex d-md-flex ">
                <v-switch :model-value="options.enableCurrent" color="primary" density="compact" hide-details
                    @change="handleInput($event, 'enableCurrent')" class="ml-3" />

                <span class="mt-lg-5 mt-md-5 mt-2 ml-3">In Progress</span>
            </div>
      
        </div>
              <div class="d-flex d-lg-none d-md-none ">
                <v-switch :model-value="options.enableCurrent" color="primary" density="compact" hide-details
                    @change="handleInput($event, 'enableCurrent')" class="ml-3" />

                <span class="mt-lg-5 mt-md-5 mt-2 ml-3">In Progress</span>
            </div>

        <!-- Large Devices -->
        <div class="pt-4 d-lg-flex d-md-flex  d-none align-center ga-3 ml-auto mr-auto mt-4">
            <div v-for="(value, key, index) in days" :key="index" :class="{ 'active': options.day == key }"
                class=" border rounded bg-surface-variant-1 pa-3 d-flex  flex-column mb-3 cursor-pointer"
                @click="handleTab(key)" style=" height: 110px; width: 13.5%;">
                <div class="text-capitalize text-center align-center justify-center  pb-2  text-wrap"
                    style="white-space: wrap !important; border-bottom: 1px solid #343E4B ;">
                <div>
                        {{ key }} 
                
                </div>
                <h6 class="font-weight-light">1 - june</h6>
                </div>

                <div class="lowerSection d-flex justify-space-between mt-2">
                    <div class="d-flex align-center ">
                      <HammerIcon/>

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
        <!-- Small Devices -->
        <div class="d-lg-none d-md-none d-flex mt-4 w-100 ">
            <v-slide-group hide-arrows class="pa-2 w-100 ">
                <v-slide-item v-for="(value, key, index) in days" :key="index">
                    <div class="border rounded bg-surface-variant-1 pa-3 cursor-pointer"
                       @click="handleTab(key)"  :class="{ 'active': options.day == key }"
                        style="width: 300px; min-width: 40%; height: 120px;padding-left: 20px; margin-right: 20px; ">
                        <div class="text-capitalize d-flex align-center justify-center  pb-2 text-wrap"
                            style="border-bottom: 1px solid #343E4B;">
                            {{ key }}
                        </div>

                        <div class="lowerSection d-flex justify-space-between mt-2 ">
                            <div class="d-flex align-center">
                             <HammerIcon/>
                                <span class="pl-1 mt-1 text-body-2">
                                    {{ value.auction }}
                                </span>
                            </div>
                            <div class="d-flex align-center">
                                <v-icon color="primary" icon="mdi-car" size="20"></v-icon>
                                <span class="pl-1 mt-1 text-body-2">{{ value.car }}</span>
                            </div>
                        </div>
                    </div>
                </v-slide-item>
            </v-slide-group>
        </div>



    </user-title-bar>


    <v-container class="mx-auto  " style="padding:0 10px 100px 10px; max-width: 1400px;">
        <div class="mt-10 mb-10  w-100  ">
            <v-table fixed-header class="rounded-lg ">
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

                            <span class="rounded h-50  d-flex justify-center align-center"
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
import { useUserStore } from "@/stores/userStore";
import HammerIcon from '@/views/admin/taskManagement/component/Icon.vue'
export default {
    name: "auctionsolution",
    components: {
        CenterDropdown,
        PlateformDropdown,
        HammerIcon
    },
    data() {
        return {
          
            platforms: [],
            dropdown: null,
            carousel: 0,
            userStore: useUserStore(),
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
            await this.getRecords();
        },
        handleTab(key) {

            if (this.userStore.is_logged_in) {
                if (this.options.enableCurrent) {
                    // do nothing
                } else {
                    this.options.day = key;
                }
                this.getRecords();
            } else {
                this.$router.replace("/login");
            }
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

.disabled-tab {
    opacity: 0.5;
    pointer-events: auto;
}
</style>