  <template>
    <user-title-bar title="Members">
        <div>
                <v-expand-transition>
                    <div class="" >
                        <v-container fluid>
                            <v-row>

                            <!-- <UserCount/> -->
                                <div class="content-scroll d-flex mt-6 w-100 ga-3">
                                    <div 
                                        v-for="item in planCounts" 
                                        :key="item.id"
                                        class="status-card cursor-pointer"
                                        @click="filter.plan_name = item.id"
                                        :class="{ 'status-selected': Number(filter.plan_name) === item.id }"
                                    >
                                        <div class="d-flex justify-space-between">
                                            <div class="d-flex align-center">
                                                <small>{{ item.plan_name }}</small>
                                            </div>
                                            <div class="d-flex align-center">
                                               <HammerIcon/>
                                                <span class="ml-1">{{ item.total_users ?? 0 }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </v-row>
                        </v-container>
                    </div>
                </v-expand-transition>
        </div>
    </user-title-bar>

      <v-container max-width="1400px" >
            <v-row no-gutters class="mt-3">
                <v-col cols="12"  class="d-flex justify-space-between">
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
                    <v-col cols="12" md="6" class="d-flex justify-end align-center ga-2">
                    <UserDropdown
                        v-model="filter.id"
                        variant="outlined"
                        label="User"
                        item-title="firstName"
                        item-value="id"
                        density="compact" 
                        color="primary"
                        clearable
                    />

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
                    
                    <v-text-field 
                        v-model="filter.search" 
                        label="Search..." 
                        variant="outlined" 
                        density="compact"
                        max-width="300px" 
                        clearable />


                    <v-btn to="/admin/members/create" color="primary" height="40" variant="flat">
                        <v-icon icon="mdi-plus" />
                    </v-btn>
                    </v-col>
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


                            <template #item.action="{ item }">
                            <!-- <router-link :to="'/admin/members/edit/' + item.id">
                                <v-icon color="primary" class="editIconHover pa-4" >mdi-pencil</v-icon>
                            </router-link> -->

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
                            <template #item.package_membership_expiry_date="{ item }">
                            <v-btn
                                size="small"
                                :color="
                                getMembershipStatus(item.package_membership_expiry_date) === 'Active'
                                    ? 'primary'
                                    : getMembershipStatus(item.package_membership_expiry_date) === 'Expired'
                                    ? 'error'
                                    : 'secondary'
                                "
                                variant="flat"
                            >
                                {{ getMembershipStatus(item.package_membership_expiry_date) }}
                            </v-btn>
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
import UserDrawer from './component/UserDrawer.vue';
import UserDropdown  from '@/components/UserDropdown.vue';
import UserCount from './component/UserCount.vue';
import HammerIcon from '../taskManagement/component/Icon.vue'

export default {

  components: {
        UserDrawer,
        UserDropdown ,
        UserCount,
        HammerIcon
  },

  data() {
      return {
        viewDrawer: false,
        selectedUser: null,
        planCounts:[],
        viewLoading: false,
            filter: {
                search: null,
                length: 10,
                page: 1,
                offset: 0,
                id:null,
                plan_name:null
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
                { title: "Plan Name", value: "plan_name" },  
                { title: "Membership Status", value: "package_membership_expiry_date" },
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
        'filter.plan_name'(newVal, oldVal) {
            this.loadItems()
        },
        'filter.id'(newVal, oldVal) {
            this.loadItems()
        },
        'filter.Status'(newVal, oldVal) {
            this.loadItems()
        },
        'filter.search'(newVal, oldVal) {
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
                    this.planCounts = res.planCounts;
                    this.total = res.total;
                    // this.filter.page = Number(res.page);
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
        getMembershipStatus(expiryDate) {
            if (!expiryDate) return 'Not Buy Package'

            const now = new Date().getTime()
            const expiry = new Date(expiryDate.replace(' ', 'T')).getTime()

            return expiry > now ? 'Active' : 'Expired'
        }

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

:deep(th) {
  white-space: nowrap !important;
}

.min-select {
  min-width: 150px;
}

.status-card {
  border-radius: 6px;
  padding: 12px;
  width: 17.3%;
  background-color: rgb(var(--v-theme-background));
  border: 1px solid rgb(var(--v-theme-border));
  transition: all 0.2s ease;
}

.status-card:hover {
  border-color: #0080FF;
}

.status-selected {
  border: 2px solid #0080FF;
 
}
</style>