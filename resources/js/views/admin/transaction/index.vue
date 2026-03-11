  <template>
    <user-title-bar title="Transaction History">
        <div>
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
                                                v-model="filter.plan_id" 
                                                variant="outlined" 
                                                label="Plan Name"
                                                base-color="white"
                                                density="compact" 
                                                color="primary" 
                                                clearable
                                                  
                                                    />
                                        </v-col>
                                        <v-col cols="6" sm="4">
                                            <v-select
                                            v-model="filter.year"
                                            :items="years"
                                            label="Select Year"
                                            variant="outlined"
                                            density="compact"
                                            clearable
                                            />
                                        </v-col>
                                

                                        </v-row>

                                    <v-row>
                                        <v-col cols="6" sm="4">
                                            <v-select
                                            v-model="filter.month"
                                            :items="months"
                                            label="Select Month"
                                            variant="outlined"
                                            density="compact"
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
                                density="compact" 
                                variant="outlined"
                                max-width="150px" class="mr-2" 
                                />
                                <div class="align-self-center pl-2">{{ filter.offset }} - {{ Math.min(filter.length, total) }} of {{ total }} Records </div>
                        </div>

                        <v-spacer />

                        <div class="w-lg-75 mt-2 mt-lg-0 mt-md-0 d-flex justify-end">
                            <v-text-field 
                                v-model="filter.search" 
                            
                                label="Search..." 
                                variant="outlined" 
                                density="compact"
                                max-width="400px" 
                                clearable />

                        <div class="pl-2" >
                            <v-btn base-color="#bdbdbd" style="height: 40px;" variant="outlined" @click="loadItems">
                                <v-icon icon="mdi-magnify"></v-icon>
                            </v-btn>
                        </div>
                          <div class="pl-2" >
                            <v-btn to="/admin/transaction/create" color="primary" style="height: 40px;" variant="flat" @click="loadItems">
                                <v-icon icon="mdi-plus"></v-icon>
                            </v-btn>
                        </div>
                        </div>
                       
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

                            <template #item.membership_status="{ item }">
                                <v-btn :color="item.membership_status == 0 ? 'warning':'primary'" size="small" variant="flat"  class="cursor-text">
                                        {{ item.membership_status == 0 ? 'De Active' : 'Active' }}
                                </v-btn>
                            </template>
                              <template #item.user="{ item }">
                                <div class="d-flex flex-column">
                                <span class="font-weight-medium">
                                    {{ item.firstName }} {{ item.surname }}
                                </span>

                                <span class="text-caption text-grey">
                                    {{ item.personalEmail }}
                                </span>
                                </div>
                            </template>

                            <template #item.membership_start_date="{ item }">
                                {{ item.membership_start_date?.split(' ')[0] }}
                            </template>

                            <template #item.membership_expiry_date="{ item }">
                                {{ item.membership_expiry_date?.split(' ')[0] }}
                            </template>
                      <template #item.created_at="{ item }">
                        {{ item.created_at ? new Date(item.created_at).toISOString().split('T')[0] : '' }}
                        </template>
                  
                            <template #item.action="{ item }">
                                
                            <router-link :to="'/admin/transaction/showTransaction/' + item.id" >
                                <v-icon color="info" class="pa-4" >
                                   mdi-eye
                                </v-icon>
                            </router-link>
                            <v-icon
                            color="info"
                            class="pa-4"
                            @click="downloadPdf(item.id)"
                            >
                            mdi-download
                            </v-icon>
                            
                        </template>
                        <!-- @click="showDialog = true" -->
                            <!-- <v-dialog  v-model="showDialog">
                                <template v-slot:default="{isActive}">
                                       <v-btn icon="mdi-close" variant="flat" @click="isActive.value = false"
                                            style="position: absolute; z-index: 1; right: 0;"></v-btn>
                                        <ShowInvoice/>
                                </template>
                            </v-dialog> -->
                  
                       
                        
                        </v-data-table-server>
                    </div>
                </v-col>
            </v-row>
      </v-container>
    
  </template>

<script>
import Subscriptions from '@/models/subscriptions.model';
import PlansDropDron from "@components/PlanDropDown.vue"
import ShowInvoice from './showInvoice.vue';
import General from '@/models/general.model';
export default {

  components: {
   PlansDropDron,
   ShowInvoice
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
            showDialog: false,
            last_page: 1,
            items: [],
            total: 0,
            loading: true,
            headers: [
                // { title: "Action", key: "action" },
                {title:"id",value:"id", sortable: false},
                { title: "User", value: "user" },
                { title: "Company Name", value: "companyName", sortable: false },
                { title: "Plan Name", value: "plan" },  
                // { title: "Type", value: "membership_type" },
                { title: "Status", value: "membership_status" },
                {   title: "Membership Start Date", 
                    value: "membership_start_date",
                    format: (value) => value ? value.split(' ')[0] : ''
                },
                {   title: "Membership Expiry Date", 
                    value: "membership_expiry_date",
                    format: (value) => value ? value.split(' ')[0] : ''
                },
                {   title: "Created At", 
                    value: "created_at",
                format: (value) => value ? new Date(value).toISOString().split('T')[0] : ''
                },
                {
                    title:"Action",
                    value: 'action'
                },
        
            ],
            statusItems: [
                { label: 'Active', value: "Active" },
                { label: 'Inactive', value: "Inactive" },
                { label: 'Pending', value: "Pending" },
                { label: 'Expried', value: "Expired" },
            ],
                  months: [
                { title: "January", value: 1 },
                { title: "February", value: 2 },
                { title: "March", value: 3 },
                { title: "April", value: 4 },
                { title: "May", value: 5 },
                { title: "June", value: 6 },
                { title: "July", value: 7 },
                { title: "August", value: 8 },
                { title: "September", value: 9 },
                { title: "October", value: 10 },
                { title: "November", value: 11 },
                { title: "December", value: 12 },
      ],
   
    };
  },
  mounted() {
    this.loadItems()
  },
  computed: {
    years() {
      const currentYear = new Date().getFullYear();
      const startYear = 2000;

      return Array.from(
        { length: currentYear - startYear + 1 },
        (_, i) => currentYear - i
      );
    },
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
                    let res = await  Subscriptions.all(this.filter);
                    this.items = res.data;
                    this.total = res.total;
                    // this.filter.page = Number(res.page);
                    this.last_page = Number(res.last_page);
                    this.loading = false
                   
                } catch (error) {
                    alert(error)
                    this.loading = false
                }
        },

        getStatusColor(status) {
            switch (status) {
            case "Active":
                return "primary";
            case "Inactive":
                return "grey";
            case "Pending":
                return "warning";
            case "Expired":
                return "error";
            default:
                return "default";
            }
        },

    async downloadPdf(id) {
        this.loading = true;
        try {
            
            const response = await General.pdf(`/api/user/billing/${id}`, {}, {
                responseType: "blob" 
            });
            const blob = new Blob([response.data], { type: 'application/pdf' });
            
            const url = window.URL.createObjectURL(blob);
            const link = document.createElement("a");
            link.href = url;
            link.setAttribute("download", `invoice-${id}.pdf`);
            
            document.body.appendChild(link);
            link.click();
            
            // Cleanup
            link.remove();
            window.URL.revokeObjectURL(url);
            this.loading = false;
        } catch (error) {
            console.error("PDF Download error:", error);
            this.loading = false;
        }
    }


    }
  
};

</script>

<style scoped>

</style>