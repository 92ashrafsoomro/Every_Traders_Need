<template>
    <v-container max-width="1400px">
        <v-col cols="12" md="12">
            <v-card class="border">
                <div class="d-flex align-center justify-space-between px-4 py-3">
                    <h3 class="text-h6 font-weight-bold">
                        Create Staffs
                    </h3>
                    <router-link :to="'/admin/stafUser/'">
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
                                <v-text-field label="First Name" v-model="form.firstName" variant="outlined"
                                    density="compact" hide-details class="id-box" />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-text-field label="Email" v-model="form.personalEmail" variant="outlined"
                                density="compact" hide-details class="id-box" />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-text-field label="Job Title" v-model="form.jobTitle" variant="outlined"
                                density="compact" hide-details class="id-box" />
                            </v-col>
                            <v-col cols="12" md="6">
                               <v-text-field label="Phone" v-model="form.phone" variant="outlined"
                                   density="compact" hide-details class="id-box" />
                           </v-col>
                            <v-col cols="12" md="6">
                                <v-text-field label="Password" v-model="form.password" variant="outlined"
                                    density="compact" hide-details class="id-box" type="password" />
                            </v-col>
                            <v-col cols="12" md="6">
                                <UserTypeDropDown label="User Role" 
                                    v-model="form.user_type"
                                    variant="outlined"
                                    item-title="name"
                                    item-value="id"
                                    density="compact"
                                     hide-details 
                                     class="id-box" />
                            </v-col>
                             <v-col cols="12" md="6">
                                <v-select
                                    :items="statusItems"
                                    label="Status"
                                    v-model="form.status"
                                    item-title="value"
                                    item-value="id"
                                    variant="outlined"
                                    density="compact"
                                    hide-details
                                    />
                            </v-col>
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
import UserTypeDropDown from '@/components/UserTypeDropDown.vue';
export default {
    components:{
        UserTypeDropDown
    },
    data() {
        return {
             statusItems: [
                { value: 'Active', id: 1 },
                { value: 'Pending', id: 0 },
                ],
            form: {
                id: '',
                firstName: '',
                personalEmail: '',
                user_type: '',
                jobTitle: '',
                phone:'',
                password: '',
                status: ''
            },
            loading: false,
        }
    },
    methods: {
        async createUser() {
            this.loading = true;
            try {
                let res = await General.post("/api/cruds/staffs", this.form);
                this.$alertStore.add(res.message, 'success');
                this.form.id = '',
                    this.form.firstName = '',
                    this.form.personalEmail = '',
                    this.form.user_type = '',
                    this.form.role_name = '',
                    this.form.phone = '',
                    this.form.jobTitle = '',
                    this.form.password = '',
                    this.form.status = ''
            } catch (error) {
                this.$alertStore.add(error.message || 'Some Thing went wrong', error)
            } finally {
                this.loading = false;
            }
        }
    }
}
</script>