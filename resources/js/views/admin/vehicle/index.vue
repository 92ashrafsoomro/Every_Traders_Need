  <template>
    <user-title-bar title="Vehicle">
        <div>
            <!-- <p class="text-subtitle-1 mb-2 font-weight-medium">Filter, compare, and uncover vehicles that match your profit goals.</p> -->
       
                <v-card-title
                    class="d-flex cursor-pointer widthstatic"
                    @click="showFilters = !showFilters"
                >
                    <span class="text-h6 font-weight-bold ">
                    Filters
                    </span>

                    <v-icon color="primary">
                    {{ showFilters ? 'mdi-chevron-up' : 'mdi-chevron-down' }}
                    </v-icon>
                </v-card-title>
            
                <v-expand-transition>
                    <div v-show="showFilters">
                        <v-container fluid>
                            <v-row>
                                <v-col cols="12">
                                    <v-row cols="12" class="mt-1 text-center">
                                        <v-col cols="4" sm="4" class="pl-2">
                                            <PlateformDropdown label="Select Platform" variant="outlined" color="primary"class="id-box" v-model="filter.platform"
                                            hide-details
                                            clearable
                                            density="comfortable"  />
                                        </v-col>
                                        <v-col cols="4" sm="4" class="pl-2">
                                            <CenterDropdown label="Select Center" variant="outlined" color="primary"class="id-box" v-model="filter.center"
                                            hide-details
                                            clearable
                                            density="comfortable"  />
                                        </v-col>
                                        <v-col cols="4" sm="4" class="pl-2">
                                            <v-select 
                                                v-model="filter.vehicleType" 
                                                variant="outlined" 
                                                label="Auction Type"
                                                :items="['Online','Live']"
                                                base-color="white"
                                                density="comfortable" 
                                                color="primary" 
                                                clearable 
                                                    />
                                        </v-col>
                                

                                    </v-row>
                                    <v-row cols="12" class="mt-1 text-center">
                                        <v-col cols="4" sm="4" class="pl-2">
                                            <MakeDropdown
                                            label="Select Make"
                                            variant="outlined"
                                            color="primary"
                                            class="id-box"
                                            v-model="filter.make"
                                            hide-details
                                            density="comfortable"
                                            clearable
                                            />
                                        </v-col>

                                        <v-col cols="4" sm="4" class="pl-2">
                                            <ModelDropdown
                                            label="Select Model"
                                            variant="outlined"
                                            color="primary"
                                            class="id-box"
                                            v-model="filter.model"
                                            :make="filter.make"
                                            hide-details
                                            density="comfortable"
                                            clearable
                                            />
                                        </v-col>

                                        <v-col cols="4" sm="4" class="pl-2">
                                        <VariantDropdown
                                                label="Select Variant"
                                                variant="outlined"
                                                color="primary"
                                                class="id-box"
                                                v-model="filter.variant"
                                                :model-id="filter.model" 
                                                hide-details
                                                density="comfortable"
                                                clearable
                                                />
                                        </v-col>
                                    </v-row>

                                    <v-row cols="12" class="mt-1 text-center" >
                                            <v-col cols="12" sm="4" class="pl-2">
                                                <v-text-field
                                                v-model="filter.registration"
                                                label="Search Registration"
                                                variant="outlined"
                                                color="primary"
                                                density="comfortable"
                                                hide-details
                                                clearable
                                                />
                                            </v-col>
                                            <v-col cols="12" sm="4" class="pl-2">
                                                <v-text-field
                                                v-model="filter.tableid"
                                                label="Search Auction ID"
                                                variant="outlined"
                                                type="number"
                                                color="primary"
                                                density="comfortable"
                                                hide-details
                                                clearable
                                                />
                                            </v-col>
                                            <v-col cols="12" sm="2" class="pl-2 d-flex align-center">
                                                <v-btn
                                                color="primary"
                                                block
                                                class="mt-sm-0 mt-2"
                                                @click="loadItems"
                                                >
                                                Search
                                                </v-btn>
                                            </v-col>
                                    </v-row>

                    
                                </v-col>
                    
                            </v-row>
                        </v-container>
                    </div>
                </v-expand-transition>
        </div>
    </user-title-bar>

      <v-container max-width="1400px" >
            <v-row no-gutters class="mt-3">
                <v-col cols="12">
                    <div class="d-lg-flex d-md-flex py-4">
                        <div class="d-flex align-center">
                            <v-select 
                                v-model="filter.length" 
                                :items="[100, 500, 1000, 2000]" 
                                density="comfortable" 
                                variant="outlined"
                                max-width="150px" class="mr-2" 
                                />
                                <div class="align-self-center pl-2">{{ filter.offset }} - {{ Math.min(filter.length, total) }} of {{ total }} Records </div>
                        </div>

                        <v-spacer />

                       <div class="d-flex w-lg-75 justify-end">
                         <v-text-field 
                            v-model="filter.search" 
                        
                            label="Search..." 
                            variant="outlined" 
                            density="comfortable"
                            max-width="380px" 
                            clearable />

                        <div class="pl-2" >
                            <v-btn base-color="#bdbdbd" style="height: 44px;" variant="outlined" @click="loadItems">
                                <v-icon icon="mdi-magnify"></v-icon>
                            </v-btn>
                        </div>
                       </div>
                        <!-- <div class="pl-2" >
                            <v-btn to="/admin/make/create" color="primary" style="height: 44px;" variant="flat" @click="loadItems">
                                <v-icon icon="mdi-plus"></v-icon>
                            </v-btn>
                        </div> -->
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

            

                            <template v-slot:bottom>
                                <div class="py-2 d-flex justify-end border-t">
                                    <custom-pagination 
                                    :loading="loading" 
                                    v-model:page="filter.page"
                                    :lastPage="last_page" 
                                    @page-changed="loadItems" />
                                </div>
                            </template>
                        <template #item.id="{ item }">
                            <router-link
                            :to="`vehicle/show/${item.id}`"
                            class="text-primary font-weight-bold text-decoration-none"
                            >
                            {{ item.id }}
                            </router-link>
                        </template>
                        
                        </v-data-table-server>
                    </div>
                </v-col>
            </v-row>
      </v-container>
    
  </template>

<script>

import Vehicle from '@/models/vehicle.model';
import CenterDropdown from "@components/CenterDropdown.vue"
import PlateformDropdown from "@components/PlateformDropdown.vue"
import MakeDropdown from "@components/MakeDropdown.vue"
import ModelDropdown from "@components/ModelDropdown.vue"
import VariantDropdown from "@components/VariantDropDown.vue"

export default {

  components: {
    MakeDropdown,
    CenterDropdown,
    PlateformDropdown,
    ModelDropdown,
    VariantDropdown,
  },

  data() {
      return {
        showFilters: false,
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
                { title: "#", value: "id", sortable: false },
                { title: "Reg", value: "reg" },  
                { title: "Make", value: "make_name" },
                { title: "Model", value: "model_name" },
                { title: "Variant", value: "variant_name" },
                { title: "Year", value: "year" },
                { title: "Vehicle", value: "vehicle_name" },
                { title: "Body", value: "body_name" },
                { title: "Center", value: "center_name" },
                { title: "Bidding Status", value: "bidding_status" },  
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
                    let res = await  Vehicle.all(this.filter);
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