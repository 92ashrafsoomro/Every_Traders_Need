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

                        <v-row class="pa-4">
                            <v-row>

                                <v-col cols="12">
                                    <h2 class="text-h6 font-weight-bold mb-1">User Detail</h2>
                                </v-col>


                                <v-col cols="12" md="6">
                                    <v-text-field readonly="" label="User Id" v-model="user.id" variant="outlined"
                                        density="compact" />
                                </v-col>
                                <v-col cols="12" md="6">
                                    <v-text-field readonly="" label="User Status" v-model="user.status" variant="outlined"
                                        density="compact" />
                                </v-col>
                                <v-col cols="12" md="6">
                                    <v-text-field readonly="" label="Business Type" v-model="user.businessType" variant="outlined"
                                        density="compact" />
                                </v-col>
                                <v-col cols="12" md="6">
                                    <v-text-field readonly="" label="Personal Email" v-model="user.personalEmail" variant="outlined"
                                        density="compact" />
                                </v-col>
                                <v-col cols="12" md="6">
                                    <v-text-field readonly="" label="Source" v-model="user.source" variant="outlined"
                                        density="compact" />
                                </v-col>


                            </v-row>
                            
                            
                            <v-row>
                                <v-col cols="12">
                                    <h2 class="text-h6 font-weight-bold mb-1">Transaction Detail</h2>
                                </v-col>
                                <v-divider />
                                <v-col cols="12" md="6">
                                    <v-text-field readonly="" label="Transaction ID" v-model="data.id" variant="outlined" density="compact" />
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field readonly="" label="User Id" v-model="data.user_id" variant="outlined"
                                        density="compact" />
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field readonly="" label="Plan Id" v-model="data.plan_id" variant="outlined"
                                        density="compact" />
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field readonly="" label="Membership Start Date" v-model="data.membership_start_date"
                                        variant="outlined" density="compact" />
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field readonly="" label="Membership Expiry Date" v-model="data.membership_expiry_date"
                                        variant="outlined" density="compact" />
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field readonly="" label="Membership Status" v-model="data.membership_status"
                                        variant="outlined" density="compact" />
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field readonly="" label="Join Date" v-model="data.join_date" variant="outlined"
                                        density="compact" />
                                </v-col>

                                <!-- <v-col cols="12" md="6">
                                    <v-text-field readonly="" label="Created At" v-model="data.created_at" variant="outlined"
                                        density="compact" />
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field readonly="" label="Updated At" v-model="data.updated_at" variant="outlined"
                                        density="compact" />
                                </v-col> -->

                                <v-col cols="12" md="6">
                                    <v-text-field readonly="" label="Package Name" v-model="data.package_name" variant="outlined"
                                        density="compact" />
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field readonly="" label="Package Description" v-model="data.package_description"
                                        variant="outlined" density="compact" />
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field readonly="" label="Price" v-model="data.price" variant="outlined"
                                        density="compact" />
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field readonly="" label="Discount" v-model="data.discount" variant="outlined"
                                        density="compact" />
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field readonly="" label="Total" v-model="data.total" variant="outlined"
                                        density="compact" />
                                </v-col>
                            </v-row>


                            <v-row>
                                <v-col cols="12">
                                    <h2 class="text-h6 font-weight-bold mb-1">Plan Detail</h2>
                                </v-col>
                                <v-divider />
                                <v-col cols="12" md="6">
                                    <v-text-field readonly="" label="Plan Name" v-model="planData.plan_name" variant="outlined"
                                        density="compact" />
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field readonly="" label="Description" v-model="planData.description" variant="outlined"
                                        density="compact" />
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field readonly="" label="Sort" v-model="planData.sort_by" variant="outlined"
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
