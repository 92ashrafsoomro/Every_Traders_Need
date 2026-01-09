<template>

    <Nav />
    <v-container max-width="1400px">
        <v-row no-gutters class="mt-3">
            <v-col cols="12">
                <div class="d-flex flex-wrap ">
                    <div class="d-flex align-center">
                        <v-select v-model="filter.length" :items="[10, 25, 50, 100]" density="compact"
                            variant="outlined" max-width="150px" class="mr-2" />
                        <div class="align-self-center pl-2">{{ filter.offset }} - {{ Math.min(filter.length, total) }}
                            of {{ total }} Records </div>

                    </div>

                    <v-spacer />

                    <v-text-field v-model="filter.search" label="Search..." variant="outlined" density="compact"
                        max-width="300px" clearable />

                    <div class="pl-2">
                        <!-- <v-btn base-color="#bdbdbd" style="height: 44px;" variant="outlined" @click="loadItems">
                                <v-icon icon="mdi-magnify"></v-icon>
                            </v-btn> -->
                    </div>
                    <div class="pl-2">
                        <v-btn to="/admin/model/create" color="primary" style="height: 44px;" variant="flat"
                            @click="loadItems">
                            <v-icon icon="mdi-plus"></v-icon>
                        </v-btn>
                    </div>
                </div>
            </v-col>

            <v-col cols="12" class="mt-2">
                <div class="border">
                    <v-data-table-server class="" :loading="loading" :headers="headers" :items="items"
                        :items-length="total" hover item-value="id" @update:options="loadItems">
                       
                        <template #item.action="{ item }">
                            <router-link :to="'/admin/model/edit/' + item.id">
                                <v-icon color="primary" class="editIconHover pa-4">mdi-pencil</v-icon>
                            </router-link>
                            <span class="px-2"></span>
                            <v-icon small class="clickable-icon pa-4" color="danger" @click="deleteItem(item.id)">
                                mdi-delete
                            </v-icon>
                        </template>

                        <template v-slot:bottom>
                            <div class="py-2 d-flex justify-end border-t">
                                <custom-pagination :loading="loading" v-model:page="filter.page" :lastPage="last_page"
                                    @page-changed="loadItems" />
                            </div>
                        </template>


                    </v-data-table-server>
                </div>
            </v-col>
        </v-row>
    </v-container>

</template>

<script>

import Model from '@/models/vehicle-model.model';
import Nav from '../nav/Nav.vue';
import VehicleType from '@/models/vehicle-type.model';
import { debounce } from "lodash";



export default {

    components: {
        Nav
    },
    data() {
        return {
            filter: {
                search: '',
                length: 10,
                page: 1,
                offset: 0,
            },

            last_page: 1,
            items: [],
            total: 0,
            loading: true,
            headers: [
                { title: "ID", value: "id", sortable: false },
                { title: "Make Name", value: "makeName" },
                { title: "Title", value: "name" },
                { title: "Created At", value: "date" },
                { title: "Action", key: "action" },
            ],
        };
    },
    mounted() {
        this.loadItems()
    },
    created() {
        this.debouncedSearch = debounce(() => {
            this.filter.page = 1;
            this.loadItems();
        }, 600);
    },
    computed: {

    },
    watch: {
        'filter.length'(newVal, oldVal) {
            this.loadItems()
        },
        'filter.page'(newVal, oldVal) {
            this.loadItems()
        },
        'filter.search'(newVal, oldVal) {
            this.debouncedSearch();
        }

    },

    methods: {


        async loadItems() {

            this.loading = true;
            try {
                let res = await Model.all(this.filter);
                this.items = res.data;
                this.total = res.recordsTotal;
                this.filter.page = Number(res.page);
                this.last_page = Number(res.last_page);
                this.loading = false


            } catch (error) {
                alert(error)
                this.loading = false
            }
        },
        async deleteItem(id) {
            if (!confirm("Are you sure you want to delete this item?")) return;
            this.loading = true;
            try {
                const res = await Model.delete(id);

                this.$alertStore.add(res.message || "Model deleted", "success");
                this.loadItems();

            } catch (error) {
                console.error(error);
                this.$alertStore.add(error.message || "Delete failed", "error");
                // this.loadItems(); 
            } finally {
                this.loading = false;
            }
        }

    }

};

</script>

<style scoped></style>