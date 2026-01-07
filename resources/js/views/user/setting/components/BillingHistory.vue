<template>
    <v-card title="Billing History" class="">
            <div class="border" ></div>
              <div class="border"> 
            <v-data-table-server  
                :headers="headers" 
                :items="data" 
                hover        
                :items-length="data.length" 
                hide-default-footer
                item-value="id"
                height="300"
               
            >

                    <template #item.invoice="{ item }" >
                        <v-icon icon="mdi-eye-outline" class="mr-2"></v-icon>
                        <v-icon icon="mdi-download"></v-icon>
                    </template>
            </v-data-table-server>
            </div>
        </v-card>
</template>

<script>

 import { usePageStore } from '@/stores/pageStore';
import { useUserStore } from '@/stores/userStore';

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
                { title: "Id", key: "id" },
                { title: "Date", value: "updated_at" },
                { title: "Plan Name", value: "plan.plan_name" },
                { title: "Start", value: "membership_start_date" },
                { title: "Expiry", value: "membership_expiry_date" },
                { title: "Amount", value: "plan.price" },
                { title: "Status", value: "membership_status" },
                { title: "Invoice", value: "invoice" },
            ],
        };
    },
    computed: {

    },
    mounted() {
        
        
        // this.loadDataFromProfile();
        this.data = this.userStore.user.billingHistory

    },
    methods: {
        loadDataFromProfile() {
          
        }
    }
};
</script>

