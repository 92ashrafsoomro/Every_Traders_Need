<template>
      <user-title-bar title="Auction Schedule" style="z-index: 1;"
        subtitle="Manage and view platform auctions across all centers in one place." class="pt-16">
        <div class="d-flex  ga-2 mt-10 ">
            <div style="width: 200px;">
                <PlateformDropdown label="Select Platform" variant="outlined" :model-value="options.platform_id"
                    @update:modelValue="handleInput($event, 'platform_id')" clearable />
            </div>
            <div style="width: 200px;">
                <CenterDropdown label="Select Center" variant="outlined" :model-value="options.center_id"
                    @update:modelValue="handleInput($event, 'center_id')" clearable />
            </div>
                  <div class="d-none d-lg-flex d-md-flex ">
                <v-switch :model-value="options.enableCurrent" color="primary" density="compact" hide-details
                    @change="handleInput($event, 'enableCurrent')" class="ml-3" />

                <span class="mt-lg-5 mt-md-5 mt-2 ml-3">In Progress</span>
            </div>
      
        </div>
              <div class="d-flex d-lg-none d-md-none ">
                <v-switch :model-value="options.enableCurrent" color="primary" density="compact" hide-details
                    @change="handleInput($event, 'enableCurrent')" class="ml-3" />

                <span class="mt-lg-5 mt-md-5 mt-2 ml-3">In Progress</span>
            </div>
      
        <div class="pt-4 d-lg-flex d-md-flex  d-none align-center ga-3 ml-auto mr-auto mt-4">
            <div v-for="(value, key, index) in days" :key="index" :class="{ 'active': options.day == key }"
                class=" border rounded bg-surface-variant-1 pa-3 d-flex  flex-column mb-3 cursor-pointer"
                style=" height: 95px; width: 13.5%;" @click="handleTab(key)">
                <div class="text-capitalize d-flex align-center justify-center  pb-2  text-wrap"
                    style="white-space: wrap !important; border-bottom: 1px solid #343E4B ;">
                    {{ key }}
                </div>
                <div class="lowerSection d-flex justify-space-between mt-2">
                    <div class="d-flex align-center ">
                        <svg width="15" height="15" viewBox="0 0 512 512" class="text-primary auction-svg"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill="currentColor"
                                d="M504.971 199.362l-22.627-22.627c-9.373-9.373-24.569-9.373-33.941 0l-5.657 5.657L329.608 69.255l5.657-5.657c9.373-9.373 9.373-24.569 0-33.941L312.638 7.029c-9.373-9.373-24.569-9.373-33.941 0L154.246 131.48c-9.373 9.373-9.373 24.569 0 33.941l22.627 22.627c9.373 9.373 24.569 9.373 33.941 0l5.657-5.657 39.598 39.598-81.04 81.04-5.657-5.657c-12.497-12.497-32.758-12.497-45.255 0L9.373 412.118c-12.497 12.497-12.497 32.758 0 45.255l45.255 45.255c12.497 12.497 32.758 12.497 45.255 0l114.745-114.745c12.497-12.497 12.497-32.758 0-45.255l-5.657-5.657 81.04-81.04 39.598 39.598-5.657 5.657c-9.373 9.373-9.373 24.569 0 33.941l22.627 22.627c9.373 9.373 24.569 9.373 33.941 0l124.451-124.451c9.372-9.372 9.372-24.568 0-33.941z" />
                        </svg>

                        <span class="pl-1 mt-1 text-body-2">
                            {{ value.auction }}
                        </span>
                    </div>

                    <div class="d-flex align-center">
                        <small class=" icon"><v-icon color="primary" icon="mdi-car" size="20"></v-icon></small>
                        <span class="pl-1 mt-1 text-body-2 ">{{ value.car }}</span>
                    </div>
                </div>
            </div>
        </div>

      

        <div class="d-lg-none d-md-none d-flex mt-4 w-100 ">
            <v-slide-group hide-arrows class="pa-2 w-100 ">
                <v-slide-item v-for="(value, key, index) in days" :key="index" class="">
                    <div class="border rounded bg-surface-variant-1 pa-3 cursor-pointer"
                        :class="{ 'active': options.day == key }"
                        style="width: 300px; min-width: 40%; height: 120px;padding-left: 20px; margin-right: 20px; ">
                        <div class="text-capitalize d-flex align-center justify-center  pb-2 text-wrap"
                            style="border-bottom: 1px solid #343E4B;">
                            {{ key }}
                        </div>

                        <div class="lowerSection d-flex justify-space-between mt-2 ">
                            <div class="d-flex align-center">
                               <svg width="15" height="15" viewBox="0 0 512 512" class="text-primary auction-svg"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill="currentColor"
                                    d="M504.971 199.362l-22.627-22.627c-9.373-9.373-24.569-9.373-33.941 0l-5.657 5.657L329.608 69.255l5.657-5.657c9.373-9.373 9.373-24.569 0-33.941L312.638 7.029c-9.373-9.373-24.569-9.373-33.941 0L154.246 131.48c-9.373 9.373-9.373 24.569 0 33.941l22.627 22.627c9.373 9.373 24.569 9.373 33.941 0l5.657-5.657 39.598 39.598-81.04 81.04-5.657-5.657c-12.497-12.497-32.758-12.497-45.255 0L9.373 412.118c-12.497 12.497-12.497 32.758 0 45.255l45.255 45.255c12.497 12.497 32.758 12.497 45.255 0l114.745-114.745c12.497-12.497 12.497-32.758 0-45.255l-5.657-5.657 81.04-81.04 39.598 39.598-5.657 5.657c-9.373 9.373-9.373 24.569 0 33.941l22.627 22.627c9.373 9.373 24.569 9.373 33.941 0l124.451-124.451c9.372-9.372 9.372-24.568 0-33.941z" />
                            </svg>

                            <span class="pl-1 mt-1 text-body-2">
                                {{ value.auction }}
                            </span>
                            </div>
                            <div class="d-flex align-center">
                                <v-icon color="primary" icon="mdi-car" size="20"></v-icon>
                                <span class="pl-1 mt-1 text-body-2">{{ value.car }}</span>
                            </div>
                        </div>
                    </div>
                </v-slide-item>
            </v-slide-group>
        </div>
       

    </user-title-bar>

    <v-container fluid style="max-width: 1400px;">
      
       
                <v-card class="border-sm border-white">
                    <v-data-table-server :headers="headers" :items="data" :items-length="total" :loading="loading" hover
                        hide-default-footer
                        item-value="id" @update:options="getRecords">

                        <template #item.action="{ item }">
                            <div class="d-flex">
                                <v-btn :to="'/user/auction-finder/'"><v-icon class="eyeIcon" size="20">mdi-eye-outline</v-icon></v-btn>
                                <v-btn  @click="sendData(item.id)"><v-icon class="NotifyIcon " size="20"  > mdi-bell-outline</v-icon></v-btn>
                            </div>
                        </template>
                        <template #item.platform_name="{ item }">
                               <div style="width: 120px;">
                                   <span>{{ item.platform_name }}</span>
                               </div>
                       </template>
                       <template #item.center_name="{ item }">
                           <div class="" style="max-width: 700px; ">
                               
                               <div class="center_name_width">
                                   <span>{{ item.center_names }}</span>
                                </div>
                                
                            </div>
                            
                        </template>
                        <template #item.car_count="{ item }">
                               <div style="width: 120px;">
                                   <span>{{ item.car_count }}</span>
                               </div>
                       </template>
                         <template #item.time="{ item }">
                                <div style="width: 100px;">
                                    <span>{{ item.time }}</span>
                                </div>
                        </template>
                         <template #item.status="{ item }">
                                <div style="width: 100px;">
                                    <span>{{ item.status }}</span>
                                </div>
                        </template>
               
                    </v-data-table-server>
                </v-card>
           
    </v-container>
</template>
<script>
import { auctionSheldulerList } from '@/services/pageService';
import { usePageStore } from '@/stores/pageStore';

import PlateformDropdown from '@/components/PlateformDropdown.vue';
import CenterDropdown from '@/components/CenterDropdown.vue';
import General from '@/models/general.model';

export default {
  components: {
    PlateformDropdown,
    CenterDropdown
  },

  data() {
    return {
      pageStore: usePageStore(),

      days: {},

      options: {
        length: 10,
        page: 1,
        last_page: 1,
        offset: 0,
        platform_id: null,
        center_id: null,
        day: 'today',
        enableCurrent: false,
        date: '',
      },

      data: [],
      total: 0,
      loading: false,

      headers: [
        { title: "Platform", key: "platform_name" },
        { title: "Center", value: "center_name" },
        { title: "Total Vehicles", value: "car_count" },
        { title: "Date", value: "auction_date" },
        { title: "Status", value: "status" },
        { title: "Action", key: "action", sortable: false },
      ],
    };
  },

  mounted() {
    this.nextDays();
    this.getRecords();
  },

  methods: {
    async handleInput(value, field) {
      switch (field) {
        case 'platform_id':
          this.options.platform_id = value;
          break;

        case 'center_id':
          this.options.center_id = value;
          break;

        case 'enableCurrent':
          this.options.enableCurrent = value.target.checked;
          if (value.target.checked) {
            this.options.day = 'today';
          }
          break;
      }

      this.getRecords();
    },

    handleTab(key) {
      if (!this.options.enableCurrent) {
        this.options.day = key;
        this.getRecords();
      }
    },

    async getRecords() {
      try {
        this.loading = true;

        const res = await auctionSheldulerList(this.options);

        this.data = res.data;
        this.total = res.recordsTotal;

        this.prepareDays(res.data);

        this.options.page = Number(res.page);
        this.options.offset = res.offset;
        this.options.last_page = res.last_page;

      } catch (error) {
        this.data = [];
        this.total = 0;
        this.options.page = 1;
        this.options.last_page = 1;
      } finally {
        this.loading = false;
      }
    },

    prepareDays(apiData) {
      // reset counts
      Object.keys(this.days).forEach(key => {
        this.days[key].auction = 0;
        this.days[key].car = 0;
      });

      apiData.forEach(item => {
        const itemDate = item.auction_date?.split(' ')[0];

        Object.keys(this.days).forEach(dayKey => {
          if (this.days[dayKey].date === itemDate) {
            this.days[dayKey].auction += 1;
            this.days[dayKey].car += Number(item.car_count || 0);
          }
        });
      });
    },

    nextDays() {
      this.days = {};
      const today = new Date();

      for (let i = 0; i < 7; i++) {
        const d = new Date();
        d.setDate(today.getDate() + i);

        const dayName = d.toLocaleDateString('en-US', { weekday: 'short' });
        const dateLabel = d.toLocaleDateString('en-US', {
          day: '2-digit',
         
        });

        const label = i === 0 ? 'Today' : `${dayName}`;

        this.days[label] = {
          date: d.toISOString().split('T')[0],
          auction: 0,
          car: 0
        };
      }
    },

    async sendData(auction_id) {
      this.loading = true;
      try {
        await General.post("/api/notifications/addInUserAuction", {
          auction_id
        });
        this.$alertStore.add("Added successfully", "success");
      } catch (error) {
        this.$alertStore.add("Error", "error");
      } finally {
        this.loading = false;
      }
    }
  }
};
</script>

<style scoped>
.icon {
    font-size: 10px;
    color: #00bad1;
}

.active {
    border-color: rgb(var(--v-theme-primary)) !important;
}

.icon {
    font-size: 10px;
    color: #00bad1;
}

.active {
    border-color: rgb(var(--v-theme-primary)) !important;
}

.center_name_width {
    max-width: 1000px;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
    /* padding: 10px;  */
    max-height: 48px;
    transition:
        max-width 1s ease,
        max-height 1s ease,
        background-color 1s ease;
}

.center_name_width:hover {
    max-width: 900px;
    max-height: 200px;
    /* background-color: ; */
    -webkit-line-clamp: 6;
}

.eyeIcon:hover {
    color: rgb(var(--v-theme-primary));
    cursor: pointer;
}

.NotifyIcon:hover {
    color: rgb(var(--v-theme-primary));
    cursor: pointer;
}

</style>
