<template>
    <v-card class="mb-5 border ">

        <!-- Header -->
        <div class="d-flex flex-wrap pa-6 justify-space-between ">
            <div class="text-start">
                <h3 class="text-h6">Vehicle Statistics</h3>
                <p class=" text-body-2 text-light ">Today</p>
            </div>
        
            <div class="mr-2 ml-n3 d-flex   ga-2 mt-4 mt-lg-0 mt-md-4 pl-md-4 "> 
                <PlateformDropdown
                    variant="outlined"
                    density="compact" 
                    label="Auction Type" 
                    style="max-width: 150px; min-width: 200px;" 
                    hide-details
                    v-model="auctionType"
                    :items="['Online Auction', 'Time Auction']" 
                />
                
                <PlateformDropdown  
                    v-model="platformsId" 
                    label="Select Platform" 
                    variant="outlined"
                    density="compact"
                    style="max-width: 150px; min-width: 200px;" 
                    hide-details 
                />
            </div>
        </div>

        <div class="border-b"></div>

        <!-- Data Table -->
        <v-data-table-server
            style="max-height: 450px; "
            class="rounded " :headers="headers"
            :items="data"
            :items-length="data.length"
            sort-asc-icon="false"
            :loading="isLoading" 
            item-value="auction_platform_name" 
            hide-default-footer
            hover>

            <!-- Auction Name -->
            <template #item.auction_platform_name="{ item }">
                <span class="font-weight-medium ">
                    {{ item.auction_platform_name }}
                </span>
            </template>

            <!-- Total Auction -->
            <template #item.car_count="{ item }">
                {{ item.car_count }}
            </template>

            <!-- Remaining -->
            <template #item.remaining="{ item }">
                <span class=" font-weight-medium">
                    {{ item.remaining }}
                </span>
            </template>

            <!-- Lots -->
            <template #item.lots="{ item }">
                <span class=" font-weight-medium">
                    {{ item.lots }}
                </span>
            </template>

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

            auctionType: "Online Auction",
            platformsId: null,
            generalStore:useGeneralStore(),
            isLoading: false,
            start_date : '2025-12-1',
            end_date : '2026-1-31',
            data: [],

            headers: [
                {
                    title: 'Auction House',
                    key: 'auction_platform_name',
                    sortable: false
                },
                {
                    title: 'Total Auction',
                    key: 'car_count'
                },
                {
                    title: 'Remaining',
                    key: 'remaining'
                },
                {
                    title: 'Lots',
                    key: 'lots'
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
                const options={
                     type: this.auctionType?.toLowerCase(),
                        start_date : this.generalStore.date.start_date,
                        end_date: this.generalStore.date.end_date,
                        platform: this.platformsId
                }
                const res = await General.get('/api/user/dashboard/onlineAuctions', options)
                this.data = res?.data?.data || []
                this.isLoading = false

            } catch (e) {
                console.error('onlineAuction API error', e)
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

