<template>
    <v-container fluid>
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
                                <h6 class="pb-3 text-h4 font-weight-bold">Shan Khan</h6>
                                <div class="d-flex" >
                                    <div class="px-2" > <v-icon icon="mdi-eye"/> <span>Full Stack Developer</span></div>
                                    <div class="px-2" > <v-icon icon="mdi-eye"/> <span>United Kingdom Karachi</span></div>
                                    <div class="px-2" > <v-icon icon="mdi-eye"/> <span>Joined 10 Apr 2025</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                 </custom-card> 
            </v-col>
            <v-col cols="12" sm="4" >    
                <Sidebar/>
            </v-col>
            <v-col cols="4" sm="8">
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