<template>
    <v-container max-width="1400px">
        <v-col cols="12" md="12">
            <v-card class="border">
                <div class="d-flex align-center justify-space-between px-4 py-3">
                    <h3 class="text-h6 font-weight-bold">
                        Create Transaction
                    </h3>
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
                            <!-- <v-col cols="12" md="6">
                                <v-text-field label="Name" v-model="form.name" variant="outlined"
                                    density="compact" hide-details class="id-box" />
                            </v-col> -->
                            <!-- <v-col cols="12" md="6">
                                <v-select v-model="form.membership_status"
                                    :items="[{ value: 0, text: 'Pending' }, { value: 1, text: 'Active' }]"
                                    label="Membership Status" variant="outlined" density="comfortable" item-title="text"
                                    item-value="value" hide-details />
                            </v-col> -->
                            <v-col cols="12" md="6">
                                <UserDropdown
                                    v-model="form.user_id"
                                       variant="outlined"
                                        label="User"
                                        item-title="firstName"
                                        item-value="id"
                                        density="compact" 
                                        color="primary"
                                        clearable
                                />    
                            </v-col>
                            
                            <v-col cols="12" md="6">
                           <v-select
                            v-model="form.package_id"
                                :items="packages"
                                 :item-title="item => `${item.plan_name} (${item.duration_value} ${item.duration_unit})`"
                                     item-value="id"
                                 density="compact" 
                                variant="outlined"
                                label="Select Package"
                            />



                            </v-col>
                            <v-card v-if="selectedPackage" class="mt-4 pa-4">
                            <div class="text-h6 font-weight-bold">{{ selectedPackage.plan_name }}</div>
                            <div>{{ selectedPackage.short_desc }}</div>
                            <div>Price: £{{ selectedPackage.price }}</div>
                            <div>Duration: {{ selectedPackage.duration_value }} {{ selectedPackage.duration_unit }}</div>
                            </v-card>

                            <v-col cols="12" class="text-center mt-4">
                                <v-btn @click="createUser" color="primary" height="40">
                                    create
                                </v-btn>
                            </v-col>

                        </v-row>
                    </v-container>
                </v-card-text>

            </v-card>
        </v-col>
    </v-container>

</template>

<script>
import General from '@/models/general.model';
import UserDropdown  from '@/components/UserDropdown.vue';
export default {
    components: {
        UserDropdown
    },
    data() {
        return {

            form: {
                id: '',
                // membership_status: '',
                package_id: '',
                user_id: ''
            },
            packages: [],
            selectedPackage: null,
            loading: false,
        }
    },
    mounted() {
        this.getPackages()
    },
    watch: {
        'form.package_id'(id) {
            this.selectedPackage = this.packages.find(p => p.id === id);
        }
    },

    methods: {
       async getPackages() {
            this.loading = true;
            try {
                let res = await General.get("/api/cruds/packages");
                this.packages = res.data.filter(p => p.status === 1);
                
                if (this.packages.length) {
                    this.form.package_id = this.packages[0].id;
                }
            } catch (error) {
                this.$alertStore.add(error.message || 'Something went wrong', 'error')
            } finally {
                this.loading = false;
            }
        },
        async createUser() {
            this.loading = true;
        //     const options = {
            
        //         user_id: this.form.user_id,
        //     package_id: this.selectedPackage.id, 
        //     membership_status: this.form.membership_status,
            
        // };
            try {
                let res = await General.post("/api/cruds/memberships", this.form);
                this.$alertStore.add(res.message, 'success');
                this.$router.push('/admin/transaction')
            } catch (error) {
                this.$alertStore.add(error.message || 'Some Thing went wrong', error)
            } finally {
                this.loading = false;
            }
        },
    }
}
</script>