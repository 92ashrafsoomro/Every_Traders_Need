<template>
    <v-container max-width="1400px">
        <v-col cols="12" md="12">
            <v-card class="border">
                <div class="d-flex align-center justify-space-between px-4 py-3">
                    <!-- <h3 class="text-h6 font-weight-bold">
                        Edit Role
                    </h3> -->
                    <router-link :to="'/admin/role/'">
                        <v-btn variant="text" color="primary" class="text-capitalize">
                            <v-icon start>mdi-arrow-left</v-icon>
                            Back
                        </v-btn>
                    </router-link>
                </div>

                <div class="border-b"></div>
                <v-card-text>
                    <v-container fluid>
                   
                            <v-row>
                                <v-col cols="12" md="6">
                                    <v-text-field label="ID" v-model="data.id" variant="outlined" density="compact" />
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field label="User Id" v-model="data.user_id" variant="outlined"
                                        density="compact" />
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field label="Plan Id" v-model="data.plan_id" variant="outlined"
                                        density="compact" />
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field label="Membership Start Date" v-model="data.membership_start_date"
                                        variant="outlined" density="compact" />
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field label="Membership Expiry Date" v-model="data.membership_expiry_date"
                                        variant="outlined" density="compact" />
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field label="Membership Status" v-model="data.membership_status"
                                        variant="outlined" density="compact" />
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field label="Join Date" v-model="data.join_date" variant="outlined"
                                        density="compact" />
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field label="Created At" v-model="data.created_at" variant="outlined"
                                        density="compact" />
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field label="Updated At" v-model="data.updated_at" variant="outlined"
                                        density="compact" />
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field label="Package Name" v-model="data.package_name" variant="outlined"
                                        density="compact" />
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field label="Package Description" v-model="data.package_description"
                                        variant="outlined" density="compact" />
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field label="Price" v-model="data.price" variant="outlined"
                                        density="compact" />
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field label="Discount" v-model="data.discount" variant="outlined"
                                        density="compact" />
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field label="Total" v-model="data.total" variant="outlined"
                                        density="compact" />
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field label="First Name" v-model="data.firstName" variant="outlined"
                                        density="compact" />
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field label="Surname" v-model="data.surname" variant="outlined"
                                        density="compact" />
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field label="Phone" v-model="data.phone" variant="outlined"
                                        density="compact" />
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field label="Business Type" v-model="data.businessType" variant="outlined"
                                        density="compact" />
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field label="Role Name" v-model="data.role_name" variant="outlined"
                                        density="compact" />
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field label="Company Name" v-model="data.companyName" variant="outlined"
                                        density="compact" />
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field label="User Type" v-model="data.user_type" variant="outlined"
                                        density="compact" />
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field label="Personal Email" v-model="data.personalEmail" variant="outlined"
                                        density="compact" />
                                </v-col>
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
            data : [],
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
               
            } catch (error) {
                console.error(error)
            } finally {
                this.loading = false;
            }
        },

    }
}
</script>

<!-- "id": 83,
        "user_id": 58,
        "plan_id": 3,
        "membership_start_date": "2026-02-17 11:06:05",
        "membership_expiry_date": "2027-02-17 11:06:05",
        "membership_status": "Active",
        "join_date": "2026-02-17 16:06:05",
        "created_at": "2026-02-17T11:06:05.000000Z",
        "updated_at": "2026-02-17T11:06:05.000000Z",
        "package_name": "Trader Elite",
        "package_description": null,
        "price": "179.00",
        "discount": "50",
        "total": "229",
        "plan": {
            "id": 3,
            "plan_name": "Trader Elite",
            "description": null,
            "sort_by": 0,
            "created_at": "2026-02-16T19:58:39.000000Z",
            "updated_at": "2026-02-16T19:58:39.000000Z"
        }
    } -->