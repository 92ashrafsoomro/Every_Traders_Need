<template>

    <v-container>
        <v-row>
            <v-col cols="12" >
                <h3 class="text-h5 font-medium" >Personal Information</h3>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12">
                <div style="max-width: 170px;" >
                    <img class="border w-100" :src="userStore.user.avatar" />
                </div>
                <div class="pt-3" >
                    <v-btn class="bg-background" variant="flat">Update New Photo</v-btn>
                </div>
                
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" md="6" >
                <v-text-field 
                    label="First Name"
                    v-model="form.firstName"
                    variant="outlined"
                    color="primary" 
                    density="compact" 
                    clearable />
                
            </v-col>
            <v-col cols="12" md="6" >
                <v-text-field 
                    label="Sir Name" 
                    v-model="form.surname"
                    variant="outlined"
                    color="primary" 
                    density="compact" 
                    clearable />
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" md="6" >
                <v-text-field 
                    label="Title" 
                    v-model="form.title"
                    variant="outlined"
                    color="primary" 
                    density="compact" 
                    clearable />
                
            </v-col>
            <v-col cols="12" md="6" >
                <v-text-field 
                    label="Job Title" 
                    v-model="form.jobTitle"
                    variant="outlined"
                    color="primary" 
                    density="compact" 
                    clearable />
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" >
                <h3 class="text-h5 font-medium">Company Details</h3>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" md="6" >
                <v-text-field 
                    label="Phone Number"
                    v-model="form.phone"
                    variant="outlined"
                    color="primary" 
                    density="compact" 
                    clearable />
            </v-col>
            <v-col cols="12" md="6" >
                <v-text-field 
                    label="Company Address 1" 
                    v-model="form.companyAddress1"
                    variant="outlined"
                    color="primary" 
                    density="compact" 
                    clearable />
            </v-col>
                <v-col cols="12" md="6" >
                <v-text-field 
                    label="Company Address 2"
                    v-model="form.companyAddress2"
                    variant="outlined"
                    color="primary" 
                    density="compact" 
                    clearable />
            </v-col>
            <v-col cols="12" md="6" >
                <v-text-field 
                    label="City / Town" 
                    v-model="form.townCity"
                    variant="outlined"
                    color="primary" 
                    density="compact" 
                    clearable />
            </v-col>
            <v-col cols="12" md="6" >
                <v-text-field 
                    label="Country" 
                    v-model="form.country"
                    variant="outlined"
                    color="primary" 
                    density="compact" 
                    clearable />
            </v-col>
            <v-col cols="12" md="6" >
                <v-text-field 
                    label="Zip Code" 
                    v-model="form.postcode"
                    variant="outlined"
                    color="primary" 
                    density="compact" 
                    clearable />
            </v-col>
            <v-col cols="12" md="6" >
                <v-text-field 
                    label="Telephone" 
                    v-model="form.telephone"
                    variant="outlined"
                    color="primary" 
                    density="compact" 
                    clearable />
            </v-col>
            <v-col cols="12" md="6" >
                <v-text-field 
                    label="Website" 
                    v-model="form.website"
                    variant="outlined"
                    color="primary" 
                    density="compact" 
                    clearable />
            </v-col>
            <v-col cols="12" md="6" >
                <v-text-field 
                    label="Business Email" 
                    v-model="form.businessEmail"
                    variant="outlined"
                    color="primary" 
                    density="compact" 
                    clearable />
            </v-col>
            <v-col cols="12" md="6" >
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
            <v-col cols="12">
                <v-btn class="bg-primary mr-2" variant="flat" >Save Changes</v-btn>
                <v-btn class="bg-background" variant="flat" >Cancel</v-btn>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
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
                title : '',
                jobTitle: '',
                avatar: '',
                phone: '',

                companyName:'',
                companyAddress1:'',
                companyAddress2:'',
                businessType:'',
                motorTradeInsurance:'',
                businessEmail:'',
                
                telephone:'',
                townCity:'',
                country:'',
                website:'',
                postcode:'',
            }
            
        };
    },
    computed: {
        
    },
    mounted() {

        this.loadDataFromProfile();
    },
    methods: {
        loadDataFromProfile() {
            for (const key in this.form) {
                if (!Object.hasOwn(this.form, key)) continue;
                const value = this.form[key];

                if( Object.hasOwn(this.userStore.user, key)) {
                     this.form[key] = this.userStore.user[key];
                } else {
                    this.form[key] = ''
                }
            }
        }
    }
};
</script>