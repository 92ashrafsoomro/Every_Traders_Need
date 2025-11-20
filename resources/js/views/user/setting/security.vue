<template>
    

    <v-card variant="outlined" class="bg-surface" >
            <v-container>

            <v-row>
                <v-col cols="12" >
                    <h3 class="text-h5 font-medium">Change Password</h3>
                </v-col>
            </v-row>
            <v-row>
                    <v-col cols="12" md="6" >
                        <v-text-field
                            append-inner-icon="mdi-eye" 
                            label="Current Password"
                            v-model="form.current_password"
                            variant="outlined"
                            color="primary" 
                            density="compact" 
                            clearable />
                        
                    </v-col>
            </v-row>
            <v-row>
                <v-col cols="12" md="6" >
                    <v-text-field
                        append-inner-icon="mdi-eye" 
                        label="New Password"
                        v-model="form.new_password"
                        variant="outlined"
                        color="primary" 
                        density="compact" 
                        clearable />
                    
                </v-col>
                <v-col cols="12" md="6" >
                    <v-text-field
                        append-inner-icon="mdi-eye" 
                        label="Confirm New Password" 
                        v-model="form.confirm_password"
                        variant="outlined"
                        color="primary" 
                        density="compact" 
                        clearable />
                </v-col>

                <v-col cols="12">
                    <h4 class="text-h6 font-weight-thin" >Password Requirements:</h4>
                    <ul class="pt-2 ml-5 text-body-2 font-weight-thin" >
                        <li class="py-1" >Minimum 8 characters long - the more, the better</li>
                        <li class="py-1">At least one lowercase character</li>
                        <li class="py-1">At least one number, symbol, or whitespace character</li>
                    </ul>
                    
                    <div class="my-3" >
                        <v-btn class="bg-primary mr-2" variant="flat" >Save Changes</v-btn>
                    </div>
                    
                </v-col>
            </v-row>
        </v-container>
    </v-card>
    



    
</template>

<script>
import { useUserStore } from '@/stores/userStore';



export default {
    components: {
     
    },
    data() {
        return {
            userStore: useUserStore(),
            loading:false,
            form: {
                current_password: '',
                new_password: '',
                confirm_password: '',
                
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