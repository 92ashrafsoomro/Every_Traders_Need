<template>
 <v-row no-gutters="" class="ga-2">
            <!-- Total Task -->
            <v-col cols="12" sm="6" md="3" lg="4" class="">
                <v-card class="border-bottom border border-sm w-100 h-100 border border-sm">
                    <v-container>

                        <div class="d-flex h-6">
                            <div style="background: #0080ff38; border-radius: 22px; width: 40px; height: 40px;"
                                class="circle d-flex justify-center align-center">
                                <v-icon size="22" color="primary">mdi-store-clock</v-icon>
                            </div>

                            <span class="text-h4 px-3">{{ total_user }}</span>
                        </div>


                        <div class="pt-3 text-body-1 text-whiteLite ">Total User</div>
                        <!-- <div class="pt-2 d-flex">
                            <div class="text-body-2 pr-2">
                                <span class="white">Live Auctions: </span>
                                <span class="" style="background-color: rgba(var(--v-theme-background)); padding: 8px; border-radius: 4px; ">
                                    </span> </div>
                            <div class=" text-body-2 pl-2">
                                <span class="white">Time Auctions: </span>
                                <span class=""
                                    style="background-color: rgba(var(--v-theme-background)); padding: 8px; border-radius: 4px; ">        
                                0
                            </span>
                            </div>
                        </div> -->


                    </v-container>
                </v-card>
            </v-col>
            <!-- Pending Task -->
            <v-col cols="12" sm="6" md="3" lg="4" class="">

                <v-card class="border-bottom-inprogress w-100 h-100 border border-sm">
                    <v-container>
                        <div class="d-flex h-6">
                            <div class=" bg-danger-lite d-flex justify-center align-center live-circle"
                                style="border-radius: 22px; width: 40px; height: 40px;">
                                <v-icon size="32" color="danger" class="">
                                    mdi-radiobox-marked
                                </v-icon>
                            </div>

                            <span class="text-h4 px-3">{{ total_active }}</span>
                        </div>

                        <div class="pt-3 text-body-1 text-whiteLite ">Total Active</div>
                       <div class="pt-2 d-flex">
                            <div class="text-body-2 pr-2">
                                <span class="white">Paid User: </span>
                                <span class="" style="background-color: rgba(var(--v-theme-background)); padding: 8px; border-radius: 4px; ">
                                {{ paid_user }}   
                                </span> </div>
                            <div class=" text-body-2 pl-2">
                                <span class="white">Free User: </span>
                                <span class=""
                                    style="background-color: rgba(var(--v-theme-background)); padding: 8px; border-radius: 4px; ">
                                    {{ free_user }}     
                                </span>
                            </div>
                        </div>


                    </v-container>
                </v-card>
            </v-col>
            </v-row>

</template>

<script>
import General from '@/models/general.model';

export default {

    data(){
        return{
            total_user : 0 ,
            total_active : 0 ,
            paid_user : 0,
            free_user : 0 ,
            loading: false
        }
    },
    mounted () {
        this.getUserCount()
    },
    methods:{
        async getUserCount(){
                try {      
                       this.loading = true          
                       let res = await General.get("/api/user/dashboard/counters");
                       console.log(res);
                       this.total_user = res.data.total_vehicles;
                       this.total_active = res.data.total_auctions;
                       this.paid_user = res.data.vehicles_in_reauction;
                        this.free_user = res.data.unsold_vehicles;
                } catch (error) {
                    console.error(error)
                }finally{
                    this.loading = false
                }
        }
    }
}
</script>