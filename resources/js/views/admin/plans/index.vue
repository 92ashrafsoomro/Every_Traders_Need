<template>
    <user-title-bar title="Plans" subtitle="Plans Page">

    </user-title-bar>
    <v-container fluid="" max-width="1500px">
        <div class="d-flex align-center justify-space-between">
            <!-- <div  class="d-flex align-center py-4">
                <v-select v-model="filter.length" :items="[10, 25, 50, 100]" density="compact"
                    variant="outlined" max-width="150" class="mr-2" />
                {{ filter.offset }} total
                {{ Math.min(filter.length, total) }}
                of {{ total }} Records
            </div> -->
            <div class="pl-2">
                <v-btn to="/admin/plans/create" color="primary" style="height: 44px;" variant="flat"
                    @click="getPlanData">
                    <v-icon icon="mdi-plus"></v-icon>
                </v-btn>
            </div>
        </div>
        <div class="border">
            <v-data-table-server class="" hide-default-footer="" :loading="loading" :headers="headers" :items="items"
                :items-length="total" hover item-value="id" @update:options="getPlanData">
                <template #item.created_at="{ item }">
                    <span>{{ item.created_at?.split('T')[0] }}</span>
                </template>
                <template #item.updated_at="{ item }">
                    <span>{{ item.updated_at?.split('T')[0] }}</span>
                </template>
                <template #item.action="{ item }">
                    <v-icon small class="clickable-icon pa-4" color="danger" @click="deleteItems(item.id)">
                            mdi-delete
                    </v-icon>    
                    <router-link :to="'/admin/plans/edit/' + item.id">
                        <v-icon color="primary" class="editIconHover pa-4">mdi-pencil</v-icon>
                    </router-link>

                </template>
            </v-data-table-server>
        </div>
    </v-container>
</template>

<script>
import General from '@/models/general.model';
import api from '@/plugins/axios';

export default {
    data() {
        return {
            items: [],
            total: 0,
            loading: false,
            headers: [
                { title: "ID", key: "id" },
                { title: "Plan Name", key: "plan_name" },
                { title: "Short Description", key: "short_desc" },
                { title: "Price", key: "price" },
                { title: "Duration", key: "duration_unit" },
                { title: "Duration Value", key: "duration_value" },
                { title: "Created At", key: "created_at" },
                { title: "Update At", key: "updated_at" },
                { title: "Action", key: 'action' }
            ]
        }
    },
    methods: {
        async getPlanData() {
            this.loading = true;
            try {
                let res = await General.get("/api/cruds/plans")
                this.items = res.data.data ?? res.data
                this.total = res.data.total ?? res.data.length
                this.loading = false
                // console.log("plans data"+res.data);
                // alert("Data Fetch")
            } catch (error) {
                alert("Data Not Fetch ")
                this.loading = false
            }
        },
        async deleteItems(id) {
            this.loading = true;
            try {
                let res = await General.delete('/api/cruds/plans/'+id);
                this.$alertStore.add(res.message, 'success');
                this.getPlanData()
            } catch (error) {
                this.$alertStore.add(error.message || 'Some Thing went wrong', error)
            } finally {
                this.loading = false;
            }
        }
    },
    mounted() {
        this.getPlanData()
    }
}
</script>