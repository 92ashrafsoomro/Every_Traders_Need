<template>
  <user-title-bar title="Support Tickets"></user-title-bar>

  <v-container max-width="1400px" class="mx-auto">
    <v-row>
      <v-col cols="12">
        <div class="d-lg-flex justify-space-between d-md-flex  w-100 mt-4">
          <div class="d-flex">
            <v-select v-model="filter.length" :items="[10, 50, 100]" density="compact" variant="outlined" max-width="90px" class="mr-2" />
            <div class="align-self-center pl-2 text-caption">
              {{ filter.offset + 1 }}-{{ Math.min(filter.offset + filter.length, total) }} of {{ total }}
            </div>
          </div>
          <div class="d-flex w-lg-50 w-md-50">
            <v-text-field density="compact" variant="outlined" clearable v-model="filter.search" label="Search tickets..." hide-details  style="height: 44px;" />
            <div class="pl-2" >
              <v-btn base-color="#bdbdbd" style="height: 44px;" variant="outlined" @click="loadItems">
                <v-icon icon="mdi-magnify"></v-icon>
              </v-btn>
            </div>
            <div class=" mr-2" >
            <v-btn
              style="height: 44px; margin-left: 10px;"
              variant="outlined"
              @click="loadItems"
            >
              <v-icon icon="mdi-reload"></v-icon>
            </v-btn>
            </div>
            <div class=" pt-lg-0 pt-md-0 " >
                <v-btn to="/user/supportTicket/create" color="primary" style="height: 44px;" variant="flat">
                    <v-icon icon="mdi-plus"></v-icon>
                </v-btn>
            </div>
          </div>
        </div>
      </v-col>

      <v-col cols="12" class="mt-2">
        <v-card variant="">
          <v-data-table-server
            :loading="loading"
            :headers="headers"
            :items="items"
            :items-length="total"
            sort-asc-icon=""
            item-value="id"
            @update:options="loadItems"
          >
            <template #item.id="{ item }">
              <div class="d-flex align-center">
                <span class="font-weight-bold mr-2">#{{ item.id }}</span>
                <v-chip v-if="isToday(item.created_at)" size="x-small" color="primary" variant="flat">NEW</v-chip>
              </div>
            </template>

            <template #item.status="{ item }">
              <v-chip
                size="small"
                :color="getStatusColor(item.status)"
                class="text-uppercase font-weight-black"
                variant="tonal"
              >
                {{ getStatusTitle(item.status) }}
              </v-chip>
            </template>

            <template #item.priority="{ item }">
              <span :style="{ color: getPriorityColor(item.priority), fontWeight: '700' }">
                {{ item.priority }}
              </span>
            </template>

            <template #item.user_name="{ item }">
              {{ item.user_name }}
            </template>

            <template #item.action="{ item }">
              <div class="d-flex align-center ga-2">


                <router-link :to="'/user/supportTicket/chat/' + item.id">
                  <v-icon color="primary" class="pa-4">mdi-eye</v-icon>
                </router-link>

                <v-icon
                  class="pa-4"
                  color="success"
                  @click="openFeedback(item)"
                  v-if="item.closed_at && !item.feedback && item.status === 3 && item.rating === null"
                >
                  mdi-message-star
                </v-icon>

                <!-- <v-btn
                  v-if="item.closed_at && !item.feedback && item.status === 3 && item.rating === null"
                  size="small"
                  color="success"
                  variant="outlined"
                  prepend-icon="mdi-message-star"
                  @click="openFeedback(item)"
                ></v-btn> -->
              </div>
       
            </template>

            <template #bottom>
              <div class="py-2 d-flex justify-end border-t">
                <custom-pagination :loading="loading" v-model:page="filter.page" :lastPage="last_page" @page-changed="loadItems" />
              </div>
            </template>
          </v-data-table-server>
        </v-card>
      </v-col>
    </v-row>
  </v-container>


  <v-dialog v-model="feedbackDialog" max-width="500">
    <feedback 
      v-if="feedbackDialog"
      :ticket="selectedItem" 
      @close="feedbackDialog = false"
      @submitted="handleFeedbackSuccess" 
    />
  </v-dialog>


</template>

<script>
import feedback from './feedback.vue';
import General from '@/models/general.model';
export default {
  components: { feedback },
  data() {
    return {
      filter: { search: null, length: 10, page: 1, offset: 0 },
      items: [],
      last_page: 1,
      total: 0,
      loading: false,
      feedbackDialog: false,
      selectedItem: null,

      headers: [
        { title: "Ticket", key: "id" },
        { title: "Topic", key: "issue_topic" },
        { title: "Status", key: "status", align: 'center' },
        { title: "Priority", key: "priority", align: 'center' },
        { title: "Created", key: "created_at" },
        { title: "Action", key: "action", align: 'end', sortable: false },
      ],
      // Status Mapping for display
      statusMap: {
        0: { title: 'Open', color: '#9e9e9e' },
        1: { title: 'In Progress', color: '#1976d2' },
        2: { title: 'Resolved', color: '#2e7d32' },
        3: { title: 'Closed', color: '#d32f2f' },
      }
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
    openFeedback(item) {
      this.selectedItem = item;
      this.feedbackDialog = true;
    },
    handleFeedbackSuccess() {
      this.feedbackDialog = false;
      this.$alertStore?.add("Feedback submitted! Thank you.", "success");
      this.loadItems(); // Table refresh karein
    },
    getStatusTitle(val) { return this.statusMap[val]?.title || 'Unknown'; },
    getStatusColor(val) { return this.statusMap[val]?.color || '#000'; },
    
    getPriorityColor(priority) {
      if (priority === 'High') return '#d32f2f';
      if (priority === 'Medium') return '#fb8c00';
      return '#757575';
    },

    dateFormate(date) {
      return date ? date.split('T')[0] : "";
    },

    isToday(date) {
      return date ? new Date().toISOString().split('T')[0] === date.split('T')[0] : false;
    },

    async loadItems() {
      this.loading = true;
      try {
        let res = await General.get("/api/user/tickets", this.filter);
        this.items = res.data;
        this.total = Number(res.recordsTotal);
        this.last_page = Number(res.last_page);
        this.filter.offset = res.offset;
      } catch (error) {
        this.$alertStore?.add("Data load failed", "error");
      } finally {
        this.loading = false;
      }
    },


  }
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