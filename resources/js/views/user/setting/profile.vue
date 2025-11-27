<template>

    <v-col cols="12" >

        <v-card :loading="loading" :disabled="loading" class="border" title="Personal Information" >
            <div class="border-b" ></div>
            <v-card-text>

           
            <v-container fluid>
            <v-row>
                <v-col cols="12">
                        <div class="d-flex align-center" >
                            <div class="pr-2" >
                                <img style="width:100px;height: 100px;" class="border" :src="userStore.user.avatar" />
                            </div>
                            <div class="pl-3 pt-3" >
                                <v-btn color="primary" class=" text-capitalize" variant="flat">Update New Photo</v-btn>
                                <p class="pt-3 text-light text-body-2" >Allowed JPG, GIF or PNG. Max size of 800K</p>
                            </div>
                    </div>
                </v-col>
            </v-row>
            <v-row class="mt-5" >
                <v-col cols="12" >
                     <h2 class="text-body-1 text-light mb-1">User Information</h2>
                </v-col>
                <v-col cols="12" md="4" >
                    <v-text-field 
                        label="First Name"
                        v-model="form.firstName"
                        variant="outlined"
                        color="primary" 
                        density="compact" 
                        clearable />
                    
                </v-col>
                <v-col cols="12" md="4" >
                    <v-text-field 
                        label="Sir Name" 
                        v-model="form.surname"
                        variant="outlined"
                        color="primary" 
                        density="compact" 
                        clearable />
                </v-col>
                <v-col cols="12" md="4" >
                    <v-text-field 
                        label="Job Title" 
                        v-model="form.jobTitle"
                        variant="outlined"
                        color="primary" 
                        density="compact" 
                        clearable />
                </v-col>
                 <v-col cols="12" md="4" >
                    <v-text-field 
                        label="Email" 
                        v-model="form.personalEmail"
                        variant="outlined"
                        color="primary" 
                        density="compact" 
                        clearable />
                </v-col>
            </v-row>
         
            <v-row>
                <v-col cols="12" >
                     <h2 class="text-body-1 text-light mb-1">Company Information</h2>
                </v-col>
                 <v-col cols="12" md="4" >
                    <v-text-field 
                        label="Business Name"
                        v-model="form.companyName"
                        variant="outlined"
                        color="primary" 
                        density="compact" 
                        clearable />
                </v-col>
                <v-col cols="12" md="4" >
                    <v-text-field 
                        label="Business Type"
                        v-model="form.businessType"
                        variant="outlined"
                        color="primary" 
                        density="compact" 
                        clearable />
                </v-col>
                <v-col cols="12" md="4" >
                    <v-text-field 
                        label="Phone Number"
                        v-model="form.phone"
                        variant="outlined"
                        color="primary" 
                        density="compact" 
                        clearable />
                </v-col>
                <v-col cols="12" md="4" >
                    <v-text-field 
                        label="Company Address 1" 
                        v-model="form.companyAddress1"
                        variant="outlined"
                        color="primary" 
                        density="compact" 
                        clearable />
                </v-col>
                    <v-col cols="12" md="4" >
                    <v-text-field 
                        label="Company Address 2"
                        v-model="form.companyAddress2"
                        variant="outlined"
                        color="primary" 
                        density="compact" 
                        clearable />
                </v-col>
                <v-col cols="12" md="4" >
                    <v-text-field 
                        label="City / Town" 
                        v-model="form.townCity"
                        variant="outlined"
                        color="primary" 
                        density="compact" 
                        clearable />
                </v-col>
                <v-col cols="12" md="4" >
                    <v-text-field 
                        label="Country" 
                        v-model="form.country"
                        variant="outlined"
                        color="primary" 
                        density="compact" 
                        clearable />
                </v-col>
                <v-col cols="12" md="4" >
                    <v-text-field 
                        label="Zip Code" 
                        v-model="form.postcode"
                        variant="outlined"
                        color="primary" 
                        density="compact" 
                        clearable />
                </v-col>
                <v-col cols="12" md="4" >
                    <v-text-field 
                        label="Telephone" 
                        v-model="form.telephone"
                        variant="outlined"
                        color="primary" 
                        density="compact" 
                        clearable />
                </v-col>
                <v-col cols="12" md="4" >
                    <v-text-field 
                        label="Website" 
                        v-model="form.website"
                        variant="outlined"
                        color="primary" 
                        density="compact" 
                        clearable />
                </v-col>
                <v-col cols="12" md="4" >
                    <v-text-field 
                        label="Business Email" 
                        v-model="form.businessEmail"
                        variant="outlined"
                        color="primary" 
                        density="compact" 
                        clearable />
                </v-col>
           
                <v-col cols="12" md="4" >
                    <v-text-field 
                        label="Vat Number" 
                        v-model="form.vatNumber"
                        variant="outlined"
                        color="primary" 
                        density="compact" 
                        clearable />
                </v-col>
                <v-col cols="12" md="4" >
                    <v-select 
                        label="Motor Trade Insurance?"
                        :items="['Yes','No']" 
                        v-model="form.motorTradeInsurance"
                        variant="outlined"
                        color="primary" 
                        density="compact" 
                        />
                </v-col>
            </v-row>

            <v-row>
                <v-col cols="12" >
                     <h2 class="text-body-1 text-light mb-1">Proof Information</h2>
                </v-col>
                <v-col cols="12" md="4" >
                    <v-file-input 
                        clearable
                        v-model="form.uploadID" 
                        label="File input" 
                        density="comfortable"
                        variant="outlined" 
                        accept="image/*" 
                        color="primary"
                        prepend-icon="mdi-file"/>
                </v-col>
                <v-col cols="12" md="4" >
                    <v-file-input 
                        clearable
                        v-model="form.motorTradeProof" 
                        label="File input" 
                        density="comfortable"
                        variant="outlined" 
                        accept="image/*" 
                        color="primary"
                        prepend-icon="mdi-file"/>
                </v-col>
                <v-col cols="12" md="4" >
                    <v-file-input 
                        clearable
                        v-model="form.addressProof" 
                        label="File input" 
                        density="comfortable"
                        variant="outlined" 
                        accept="image/*" 
                        color="primary"
                        prepend-icon="mdi-file"/>
                </v-col>
                   
            </v-row>


            <v-row>
                <v-col cols="12">
                    <v-btn @click="onSubmit" class="bg-primary mr-2" variant="flat" >Save Changes</v-btn>
                    <v-btn class="bg-background" variant="flat" >Cancel</v-btn>
                </v-col>
            </v-row>

        </v-container>
         </v-card-text>
        </v-card>
    </v-col>

</template>

<script>
import authService from '@/services/authService';
import { useUserStore } from '@/stores/userStore';
import { toRaw } from 'vue';



export default {
    components: {
     
    },
    data() {
        return {
            userStore: useUserStore(),
            loading:false,
            form: {
                firstName : '',
                surname : '',
                jobTitle: '',
                avatar: '',
                phone: '',
                personalEmail: '',

                companyName:'',
                companyAddress1:'',
                companyAddress2:'',
                businessType:'',
                motorTradeInsurance:'',
                businessEmail: '',
                vatNumber:'',
                telephone:'',
                townCity:'',
                country:'',
                website:'',
                postcode: '',

                uploadID:null,
                motorTradeProof:null,
                addressProof:null,
            }
            
        };
    },
    computed: {
        
    },
    mounted() {

        this.loadDataFromProfile();

    },
    methods: {
        async loadDataFromProfile() {

              this.loading = true;
            authService.getProfile().then((res) => {
                
                let data = res.data.user
                for (const key in this.form) {
                    if (!Object.hasOwn(this.form, key)) continue;
                    const value = this.form[key];

                    if (['uploadID','motorTradeProof','addressProof'].includes(key)) {
                        continue;
                    }

                    if( Object.hasOwn(data, key)) {
                        this.form[key] = data[key];
                    } else {
                        this.form[key] = ''
                    }
                }

                this.loading = false;
                    
            }).catch((error) => {

                 this.loading = false;
            })

              
        },
        onSubmit(){

            // alert('asdasd');
            // this.loading = true;
            // console.log(toRaw(this.form));

            
            
        }
    }
};
</script>