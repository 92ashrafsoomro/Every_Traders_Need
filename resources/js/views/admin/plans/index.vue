<template>
    <user-title-bar title="Plans" subtitle="Plans Page">

    </user-title-bar>
    <v-container fluid="" max-width="1500px">
        <div class="border">
            <v-data-table-server class="" :loading="loading" :headers="headers" :items="items" :items-length="total"
                hover item-value="id" @update:options="getPlainData">
                <template #item.created_at="{ item }">
                    <span>{{ item.created_at?.split('T')[0] }}</span>
                </template>
                <template #item.updated_at="{item}">
                    <span>{{ item.updated_at?.split('T')[0] }}</span>
                </template>
            </v-data-table-server>
        </div>
    </v-container>
</template>

<script>
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
                { title: "Update At" , key: "updated_at"}
            ]
        }
    },
    methods: {
        async getPlainData() {
            this.loading = true;
            try {
                let res = await api.get("/api/cruds/plans")
                this.items = res.data.data ?? res.data
                this.total = res.data.total ?? res.data.length
                this.loading = false
                // console.log("plans data"+res.data);
                // alert("Data Fetch")
            } catch (error) {
                alert("Data Not Fetch ")
                this.loading = false
            }
        }
    },
    mounted() {
        this.getPlainData()
    }
}
</script>