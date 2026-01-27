<template>
    <v-container max-width="1400px">
        <v-col cols="12" md="12">
            <v-card class="border">
                <div class="d-flex align-center justify-space-between px-4 py-3">
                    <h3 class="text-h6 font-weight-bold">
                        Create Staf
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
                <!-- 
                    <v-col cols="12" md="6">
                    <v-text-field
                        label="ID"
                        v-model="form.id"
                        readonly
                        variant="outlined"
                        density="compact"
                        hide-details
                        class="id-box"
                    />
                    </v-col> -->
                    <v-col cols="12" md="6">
                    <v-text-field
                        label="First Name"
                        v-model="form.firstName"
                        
                        variant="outlined"
                        density="compact"
                        hide-details
                        class="id-box"
                    />
                    </v-col>
                    <v-col cols="12" md="6">
                    <v-text-field
                        label="Email"
                        v-model="form.personalEmail"
                        
                        variant="outlined"
                        density="compact"
                        hide-details
                        class="id-box"
                    />
                    </v-col>
                    <v-col cols="12" md="6">
                    <v-text-field
                        label="User Type"
                        v-model="form.user_type"
                        
                        variant="outlined"
                        density="compact"
                        hide-details
                        class="id-box"
                    />
                    </v-col>
                    <v-col cols="12" md="6">
                    <v-text-field
                        label="Job Title"
                        v-model="form.jobTitle"
                        
                        variant="outlined"
                        density="compact"
                        hide-details
                        class="id-box"
                    />
                    </v-col>
                    <v-col cols="12" md="6">
                    <v-text-field
                        label="Password"
                        v-model="form.password"
                        
                        variant="outlined"
                        density="compact"
                        hide-details
                        class="id-box"
                    />
                    </v-col>
                    <v-col cols="12" md="6">
                    <v-text-field
                        label="Status"
                        v-model="form.status"
                        
                        variant="outlined"
                        density="compact"
                        hide-details
                        class="id-box"
                    />
                    </v-col>
                      <v-col cols="12" class="text-center mt-4">
                        <v-btn
                        @click="editUser"
                        color="primary"
                        height="40"
                        >
                      Update
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
import { useUserStafStore } from './userStafStore';
export default {
    data(){
        return{
            stafStore : useUserStafStore(),
            form:{
                id : '',
                firstName : '',
                personalEmail : '',
                user_type : '',
                jobTitle : '',
                password : '',
                status : ''
            },
            loading : false,
        }
    },
    mounted(){
       
        this.form.id = this.$route.params.id
        this.fetchSignleRecord()
    },
    methods:{
        async fetchSignleRecord(){
            this.loading = true;
            try {
                const res = await this.stafStore.getSingleRecord(this.form.id);
                this.form.id = res.id
                this.form.firstName = res.firstName
                this.form.personalEmail = res.personalEmail
                this.form.user_type = res.user_type
                this.form.jobTitle = res.jobTitle
                this.form.jobTitle = res.password
                this.form.jobTitle = res.status
            } catch (error) {
                  this.$alertStore.add(error.message || 'Some Thing went wrong' , error)
            }
        },
        async editUser(){
            this.loading = true;
            try {
                let res = await General.put("/api/cruds/staffs/"+this.form.id , this.form);
                this.$alertStore.add(res.message, 'success');
                this.$router.push("/admin/stafUser")
                
                
            }catch (error) {
                this.$alertStore.add(error.message || 'Some Thing went wrong' , error)
            }finally {
                this.loading = false;
            }
        }
    }
}
</script>