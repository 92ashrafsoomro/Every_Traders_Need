<template>
    <user-title-bar title="Dictionary">
        <!-- Toggle Filters -->
        <div>
            <v-card-title class="d-flex cursor-pointer" @click="showFilters = !showFilters">
                <span class="text-h6 font-weight-bold">Filters</span>
                <v-icon color="primary">
                    {{ showFilters ? "mdi-chevron-up" : "mdi-chevron-down" }}
                </v-icon>
            </v-card-title>

            <v-expand-transition>
                <div v-show="showFilters">
                    <v-container fluid>
                        <v-row class="mt-1 text-center content-scroll" align="center">

                            <!-- Dictionary Name -->
                            <v-col cols="12" sm="4">
                                <v-select density="compact" variant="outlined" clearable v-model="filter.name"
                                    item-title="label" label="Prefix Name" :items="Dictionary.prefixName" />
                            </v-col>

                            <!-- Dictionary Key -->
                            <v-col cols="12" sm="3">
                                <v-text-field density="compact" variant="outlined" clearable v-model="filter.key"
                                    label="Dictionary Key" />
                            </v-col>

                            <!-- Dictionary Value -->
                            <v-col cols="12" sm="3">
                                <div class="d-flex">
                                     <v-text-field density="compact" variant="outlined" clearable
                                        v-model="filter.value" label="Dictionary Value" />
                                    <v-btn style="height: 44px; margin-left: 10px;" variant="outlined"
                                        @click="loadItems" class="mr-2">
                                        <v-icon icon="mdi-magnify"></v-icon>
                                    </v-btn>
                                </div>
                            </v-col>
                            <!-- <v-col cols="12" sm="5" class="d-flex">
                                <v-text-field density="compact" variant="outlined" clearable v-model="filter.search"
                                    label="Search" />

                                <v-btn style="height: 44px; margin-left: 10px;" variant="outlined" @click="loadItems"
                                    class="mr-2">
                                    <v-icon icon="mdi-magnify"></v-icon>
                                </v-btn>
                                <v-btn to="/admin/dictionary/create" color="primary" style="height: 44px;"
                                    variant="flat">
                                    <v-icon icon="mdi-plus"></v-icon>
                                </v-btn>
                            </v-col> -->

                        </v-row>
                    </v-container>
                </div>
            </v-expand-transition>
        </div>
    </user-title-bar>


    <v-container max-width="1400px">
        <div class="d-flex  justify-space-between w-100 ">
            <div class="d-flex w-50 ">
                <v-select v-model="filter.length" :items="[100, 500, 1000, 2000]" density="compact" variant="outlined"
                    max-width="90px" class="mr-2" />
                <div class="align-self-center pl-2">
                    {{ filter.offset + 1 }} - {{ Math.min(filter.offset + filter.length, totalRecord) }} of {{
                        total }} Records
                </div>

            </div>

            <div class="w-50 d-flex">
                <v-text-field density="compact" variant="outlined" clearable v-model="filter.search"
                    label="Search" />

                <v-btn style="height: 44px; margin-left: 10px;" variant="outlined" @click="loadItems" class="mr-2">
                    <v-icon icon="mdi-magnify"></v-icon>
                </v-btn>
                <v-btn to="/admin/dictionary/create" color="primary" style="height: 44px;" variant="flat">
                    <v-icon icon="mdi-plus"></v-icon>
                </v-btn>
            </div>

        </div>
        <v-row no-gutters class="mt-3">



            <v-col cols="12" class="mt-2">
                <div class="border">
                    <v-data-table-server class="" style="height: 900px;" :headers="headers" :loading="loading"
                        fixed-header sort-asc-icon="" :items="items" :items-length="total" hover item-value="id"
                        :lastPage="last_page" @update:options="loadItems">
                        <template v-slot:bottom>
                            <div class="py-2 d-flex justify-end border-t">
                                <custom-pagination :loading="loading" v-model:page="filter.page" :lastPage="last_page"
                                    @page-changed="loadItems" />
                            </div>
                        </template>
                        <template #item.action="{ item }">
                            <span class=" px-2"></span>
                            <v-icon class="clickable-icon pa-4" color="danger" @click="deleteItem(item)">
                                mdi-delete
                            </v-icon>
                        </template>



                    </v-data-table-server>
                </div>
            </v-col>
        </v-row>
    </v-container>




</template>
<script>

import Dictionary from "@/models/dictionary";
import BaseSelect from "./component/BaseSelect.vue";

export default {
    components: { BaseSelect },
    data() {
        return {
            showFilters: true,
            Dictionary,
            viewDrawer: false,
            selectedUser: null,
            viewLoading: false,
            filter: {
                key: null,
                value: null,
                name: null,
                search: "",
                length: 50,
                page: 1,
                offset: 0,
            },
            last_page: 1,
            items: [],
            total: 0,
            loading: true,
            headers: [
                { title: "Id", value: "id" },
                { title: "Name", value: "name" },
                { title: "Key", value: "prefix_key" },
                { title: "Value", value: "prefix_value" },
                { title: "Action", value: "action", sortable: false },
            ],
        };
    },
    mounted() {
        this.loadItems();
    },
    watch: {
        'filter.length'(newVal, oldVal) {
            this.filter.page = 1;
            this.loadItems()
        },
        'filter.page'(newVal, oldVal) {
            this.loadItems()
        },
        'filter.make'(val) {
            this.filter.model = null
            this.filter.variant = null
        },
        'filter.model'(val) {
            this.filter.variant = null
        }


    },
    methods: {
        async loadItems() {
            this.loading = true;
            try {
                const res = await Dictionary.all(this.filter);
                this.items = res.data || [];
                this.totalRecord = res.recordsTotal || this.items.length;
                this.total = this.totalRecord;
                // this.filter.page = Number(res.page);
                this.last_page = Number(res.last_page);
            } catch (error) {
                alert(error);
            } finally {
                this.loading = false;
            }
        },
        async deleteItem(item) {
            if (!confirm("Are you sure you want to delete this item?")) return;
            this.loading = true;
            try {
                const res = await Dictionary.delete(item.prefix_key, { name: item.name });
                this.$alertStore.add(res.message || "Prefix deleted", "success");
                this.loadItems();
            } catch (error) {
                console.error(error);
                this.$alertStore.add(error.message || "Delete failed", "error");
            } finally {
                this.loading = false;
            }
        },
    },
};

</script>

<style scoped>
.widthstatic {
    width: 10% !important;
}

.v-list-item__content {
    display: flex !important;
    justify-content: space-between !important;
}

.eyeIcon:hover {
    background-color: rgb(var(--v-theme-primary), 0.2) !important;
    cursor: pointer;
    border-radius: 20px;
}
</style>