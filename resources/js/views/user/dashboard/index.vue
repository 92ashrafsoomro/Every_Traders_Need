<template>

  <user-title-bar>

    <div class="d-flex flex-column flex-xs-row  flex-md-row  justify-space-between align-start pa-3  "
      style="margin-top: -40px; max-width: 1400px;">
      <div style="max-width: 700px;  " class="">
        <div>
          <h6 class="test-bg text-h5 font-weight-bold">Welcome back , <span class="text-primary">Mr Shan!</span> </h6>
        </div>
        <div class="pr-5 pb-5">
          <p class="mt-3 text-body-1 pa-2 rounded-lg  text-whiteLite"
            style="background-color: #3399ff20; backdrop-filter: blur(5px)">
            Choose The best Plain For Your Need
          </p>
        </div>
      </div>
      <div>

      </div>
    </div>
  </user-title-bar>

  <v-container fluid class="" style="max-width: 1400px;">

    <v-row style="margin-top: -60px;">
      <!-- Total Auctions -->


      <!-- Total Auctions -->
      <v-col cols="12" sm="6" md="3" class="">

        <v-card class="border-bottom border border-sm">
          <v-container>

            <div class="d-flex h-6">
              <div style="background: #0080ff38; border-radius: 22px; width: 40px; height: 40px;"
                class="circle d-flex justify-center align-center">
                <v-icon size="22" color="primary">mdi-store-clock</v-icon>
              </div>

              <span class="text-h4 px-3">{{ counter.total_Auctions }}</span>
            </div>


            <div class="pt-3 text-body-1 text-whiteLite ">Total Auctions</div>
            <div class="pt-2 d-flex">
              <div class="text-body-2 pr-2">
                <span class="white">Live Auctions: </span>
                <span class=""
                  style="background-color: rgba(var(--v-theme-background)); padding: 8px; border-radius: 4px; ">{{
                    counter.liveAuctions }}</span>
              </div>
              <div class=" text-body-2 pl-2">
                <span class="white">Time Auctions: </span>
                <span class=""
                  style="background-color: rgba(var(--v-theme-background)); padding: 8px; border-radius: 4px; "> {{
                    counter.timeAuctions }}</span>
              </div>
            </div>


          </v-container>
        </v-card>
      </v-col>
      <!-- Total Auctions -->
      <v-col cols="12" sm="6" md="3" class="">

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

              <span class="text-h4 px-3">{{ counter.total_Auctions }}</span>
            </div>

            <div class="pt-3 text-body-1 text-whiteLite ">Inprogress Auctions</div>
            <div class="pt-2 d-flex justify-space-between">
              <div class="text-body-2 pr-2">
                <span class="white">Inprogress Auctions: </span>
                <span class="" style="background-color: rgba(var(--v-theme-background)); padding: 8px; border-radius: 4px; ">{{counter.inprogress_Auctions }}</span>
              </div>
              <div class="text-body-2">View</div>

            </div>


          </v-container>
        </v-card>
      </v-col>
      <!-- Total Auctions -->
      <v-col cols="12" sm="6" md="3" class="">

        <v-card class="border-bottom  border border-sm">
          <v-container>

            <div class="d-flex h-6">
              <div style="background: #0080ff38; border-radius: 22px; width: 40px; height: 40px;"
                class="circle d-flex justify-center align-center">
                <v-icon size="32" color="primary">mdi-bash</v-icon>
              </div>
              <span class="text-h4 px-3">{{ counter.totalVehicles }}</span>
            </div>

            <div class="pt-3 text-body-1 text-whiteLite ">Total Vehicles</div>
            <div class="pt-2 d-flex">
              <div class="text-body-2 pr-2">
                <span class="white">Total Vehicles:</span>
                <span class=""
                  style="background-color: rgba(var(--v-theme-background)); padding: 8px; border-radius: 4px; ">{{
                    counter.totalVehicles }}</span>
              </div>
            </div>


          </v-container>
        </v-card>
      </v-col>

      <v-col cols="12" sm="6" md="3" class="">

        <v-card class="border-bottom  border border-sm">
          <v-container>
            <div class="d-flex h-6">
              <div style="background: #0080ff38; border-radius: 22px; width: 40px; height: 40px;"
                class="circle d-flex justify-center align-center">
                <v-icon size="32" color="primary">mdi-repeat-variant</v-icon>
              </div>
              <span class="text-h4 px-3">{{ counter.vehicleReauctions }}</span>
            </div>

            <div class="pt-3 text-body-1 text-whiteLite ">Vehicle in reauctions</div>
            <div class="pt-2 d-flex">
              <div class="text-body-2 pr-2">
                <span class="white">Vehicles:</span>
                <span class=""
                  style="background-color: rgba(var(--v-theme-background)); padding: 8px; border-radius: 4px; ">{{
                    counter.vehicleReauctions }}</span>
              </div>

            </div>


          </v-container>
        </v-card>
      </v-col>
    </v-row>

    <v-container />


    <v-row>

      <!-- Auction Columns -->
      <v-col>
        <!-- <div > -->
        <Auction />
        <!-- </div> -->
      </v-col>

      <!-- Right Column: Vehicle Statistics -->
      <v-col cols="12" md="6">

        <v-card class="   border  ">
          <div class=" pa-6  ">
            <h3 class="text-h6">Vehicle Statistics</h3>
            <p class=" text-body-2 text-light  ">Today</p>
          </div>
          <div class=" border-b mt-2 "></div>
          <v-card-text class="d-flex flex-column h-100 justify-space-between">
            <v-container>


              <v-row>
                <v-col cols="12" sm="6" class="ml-n4  ">
                  <div class="pa-3">
                    <div class="">
                      <div class="text-h3 font-weight-bold ">254</div>
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
                          <div class="text-h5 font-weight-bold">{{ vehicelState.sold_vehicles }}</div>
                          <div class="text-body-1 text-light_text_on ml-2 ">Sold</div>
                        </div>
                      </div>

                      <div class="d-flex h-6 mb-3">
                        <div style="background: #0080ff38; border-radius: 22px; width: 40px; height: 40px;"
                          class="circle d-flex justify-center align-center">
                          <v-icon size="20" color="primary">mdi-minus-circle</v-icon>
                        </div>
                        <div class="pl-3 d-flex  align-center">
                          <div class="text-h5 font-weight-bold">{{ vehicelState.not_sold }}</div>
                          <div class="text-body-1 text-light_text_on ml-2  ">Not Sold</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </v-col>
                <v-col cols="12" sm="6" class="d-flex justify-center justify-sm-start ml-lg-n5">
                  <VehicleStateChart :vehicelState="vehicelState" />
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
export default {
  name: 'AuctionDashboard',
  components: {
    VehicleStateChart,
    Auction
  },

  data() {
    return {
      onlinePlatform: null,
      timePlatform: null,
      platforms: [],


      counter: {
        total_Auctions: 1,
        liveAuctions: 2,
        timeAuctions: 3,
        inprogress_Auctions: 4,
        totalVehicles: 5,
        vehicleReauctions: 6,
        isLoading: false
      },
      vehicelState:
      {
        isLoading: false,
        onsale_vehicles: 2,
        provisional_vehicles: 3,
        sold_vehicles: 5,
        not_sold: 0,
        total_vehicles: 100,
      }

    }
  },
  computed: {

  },
  methods: {

    async getCountData() {
      this.counter.isLoading = true;
      try {

        let res = await api.get("/api/user/dashboard/counters");
        this.counter.total_Auctions = res.data.data.total_auctions;
        this.counter.inprogress_Auctions = res.data.data.vehicles_in_progress_auctions;
        this.counter.totalVehicles = res.data.data.total_vehicles;
        this.counter.vehicleReauctions = res.data.data.vehicles_in_reauction
        this.counter.isLoading = false;

      } catch (error) {
        this.counter.isLoading = false;
        console.error(error.message, "counters Api error");
      }
    },

    async getVehicleStates() {
      this.vehicelState.isLoading = true;
      try {
        let res = await api.get("/api/user/dashboard/vehicleStates");
        this.vehicelState.inprogress_vehicles = res.data.data.inprogress_vehicles;
        this.vehicelState.sold_vehicles = res.data.data.sold_vehicles


        this.vehicelState.data = res.data.data;
        this.vehicelState.isLoading = false;
        this.vehicelState.total_vehicles = res.data.data.total_vehicles;

      } catch (error) {
        console.error(error.message, "vehicleStates Api error");
        this.timeAutions.isLoading = false
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