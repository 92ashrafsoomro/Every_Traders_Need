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
                                    <v-text-field readonly="" label="Company Address1" :model-value="user.companyAddress1" variant="outlined"
                                        density="compact" />
                                </v-col>
                                <v-col cols="12" md="4">
                                    <v-text-field readonly="" label="Company Address2" :model-value="user.companyAddress2" variant="outlined"
                                        density="compact" />
                                </v-col>
                                <v-col cols="12" md="4">
                                    <v-text-field readonly="" label="Town/City" :model-value="user.townCity" variant="outlined"
                                        density="compact" />
                                </v-col>
                                <v-col cols="12" md="4">
                                    <v-text-field readonly="" label="Country" :model-value="user.country" variant="outlined"
                                        density="compact" />
                                </v-col>
                                <v-col cols="12" md="4">
                                    <v-text-field readonly="" label="Postcode" :model-value="user.postcode" variant="outlined"
                                        density="compact" />
                                </v-col>
                                <v-col cols="12" md="4">
                                    <v-text-field readonly="" label="Telephone" :model-value="user.telephone" variant="outlined"
                                        density="compact" />
                                </v-col>
                                <v-col cols="12" md="4">
                                    <v-text-field readonly="" label="Phone" :model-value="user.phone" variant="outlined"
                                        density="compact" />
                                </v-col>
                                <v-col cols="12" md="4">
                                    <v-text-field readonly="" label="Business Type" :model-value="user.businessType" variant="outlined"
                                        density="compact" />
                                </v-col>
                                <v-col cols="12" md="4">
                                    <v-text-field readonly="" label="Company Registration" :model-value="user.companyReg" variant="outlined"
                                        density="compact" />
                                </v-col>
                                <v-col cols="12" md="4">
                                    <v-text-field readonly="" label="Company Website" :model-value="user.website" variant="outlined"
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
                            <v-divider></v-divider>

                                <v-row class="pa-4">

                                <v-col cols="12">
                                    <h2 class="text-h6 font-weight-bold mb-1">Transaction History</h2>
                                </v-col>

                                <v-col cols="12" class="mt-2">
                                    <div class="border">
                                        <v-data-table
                                        :loading="loading"
                                        :headers="headers"
                                        :items="items"
                                        item-value="id"
                                        hide-default-footer
                                        >
                                        <template v-slot:item.amount="{ item }">
                                            {{ item.currency }} {{ item.amount }}
                                        </template>
                                        <template v-slot:item.user_name="{ item }">
                                            {{ item.first_name }} {{ item.last_name }}
                                        </template>

                                        <template v-slot:item.payment_date="{ value }">
                                            {{ formatDate(value) }}
                                        </template>
                                        </v-data-table>
                                    </div>
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
            items: [],
            headers: [
                { title: "ID", key: "id", sortable: false },
                { title: "Transaction ID", key: "transaction_id", sortable: false },
                // { title: "Payer ID", key: "payer_id", sortable: false },
                // { title: "Charge Id", key: "charge_id", sortable: false },
                { title: "Name", key: "user_name", sortable: false },
                { title: "Country", key: "country", sortable: false },
                { title: "State", key: "state", sortable: false },
                { title: "City", key: "city", sortable: false },
                { title: "Zip Code", key: "zip_code", sortable: false },
                { title: "Amount", key: "amount", sortable: false },
                { title: "Payment Method", key: "payment_method", sortable: false },
                { title: "Status", key: "payment_status", sortable: false },
                { title: "Payment Date", key: "payment_date", sortable: false },
            ],
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
            const responseData = res.data || {};
            
            this.data = responseData;
            this.planData = responseData.plan || {};
            this.user = responseData.user || {};
            if (responseData.payment) {
            this.items = [responseData.payment]; 
            } else {
                this.items = [];
            }

        } catch (error) {
            console.error("Fetch Error:", error);
            this.items = [];
        } finally {
            this.loading = false;
        }
    },

    }
}
</script>
