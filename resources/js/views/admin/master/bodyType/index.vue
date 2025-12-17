  <template>

      <Nav/>
      <v-container max-width="1400px" >
            <v-row no-gutters class="mt-3">
                <v-col cols="12">
                    <div class="d-flex flex-wrap align-center">
                        <div class="d-flex align-center">
                            <v-select 
                                v-model="filter.length" 
                                :items="[10, 25, 50, 100]" 
                                density="compact" 
                                variant="outlined"
                                label="Length"
                                max-width="150px" class="mr-2" 
                                />
                                <div class="align-self-center pl-2">{{ filter.offset }} - {{ Math.min(filter.length, total) }} of {{ total }} Records </div>
                            
                        </div>

                        <v-spacer />

                        <v-text-field 
                            v-model="filter.search" 
                            prepend-inner-icon="mdi-magnify" 
                            placeholder="Search..." 
                            variant="outlined" 
                            density="compact"
                            max-width="300px" 
                            clearable />
                    </div>
                </v-col>

                <v-col cols="12" class="mt-2"  >
                    <div class="border"> 
                        <v-data-table-server 
                            class=""
                            :loading="loading" 
                            :headers="headers" 
                            :items="items" 
                            :items-length="total" 
                            hover
                           
                            item-value="id" 
                            @update:options="loadItems" >

                            <template #item.action="{ item }">
                                <router-link :to="'/admin/bodyType/'">
                                    <v-icon color="light">mdi-pencil</v-icon>
                                </router-link>
                                <span class="px-2" ></span>
                                <router-link :to="'/admin/bodyType/'">
                                    <v-icon color="light" >mdi-delete</v-icon>
                                </router-link>
                            </template>

                            <template v-slot:bottom>
                                <div class="py-2 d-flex justify-end border-t">
                                    <custom-pagination 
                                    :loading="loading" 
                                    v-model:page="filter.page"
                                    :lastPage="last_page" 
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
import BodyType from '@/models/body-type.model';
import Nav from '../nav/Nav.vue';



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
                { title: "ID", value: "id",sortable: false },
                { title: "Title", value: "name" },
                { title: "Created At", value: "date" },
                { title: "Action", key: "action" },
            ],
    };
  },
  mounted() {
    this.loadItems()
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
            this.loadItems()
        }
        
    },
    
     methods: {

    
        async loadItems() {
        
                this.loading = true;
                try {
                    let res = await BodyType.all(this.filter);
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


    }
  
};

</script>

<style scoped>

</style>