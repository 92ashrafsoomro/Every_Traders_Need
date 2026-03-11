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
                {{ item.type }}
              </td>
              <td class="text-center">
                <v-switch v-model="item.email" color="primary" hide-details inset class="d-inline-flex  "></v-switch>

                <!-- 👇 SIRF IMPORTANT KE LIYE -->
                <p v-if="item.important" class="text-white text-caption  cursor-pointer" @click="selectAllEmail">
                  Select All (Email)
                </p>
              </td>
              <td class="text-center">
                <v-switch v-model="item.browser" color="primary" hide-details inset
                  class="d-inline-flex"></v-switch>

                <div v-if="item.important" class="text-white text-caption mt-1 cursor-pointer"
                  @click="selectAllBrowser">
                  Select All (Browser)
                </div>
              </td>
            </tr>
          </tbody>
        </v-data-table-server>

        <div class=" pa-4 border-t">
          <v-btn color="primary" variant="flat" class="mx-2" style="height: 50px;">
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
export default {
  name: 'NotificationSettings',

  data() {
    return {
      notifications: [
        { type: 'Auction Activity', email: true, browser: true, important: true },
        { type: 'New Auction Finder Alerts', email: true, browser: true },
        { type: 'Upcoming Auction Reminder', email: true, browser: true },
        { type: 'Auction Result Published', email: true, browser: true },
        { type: 'Reauction Alerts', email: true, browser: true },
        { type: 'Auction Delays / Status Updates', email: true, browser: true },
        { type: 'Vehicle Tracking', email: false, browser: false, important: true },
        { type: 'Interest-Based Alerts', email: true, browser: true },
        { type: 'Scheduling', email: false, browser: false, important: true },
        { type: 'Auction Calendar Reminder', email: true, browser: true },
        { type: 'Daily/Weekly Auction Digest', email: true, browser: true },
        { type: 'System', email: false, browser: false, important: true },
        { type: 'Membership / Billing Updates', email: true, browser: true },
        { type: 'System Updates & News Features', email: true, browser: true },
        { type: 'Security Alerts', email: true, browser: true },
        { type: 'News Engagement', email: false, browser: false, important: true },
        { type: 'News & Blog Updates', email: true, browser: true },
        { type: 'Special Offers & Promotions', email: true, browser: true },
        { type: 'Survey & Feedback Requests', email: true, browser: true },
      ]
    }
  },

  methods: {
    selectAllEmail() {
      this.notifications.forEach(n => n.email = true)
    },
    selectAllBrowser() {
      this.notifications.forEach(n => n.browser = true)
    }
  }
}
</script>

<style scoped>
</style>