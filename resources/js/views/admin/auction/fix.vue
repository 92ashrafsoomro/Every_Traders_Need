<template>
   

    <v-container max-width="1400px">
        <v-row no-gutters class="mt-3">
            <v-col cols="12">
                <div class="d-lg-flex d-md-flex py-4">
                
                    <v-btn @click="loadItems" >lOAD</v-btn>
                </div>
            </v-col>
            <v-col cols="12" class="mt-2">
                <div class="border">
                    <v-table :loading="loading" >
                        <thead>
                            <tr>
                               <th>Id</th>
                               <th>Title</th>
                               <th>Vehicle</th>
                               <th>Body</th>
                               <th>Center</th>
                               <th>Make</th>
                               <th>Model</th>
                               <th>Variant</th>
                               <th>Error</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-if="loading">
                                <td colspan="3" class="text-center">
                                Loading...
                                </td>
                            </tr>
                            <tr v-else v-for="(item, index) in items" :key="index" >
                                <td>{{ item.id }}</td>
                                <td>{{ item.title }}</td>
                                <td>{{ item.vehicle_id }}</td>
                                <td>{{ item.body_id }}</td>
                                <td>{{ item.center_id }}</td>
                                <td>{{ item.make_id }}</td>
                                <td>{{ item.model_id }}</td>
                                <td>{{ item.variant_id }}</td>
                                <td>{{ item.errors }}</td>
                            </tr>
                        </tbody>
                    </v-table>
                </div>
            </v-col>
        </v-row>
    </v-container>
</template>
<script>


import General from '@/models/general.model';

export default {
    components: {
      
    },
    data() {
        return {
            General,
            showFilters: true,
            items: [],
            total: 0,
            loading: true,
        };
    },
    mounted() {
        this.loadItems()
    },
    computed: {

    },
    methods: {

        async loadItems() {

            this.loading = true;
            try {

                let res = await General.get('/api/cruds/auctions/sheetFix', {});
                // console.log(res);
                
                this.items = res.data.data;
                this.loading = false;
                // this.filter.page = Number(res.page)
                // this.total = res.recordsTotal;
                // this.last_page = Number(res.last_page);
            } catch (error) {
                alert(error);
            } finally {
                this.loading = false;
            }
        },

      
    }



}

</script>

<style scoped></style>