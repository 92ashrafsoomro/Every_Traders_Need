<template>

    <custom-card title="Current Plan" class="bg-surface" >
        <v-container>
            <div class="d-flex  flex-wrap justify-space-between" >
                <div class="py-3" >
                        <div class="mb-3" >
                            <p class="text-h6" >Your Current Plan is "Free"</p>
                            <p class="text-body-2" style="color:rgb(var(--v-theme-light))" >For small dealers.</p>
                        </div>
                        <div>
                            <p class="text-h6" >Active until 2025-12-07 11:52:44</p>
                            <p class="text-body-2 font-weight-thin" style="color:rgb(var(--v-theme-light))" >We will send you a notification upon Subscription expiration</p>
                        </div>
                        
                </div>
                <div class="py-3 px-3" >

                    <div class="d-flex align-center  rounded-lg px-5 mb-3 py-1" style="background-color: #504448;" >
                         <p class="px-1 py-1 rounded bg-warning">
                            <v-icon color="white" icon="mdi-alert" />
                         </p>
                        <div class="pl-3 py-3"  >
                            <h6 class="text-h5 text-warning font-weight-bold " >We need your attention!</h6>
                            <p class="text-body-2 text-warning" >Your plan requires update</p>
                        </div>
                        
                    </div>


                    
                    <div class="w-100" >
                        <p class="d-flex justify-space-between" >
                            <span class="text-h6" >Days</span>
                            <span class="text-h6" >16 of 30 Days</span>
                        </p>
                        <div class="py-3" style="width:300px" >
                             <v-progress-linear height="7" color="warning" model-value="20"></v-progress-linear>
                        </div>
                        <p class="text-body-2" style="color:rgb(var(--v-theme-light))" >16 days remaining until your plan requires update</p>
                    </div>
                    

                </div>
            </div>
        </v-container>
    </custom-card>
  

</template>
<script>
 import { useUserStore } from '@/stores/userStore';
 import { usePageStore } from '@/stores/pageStore';

 export default {
    components: {

    },
    data() {
        return {
            userStore: useUserStore(),
            pageStore: usePageStore(),
        };
    },
    computed: {

    },
    mounted() {

      
    },
    methods: {
        loadDataFromProfile() {
      
        }
    }
};
</script>
