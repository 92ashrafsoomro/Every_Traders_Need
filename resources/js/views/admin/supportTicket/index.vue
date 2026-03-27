<template>
  <user-title-bar title="Support Ticket"></user-title-bar>

  <v-container max-width="1400px" class="mx-auto">
    <v-row>
      <v-col cols="12">
        <div class="d-flex justify-space-between w-100 mt-4">

          <!-- Left Side -->
          <div class="d-flex w-50">
            <v-select
              v-model="filter.length"
              :items="[100, 500, 1000, 2000]"
              density="compact"
              variant="outlined"
              max-width="90px"
              class="mr-2"
            />
            <div class="align-self-center pl-2">
              {{ filter.offset + 1 }} -
              {{ Math.min(filter.offset + filter.length, total) }}
              of {{ total }} Records
            </div>
          </div>

          <!-- Right Side -->
          <div class="w-50 d-flex">
            <v-text-field
              density="compact"
              variant="outlined"
              clearable
              v-model="filter.search"
              label="Search"
            />
            <v-btn
              style="height: 44px; margin-left: 10px;"
              variant="outlined"
              @click="loadItems"
            >
              <v-icon icon="mdi-magnify"></v-icon>
            </v-btn>
            <v-btn
              style="height: 44px; margin-left: 10px;"
              variant="outlined"
              @click="loadItems"
            >
              <v-icon icon="mdi-reload"></v-icon>
            </v-btn>
          </div>

        </div>
      </v-col>

      <v-col cols="12" class="mt-2">
        <div class="border">

          <v-data-table-server
            :loading="loading"
            :headers="headers"
            :items="items"
            :items-length="total"
            hover
            item-value="id"
            @update:options="loadItems"
          >

          <template #item.id="{ item }">
            <div class="d-flex align-center">
              
              <span class="mr-2 font-weight-medium">
                {{ item.id }}
              </span>

              <v-chip
                v-if="isToday(item.created_at)"
                size="x-small"
                color="primary"
                variant="flat"
                class="new-badge"
              >
                NEW
              </v-chip>

            </div>
          </template>

          <template #item.status="{ item }">
            <v-select
              v-model="item.status"
              :items="statusItems"
              item-title="title"
              item-value="value"
              density="compact"
              variant="outlined"
              hide-details
              class="min-select"
              @update:modelValue="updateStatus(item)"
            >
              <template #selection="{ item }">
                <span
                  :style="{ 
                    color: getStatusColor(item.raw.value), 
                    fontWeight: '600' 
                  }"
                >
                  {{ item.raw.title }}
                </span>
              </template>
            </v-select>
          </template>

          <template #item.priority="{ item }">
          <v-select
            v-model="item.priority"
            :items="priorityItems"
            item-title="title"
            item-value="value"
            density="compact"
            variant="outlined"
            hide-details
            class="min-select"
            @update:modelValue="updatePriority(item)"
          >
            <template #selection="{ item }">
              <span
                :style="{ 
                  color: getPriorityColor(item.raw.value), 
                  fontWeight: '600' 
                }"
              >
                {{ item.raw.title }}
              </span>
            </template>
          </v-select>
        </template>


            <template #item.created_at="{ item }">
              <span>{{ dateFormate(item.created_at) }}</span>
            </template>

            <template #item.updated_at="{ item }">
              <span>{{ dateFormate(item.updated_at) }}</span>
            </template>
            <template #item.user_name="{ item }">
              <span>{{ item.user?.firstName ?? '' }} {{ item.user?.lastName ?? '' }}</span>
            </template>
            <template #item.user_memberships="{ item }">
              <span>{{ item.user?.latest_membership?.package_name ?? 'None' }}</span>
            </template>
            <template #item.user_memberships_price="{ item }">
              <span>{{ item.user?.latest_membership?.total ?? 'None' }}</span>
            </template>

     
            <template #item.action="{ item }">
              <div class="d-flex">
                <router-link :to="'/admin/supportTicket/edit/' + item.id">
                  <v-icon color="primary" class="pa-4">mdi-eye</v-icon>
                </router-link>

                <v-icon
                  class="pa-4"
                  color="error"
                  @click="deleteItem(item.id)"
                >
                  mdi-delete
                </v-icon>
              </div>
            </template>

            <template #bottom>
              <div class="py-2 d-flex justify-end border-t">
                <custom-pagination
                  :loading="loading"
                  v-model:page="filter.page"
                  :lastPage="last_page"
                  @page-changed="loadItems"
                />
              </div>
            </template>

          </v-data-table-server>

        </div>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import General from '@/models/general.model';

export default {
  data() {
    return {
      filter: {
        search: null,
        length: 10,
        page: 1,
        offset: 0,
      },
      items: [],
      last_page: 1,
      total: 0,
      loading: false,

      headers: [
        { title: "ID", key: "id" },
        // { title: "User ID", key: "user_id" },
        { title: "User Name", key: "user_name" },
        { title: "Memberships", key: "user_memberships" },
        { title: "Price", key: "user_memberships_price" },
        { title: "Issue Topic", key: "issue_topic" },
        { title: "Issue Type", key: "issue_type" },
        { title: "Status", key: "status" },
        { title: "Priority", key: "priority" },
        { title: "Created At", key: "created_at" },
        { title: "Updated At", key: "updated_at" },
        { title: "Action", key: "action" },
      ],
      statusItems: [
        { title: 'Open', value: 0 },
        { title: 'In Progress', value: 1 },
        { title: 'Resolved', value: 2 },
        { title: 'Closed', value: 3 },
      ],
      priorityItems: [
        { title: 'Low', value: 'Low' },
        { title: 'Medium', value: 'Medium' },
        { title: 'High', value: 'High' },
      ],
    };
  },

  mounted() {
    this.loadItems();
  },

  watch: {
    'filter.length'() {
      this.filter.page = 1;
      this.loadItems();
    },
    'filter.page'() {
      this.loadItems();
    },
  },

  methods: {

    dateFormate(date) {
      if (!date) return "";
      return date.split('T')[0];
    },

    async loadItems() {
      this.loading = true;
      try {
        let res = await General.get("/api/cruds/tickets", this.filter);

        this.items = res.data;
        this.total = Number(res.recordsTotal);
        this.last_page = Number(res.last_page);
        this.filter.offset = res.offset;

      } catch (error) {
        console.error(error);
        alert("Data load failed");
      } finally {
        this.loading = false;
      }
    },

    async deleteItem(id) {
      if (!confirm("Are you sure you want to delete this item?")) return;

      this.loading = true;
      try {
        let res = await General.delete("/api/cruds/tickets/" + id);
        this.$alertStore.add(res.message || "Deleted", "success");
        this.loadItems();
      } catch (error) {
        this.$alertStore.add("Delete failed", "error");
      } finally {
        this.loading = false;
      }
    },

      getStatusColor(status) {
        switch (status) {
          case 0: return "#9e9e9e";
          case 1: return "#1976d2";
          case 2: return "#2e7d32";
          case 3: return "#d32f2f";
          default: return "#000000";
        }
      },

      getPriorityColor(priority) {
        switch (priority) {
          case 'Low':
            return '#9e9e9e';   
          case 'Medium':
            return '#1976d2';   
          case 'High':
            return '#d32f2f'; 
          default:
            return '#000000';
        }
      },

      isToday(date) {
        if (!date) return false;

        const today = new Date().toISOString().split('T')[0];
        const recordDate = date.split('T')[0];

        return today === recordDate;
      },

      async updateStatus(item) {
        try {
          await General.post(`/api/cruds/tickets/${item.id}/status`, {
            status: item.status
          });

          this.$alertStore.add("Status updated successfully", "success");

        } catch (error) {
          console.error(error);
          this.$alertStore.add("Status update failed", "error");
          this.loadItems(); // rollback if failed
        }
      },

      async updatePriority(item) {
        try {
          await General.post(`/api/cruds/tickets/${item.id}/priority`, {
            priority: item.priority
          });

          this.$alertStore.add("Priority updated successfully", "success");

        } catch (error) {
          console.error(error);
          this.$alertStore.add("Priority update failed", "error");
          this.loadItems(); 
        }
      },

  },
};
</script>

<style scoped>
.min-select {
  min-width: 170px;
}

.status-card {
  border-radius: 6px;
  padding: 12px;
  width: 15.5%;
  background-color:rgb(var(--v-theme-surface-variant-1));
  transition: all 0.2s ease;
}

.status-card:hover {
  border-color: #0080FF;
}

.status-selected {
  border: 2px solid #0080FF;
 
}
.new-badge {
  font-size: 10px;
  font-weight: 600;
  letter-spacing: 0.5px;
}
</style>