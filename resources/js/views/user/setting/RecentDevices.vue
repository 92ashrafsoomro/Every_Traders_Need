<template>
    <v-col cols="12">
        <v-card title="Recent Devices" class="">
            <div class="border"></div>

            <v-data-table-server class="pb-3" :headers="headers" :items="data" :items-length="total"
                item-value="id">
                <template #item.platform="{ item }">
                    <p>
                        <v-icon class="text-primary" icon="mdi-microsoft-windows-classic" />
                        <span class="px-2 font-weight-thin"> {{ item.platform }}</span>
                    </p>
                </template>
                <template #item.browser="{ item }">
                    <p>
                        <v-icon class="text-orange" icon="mdi-google-chrome" />
                        <span class="px-2 font-weight-thin"> {{ item.browser }}</span>
                    </p>
                </template>

                <template v-slot:bottom>
                    <!-- <div class="py-2">
                        <custom-pagination :loading="pageStore.recentDevices.loading"
                            v-model:page="pageStore.recentDevices.page" :lastPage="pageStore.recentDevices.last_page" />
                    </div> -->
                </template>
            </v-data-table-server>
        </v-card>

    </v-col>
</template>


<script>

import api from '@plugins/axios'

export default {
    data() {
        return {

            loading: false,
            data: [],
            headers: [
                { title: "Platform", value: "platform", sortable: false },
                { title: "Browser", value: "browser" },
                { title: "Device", value: "device" },
                { title: "Location", value: "location" },
                { title: "Date", key: "created_at", sortable: false },
            ],
            total : 0,
        };
    },

    methods:{
        async getRecentdevices() {
                try {
                    let res = await api.get("/api/user/profile/userDevices");
                    this.data = res.data.data;
                    this.total = res.data.total;
                } catch (err) {
                    console.log(err.message);
                }
        }
    },

    mounted(){
        this.getRecentdevices();

    }
    
}
</script>