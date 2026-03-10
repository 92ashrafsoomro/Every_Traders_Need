<template>
      <user-title-bar title="Global Settings" >

    </user-title-bar>
  <v-container fluid class="pa-4" max-width="1400px">
    <v-row no-gutters>
      <v-col cols="12" md="3">
        <v-tabs v-model="tab" direction="vertical" color="primary">
          <v-tab value="profile">
            <v-icon start>mdi-account</v-icon>
            Personal Information
          </v-tab>
          <v-tab value="notifications">
            <v-icon start>mdi-bell</v-icon>
            Notification Setting
          </v-tab>
        </v-tabs>
      </v-col>

      <v-col cols="12" md="9" class="pa-8">
        <v-window v-model="tab">
          
          <v-window-item value="profile">
            <h2 class="text-h5 mb-6">Personal Information</h2>
            <v-row>
              <v-col cols="12" md="6">
                <v-text-field label="First Name" v-model="form.firstName" variant="outlined" density="compact" />
              </v-col>
              <v-col cols="12" md="6">
                <v-text-field label="Last Name" v-model="form.lastName" variant="outlined" density="compact" />
              </v-col>
            </v-row>
          </v-window-item>

          <v-window-item value="notifications">
            <h2 class="text-h5 mb-6">Notification Settings</h2>
            <p>Notification controls will go here.</p>
          </v-window-item>

        </v-window>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  data: () => ({
    tab: 'profile',
    form: {
      firstName: 'AJOY',
      lastName: 'Sarker',
    },
  }),
};
</script>

<style scoped>

</style>