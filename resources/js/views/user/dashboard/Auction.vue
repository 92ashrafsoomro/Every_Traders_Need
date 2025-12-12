<template>

    <v-card class="mb-5 border" title="Online / Time Auction">
        <template v-slot:append>
            <div class="d-flex mt-2">
                <div class="mr-2">
                    <plateform-dropdown label="Online Auction" variant="outlined" density="compact" max-width="180px"
                        min-width="180px" hide-details v-model="auctionType"
                        :items="['Online Auction', 'Time Auction']" />

                </div>

                <div class="d-none d-sm-block">
                    <PlateformDropdown v-model="platformsId" label="Select Platform" variant="outlined"
                        density="compact" max-width="180px" min-width="180px" hide-details />


                </div>
            </div>

        </template>

        <div class="border-b"></div>

        <v-card-text style="max-height: 400px; ">

            <v-select v-model="platformsId" :items="platforms" label="Select Platform" variant="outlined"
                density="compact" hide-details class="d-block d-sm-none mb-3" />

            <v-table density="comfortable" height="400px" fixed-header>
                <thead>
                    <tr>
                        <th>PLATFORM {{ auctionType }}</th>
                        <th>TOTAL AUCTION</th>
                        <th>REMAINING</th>
                        <th>LOTS</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-if="isLoading">
                        <td colspan="5">
                            <v-progress-linear color="primary" indeterminate />
                        </td>
                    </tr>

                    <template v-else-if="data.length">
                        <v-hover v-for="item in data" :key="item.auction_platform_name" v-slot="{ isHovering, props }">
                            <tr v-bind="props" :class="[
                                isHovering ? 'bg-shadow' : '',
                                isHovering ? 'elevation-2' : ''
                            ]">
                                <td>{{ item.auction_platform_name }}</td>
                                <td>{{ item.car_count }}</td>
                                <td>{{ item.remaining }}</td>
                                <td>{{ item.lots }}</td>
                            </tr>
                        </v-hover>
                    </template>


                    <tr v-else>
                        <td colspan="5" class="text-center py-4 text-grey">No data found</td>
                    </tr>
                </tbody>
            </v-table>

        </v-card-text>
    </v-card>


</template>

<script>

import PlateformDropdown from '@/components/PlateformDropdown.vue';
import api from '@/plugins/axios';
export default {
    name: "actions",
    components: {
        PlateformDropdown
    },
    data() {
        return {
            platforms: [],
            data: [],
            platformsId: null,
            isLoading: false,
            auctionType: 'Online Auction'
        }
    },
    watch: {
        auctionType(newVal, oldVal) {
            this.getOnlineAction()
        },
        platformsId(newVal, oldVal) {
            this.getOnlineAction()
        }
    },

    methods: {
        async getOnlineAction() {
            this.isLoading = true;
            try {
                let res = await api.get("/api/user/dashboard/onlineAuctions", {
                    params: {
                        type: this.auctionType.toLowerCase(),
                        platform: this.platformsId
                    }
                });
                this.data = res.data.data;
                this.isLoading = false;
            } catch (error) {
                console.error(error.message, "onlineAuction Api error");
                this.isLoadin = false;
            }
        },


    },

    mounted() {
        this.getOnlineAction();

    }
}
</script>