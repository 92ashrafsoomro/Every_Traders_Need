<template>

    <Nav />

    <v-container max-width="1400px">
        <v-row no-gutters class="mt-3">
            <v-col cols="12">
        
                <div class="d-flex align-center justify-space-between ga-4">

                    <!-- Left: Page Length + Records -->
                    <div class="d-flex align-center ga-2">
                        <v-select
                            v-model="filter.length"
                            :items="[10, 25, 50, 100]"
                            density="compact"
                            variant="outlined"
                            max-width="120"
                        />
                        <div class="text-caption">
                            {{ filter.offset }} - {{ Math.min(filter.length, total) }} of {{ total }} Records
                        </div>
                    </div>

                    <!-- Middle: Make + Search -->
                    <div class="d-flex align-center ga-3 flex-grow-1 justify-end">
                        <MakeDropdown
                            :modelValue="makeId"
                            @update:value="handleMake($event)"
                            label="Make Name"
                            item-title="name"
                            clearable
                            item-value="id"
                            return-object
                            max-width="220"
                        />

                        <v-text-field
                            v-model="filter.search"
                            label="Search..."
                            variant="outlined"
                            density="compact"
                            max-width="260"
                            clearable
                        />
                        
                    </div>

                        <div class="mt-n2 d-flex ga-2">    
                    
                    <v-btn 
                        base-color="#bdbdbd" 
                        style="height: 40px;" 
                        variant="outlined" 
                        @click="loadItems"
                    >
                    <v-icon>mdi-magnify</v-icon>
                    </v-btn> 
                        <v-btn 
                            to="/admin/model/create"
                            color="primary"
                            class=""
                            style="height: 40px;"
                            variant="flat"
                            @click="loadItems"
                    >
                        <v-icon icon="mdi-plus"></v-icon>
                    </v-btn>
                
                </div>

                </div>
            </v-col>

            <v-col cols="12" class="mt-2">
                <div class="border">
                    <v-data-table-server
                        class="" 
                        :loading="loading" 
                        :headers="headers" 
                        :items="items"
                        :items-length="total" 
                        hover 
                        item-value="id" 
                        @update:options="loadItems"
                    >
                       
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
                                <custom-pagination 
                                    :loading="loading" 
                                    v-model:page="filter.page" 
                                    :lastPage="last_page"
                                    @page-changed="loadItems"
                                />
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
import MakeDropdown from '@/components/MakeDropdown.vue';


export default {

    components: {
        Nav,
        MakeDropdown
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
            makeId: null,
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
    emits: ['update:dailog'],

    methods: {

        handleMake($event){
           this.makeId = $event ? Number($event.id) : null;
           this.handleSearch()
        },
        handleSearch(){
            if(!this.makeId){
                this.loadItems()
                return false
            }
            
            this.dropDownSearch()
        },

        async dropDownSearch(){
            this.loading = true;
            try {
                let res = await Model.all({
                    filter: this.filter,
                    make_id: this.makeId,
                });
                 this.items = res.data;
                 this.total = res.recordsTotal;
                 this.last_page = Number(res.last_page);
                 this.loading = false

            } catch (error) {
                alert(error)
                this.loading = false
            }
        },
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