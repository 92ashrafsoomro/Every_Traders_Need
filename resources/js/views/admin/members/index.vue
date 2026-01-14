  <template>
    <user-title-bar title="Members">
        <div>
                <v-expand-transition>
                    <div class="" >
                        <v-container fluid>
                            <v-row>
                                <v-col cols="12">
                                    <v-row cols="12" class="mt-1 text-center content-scroll">
                                       <v-col cols="4" sm="" class="pl-2">
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
                                       <v-col cols="4" sm="3" class="pl-2">
                                            <PlansDropDron
                                                v-model="filter.plan_name" 
                                                variant="outlined" 
                                                label="Plan Name"
                                                base-color="white"
                                                 density="compact"  
                                                color="primary" 
                                                clearable
                                                  
                                                    />
                                        </v-col>
                                       <v-col cols="4" sm="4" class="pl-2">
                                            <v-text-field 
                                                v-model="filter.search"  
                                                 label="Search"
                                                variant="outlined" 
                                                  
                                                 density="compact" 
                                                clearable />
                                        </v-col>
                                        <v-col cols="3" sm="2" class="pl-2 d-flex align-center">
                                                <div class="pl-2" >
                                                    <v-btn base-color="#bdbdbd" style="height: 44px;" variant="outlined" @click="loadItems">
                                                        <v-icon icon="mdi-magnify"></v-icon>
                                                    </v-btn>
                                                </div>

                                                <div class="pl-2" >
                                                    <v-btn to="/admin/members/create" 
                                                        color="primary" 
                                                        style="height: 
                                                        44px;" variant="flat" 
                                                    >
                                                        <v-icon icon="mdi-plus"></v-icon>
                                                    </v-btn>
                                                </div>
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

                            <template #item.action="{ item }">
                            <router-link :to="'/admin/members/edit/' + item.id">
                                <v-icon color="primary" class="editIconHover pa-4" >mdi-pencil</v-icon>
                            </router-link>

                            <span class="px-2"></span>
                            <v-icon
                                color="info"
                                class="clickable-icon pa-4" 
                                  @click="openView(item.id)"
                            >
                                mdi-eye
                            </v-icon>

                            <span class="px-2"></span>

                            <v-icon
                               
                                class="clickable-icon pa-4" color="danger"
                                @click="deleteItem(item.id)"
                            >
                                mdi-delete
                            </v-icon>
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
                            <template #item.company="{ item }">
                                <div class="d-flex flex-column">
                                <span class="font-weight-medium">
                                    {{ item.companyName }} 
                                </span>

                                <span class="text-caption text-grey">
                                    {{ item.businessType }}
                                </span>
                                </div>
                            </template>

                            
                        </v-data-table-server>
                    </div>
                </v-col>
            </v-row>
      </v-container>


    <UserDrawer
      :viewDrawer.sync="viewDrawer"
      :selectedUser="selectedUser"
      :viewLoading="viewLoading"
      @update:viewDrawer="viewDrawer = $event"
 
    />





  </template>

<script>

import Members from '@/models/member.model';
import PlansDropDron from "@components/PlanDropDown.vue"
import UserDrawer  from './component/UserDrawer.vue';

export default {

  components: {
   PlansDropDron,UserDrawer 
  },

  data() {
      return {
        viewDrawer: false,
        selectedUser: null,
        viewLoading: false,
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
                
                {title:"id",value:"id"},
                { title: "User", value: "user",},
                { title: "Company & Business Type", value: "company", sortable: false },
                { title: "Status", value: "status" },
                { title: "Plan Name", value: "plan" },  
                { title: "Membership Status", value: "membership_status" },
                { title: "Action", key: "action" },
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
                    this.total = res.total;
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
        async deleteItem(id) {
             if (!confirm("Are you sure you want to delete this item?")) return;
            this.loading = true;
            try {
            const res = await Members.delete(id);
      
            this.$alertStore.add(res.message || "Member deleted", "success");
            this.loadItems(); 
            
        } catch (error) {
            console.error(error);
            this.$alertStore.add(error.message || "Delete failed", "error");
            } finally {
            this.loading = false;
            }
        }, 
        async openView(id) {
            this.viewDrawer = true;
            this.viewLoading = true;
            this.selectedUser = null;

            try {
                const res = await Members.show(id);
                this.selectedUser = res.data;
            } catch (error) {
                console.error(error);
                this.$alertStore?.add("Failed to load user details", "error");
                this.viewDrawer = false;
            } finally {
                this.viewLoading = false;
            }
        },

    }
  
};

</script>

<style scoped>
.widthstatic{
    width: 10% !important;
}
.v-list-item__content{
    display: flex !important;
  justify-content: space-between !important;
}
</style>