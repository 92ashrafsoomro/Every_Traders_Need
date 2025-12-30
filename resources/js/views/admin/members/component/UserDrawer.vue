<template>
  <v-navigation-drawer
    :model-value="viewDrawer"  
    location="right"
    width="520"
    temporary
    @update:model-value="$emit('update:viewDrawer', $event)" 
  >
    <v-toolbar flat color="primary" class="mt-2">
      <v-avatar size="40" class="mr-3 mx-3">
        <v-img
          :src="selectedUser?.uploadID 
            ? `https://localhost/autoboli/uploads/${selectedUser.uploadID}` 
            : 'https://ui-avatars.com/api/?name=' + selectedUser?.firstName"
        />
      </v-avatar>

      <div class="text-white">
        <div class="font-weight-bold">
          {{ selectedUser?.firstName }} {{ selectedUser?.surname }}
        </div>
        <small>{{ selectedUser?.personalEmail }}</small>
      </div>

      <v-spacer />

      <v-btn icon @click="$emit('update:viewDrawer', false)">
        <v-icon color="white">mdi-close</v-icon>
      </v-btn>
    </v-toolbar>

    <v-divider />

    <v-card-text v-if="viewLoading" class="text-center py-10">
      <v-progress-circular indeterminate color="primary" />
    </v-card-text>
    
    <v-card-text v-else-if="selectedUser">
    <v-chip
      class="mb-4"
      :color="selectedUser.status === 1 ? 'green' : 'red'"
      text-color="white"
      size="small"
    >
      {{ selectedUser.status === 1 ? 'Active Member' : 'Inactive Member' }}
    </v-chip>
      <v-card class="mb-4">
        <v-card-title class="text-subtitle-1 font-weight-bold">
          <v-icon class="mr-2">mdi-domain</v-icon>
          Company Information
        </v-card-title>
        <v-divider />
        <v-card-text>
          <v-list density="compact">
            <v-list-item style="display: flex; justify-content: space-between;">
              <span class="font-weight-medium">Company Name: </span>
              <span>{{ selectedUser.companyName || '-' }}</span>
            </v-list-item>
            <v-list-item style="display: flex; justify-content: space-between;">
              <span class="font-weight-medium">Business Type: </span>
              <span>{{ selectedUser.businessType || '-' }}</span>
            </v-list-item>
            <v-list-item style="display: flex; justify-content: space-between;">
              <span class="font-weight-medium">Registration No: </span>
              <span>{{ selectedUser.companyReg || '-' }}</span>
            </v-list-item>
            <v-list-item style="display: flex; justify-content: space-between;">
              <span class="font-weight-medium">Vat No: </span>
              <span>{{ selectedUser.vatNumber || '-' }}</span>
            </v-list-item>
            <v-list-item style="display: flex; justify-content: space-between;">
              <span class="font-weight-medium">Company Address 1: </span>
              <span>{{ selectedUser.companyAddress1 || '-' }}</span>
            </v-list-item>
            <v-list-item style="display: flex; justify-content: space-between;">
              <span class="font-weight-medium">Company Address 2: </span>
              <span>{{ selectedUser.companyAddress2 || '-' }}</span>
            </v-list-item>
            <v-list-item style="display: flex; justify-content: space-between;">
              <span class="font-weight-medium">Telephone: </span>
              <span>{{ selectedUser.telephone || '-' }}</span>
            </v-list-item>
            <v-list-item style="display: flex; justify-content: space-between;">
              <span class="font-weight-medium">Website: </span>
              <span>
                <a :href="selectedUser.website" target="_blank">{{ selectedUser.website || '-' }}</a>
              </span>
            </v-list-item>
            <v-list-item style="display: flex; justify-content: space-between;">
              <span class="font-weight-medium">Address Proof: </span>
              <span>
                <v-btn
                  v-if="selectedUser.addressProof"
                  :href="selectedUser.addressProof"
                  target="_blank"
                  small
                  outlined
                  color="primary"
                >
                  View
                </v-btn>
                <span v-else>Not uploaded</span>
              </span>
            </v-list-item>
            <v-list-item style="display: flex; justify-content: space-between;">
              <span class="font-weight-medium">Motor TradeProof: </span>
              <span>
                <v-btn
                  v-if="selectedUser.motorTradeProof"
                  :href="selectedUser.motorTradeProof"
                  target="_blank"
                  small
                  outlined
                  color="primary"
                >
                  View
                </v-btn>
                <span v-else>Not uploaded</span>
              </span>
            </v-list-item>
          </v-list>
        </v-card-text>
      </v-card>

      <v-card class="mb-4">
        <v-card-title class="text-subtitle-1 font-weight-bold">
          <v-icon class="mr-2">mdi-account</v-icon>
          Personal Information
        </v-card-title>
        <v-divider />
        <v-card-text>
          <v-list density="compact">
            <v-list-item style="display: flex; justify-content: space-between;">
              <span class="font-weight-medium">Full Name: </span>
              <span>{{ selectedUser.firstName }} {{ selectedUser.surname }}</span>
            </v-list-item>
            <v-list-item style="display: flex; justify-content: space-between;">
              <span class="font-weight-medium">Job Title: </span>
              <span>{{ selectedUser.jobTitle || '-' }}</span>
            </v-list-item>
            <v-list-item style="display: flex; justify-content: space-between;">
              <span class="font-weight-medium">Phone: </span>
              <span>{{ selectedUser.phone || '-' }}</span>
            </v-list-item>
            <v-list-item style="display: flex; justify-content: space-between;">
              <span class="font-weight-medium">Email: </span>
              <span>{{ selectedUser.personalEmail || '-' }}</span>
            </v-list-item>
          </v-list>
        </v-card-text>
      </v-card>


      <v-card>
        <v-card-title class="text-subtitle-1 font-weight-bold">
          <v-icon class="mr-2">mdi-map-marker</v-icon>
          Address
        </v-card-title>
        <v-divider />
        <v-card-text>
          <v-list density="compact">
            <v-list-item style="display: flex; justify-content: space-between;">
              <span class="font-weight-medium">Address: </span>
              <span>
                {{ selectedUser.companyAddress1 }}<br>
                {{ selectedUser.companyAddress2 }}<br>
                {{ selectedUser.townCity }}, {{ selectedUser.country }} - {{ selectedUser.postcode }}
              </span>
            </v-list-item>
          </v-list>
        </v-card-text>
      </v-card>
    </v-card-text>
  </v-navigation-drawer>
</template>

<script>
export default {
  name: "UserDrawer",
  props: {
    viewDrawer: {
      type: Boolean,
      required: true
    },
    selectedUser: {
      type: Object,
      required: true
    },
    viewLoading: {
      type: Boolean,
      default: false
    }
  }
};
</script>
