<template>
    <user-title-bar title="Dashboard" subtitle="Track recently watched and alerted vehicles — stay ahead of every auction opportunity">
        <div class="d-flex align-center ga-3">
            <!-- <v-btn variant="tonal" class="text-none px-5 py-2"
                :class="{ 'bg-primary text-white': activeTab === 'watchlist' }" @click="activeTab = 'watchlist'">
                WatchList
            </v-btn> -->

            <!-- <v-btn variant="tonal" class="text-none px-5 py-2"
                :class="{ 'bg-primary text-white': activeTab === 'alerts' }" @click="activeTab = 'alerts'">
                Your Alerts
            </v-btn> -->
        </div>
    </user-title-bar>


      <v-container fluid class="">

            <!-- Top Stats Bar -->
        <v-row  class="">
          <v-col cols="12">
            <v-row  class="py-4" justify="center">
              <!-- Total Auctions -->
              <v-col v-for="(value,key,index) in getCounter"  cols="3" class="">
                <custom-card class="border-b" >
                    <v-container>
                
                        <div class="d-flex h-6 align-center  ">
                            <div style="background: #0080ff38;border-radius: 22px;padding: 4px 6px;" class=" circle">
                                <v-icon size="32" color="primary">mdi-circle</v-icon>
                            </div>                       
                            <span class="text-h4 px-1" >0</span>
                        </div>
                        <div class="pt-3 text-body-1 text-light ">{{ value.title }}</div>
                        <div class="pt-2 d-flex">
                            <div class="text-body-2 pr-2">
                                <span style="color: #76778e;" >Live Auctions: </span>
                                <span> 0</span>
                            </div>
                            <div class=" text-body-2 pl-2"  >
                                <span style="color: #76778e;" >Time Auctions: </span>
                                <span> 0</span>
                            </div>
                        </div>
                    </v-container>
                </custom-card>
              
              </v-col>

        
            </v-row>
          </v-col>
        </v-row>

        <v-container class="mt-6">
          <v-row>
            <!-- Left Column -->
            <v-col cols="7">
              <!-- Online Auction -->
              <v-card class="mb-6" elevation="4">
                <v-card-title class="bg-primary text-h6">Online Auction</v-card-title>
                <v-card-text>
                  <v-select
                    v-model="onlinePlatform"
                    :items="platforms"
                    label="Select Platform"
                    variant="outlined"
                    density="comfortable"
                    hide-details
                    class="mb-4"
                  ></v-select>

                  <v-table density="comfortable">
                    <thead>
                      <tr>
                        <th class="text-left">PLATFORM</th>
                        <th class="text-left">TOTAL AUCTION</th>
                        <th class="text-left">REMAINING</th>
                        <th class="text-left">LOTS</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td colspan="4" class="text-center text-grey">
                          No data available
                        </td>
                      </tr>
                    </tbody>
                  </v-table>
                </v-card-text>
              </v-card>

              <!-- Time Auction -->
              <v-card elevation="4">
                <v-card-title class="bg-primary text-h6">Time Auction</v-card-title>
                <v-card-text>
                  <v-select
                    v-model="timePlatform"
                    :items="platforms"
                    label="Select Platform"
                    variant="outlined"
                    density="comfortable"
                    hide-details
                    class="mb-4"
                  ></v-select>

                  <v-table density="comfortable">
                    <thead>
                      <tr>
                        <th class="text-left">PLATFORM</th>
                        <th class="text-left">TOTAL</th>
                        <th class="text-left">END TIME</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td colspan="3" class="text-center text-grey">
                          No data available
                        </td>
                      </tr>
                    </tbody>
                  </v-table>
                </v-card-text>
              </v-card>
            </v-col>

            <!-- Right Column: Vehicle Statistics -->
            <v-col cols="5">
              <v-card elevation="4" class="h-100">
                <v-card-title class="bg-primary text-h6">Vehicle Statistics</v-card-title>
                <v-card-text class="d-flex flex-column h-100 justify-space-between">
                  <div>
                    <div class="text-caption text-grey-lighten-1 mb-2">Today</div>
                    <div class="text-h2 font-weight-bold text-blue-accent-2">254</div>
                    <div class="text-caption text-grey-lighten-1 mb-6">Remaining</div>

                    <v-row class="mt-8">
                      <v-col cols="6">
                        <div class="d-flex align-center">
                          <v-icon color="blue-accent-2" class="mr-3">mdi-circle</v-icon>
                          <div>
                            <div class="text-h5 font-weight-bold">0</div>
                            <div class="text-caption text-grey-lighten-1">Sold</div>
                          </div>
                        </div>
                      </v-col>
                      <v-col cols="6">
                        <div class="text-h3 font-weight-bold text-grey-lighten-1 text-right">0</div>
                        <div class="text-caption text-grey-lighten-1 text-right">Done</div>
                      </v-col>
                    </v-row>

                    <v-row class="mt-6">
                      <v-col cols="6">
                        <div class="d-flex align-center">
                          <v-icon color="blue" class="mr-3">mdi-circle</v-icon>
                          <div>
                            <div class="text-h5 font-weight-bold">0</div>
                            <div class="text-caption text-grey-lighten-1">Provisional</div>
                          </div>
                        </div>
                      </v-col>
                    </v-row>

                    <v-row class="mt-6">
                      <v-col cols="6">
                        <div class="d-flex align-center">
                          <v-icon color="blue-darken-2" class="mr-3">mdi-circle</v-icon>
                          <div>
                            <div class="text-h5 font-weight-bold">0</div>
                            <div class="text-caption text-grey-lighten-1">Not Sold</div>
                          </div>
                        </div>
                      </v-col>
                    </v-row>
                  </div>
                </v-card-text>
              </v-card>
            </v-col>
          </v-row>
        </v-container>

     

        
      </v-container>
 
</template>

<script>
export default {
  name: 'AuctionDashboard',

  data() {
    return {
      onlinePlatform: null,
      timePlatform: null,
      platforms: [] // You can populate this later: ['Platform A', 'Platform B', ...]
    }
    },
    computed: {
        getCounter() {

            return {
                totalAuctions: {
                    title:'Total Auctions'
                },
                inprogressAuctions: {
                    title:'Inprogress Auctions'
                },
                totalVehicles: {
                    title: 'Total Vehicles',
                },
                vehicleinReauctions: {  
                    title:'Vehicle in reauctions'
                }
            }
        }
    
   },

  mounted() {
    // You can fetch platforms here if needed
    // this.platforms = ['Copart', 'IAAI', 'Manheim', ...]
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


.border-b{
   border-bottom: 5px solid rgb(var(--v-theme-primary)) !important;
}


</style>