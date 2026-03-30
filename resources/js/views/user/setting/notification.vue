<template>

  <v-col>
    <v-card title="Notifications" subtitle="Change to notification settings, the user will get the update" class="border" style="padding: 0 !important;">
      <div class="border"></div>
      <v-container  fluid="" style="padding: 0 !important;">

        <!-- Notifications Table -->
        <v-data-table-server hide-default-footer="" class="bg-surface notification-table  " density="" style="padding: 0  !important;">
          <thead>
            <tr class="bg-surface" style="padding: 0 !important;">
              <th class="text-left text-white text-caption font-weight-bold pa-4">TYPE</th>
              <th class="text-center text-white text-caption font-weight-bold">EMAIL</th>
              <th class="text-center text-white text-caption font-weight-bold">BROWSER</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, i) in notifications" :key="i" class="border-b border-grey-darken-3"
              :class="item.important ? 'bgColor' : ''">
              <td class="text-white  text-subtitle-1 font-weight-medium">
                {{ item.name  }}
              </td>
              <td class="text-center">
              <v-checkbox
                  v-model="item.email"
                  hide-details
                  inset
                  density="compact"
                  color="primary"
                  base-color="grey-darken-2"
                  class="small-switch"
                />

              </td>
              <td class="text-center">
              <v-checkbox
                  v-model="item.browser"
                  hide-details
                  inset
                  density="compact"
                  color="primary"
                  base-color="grey-darken-2"
                  class="small-switch"
                />
        
              </td>
            </tr>
          </tbody>
        </v-data-table-server>

        <div class=" pa-4 border-t">
          <v-btn color="primary" @click="saveSettings" variant="flat" class="mx-2" style="height: 50px;">
            Save changes
          </v-btn>
          <v-btn variant="elevated" class="mx-2 bg-background" style="height: 50px;">
            Cancel
          </v-btn>
        </div>
      </v-container>
    </v-card>
  </v-col>



</template>

<script>
import General from '@/models/general.model';
export default {
   name: 'NotificationSettings',

  data() {
    return {
      notifications: []
    }
  },

    mounted() {
    this.loadNotifications();
  },
  methods: {
    async loadNotifications() {
      try {
        const res = await General.get('/api/user/notification-list');
        this.notifications = res.data.map(n => ({
          ...n,
          email: !!n.email,      
          browser: !!n.browser,  

        }));
      } catch (err) {
        console.error(err);
      }
    },

    async saveSettings() {
      try {
        const payload = this.notifications.map(n => ({
          notification_id: n.id,
          email: n.email ? 1 : 0,
          browser: n.browser ? 1 : 0
        }));

        await General.post('/api/user/notification/save', { settings: payload });
        this.$alertStore.add("Notification settings saved successfully", "success");
      } catch (err) {
        console.error(err);
        this.$alertStore.add("Failed to save notification settings", "error");
      }
    }
  }
  }

</script>

<style scoped>
.small-switch {
  display: inline-block;
}

.small-switch .v-selection-control__wrapper {
  margin: auto;
}
</style>