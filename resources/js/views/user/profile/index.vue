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
        <div class="profile-wrapper">

  <!-- PROFILE NAME (ALWAYS TOP) -->
  <div class=" py-2">
    <h6 class="text-h4 font-weight-bold text-white">
      {{ userStore.user.firstName }}
    </h6>
  </div>

  <!-- SCROLLABLE INFO -->
  <div class="d-flex align-center text-light ga-3 py-1 profile-scroll px-3" style="width: 150px;">
    <div class="pr-3 d-flex align-center bg-background pa-2 rounded-sm flex-shrink-0">
      <v-icon icon="mdi-equalizer" color="primary" />
      <span class="text-body-2 px-2">
        {{ userStore.user.companyName }}
      </span>
    </div>

    <div class="px-3 d-flex align-center bg-background pa-2 rounded-sm flex-shrink-0">
      <v-icon icon="mdi-briefcase-outline" color="primary" />
      <span class="text-body-2 px-2">
        {{ userStore.user.jobTitle }}
      </span>
    </div>

    <div
      v-if="userStore.user.plan"
      class="bg-background pa-2 rounded-sm px-3 d-flex align-center flex-shrink-0"
    >
      <v-icon icon="mdi-lightning-bolt" color="primary" />
      <span class="text-body-2 px-2 text-capitalize">
        {{ userStore.user.plan.membership_type }}
      </span>
    </div>
  </div>

</div>


        </div>

        <!-- Responsive Tab Buttons -->


      </slot>
    </div>
  </div>

   <div style="max-width: 1400px; max-height: 1300px;" class="mx-auto py-10 px-4">
    <v-row  no-gutters="" >
      <v-col cols="12" md="5">
        <Sidebar />
      </v-col>
      <v-col cols="12" md="7">
        <v-card title="Notification" class=" h-100 d-flex flex-column" >
          <div class="border-b"></div>
          <v-card-text class="notification-scroll h-100">
         
  
                <template v-for="(note, i) in notifications" :key="i">
                    <v-list-item class="px-4 py-4 bg-surface">
                        <div class="d-flex align-start gap-4 w-100">
                            <!-- Avatar -->
                            <v-avatar size="42">
                                <v-img :src="note.image || userAvatar" cover />
                            </v-avatar>


                            <div class="flex-grow-1 min-w-0 ml-2 mr-1">
                                <p class="text-body-2 font-weight-medium mb-1 text-wrap">
                                    {{ note.title }}
                                </p>
                                <p class="text-caption text-medium-emphasis text-wrap">
                                    {{ note.message }}
                                </p>

                            </div>


                            <div class="mt-2">
                                <v-icon v-if="note.is_read == 0" color="primary" size="10">
                                    mdi-circle
                                </v-icon>
                            </div>
                        </div>
                    </v-list-item>
                    <v-divider v-if="i < notifications.length - 1" />
                </template>
  
           </v-card-text>

        </v-card>
      </v-col>
    </v-row>
  </div> 
</template>

<script>
import { useUserStore } from '@/stores/userStore';
import RecentDevices from './RecentDevices.vue';
import Sidebar from './Sidebar.vue';
import { changPassword } from '@/services/authService';
import userAvatar from "@/assets/images/avatar/user.png"
import General from '@/models/general.model';

export default {
  components: {
    RecentDevices,
    Sidebar
  },
  data() {
    return {
      userStore: useUserStore(),
      userAvatar,
     notifications: [],
      isLoading: false,
    };
  },

  computed: {

  },
  mounted() {
  this.notificationFetch();
  },
  methods:{
     async notificationFetch() {
            this.isLoading = true;
            try {
                const res = await General.get("/api/user/notifications/userNotification");
                this.notifications = res.data;
            } catch (error) {
                console.error("Error fetching notifications:", error);
            } finally {
                this.isLoading = false;
            }
        },
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

@media (max-width: 599px) {
  .profile-scroll {
    overflow-x: auto;
    flex-wrap: nowrap;
    margin-right  : -60px;
    /* width: 100% !important; */
  }
}
.notification-scroll {

  overflow-y: auto;

  /* Hide scrollbar - Chrome, Edge, Safari */
  scrollbar-width: none;      /* Firefox */
  -ms-overflow-style: none;   /* IE / Edge */
}

.notification-scroll::-webkit-scrollbar {
  display: none;              /* Chrome / Safari */
}


</style>