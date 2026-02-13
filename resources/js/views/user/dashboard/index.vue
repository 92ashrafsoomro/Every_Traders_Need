<template>

  <user-title-bar>

    <div class="d-flex flex-column flex-xs-row  flex-md-row  justify-space-between align-start pa-3 ml-lg-n7 "
      style="margin-top: -40px; max-width: 1400px;">
      <div style="max-width: 700px;  " class="">
        <div>
          <h6 class="test-bg text-h5 font-weight-bold">Welcome back , <span class="text-primary">Mr {{userStore.user.firstName}}!</span> </h6>
        </div>
        <div class="pr-5 pb-5">
          <p class="mt-3 text-body-1 pa-2 rounded-lg  text-whiteLite"
            style="background-color: #3399ff20; backdrop-filter: blur(5px)">
       Get a real-time snapshot of today’s auctions, reauctions, and market activity.
          </p>
        </div>
      </div>
      <div>

      </div>
    </div>
  </user-title-bar>

  <div style="max-width: 1400px; " class="mx-auto mb-5 ">
      <v-row no-gutters="" class="ga-5" style="margin-top: -30px;  padding: 0">
        <!-- Total Auctions -->
  
  
        <!-- Total Auctions -->
        <v-col cols="12" sm="6" md="" lg="" class="">
  
          <v-card class="border-bottom border border-sm ">
            <v-container>
  
              <div class="d-flex h-6">
                <div style="background: #0080ff38; border-radius: 22px; width: 40px; height: 40px;"
                  class="circle d-flex justify-center align-center">
                  <v-icon size="22" color="primary">mdi-store-clock</v-icon>
                </div>
  
                <span class="text-h4 px-3">{{ auctionCounter.total_auctions }}</span>
              </div>
  
  
              <div class="pt-3 text-body-1 text-whiteLite ">Total Auctions</div>
              <div class="pt-2 d-flex">
                <div class="text-body-2 pr-2">
                  <span class="white">Live Auctions: </span>
                  <span class=""
                    style="background-color: rgba(var(--v-theme-background)); padding: 8px; border-radius: 4px; ">
                    {{auctionCounter.live_auctions }}</span>
                </div>
                <div class=" text-body-2 pl-2">
                  <span class="white">Time Auctions: </span>
                  <span class=""
                    style="background-color: rgba(var(--v-theme-background)); padding: 8px; border-radius: 4px; "> {{
                      auctionCounter.time_auctions }}</span>
                </div>
              </div>
  
  
            </v-container>
          </v-card>
        </v-col>
        <!-- Total Auctions -->
        <v-col cols="12" sm="6" md="" lg="" class="">
  
          <v-card class="border-bottom-inprogress w-100 border border-sm">
            <v-chip text-color="white" size="small" class="bg-danger position-absolute mt-5 right-0  "
              style="border-radius: 3px 0 0 3px;" label>
              <v-icon size="10" color="white" class="mr-2">
                mdi-circle
              </v-icon> Live
            </v-chip>
            <v-container>
              <div class="d-flex h-6">
                <div class=" bg-danger-lite d-flex justify-center align-center live-circle"
                  style="border-radius: 22px; width: 40px; height: 40px;">
                  <v-icon size="32" color="danger" class="">
                    mdi-radiobox-marked
                  </v-icon>
                </div>
  
                <span class="text-h4 px-3">{{ auctionCounter.in_progressAuctions }}</span>
              </div>
  
              <div class="pt-3 text-body-1 text-whiteLite ">Inprogress Auctions</div>
              <div class="pt-2 d-flex justify-space-between">
                <div class="text-body-2 pr-2">
                  <span class="white">Vehicles:</span>
                  <span class=""
                    style="background-color: rgba(var(--v-theme-background)); padding: 8px; border-radius: 4px; ">
                    {{auctionCounter.vehicles_in_progress_auctions }}</span> 
                    </div>
                <div class="text-body-2">View</div>
  
              </div>
  
  
            </v-container>
          </v-card>
        </v-col>
        <!-- Total Auctions -->
        <v-col cols="12" sm="6" md="" lg="" class="">
  
          <v-card class="border-bottom  border border-sm">
            <v-container>
  
              <div class="d-flex h-6">
                <div style="background: #0080ff38; border-radius: 22px; width: 40px; height: 40px;"
                  class="circle d-flex justify-center align-center">
                  <v-icon size="32" color="primary">mdi-bash</v-icon>
                </div>
                <span class="text-h4 px-3">{{ auctionCounter.total_vehicles }}</span>
              </div>
  
              <div class="pt-3 text-body-1 text-whiteLite ">Total Vehicles</div>
              <div class="pt-2 d-flex">
                <div class="text-body-2 pr-2">
                  <span class="white">Sold:</span>
                  <span class=""
                    style="background-color: rgba(var(--v-theme-background)); padding: 8px; border-radius: 4px; ">
                    {{auctionCounter.sold_vehicles }}</span>
                </div>
              </div>
  
  
            </v-container>
          </v-card>
        </v-col>
  
        <v-col cols="12" sm="6" md="" lg="" class="">
  
          <v-card class="border-bottom  border border-sm ">
            <v-container>
              <div class="d-flex h-6">
                <div style="background: #0080ff38; border-radius: 22px; width: 40px; height: 40px;"
                  class="circle d-flex justify-center align-center">
                  <v-icon size="32" color="primary">mdi-repeat-variant</v-icon>
                </div>
                <span class="text-h4 px-3">{{ auctionCounter.reAuctionVehicles }}</span>
              </div>
  
              <div class="pt-3 text-body-1 text-whiteLite ">Vehicle in reauctions</div>
              <div class="pt-2 d-flex justify-space-between">
                <div class="text-body-2 pr-2">
                  <span class="white">Remaining:</span>
                  <span class=""
                    style="background-color: rgba(var(--v-theme-background)); padding: 8px; border-radius: 4px; ">
                    {{auctionCounter.remainingReAuctionVehicles }}</span>
                  </div>
                  <div class="text-body-2">View</div>
  
              </div>
  
  
            </v-container>
          </v-card>
        </v-col>
      </v-row>
      </div>
  <v-container style="max-width: 1400px; padding: 0 !important;" fluid="" class="mt-5" >



    <v-row no-gutters="" class="ga-5">
      <v-col cols="12" md="6" lg="">
        <!-- <div > -->
        <Auction />
        <!-- </div> -->
      </v-col>

      <!-- Right Column: Vehicle Statistics -->
      <v-col cols="12" md="6" lg="">

        <v-card class="   border  " style="min-height: 490px; max-height: 490px;">
          <div class=" px-4 py-3  ">
            <h3 class="text-h6">Vehicle Statistics</h3>
            <p class=" text-body-2 text-light  ">Today</p>
          </div>
          <div class=" border-b mt-2 "></div>
          <v-card-text class="d-flex flex-column h-100 justify-space-between">
            <v-container fluid="">


              <v-row>
                <v-col cols="12" sm="6" class="ml-n4  ">
                  <div class="pa-3">
                    <div class="">
                      <div class="text-h3 font-weight-bold ">{{vehicelState.remaining_vehicles}}</div>
                      <div class="text-subtitle-2 text-light mb-6">Remaining</div>
                    </div>
                    <div style="margin-top: 50px;" class="">
                      <div class="d-flex h-6 mb-6 ">
                        <div style="background: #0080ff38; border-radius: 22px; width: 40px; height: 40px;"
                          class="circle d-flex justify-center align-center">
                          <v-icon size="20" color="primary">mdi-message-reply-text</v-icon>
                        </div>
                        <div class="pl-3 d-flex align-center">
                          <div class="text-h5 font-weight-bold">
                            {{ vehicelState.inprogress_vehicles }}
                          </div>
                          <div class="text-body-1 text-light_text_on ml-2 ">Provisional</div>
                        </div>
                      </div>
                      <div class="d-flex h-6 mb-6">
                        <div style="background: #0080ff38; border-radius: 22px; width: 40px; height: 40px;"
                          class="circle d-flex justify-center align-center">
                          <v-icon size="20" color="primary">mdi-check-decagram</v-icon>
                        </div>
                        <div class="pl-3 d-flex  align-center">
                          <div class="text-h5 font-weight-bold">{{ vehicelState.vehicelState_sold_vehicles }}</div>
                          <div class="text-body-1 text-light_text_on ml-2 ">Sold</div>
                        </div>
                      </div>

                      <div class="d-flex h-6 mb-3">
                        <div style="background: #0080ff38; border-radius: 22px; width: 40px; height: 40px;"
                          class="circle d-flex justify-center align-center">
                          <v-icon size="20" color="primary">mdi-minus-circle</v-icon>
                        </div>
                        <div class="pl-3 d-flex  align-center">
                          <div class="text-h5 font-weight-bold">{{ vehicelState.vehicelState_notsold_vehicles }}</div>
                          <div class="text-body-1 text-light_text_on ml-2  ">Not Sold</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </v-col>
                <v-col cols="12" sm="6" class="d-flex justify-center justify-sm-start ml-lg-n5" >
                 <VehicleStateChart 
                    :vehicelState="vehicelState" 
                    :doneValue="vehicelState.done_vehicles"
                  />
                                  </v-col>

              </v-row>
            </v-container>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>


  </v-container>

</template>

<script>
import api from '@/plugins/axios';
import VehicleStateChart from '@/views/user/dashboard/VehicleStateChart.vue';
import Auction from './Auction.vue';
import General from '@/models/general.model';
import { useGeneralStore } from '@/stores/generalStore';
import { useUserStore } from '@/stores/userStore';
export default {
  name: 'AuctionDashboard',
  components: {
    VehicleStateChart,
    Auction
  },

  data() {
    return {
      userStore:useUserStore(),
      generalStore : useGeneralStore(),
      onlinePlatform: null,
      timePlatform: null,
      platforms: [],
      isLoading: false,
     
      auctionCounter:{
        total_auctions : 0,
        live_auctions : 0,
        time_auctions:0,
        in_progressAuctions : 0 , 
        vehicles_in_progress_auctions : 0,
        totalVehiclesInProgress : 0 ,
        remaining : 0 , 
        total_vehicles: 0,
        sold_vehicles : 0,
        unsold_vehicles : 0 ,
        reAuctionVehicles : 0 ,
        remainingReAuctionVehicles : 0 ,
        remaining : 0 ,
      },
      vehicelState:
      {
        onsale_vehicles: 2,
        provisional_vehicles: 3,
        vehicelState_sold_vehicles: 5,
        vehicelState_notsold_vehicles: 5,
        done_vehicles : 0,
        inprogress_vehicles:0,
        not_sold: 0,
        remaining_vehicles : 0,
        total_vehicles: 100,
      }
     
    }
  },
  computed: {

  },
  methods: {

    async getCountData() {
      this.isLoading = true;
      try {
         

          let res = await General.get("/api/user/dashboard/counters", this.generalStore.date);

          this.auctionCounter.total_auctions = res.data.total_auctions; //
          this.auctionCounter.live_auctions = res.data.live_auctions; //
          this.auctionCounter.time_auctions = res.data.time_auctions; //
          this.auctionCounter.in_progressAuctions = res.data.in_progress_auction; //
          this.auctionCounter.vehicles_in_progress_auctions = res.data.in_progress_vehicle;
          this.auctionCounter.totalVehiclesInProgress = res.data.in_progress;
          this.auctionCounter.total_vehicles = res.data.total_vehicles; //
          this.auctionCounter.sold_vehicles = res.data.sold_vehicles; //
          this.auctionCounter.unsold_vehicles = res.data.unsold_vehicles;
          this.auctionCounter.reAuctionVehicles = res.data.reAuctionVehicles;
          this.auctionCounter.remainingReAuctionVehicles = res.data.remainingReAuctionVehicles;

        } catch (error) {
        this.isLoading = false;
        console.error(error.message, "counters Api error");
      }
    },

    async getVehicleStates() {
      this.isLoading = true;
     
      try {
     
        let res = await General.get("/api/user/dashboard/vehicleStates", this.generalStore.date);
        this.vehicelState.data = res.data;
        this.vehicelState.inprogress_vehicles = res.data.inprogress_vehicles;
        this.vehicelState.vehicelState_sold_vehicles = res.data.sold_vehicles
        this.vehicelState.vehicelState_notsold_vehicles = res.data.not_sold_vehicles
        this.vehicelState.done_vehicles = res.data.done_vehicles 
        this.vehicelState.total_vehicles = res.data.total_vehicles;
        this.vehicelState.remaining_vehicles = res.data.remaining_vehicles;
        this.isLoading = false;

      } catch (error) {
        console.error(error.message, "vehicleStates Api error");
        this.isLoading = false
      }
    }
  },

  mounted() {
    this.getCountData();
    this.getVehicleStates();
  }


}

</script>

<style scoped>
.bg-primary-darken-1 {
  background-color: #0d1b2a;
}

.blink {
  animation: blinker 1.5s linear infinite;
}

@keyframes blinker {
  50% {
    opacity: 0.4;
  }
}

.border-x {
  border-left: 1px solid rgba(255, 255, 255, 0.12) !important;
  border-right: 1px solid rgba(255, 255, 255, 0.12) !important;
}

.border-l {
  border-left: 1px solid rgba(255, 255, 255, 0.12) !important;
}


.border-bottom {
  border-bottom: 5px solid rgb(var(--v-theme-primary)) !important;
}

.border-bottom-inprogress {
  border-bottom: 5px solid rgb(var(--v-theme-danger)) !important;
}

.live-circle {
  position: relative;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background-color: rgba(255, 0, 0, 0.15);
}

/* animated ring */
.live-circle::before {
  content: "";
  position: absolute;
  inset: 0;
  border-radius: 50%;
  background-color: rgba(255, 0, 0, 0.2);
  animation: pulse-bg 2s infinite ease-in-out;
  z-index: 0;
}


.live-circle>* {
  position: relative;
  z-index: 1;
}

@keyframes pulse-bg {
  0% {
    transform: scale(1);
    opacity: 1;
  }

  50% {
    transform: scale(1.2);
    opacity: 0.10.
  }

  100% {

    transform: scale(1);
    opacity: 0.16.
  }

}
</style>