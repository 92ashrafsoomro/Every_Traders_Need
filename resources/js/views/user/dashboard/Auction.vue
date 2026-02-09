<template>
    <v-card class="mb-5 border " style="min-height: 490px; max-height: 490px;">

        <!-- Header -->
        <div class="d-flex  pa-4 justify-space-between ">
            <div class="text-start">
                <h3 class="text-h6">Online Auction</h3>
                <p class=" text-body-2 text-light ">Today</p>
            </div>

            <div class="mr-2 ml-n3 d-flex   ga-2 mt-4 mt-lg-0 mt-md-4 pl-md-4 ">
              

                    <!-- Time Auction -->
                    <v-btn variant="tonal" class="buttonBorder text-none px-5"
                        :class="{ 'bg-primary text-white': auctionType === 1 }" @click="auctionType = 1"
                        style="height: 50px;">
                        <span class="text-capitalize text-body-1">Time Auction</span>
                    </v-btn>

                    <!-- Online Auction -->
                    <v-btn variant="tonal" class="buttonBorder text-none px-5"
                        :class="{ 'bg-primary text-white': auctionType === 2 }" @click="auctionType = 2"
                        style="height: 50px;">
                        <span class="text-capitalize text-body-1">Online Auction</span>
                    </v-btn>


                <!-- <PlateformDropdown v-model="platformsId" label="Select Platform" variant="outlined" density="compact"
            
                    clearable style="max-width: 150px; min-width: 150px; " hide-details /> -->
            </div>
        </div>

        <div class="border-b"></div>

        <!-- Data Table -->
        <v-data-table-server style="" class="rounded " :headers="headers"
            :items="data" :items-length="data.length" sort-asc-icon="false" :loading="isLoading"
            item-value="auction_platform_name" hide-default-footer hover>

            <!-- Auction Name -->


            <!-- No Data -->
            <template #no-data>
                <div class="text-center py-4 text-grey">
                    No data found
                </div>
            </template>

        </v-data-table-server>
    </v-card>
</template>

<script>
import PlateformDropdown from '@/components/PlateformDropdown.vue'
import General from '@/models/general.model';
import api from '@/plugins/axios'
import { useGeneralStore } from '@/stores/generalStore';
export default {
    components: { PlateformDropdown },

    data() {
        return {

            auctionTypeOptions: [
                { label: 'Time Auction', id: 1 },
                { label: 'Online Auction', id: 2 }
            ],
            auctionType: 2,
            platformsId: null,
            generalStore: useGeneralStore(),
            isLoading: false,
            start_date: '2025-12-1',
            end_date: '2026-1-31',
            data: [],

            headers: [
                {
                    title: 'Auction House',
                    value: 'name',
                },
                {
                    title: 'Total Auction',
                    value: 'total_auctions'
                },
                {
                    title: 'Total Lots',
                    value: 'total_lots'
                },
                {
                    title: 'Remaining Lots',
                    value: 'remaining_lots'
                }
            ]
        }
    },

    watch: {
        auctionType() {
            this.getOnlineAction()
        },
        platformsId() {
            this.getOnlineAction()
        }
    },

    methods: {
        async getOnlineAction() {
            this.isLoading = true
            try {
                const options = {
                    type: this.auctionType,
                    start_date: this.generalStore.date.start_date,
                    end_date: this.generalStore.date.end_date,
                    platform: this.platformsId
                }

                const res = await General.get('/api/user/dashboard/onlineAuctions', options)

                this.data = res.data

            } catch (e) {
                console.error('error', e)
                this.data = []
            } finally {
                this.isLoading = false
            }
        }

    },

    mounted() {
        this.getOnlineAction()
    }
}
</script>
