<template>
    <v-container max-width="1400px">
        <v-col cols="12" md="12">
            <v-card class="border">
                <div class="d-flex align-center justify-space-between px-4 py-3">
                    <h3 class="text-h6 font-weight-bold">
                        Edit Role
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
                <!-- 
                    <v-col cols="12" md="6">
                    <v-text-field
                        label="ID"
                        v-model="form.id"
                        readonly
                        variant="outlined"
                        density="compact"
                        
                    />
                    </v-col> -->
                    <v-col cols="12" md="6">
                    <v-text-field
                        label="First Name"
                        v-model="form.name"
                        
                        variant="outlined"
                        density="compact"
                        
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
export default {
    
    data(){
        return{
           
            form:{
                id : '',
                name : '',
            },
            loading : false,
        }
    },
   mounted(){
    this.form.id = this.$route.params.id;
    this.fetchSingleRecord();
},
    methods:{
        async fetchSingleRecord(){
            this.loading = true;
            try {
               let res = await General.get("/api/cruds/roles/" + this.form.id);
               console.log(res);
                this.form.name = res.data.name
            } catch (error) {
                console.error(error)
            }finally {
                this.loading = false;
            }
        },
        async editUser(){
            this.loading = true;
            try {
                let res = await General.put("/api/cruds/roles/"+this.form.id , this.form);
                this.$alertStore.add(res.message, 'success');
                this.$router.push("/admin/role")
                
                
            }catch (error) {
                this.$alertStore.add(error.message || 'Some Thing went wrong' , error)
            }finally {
                this.loading = false;
            }
        }
    }
}
</script>