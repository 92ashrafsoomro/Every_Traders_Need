<template>
    <v-container max-width="1300px" fluid>
        <v-row class="">
            <v-col cols="12" >
                 <custom-card>
                    <div class="py-5 d-flex align-end  flex-wrap">
                        <div class="px-5">
                            <div style="max-width: 150px" >
                                <img class="w-100" :src="userStore.user.avatar" />
                            </div>
                        </div>
                        <div class="" >
                            <div class="pl-3" >
                                <h6 class="pb-3 text-h4 font-weight-bold">{{ userStore.user.firstName }}</h6>
                                <div class="d-flex" >
                                    
                                    <div class="px-2" > <v-icon icon="mdi-equalizer"/> <span>{{ userStore.user.companyName }}</span></div>
                                    <div class="px-2" > <v-icon icon="mdi-briefcase-outline"/> <span>{{ userStore.user.jobTitle }}</span></div>
                                    <div class="px-2" > <v-icon icon="mdi-lightning-bolt"/> <span>Active Plan</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                 </custom-card> 
            </v-col>
            <v-col cols="12" sm="5" >    
                <Sidebar/>
            </v-col>
            <v-col cols="4" sm="7">
                <RecentDevices/>    
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import { useUserStore } from '@/stores/userStore';
import RecentDevices from './RecentDevices.vue';
import Sidebar from './Sidebar.vue';


export default {
    components: {
    RecentDevices,
    Sidebar
    },
    data() {
        return {
          userStore: useUserStore(),
        };
    },

    computed: {
       
    },
};
</script>



<style>



</style>