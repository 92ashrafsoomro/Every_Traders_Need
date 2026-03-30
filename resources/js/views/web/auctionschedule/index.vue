<template>
  <user-title-bar title="Auction Schedule" style="z-index: 1; margin-bottom: 0 !important;"
    subtitle="Manage and view platform auctions across all centers in one place."  class="pt-16" >
    <div class="d-flex  ga-2 mt-5 ">
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

    <div class=" d-lg-flex d-md-flex  d-none align-center ga-5 ml-auto mr-auto mt-5">
      <div v-for="(value, key, index) in days" :key="index" :class="{ 'active': options.day == key }"
        class="border rounded bg-surface-variant-1 pa-3 d-flex flex-column cursor-pointer"
        style="height: 95px; width: 13.5%;"  @click="!options.enableCurrent && handleTab(key)">

        <div class="text-capitalize d-flex align-center justify-center pb-2 text-wrap"
          style="white-space: wrap !important; border-bottom: 1px solid #343E4B;">
          {{ key }}
        </div>

        <div class="lowerSection d-flex justify-space-between mt-2">
          <div class="d-flex align-center">
            <HammerIcon/>
            <span class="pl-1 mt-1 text-body-2">{{ value.auction }}</span>
          </div>

          <div class="d-flex align-center">
            <v-icon color="primary" icon="mdi-car" size="20"></v-icon>
            <span class="pl-1 mt-1 text-body-2">{{ value.car }}</span>
          </div>
        </div>
      </div>

    </div>



    <div class="d-lg-none d-md-none d-flex mt-4 w-100 mb-5">
      <v-slide-group hide-arrows class="pa-2 w-100 ">
        <v-slide-item v-for="(value, key, index) in days" :key="index" class="">
          <div class="border rounded bg-surface-variant-1 pa-3 cursor-pointer" :class="{ 'active': options.day == key }"
            style="width: 300px; min-width: 40%; height: 120px;padding-left: 20px; margin-right: 20px; "  @click="!options.enableCurrent && handleTab(key)">
            <div class="text-capitalize d-flex align-center justify-center  pb-2 text-wrap"
              style="border-bottom: 1px solid #343E4B;">
              {{ key }}
            </div>

            <div class="lowerSection d-flex justify-space-between mt-2 ">
              <div class="d-flex align-center">
                <HammerIcon/>

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

  <v-container fluid="" style="max-width: 1400px;">


    <v-card class="border-sm border-white mt-5">
      <v-data-table-server :headers="headers" sort-asc-icon="" :items="data" :items-length="total" :loading="loading"
        hover hide-default-footer item-value="id" >

        <template #item.action="{ item }">
          <div class="d-flex">
            <v-btn :to="'/user/auction-finder/'">
              <v-icon size="20">mdi-eye-outline</v-icon>
            </v-btn>
            <v-icon class="bell text-capitalize text-body-1 border" :disabled="alertedAuctionIds.includes(item.id)"
              @click="sendAlert(item.id)" :style="{
                backgroundColor: alertedAuctionIds.includes(item.id) ? 'rgba(var(--v-theme-primary),0.2)' : 'transparent',
                cursor: alertedAuctionIds.includes(item.id) ? 'not-allowed' : 'pointer'
              }">mdi-bell-outline</v-icon>

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
import HammerIcon from '@/views/admin/taskManagement/component/Icon.vue'
import { useUserStore } from '@/stores/userStore';
export default {
  components: {
    PlateformDropdown,
    CenterDropdown,
    HammerIcon
  },

  data() {
    return {
      pageStore: usePageStore(),
      userStore: useUserStore(),
      days: {},

      options: {
        length: 10,
        page: 1,
        last_page: 1,
        offset: 0,
        platform_id: null,
        center_id: null,
        day: 'Today',
        enableCurrent: false,
        date: '',
      },
      alertedAuctionIds: [],
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
    this.options.date = this.days['Today'].date;
    this.getRecords();
    this.existAlert()
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
  
    prepareDays(apiData) {
      const days = {};
      const today = new Date();

      // Step 1: create next 7 days placeholders
      for (let i = 0; i < 7; i++) {
        const d = new Date();
        d.setDate(today.getDate() + i);

        const dayName = d.toLocaleDateString('en-US', { weekday: 'short' });
        const label = i === 0 ? 'Today' : dayName;

        days[label] = {
          date: d.toISOString().split('T')[0],
          auction: 0,
          car: 0
        };
      }

      // Step 2: merge API data (groups) into the 7-day placeholders
      const groups = apiData.groups || [];
      groups.forEach(group => {
        const d = new Date(group.auction_day);
        const dayName = d.toLocaleDateString('en-US', { weekday: 'short' });
        const label = (d.toDateString() === today.toDateString()) ? 'Today' : dayName;

        // Only overwrite if the day exists in next 7 days
        if (days[label]) {
          days[label].auction = group.total_auctions;
          days[label].car = group.total_vehicles;
        }
      });

      this.days = days;

      // Set default selected day if not set
      if (!this.options.day) {
        this.options.day = 'Today';
        this.options.date = this.days['Today'].date;
      }
    },
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
            this.options.day = 'Today';
            this.options.date = this.days['Today'].date;
          }
          break;
      }

      this.getRecords();
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

    async existAlert() {
      try {
        const res = await General.get("/api/notifications/userAuctionList")

        this.alertedAuctionIds = (res.data || []).map(
          alert => alert.auction_id
        )

      } catch (error) {
        console.error(error)
      }
    },

    async sendAlert(auction_id) {
      try {
        await General.post("/api/notifications/addInUserAuction", {
          auction_id
        })

        this.alertedAuctionIds.push(auction_id)
        this.$alertStore.add("Added successfully", "success")

      } catch (error) {
        this.$alertStore.add("Error", "error")
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
