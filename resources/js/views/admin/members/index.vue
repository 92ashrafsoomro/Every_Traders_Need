  <template>
    <user-title-bar>
        <div>
            <h1 class="text-h3 mb-2 font-weight-bold">Members </h1>
            <!-- <p class="text-subtitle-1 mb-2 font-weight-medium">Filter, compare, and uncover vehicles that match your profit goals.</p> -->
       
                <v-card-title
                    class="d-flex cursor-pointer widthstatic"
                    @click="showFilters = !showFilters"
                >
                    <span class="text-h6 font-weight-bold">
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
                                            <v-select
                                                v-model="filter.status"
                                                variant="outlined"
                                                label="Status"
                                                :items="statusItems"
                                                item-title="label"
                                                item-value="value"
                                                density="compact"
                                                color="primary"
                                                clearable
                                                />

                                        </v-col>
                                       <v-col cols="4" sm="4" class="pl-2">
                                            <PlansDropDron
                                                v-model="filter.plan_name" 
                                                variant="outlined" 
                                                label="Plan Name"
                                                base-color="white"
                                                density="compact" 
                                                color="primary" 
                                                clearable
                                                persistent-placeholder="" 
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
                    <div class="d-flex flex-wrap ">
                        <div class="d-flex align-center">
                            <v-select 
                                v-model="filter.length" 
                                :items="[100, 500, 1000, 2000]" 
                                density="compact" 
                                variant="outlined"
                                max-width="150px" class="mr-2" 
                                />
                                <div class="align-self-center pl-2">{{ filter.offset }} - {{ Math.min(filter.length, total) }} of {{ total }} Records </div>
                        </div>

                        <v-spacer />

                        <v-text-field 
                            v-model="filter.search" 
                        
                            placeholder="Search..." 
                            variant="outlined" 
                            density="compact"
                            max-width="300px" 
                            clearable />

                        <div class="pl-2" >
                            <v-btn base-color="#bdbdbd" style="height: 44px;" variant="outlined" @click="loadItems">
                                <v-icon icon="mdi-magnify"></v-icon>
                            </v-btn>
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

                            <template #item.status="{ item }">
                                <v-btn
                                size="small"
                                :color="item.status == 1 ? 'primary' : 'error'"
                                variant="flat"
                                @click="toggleStatus(item)"
                                >
                                {{ item.status == 1 ? 'Active' : 'Deactive' }}
                                </v-btn>
                            </template>
                            <template #item.membership_status="{ item }">
                                <v-btn
                                size="small"
                                :color="item.membership_status == 'Active' ? 'primary' : 'error'"
                                variant="flat"
                                >
                                {{ item.membership_status == 'Active' ? 'Active' : 'Expired' }}
                                </v-btn>
                            </template>
                       
                        
                        </v-data-table-server>
                    </div>
                </v-col>
            </v-row>
      </v-container>
    
  </template>

<script>

import Members from '@/models/member.model';
import PlansDropDron from "@components/PlanDropDown.vue"


export default {

  components: {
   PlansDropDron,
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
                // { title: "Action", key: "action" },
                {title:"id",value:"id"},
                { title: "First Name", value: "firstName", sortable: false },
                { title: "Last Name", value: "surname", sortable: false },
                { title: "Company Name", value: "companyName", sortable: false },
                { title: "Personal Email", value: "personalEmail" },
                { title: "Plan Name", value: "plan" },  
                { title: "Phone", value: "phone" },
                { title: "Business Type", value: "businessType" },
                { title: "User role", value: "role_name" },
                { title: "Status", value: "status" },
                { title: "Membership Status", value: "membership_status" },
                {   title: "Membership Expiry", 
                    value: "membership_expiry_date",
                    format: (value) => value ? value.split(' ')[0] : ''


                },
        
            ],
            statusItems: [
                { label: 'Active', value: 1 },
                { label: 'Deactive', value: 0 },
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
                    let res = await  Members.all(this.filter);
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

          async toggleStatus(item) {
                const newStatus = item.status == 1 ? 0 : 1;

                try {
                await Members.changeStatus(item.id, {
                    params: {
                    user_id: item.id,
                    status: newStatus,
                    },
                });
                item.status = newStatus;

                } catch (error) {
                console.error(error);
                alert("Status update failed");
                }
            },



    }
  
};

</script>

<style scoped>
.widthstatic{
    width: 10% !important;
}
</style>