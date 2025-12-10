<template>
  <v-card class="bg-surface mx-auto mt-10 border-thin" max-width="1600px ">
    <v-card-title class="d-flex justify-space-between align-center pa-4 border-thin">
      <span class="text-h6 text-white">Platform</span>
      <v-btn color="primary" prepend-icon="mdi-plus">
        Add New Platform
      </v-btn>
    </v-card-title>

    <v-card-text class="pa-0">
      <!-- Toolbar: Entries per page + Showing info + Search -->
      <div class="d-flex flex-wrap align-center pa-4 gap-4 bg-surface border-thin">
        <div class="d-flex align-center">
          <v-select v-model="itemsPerPage" :items="[10, 25, 50, 100]" density="compact" variant="outlined" hide-details
            style="width: 80px;" class="mr-2" />
          <span class="text-grey-lighten-1 text-caption">
            Showing 1 to {{ Math.min(itemsPerPage, platforms.length) }} of {{ platforms.length }} entries
          </span>
        </div>

        <v-spacer />

        <v-text-field v-model="search" prepend-inner-icon="mdi-magnify" placeholder="Search..." density="compact"
          variant="solo" hide-details class="max-width-300" clearable />
      </div>

      <!-- Data Table -->
      <v-data-table :headers="headers" :items="platforms" :items-per-page="itemsPerPage"
        class="bg-surface text-white my-table" hide-default-footer>

        <!-- Image Slot -->
        <template v-slot:item.image="{ item }">
          <div class="pa-2">
            <img src="@/assets/images/avatar/user.png" width="60" height="40" contain
              class="bg-white rounded" alt="Platform Image" />
          </div>
        </template>

        <!-- Name Slot -->
        <template v-slot:item.name="{ item }">
          <span class="font-weight-medium">{{ item.name }}</span>
        </template>

        <!-- Actions Slot -->
        <template v-slot:item.actions="{ item }">
          <v-btn size="small" color="warning" class="mr-2 text-capitalize">
            Edit
          </v-btn>
          <v-btn size="small" color="error" class="text-capitalize">
            Delete
          </v-btn>
        </template>

        <!-- Index # -->
        <template v-slot:item.index="{ index }">
          <td>{{ platforms.length - index }}</td>
        </template>
      </v-data-table>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  data() {
    return {

      itemsPerPage: 10,
      headers: [
        { title: "#", key: "index", width: "60px", sortable: false },
        { title: "IMAGE", key: "image", width: "100px", sortable: false },
        { title: "NAME", key: "name" },
        { title: "CREATED AT", key: "created_at" },
        { title: "UPDATED AT", key: "updated_at" },
        { title: "ACTIONS", key: "actions", align: "end", sortable: false, width: "180px" },
      ],
      platforms: [
        { id: 35, image: "protruck.png", name: "Protruck Auctions", created_at: "2025-10-07T03:26:38.000000Z", updated_at: "2025-10-07T03:26:38.000000Z" },
        { id: 34, image: "eama.png", name: "East Anglian Motor Auctions", created_at: "2025-10-07T03:37:06.000000Z", updated_at: "2025-10-07T03:37:06.000000Z" },
        { id: 33, image: "morris-leslie.png", name: "Morris Leslie Vehicle Auctions", created_at: "2025-10-07T03:26:15.000000Z", updated_at: "2025-10-07T03:26:15.000000Z" },
        { id: 32, image: "cva.png", name: "Commercial Vehicle Auctions Ltd", created_at: "2025-10-07T03:34:43.000000Z", updated_at: "2025-10-07T03:34:43.000000Z" },
        { id: 31, image: "synetiq.png", name: "SYNETIQ", created_at: "2025-10-07T03:35:56.000000Z", updated_at: "2025-10-07T03:35:56.000000Z" },
        { id: 30, image: "seaview.png", name: "Seaview Recovery", created_at: "", updated_at: "" },
        { id: 29, image: "clwyd.png", name: "Clwyd Car Auctions Ltd", created_at: "", updated_at: "" },
        // Add more as needed...
      ],
    };
  },
  computed: {

  },
};
</script>

<style scoped>
.gap-4>*+* {
  margin-left: 16px;
}

.max-width-300 {
  max-width: 300px;
}

.v-data-table ::v-deep(th) {
  color: #bbbbbb !important;
  font-weight: 500;
}

.v-data-table ::v-deep(td) {
  color: white !important;
}

/* Border styles for the table */
.my-table {
  border: 1px solid #1e293b;
  /* dark slate gray */
  border-radius: 8px;
  overflow: hidden;
}

/* Borders for table header and rows */
.my-table ::v-deep(th),
.my-table ::v-deep(td) {
  border-bottom: 1px solid #334155;
  /* slightly lighter slate */
}

/* Remove border for last row */
.my-table ::v-deep(tr:last-child td) {
  border-bottom: none;
}
</style>
