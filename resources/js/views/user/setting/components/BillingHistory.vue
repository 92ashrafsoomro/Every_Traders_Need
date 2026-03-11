<template>
    <v-card title="Billing History" class="mt-5 " border="">
        <div class="border"></div>
        <div class="border">
            <v-data-table-server sort-asc-icon=""  :headers="headers" :items="data"  hover :items-length="total" hide-default-footer
                item-value="id">

                <!-- <template #item.invoice="{ item }">
                    <v-icon icon="mdi-eye-outline" class="mr-2"></v-icon>
                    <v-icon icon="mdi-download"></v-icon>
                </template> -->

                <template #item.updated_at="{ item }">
                    <span class="">
                        {{ dateFormate(item.updated_at) }}
                    </span>
                </template>
                <template #item.membership_start_date="{ item }">
                    <span class="">
                        {{ dateFormate(item.membership_start_date) }}
                    </span>
                </template>
                <template #item.membership_expiry_date="{ item }">
                    <span class="">
                        {{ dateFormate(item.membership_expiry_date) }}
                    </span>
                </template>
                <template #item.invoice="{ item }">
                    <v-icon
                        color="info"
                        class="pa-4"
                        @click="downloadPdf(item.id)"
                        >
                        mdi-download
                    </v-icon>
                            
                </template>

                <template #item.membership_status="{ item }">
                    <v-btn :color="item.membership_status == 0 ? 'warning':'primary'" size="small" variant="flat"  class="cursor-text">
                            {{ item.membership_status == 0 ? 'De Active' : 'Active' }}
                    </v-btn>
            </template>
            </v-data-table-server>
        </div>
    </v-card>
</template>

<script>

import { usePageStore } from '@/stores/pageStore';
import { useUserStore } from '@/stores/userStore';
import General from '@/models/general.model';

export default {
    components: {

    },
    data() {
        return {
            pageStore: usePageStore(),
            userStore: useUserStore(),
            data: [],
            loading: true,
            headers: [
                // { title: "Id", key: "id" },
                { title: "Date", value: "updated_at" },
                { title: "Plan Name", value: "package_name" },
                { title: "Start", value: "membership_start_date" },
                { title: "Expiry", value: "membership_expiry_date" },
                { title: "Amount", value: "price" },
                { title: "Status", value: "membership_status" },
                { title: "Invoice", value: "invoice" },
            ],
        };
    },
    computed: {

    },
    mounted() {


        this.loadDataFromProfile();
        this.data = this.userStore.user.billingHistory

    },
    methods: {
        async loadDataFromProfile() {
            this.loading = true;
                try {
                    let res = await  General.get(`/api/user/billing-history`);
                    this.data = res.data.data ?? res.data;
                    this.loading = false;
                   
                } catch (error) {
                    alert(error)
                    this.loading = false
                }
        },

        dateFormate(date) {
            if (!date) return ''
            return date.split('T')[0].split(' ')[0]
        },
            async downloadPdf(id) {
        this.loading = true;
        try {
            
            const response = await General.pdf(`/api/user/billing/${id}`, {}, {
                responseType: "blob" 
            });
            const blob = new Blob([response.data], { type: 'application/pdf' });
            
            const url = window.URL.createObjectURL(blob);
            const link = document.createElement("a");
            link.href = url;
            link.setAttribute("download", `invoice-${id}.pdf`);
            
            document.body.appendChild(link);
            link.click();
            
            // Cleanup
            link.remove();
            window.URL.revokeObjectURL(url);
            this.loading = false;
        } catch (error) {
            console.error("PDF Download error:", error);
            this.loading = false;
        }
    }


    }
};
</script>
