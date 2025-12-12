<template>

  <user-title-bar>

    <div class="d-flex flex-column flex-xs-row flex-md-row ml-n10 justify-space-between align-start pa-3">
      <div style="max-width: 600px;">
        <div>
          <h6 class="test-bg text-h5 font-weight-bold">Welcome back , <span class="text-primary">Mr Shan!</span> </h6>
        </div>
        <div class="pr-5 pb-5">
          <p class="mt-3 text-body-1 text-light ">
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quisquam excepturi distinctio cum numquam minima
            porro tempore possimus a, id voluptates totam, inventore vitae unde cupiditate perspiciatis quidem dolor ab
            sequi.
          </p>
        </div>
      </div>
      <div>
        <v-card max-width="500px" class="bg-primary rounded p-6">
          <v-card-text>
            <div class="d-flex flex-sm-wrap align-center ">
              <div class="pa-3" style="max-width: 300px;">
                <h6 class="text-h6 font-weight-bold">Refer & Earn</h6>
                <p class="text-body-1 text-background font-weight-bold">Use Refer & Earn modal to encourage your exiting
                  customers refer their friends & colleague.</p>
              </div>
              <div style="max-width: 300px;" class="pa-3">
                <div class="dot-box"
                  style="width: 100px; height: 50px; background-color: rgba(0, 0, 0, 0.466); border-radius: 8px;display: flex;align-items: center;justify-content: center;margin-left: 10px; ">
                  <div class="dot" style=" width: 30px;  height: 30px; background-color: black;  border-radius: 4px;">
                  </div>
                </div>
              </div>
            </div>
          </v-card-text>
        </v-card>
      </div>
    </div>
  </user-title-bar>

  <v-container fluid class="" style="max-width: 1590px;">

    <v-row class="mt-1">
      <!-- Total Auctions -->


      <!-- Total Auctions -->
      <v-col cols="12" sm="6" md="3" class="">

        <v-card class="border-bottom w-100 border border-md" style="padding: 15px;">
          <v-container>

            <div class="d-flex h-6">
              <div style="background: #0080ff38; border-radius: 22px; width: 40px; height: 40px;"
                class="circle d-flex justify-center align-center">
                <v-icon size="22" color="primary">mdi-store-clock</v-icon>
              </div>

              <span class="text-h4 px-3">{{ counter.total_Auctions }}</span>
            </div>


            <div class="pt-3 text-body-1 text-light ">Total Auctions</div>
            <div class="pt-2 d-flex">
              <div class="text-body-2 pr-2">
                <span style="color: #76778e;">Live Auctions: </span>
                <span class="ml-2">{{ counter.liveAuctions }}</span>
              </div>
              <div class=" text-body-2 pl-2">
                <span style="color: #76778e;">Time Auctions: </span>
                <span class="ml-2"> {{ counter.timeAuctions }}</span>
              </div>
            </div>


          </v-container>
        </v-card>
      </v-col>
      <!-- Total Auctions -->
      <v-col cols="12" sm="6" md="3" class="">

        <v-card class="border-bottom w-100 border border-md" style="padding: 15px;">
          <v-container>
            <div class="d-flex h-6">
              <div style="border-radius: 22px; width: 40px; height: 40px;"
                class="bg-danger-lite circle d-flex justify-center align-center">
                <v-icon size="32" color="danger">mdi-radiobox-marked</v-icon>
              </div>
              <span class="text-h4 px-3">{{ counter.total_Auctions }}</span>
            </div>

            <div class="pt-3 text-body-1 text-light ">Inprogress Auctions</div>
            <div class="pt-2 d-flex">
              <div class="text-body-2 pr-2">
                <span style="color: #76778e;">Inprogress Auctions: </span>
                <span class="ml-2">{{ counter.inprogress_Auctions }}</span>
              </div>

            </div>


          </v-container>
        </v-card>
      </v-col>
      <!-- Total Auctions -->
      <v-col cols="12" sm="6" md="3" class="">

        <v-card class="border-bottom w-100 border border-md" style="padding: 15px;">
          <v-container>

            <div class="d-flex h-6">
              <div style="background: #0080ff38; border-radius: 22px; width: 40px; height: 40px;"
                class="circle d-flex justify-center align-center">
                <v-icon size="32" color="primary">mdi-bash</v-icon>
              </div>
              <span class="text-h4 px-3">{{ counter.totalVehicles }}</span>
            </div>

            <div class="pt-3 text-body-1 text-light ">Total Vehicles</div>
            <div class="pt-2 d-flex">
              <div class="text-body-2 pr-2">
                <span style="color: #76778e;">Total Vehicles:</span>
                <span class="ml-2">{{ counter.totalVehicles }}</span>
              </div>
            </div>


          </v-container>
        </v-card>
      </v-col>

      <v-col cols="12" sm="6" md="3" class="">

        <v-card class="border-bottom w-100 border border-md" style="padding: 15px;">
          <v-container>
            <div class="d-flex h-6">
              <div style="background: #0080ff38; border-radius: 22px; width: 40px; height: 40px;"
                class="circle d-flex justify-center align-center">
                <v-icon size="32" color="primary">mdi-repeat-variant</v-icon>
              </div>
              <span class="text-h4 px-3">{{ counter.vehicleReauctions }}</span>
            </div>

            <div class="pt-3 text-body-1 text-light ">Vehicle in reauctions</div>
            <div class="pt-2 d-flex">
              <div class="text-body-2 pr-2">
                <span style="color: #76778e;">Vehicles:</span>
                <span class="ml-2">{{ counter.vehicleReauctions }}</span>
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
        <Auction/>
      </v-col>

      <!-- Right Column: Vehicle Statistics -->
      <v-col cols="12" md="6">

        <v-card title="Vehicle Statistics" subtitle="Today" class="pa-4">
          <v-card-text class="d-flex flex-column h-100 justify-space-between">
            <v-container>


              <v-row>
                <v-col cols="12" sm="6" class="ml-n4">
                  <div>
                    <div class="text-h3 font-weight-bold ">254</div>
                    <div class="text-body-2 text-light mb-6">Remaining</div>
                  </div>
                  <div>
                    <div class="d-flex h-6 mb-3">
                      <div style="background: #0080ff38; border-radius: 22px; width: 40px; height: 40px;"
                        class="circle d-flex justify-center align-center">
                        <v-icon size="32" color="primary">mdi-update</v-icon>
                      </div>
                      <div class="pl-3 d-flex">
                        <div class="text-h5 font-weight-bold">
                          {{ vehicelState.inprogress_vehicles }}
                        </div>
                        <div class="text-h6 text-grey-lighten-1 ml-2">provisional</div>
                      </div>
                    </div>
                    <div class="d-flex h-6 mb-3">
                      <div style="background: #0080ff38; border-radius: 22px; width: 40px; height: 40px;"
                        class="circle d-flex justify-center align-center">
                        <v-icon size="28" color="primary">mdi-check</v-icon>
                      </div>
                      <div class="pl-3 d-flex">
                        <div class="text-h5 font-weight-bold">{{ vehicelState.sold_vehicles }}</div>
                        <div class="text-h6 text-grey-lighten-1 ml-2">Sold</div>
                      </div>
                    </div>

                    <div class="d-flex h-6 mb-3">
                      <div style="background: #0080ff38; border-radius: 22px; width: 40px; height: 40px;"
                        class="circle d-flex justify-center align-center">
                        <v-icon size="32" color="primary">mdi-cancel</v-icon>
                      </div>
                      <div class="pl-3 d-flex">
                        <div class="text-h5 font-weight-bold">{{ vehicelState.not_sold }}</div>
                        <div class="text-h6 text-grey-lighten-1 ml-2">Not Sold</div>
                      </div>
                    </div>
                  </div>
                </v-col>
                <v-col cols="12" sm="6" class="mt-n12">
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
import Auction from './auction.vue';
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

</style>