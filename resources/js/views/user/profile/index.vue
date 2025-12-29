<template>
  <div class="w-100 bg-surface" style="height: 180px;">
    <div class="pattern-bg" style="height: 240px;"></div>
    <div class="position-relative">
      <slot>
        <div style="max-width: 1400px;" class="mx-auto py-5 d-flex align-center justify-start ">
          <!-- Avatar -->
          <div class="py-2 px-5">
            <div style="max-width: 150px">
              <img style="width: 100px; height:100px" class="border" :src="userStore.user.avatar" />
            </div>
          </div>
          <!-- User Info -->
          <div class="py-2 flex-grow-1">
            <div class="pl-3">
              <h6 class="pb-3 text-h4 font-weight-bold">{{ userStore.user.firstName }}</h6>
              <div class="d-flex align-center flex-wrap text-light ga-3">
                <div class="pr-3 d-flex align-center bg-background pa-2 rounded-sm">
                  <v-icon icon="mdi-equalizer" color="primary" />
                  <span class="text-body-2 px-2">{{ userStore.user.companyName }}</span>
                </div>
                <div class="px-3 d-flex align-center bg-background pa-2 rounded-sm">
                  <v-icon icon="mdi-briefcase-outline" color="primary" />
                  <span class="text-body-2 px-2">{{ userStore.user.jobTitle }}</span>
                </div>
                <div v-if="userStore.user.plan" class="bg-background pa-2 rounded-sm px-3 d-flex align-center">
                  <v-icon icon="mdi-lightning-bolt" color="primary" />
                  <span class="text-body-2 px-2 text-capitalize">{{ userStore.user.plan.membership_type }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Responsive Tab Buttons -->
        

      </slot>
    </div>
  </div>

  <v-container max-width="1400px" fluid>
    <v-row>
      <v-col cols="12" md="5">
        <Sidebar />
      </v-col>
      <v-col cols="12" md="7">
        <v-card title="Notification" class="border">
          <div class="border-b"></div>
          <v-card-text>
            <p>Notifications...</p>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { useUserStore } from '@/stores/userStore';
import RecentDevices from './RecentDevices.vue';
import Sidebar from './Sidebar.vue';
import { changPassword } from '@/services/authService';


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
    async mounted() {


        //    console.log(res);


    }
};
</script>



<style>
.pattern-bg {
    /* position: absolute; */
    /* inset: 0; */
    background-image: radial-gradient(#0080ff 1.5px, transparent 1.2px);
    background-size: 16px 16px;
    background-repeat: repeat;
    /* opacity: 0.25; */
    pointer-events: none;
    /* z-index: 0; */
}
</style>