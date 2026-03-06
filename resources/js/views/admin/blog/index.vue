  <template>
    <user-title-bar title="Blog">
    </user-title-bar>
    <v-container max-width="1400px" class="mx-auto">
      <v-row>
        <v-col cols="12">
          <div class="d-flex  justify-space-between w-100 mt-4">
            <div class="d-flex w-50 ">
              <v-select v-model="filter.length" :items="[100, 500, 1000, 2000]" density="compact" variant="outlined"
                max-width="90px" class="mr-2" />
              <div class="align-self-center pl-2">
                {{ filter.offset + 1 }} - {{ Math.min(filter.offset + filter.length, total) }} of {{ total }} Records
              </div>


            </div>

            <div class="w-50 d-flex">
              <v-text-field density="compact" variant="outlined" clearable v-model="filter.search" label="Search" />

              <v-btn style="height: 44px; margin-left: 10px;" variant="outlined" @click="loadItems" class="mr-2">
                <v-icon icon="mdi-magnify"></v-icon>
              </v-btn>
              <v-btn to="/admin/blog/create" color="primary" style="height: 44px;" variant="flat">
                <v-icon icon="mdi-plus"></v-icon>
              </v-btn>
            </div>

          </div>
        </v-col>
        <v-col cols="12" class="mt-2">
          <div class="border">
            <v-data-table-server :loading="loading" :headers="headers" :items="items" :items-length="total" hover
              item-value="id" @update:options="loadItems">

              <template #item.image_preview="{ item }">
                <img :src="item.image_preview" alt="preview" style="width:80px; height:60px; object-fit:cover" />
              </template>
              <template #item.created_at="{ item }">
               <span>{{ dateFormate(item.created_at) }}</span>
              </template>
              <template #item.updated_at="{ item }">
               <span>{{ dateFormate(item.updated_at) }}</span>
              </template>
              <template #item.category="{ item }">
                <span>{{ item.category?.title || '-' }}</span>
              </template>

              <template #item.author="{ item }">
                <span v-if="item.author">
                  {{ item.author.firstName }} {{ item.author.surname }}
                </span>
                <span v-else>-</span>
              </template>
              

              <template v-slot:bottom>
                <div class="py-2 d-flex justify-end border-t">
                  <custom-pagination :loading="loading" v-model:page="filter.page" :lastPage="last_page"
                    @page-changed="loadItems" />
                </div>
              </template>
              <template #item.action="{ item }">
                <div class="d-flex">
                  <router-link :to="'/admin/blog/edit/' + item.id">
                    <v-icon color="primary" class="editIconHover pa-4">mdi-pencil</v-icon>
                  </router-link>

                  <span class="px-2"></span>

                  <v-icon class="clickable-icon pa-4" color="danger" @click="deleteItem(item.id)">
                    mdi-delete
                  </v-icon>
                </div>
              </template>
            </v-data-table-server>

          </div>

        </v-col>
      </v-row>
    </v-container>

  </template>

<script>
import General from '@/models/general.model';



export default {

  data() {
    return {
      filter: {
        search: null,
        length: 10,
        page: 1,
        offset: 0,
      },
      items: [],
      last_page: 1,
      total: 0,
      loading: false,
      viewDialog: false,
      viewItem: null,
      headers: [
        { title: "id", value: "id" },
        { title: "Image", key: "image_preview" },
        { title: "Category", value: "category", },
        { title: "Title", value: "title" },
        { title: "Created by", value: "author" },
        { title: "Date", value: "date" },
        { title: "Created At", key: "created_at" },
        { title: "Updated At", key: "updated_at" },
        { title: "Action", key: "action" }
      ]
    };
  },
  mounted() {
    this.loadItems()
  },
  computed: {

  },
  watch: {
    'filter.length'(newVal, oldVal) {
      this.filter.page = 1;
      this.loadItems()

    },
    'filter.page'(newVal, oldVal) {
      this.loadItems()
    },


  },
  methods: {
    dateFormate(date) {
      if (!date) return ""
      return date?.split('T')[0].split(' ')[0]
    },
    async loadItems() {
      this.loading = true;
      try {
        let res = await General.get("/api/cruds/blogs", this.filter);
        this.items = res.data;
        this.total = Number(res.recordsTotal);
        this.last_page = Number(res.last_page)
        this.filter.offset = res.offset;
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
        let res = await General.delete("/api/cruds/blogs/"+id);
        this.$alertStore.add(res.message || "deleted", "success");
        this.loadItems();
      } catch (error) {
        console.error(error);
        this.$alertStore.add(error.message || "Delete failed", "error");
      } finally {
        this.loading = false;
      }
    }
  }


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
</style>