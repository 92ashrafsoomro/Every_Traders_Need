<template>
    <v-col cols="12">

        <v-card title="Change Password" class="bg-surface">
             <div class="border" ></div>
            <v-container fluid>

                <v-row>
                    <v-col cols="12" md="6">
                        <v-text-field 
                            append-inner-icon="mdi-eye" 
                            label="Current Password"
                            v-model="form.current_password" 
                            :type="toggle_password ? 'text' : 'password'"
                            @click:append-inner="toggle_password = !toggle_password" 
                            variant="outlined" 
                            color="primary"
                            density="compact" />

                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" md="6">
                        <v-text-field append-inner-icon="mdi-eye" label="New Password" v-model="form.new_password"
                            :type="toggle_new_password ? 'text' : 'password'"
                            @click:append-inner="toggle_new_password = !toggle_new_password" variant="outlined"
                            color="primary" density="compact" />

                    </v-col>
                    <v-col cols="12" md="6">
                        <v-text-field append-inner-icon="mdi-eye" label="Confirm New Password"
                            v-model="form.confirm_password" :type="toggle_confirm_Password ? 'text' : 'password'"
                            @click:append-inner="toggle_confirm_Password = !toggle_confirm_Password" variant="outlined"
                            color="primary" density="compact" />
                    </v-col>

                    <v-col cols="12">
                        <h4 class="text-h6 font-weight-thin">Password Requirements:</h4>
                        <ul class="pt-2 ml-5 text-body-2 font-weight-thin">
                            <li class="py-1">Minimum 8 characters long - the more, the better</li>
                            <li class="py-1">At least one lowercase character</li>
                            <li class="py-1">At least one number, symbol, or whitespace character</li>
                        </ul>

                        <div class="my-3">
                            <v-btn @click="formSubmit" class="bg-primary mr-2" variant="flat">Save Changes</v-btn>
                        </div>

                    </v-col>
                </v-row>
            </v-container>
        </v-card>
    </v-col>

    <v-col cols="12">

        <RecentDevices/>
    </v-col>
</template>
<script>
import { changPassword } from '@/services/authService';
import RecentDevices from './RecentDevices.vue';

export default {
    components: {
        RecentDevices,
    },
    data() {
        return {
            toggle_password: true,
            toggle_new_password: true,
            toggle_confirm_Password: true,
            loading: false,
            form: {
                current_password:'',
                new_password: '',
                confirm_password:'',
            }
        };
    },
    computed: {

    },
    mounted() {
    },
    methods: {
   
        async formSubmit() {
            try {
                let res = await changPassword({
                    current_password: this.form.current_password,
                    new_password: this.form.new_password,
                    new_password_confirmation: this.form.confirm_password
                });
                
                this.$alertStore.add("Password Changed", 'success');
                this.form.current_password = '';
                this.form.new_password = '';
                this.form.confirm_password = '';


            } catch (error) {
                this.$alertStore.add(error.message, 'error');
          
            }
        }
    }
};
</script>
