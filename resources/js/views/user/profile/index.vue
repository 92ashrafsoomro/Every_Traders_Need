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

              <div v-if="userStore.user.plan"
                class="bg-background pa-2 rounded-sm px-3 d-flex align-center flex-shrink-0">
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

  <div style="max-width: 1400px;" class="mx-auto mt-5 mb-5 px-4">
    <div class="d-flex flex-lg-row  flex-md-row flex-column ga-5">
      <Sidebar />
      <v-card class=" d-flex flex-column border notification-card">
        <div class="d-flex justify-space-between align-center pa-4">
          <h2 class="text-h6 font-weight-medium">Notifications</h2>
        </div>
        <div class="border-b"></div>
        <v-card-text class="notification-scroll">
          <template v-for="(note, i) in notifications" :key="i">
            <v-list-item class="px-4 py-4 bg-surface">
              <div class="d-flex align-start gap-4 w-100">
                <!-- Avatar -->
                <v-avatar size="42" class="mt-2">
                  <v-img :src="note.image || userAvatar" cover />
                </v-avatar>


                <div class="flex-grow-1 min-w-0 ml-4 mr-1">
                  <router-link :to="getNotificationLink(note)" style="text-decoration: none; color: rgb(var(--v-theme-whiteLight));">
                    <p class="text-body-2 font-weight-medium mb-1 text-wrap rounded-md">
                      {{ note.title }}
                    </p>
                  </router-link>

                  <p class="text-caption text-medium-emphasis text-wrap">
                    {{ note.message }}
                  </p>
                  <div>
                    {{ dateFormate(note.date) }}
                  </div>
                </div>

              </div>
            </v-list-item>
            <v-divider v-if="i < notifications.length - 1" />
          </template>

        </v-card-text>

      </v-card>
    </div>
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
  methods: {
    async notificationFetch() {
      this.isLoading = true;
      try {
        const res = await General.get("/api/notifications/myNotifications");
        this.notifications = res;
      } catch (error) {
        console.error("Error fetching notifications:", error);
      } finally {
        this.isLoading = false;
      }
    },
    // async readNotification(id){
    //   this.isLoading = true;
    //     try {
    //         const res = await General.post("/api/notifications/markRead/"+id);
    //         this.$alertStore.add(res.message || "Notification Read", "success");
    //         this.notificationFetch();


    //     } catch (error) {
    //         console.error("Error fetching notifications:", error);
    //     } finally {
    //         this.isLoading = false;
    //     }
    // },
     getNotificationLink(note) {
        if (note.type === "vehicle") {
            return `/user/vehicle-detail/${note.id}`;
        } else if (note.type === "auction") {
            return `/autoboli/user/reauction`;
        }
        return "#"; // fallback if type is unknown
    },
    dateFormate(date) {
      if (!date) return ''
      return date.split('T')[0].split(' ')[0]
    }

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
    margin-right: -60px;
    /* width: 100% !important; */
  }
}

.notification-card {
  max-height: 1260px;
  min-height: 1260px;
  width: 100%;
  max-width: 950px;
}

/* Small screens */
@media (max-width: 600px) {
  .notification-card {
    max-width: auto;
    min-width: auto;
    margin: 0 auto;
  }
}


.notification-scroll {

  overflow-y: auto;

  /* Hide scrollbar - Chrome, Edge, Safari */
  scrollbar-width: none;
  /* Firefox */
  -ms-overflow-style: none;
  /* IE / Edge */
}

.notification-scroll::-webkit-scrollbar {
  display: none;
  /* Chrome / Safari */
}

.vehicleName:hover {
  background-color: rgb(var(--v-theme-primary), 0.3);
  transition: 0.2s ease-in-out;
}
</style>