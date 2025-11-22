<template>
<custom-card title="Billing History" class="">
        <v-data-table-server class="pb-3" 
            :headers="pageStore.billingHistory.headers" 
            :items="pageStore.billingHistory.data" 
            :items-length="pageStore.billingHistory.total"
            :loading="pageStore.billingHistory.loading" 
            item-value="id"
            >
                <template #item.status="{ item }">
                    
                    <v-btn v-if="item.status == 'Active'" color="success" variant="flat">{{ item.status }}</v-btn>
                    
                    <v-btn v-else-if="item.status == 'Expired'" color="danger" variant="flat">{{ item.status }}</v-btn>

                    <v-btn v-else color="warning" variant="flat">{{ item.status }}</v-btn>
                </template>

                <template #item.invoice="{ item }">

                    <v-btn icon="mdi-eye" color="primary" variant="tonal"></v-btn>
                    <v-btn icon="mdi-download" color="success" variant="tonal"></v-btn>

                
                </template>

                <template v-slot:bottom>
                    <div class="py-2" >
                        <custom-pagination
                        :loading="pageStore.billingHistory.loading"
                        v-model:page="pageStore.billingHistory.page" 
                        :lastPage="pageStore.billingHistory.last_page"
                        />
                    </div>
                </template>
            </v-data-table-server>
    </custom-card>
</template>

<script>

 import { usePageStore } from '@/stores/pageStore';

 export default {
    components: {

    },
    data() {
        return {
            pageStore: usePageStore(),
        };
    },
    computed: {

    },
    mounted() {

        // this.loadDataFromProfile();
    },
    methods: {
        loadDataFromProfile() {
          
        }
    }
};
</script>
