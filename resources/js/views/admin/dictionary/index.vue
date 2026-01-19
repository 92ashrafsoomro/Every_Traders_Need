<template>
    <user-title-bar title="Dictionary">
         <div class="d-flex ga-3 mb-4 mt-6">
                                <v-btn
                                    v-for="item in Dictionary.prefixName"
                                    :key="item.value"
                                    class="mx-1 text-none px-5 py-2 mb-3 master-btn text-capitalize"
                                    style="height: 50px"
                                    :color="filter.name === item.value ? 'primary' : undefined"
                                    :variant="filter.name === item.value ? 'flat' : 'tonal'"
                                    @click="selectPrefix(item.value)"
                                >
                                    {{ item.label }}
                                </v-btn>
                            </div>
        <!-- Toggle Filters -->
        
    </user-title-bar>


    <v-container max-width="1400px">
        <div class="d-flex  justify-space-between w-100 mt-4">
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
                 <div class="border table-scroll-wrapper">
                    <v-data-table-server class="table-scroll" :headers="headers" :loading="loading"
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
                // { title: "Name", value: "name" },
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
       selectPrefix(value) {
    this.filter.name = value
    this.filter.page = 1
    this.loadItems()
  },

  async loadItems() {
    this.loading = true
    try {
      const res = await Dictionary.all(this.filter)
      this.items = res.data || []
      this.totalRecord = res.recordsTotal || this.items.length
      this.total = this.totalRecord
      this.last_page = Number(res.last_page)
    } finally {
      this.loading = false
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
.master-btn {
  transition: background-color 0.2s ease;
}

/* vertical scroll hide */
.table-scroll-wrapper .v-table__wrapper {
  overflow-y: auto;

  /* Firefox */
  scrollbar-width: none;

  /* Edge */
  -ms-overflow-style: none;
}

/* Chrome / Safari */
.table-scroll-wrapper .v-table__wrapper::-webkit-scrollbar {
  display: none;
}
.table-scroll-wrapper {
  height: 400px; /* ya calc(100vh - 250px) */
}


</style>