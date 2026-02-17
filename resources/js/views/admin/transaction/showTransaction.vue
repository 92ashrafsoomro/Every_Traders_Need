<template>
    <v-container max-width="1400px">
        <v-col cols="12" md="12">
            <v-card class="border">
                <div class="d-flex align-center justify-space-between px-4 py-3">
                    <!-- <h3 class="text-h6 font-weight-bold">
                        Edit Role
                    </h3> -->
                    <router-link :to="'/admin/transaction/'">
                        <v-btn variant="text" color="primary" class="text-capitalize">
                            <v-icon start>mdi-arrow-left</v-icon>
                            Back
                        </v-btn>
                    </router-link>
                </div>

                <div class="border-b"></div>
                <v-card-text>
                    <v-container fluid>

                        <v-row >
                            <v-row class="pa-4">

                                <v-col cols="12">
                                    <h2 class="text-h6 font-weight-bold mb-1">User Detail</h2>
                                </v-col>


                                <!-- <v-col cols="12" md="4">
                                    <v-text-field readonly="" label="User Id" :model-value="user.id" variant="outlined"
                                        density="compact" />
                                </v-col> -->
                                <!-- <v-col cols="12" md="4">
                                    <v-text-field readonly="" label="User Status" :model-value="user.status == 1 ? 'Active' : 'Pending'" variant="outlined"
                                        density="compact" />
                                </v-col> -->
                                <v-col cols="12" md="4">
                                    <v-text-field readonly="" label="First Name" :model-value="user.firstName" variant="outlined"
                                        density="compact" />
                                </v-col>
                                <v-col cols="12" md="4">
                                    <v-text-field readonly="" label="Surname" :model-value="user.surname" variant="outlined"
                                        density="compact" />
                                </v-col>
                                <v-col cols="12" md="4">
                                    <v-text-field readonly="" label="Country" :model-value="user.country" variant="outlined"
                                        density="compact" />
                                </v-col>
                                <v-col cols="12" md="4">
                                    <v-text-field readonly="" label="Business Type" :model-value="user.businessType" variant="outlined"
                                        density="compact" />
                                </v-col>
                                <v-col cols="12" md="4">
                                    <v-text-field readonly="" label="Personal Email" :model-value="user.personalEmail" variant="outlined"
                                        density="compact" />
                                </v-col>
                                <v-col cols="12" md="4">
                                    <v-text-field readonly="" label="Source" :model-value="user.source" variant="outlined"
                                        density="compact" />
                                </v-col>


                            </v-row>
                            
                            <v-divider></v-divider>
                            <v-row class="pa-4">
                                <v-col cols="12">
                                    <h2 class="text-h6 font-weight-bold mb-1">Plan Detail</h2>
                                </v-col>
                               
                                <v-col cols="12" md="4">
                                    <v-text-field readonly="" label="Subscription ID" :model-value="data.id" variant="outlined" density="compact" />
                                </v-col>

                                <v-col cols="12" md="4">
                                    <v-text-field readonly="" label="Membership Start Date" :model-value="data.membership_start_date"
                                        variant="outlined" density="compact" />
                                </v-col>

                                <v-col cols="12" md="4">
                                    <v-text-field readonly="" label="Membership Expiry Date" :model-value="formatDate(data.membership_expiry_date)"

                                        variant="outlined" density="compact" />
                                </v-col>

                                <v-col cols="12" md="4">
                                    <v-text-field readonly="" label="Membership Status"  :model-value="data.membership_status == 1 ? 'Active' : 'Pending'"
                                        variant="outlined" density="compact" />
                                </v-col>



                                <v-col cols="12" md="4">
                                    <v-text-field readonly="" label="Package Name" :model-value="data.package_name" variant="outlined"
                                        density="compact" />
                                </v-col>

                                <v-col cols="12" md="4">
                                    <v-text-field readonly="" label="Package Description" :model-value="data.package_description"
                                        variant="outlined" density="compact" />
                                </v-col>

                                <v-col cols="12" md="4">
                                    <v-text-field readonly="" label="Price" :model-value="data.price" variant="outlined"
                                        density="compact" />
                                </v-col>

                                <v-col cols="12" md="4">
                                    <v-text-field readonly="" label="Discount %" :model-value="data.discount" variant="outlined"
                                        density="compact" />
                                </v-col>

                                <v-col cols="12" md="4">
                                    <v-text-field readonly="" label="Total" :model-value="data.total" variant="outlined"
                                        density="compact" />
                                </v-col>
                                  <v-col cols="12" md="4">
                                    <v-text-field readonly="" label="Plan Name" :model-value="planData.plan_name" variant="outlined"
                                        density="compact" />
                                </v-col>

                                <v-col cols="12" md="4">
                                    <v-text-field readonly="" label="Description" :model-value="planData.description" variant="outlined"
                                        density="compact" />
                                </v-col>

                        

                            </v-row>


                        </v-row>

                        <!-- <v-col cols="12" class="text-center mt-4">
                                <v-btn @click="editUser" color="primary" height="40">
                                    Update
                                </v-btn>
                            </v-col> -->


                    </v-container>
                </v-card-text>

            </v-card>
        </v-col>
    </v-container>

</template>

<script>
import General from '@/models/general.model';
export default {

    data() {
        return {
            data: [],
            planData: [],
            user: [],
            loading: false,
        }
    },
    mounted() {
        this.data.id = this.$route.params.id;
        this.fetchSingleRecord();
    },
    methods: {
         formatDate(date) {
    if (!date) return '';
    return date.split(' ')[0];
  },
        async fetchSingleRecord() {
            this.loading = true;
            try {
                let res = await General.get("/api/cruds/memberships/" + this.data.id);
                this.data = res.data || [];
                this.planData = res.data.plan || []
                this.user = res.data.user || []

            } catch (error) {
                console.error(error)
            } finally {
                this.loading = false;
            }
        },

    }
}
</script>
