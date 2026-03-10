<template>
  <user-title-bar title="Support Ticket">
    <template #action>
      <v-btn
        prepend-icon="mdi-arrow-left"
        color="primary"
        variant="flat"
        to="/user/supportTicket"
      >
        Back To List
      </v-btn>
    </template>
  </user-title-bar>

  <v-container max-width="1400px" class="mx-auto mt-4">
    <v-card class="pa-6 ticket-card bg-surface">
      <v-form ref="form" v-model="valid" @submit.prevent="submitTicket">
        <v-row>
          <v-col cols="12" md="6">
            <label class="form-label">Select Issue Topic</label>
            <v-select
              v-model="formData.issue_topic"
              :items="topics"
              placeholder="Select"
              density="compact"
              variant="outlined"
              :rules="[v => !!v || 'Required']"
              class="mt-1"
            />
          </v-col>

          <v-col cols="12" md="6">
            <label class="form-label">More Details</label>
            <v-text-field
              v-model="formData.issue_type"
              placeholder="Enter details"
              density="compact"
              variant="outlined"
              :rules="[v => !!v || 'Required']"
              class="mt-1"
            />
          </v-col>

   

          <v-col cols="12">
            <h5 class="mb-2 text-white">Description</h5>
            <v-textarea
              v-model="formData.details"
              placeholder="Explain your issue here..."
              variant="outlined"
              rows="4"
              class="mt-2"
              no-resize
              :rules="[v => !!v || 'Description is required']"
            />
          </v-col>

          <v-col cols="12">
            <label class="form-label">Upload Issue</label>
            <v-file-input
              v-model="attachmentFile"
              prepend-icon=""
              prepend-inner-icon="mdi-paperclip"
              label="Browse... No file selected"
              variant="outlined"
              density="compact"
              class="mt-1"
              show-size
              @change="previewImage"
            />
            
            <v-expand-transition>
              <div v-if="previewUrl" class="mt-4">
                <v-img :src="previewUrl" max-width="200" class="rounded border" />
              </div>
            </v-expand-transition>
          </v-col>

          <v-col cols="12" class="mt-2">
            <v-btn
              type="submit"
              color="primary"
              size="large"
              class="px-8"
              :loading="loading"
              :disabled="!valid"
            >
              Submit Ticket
            </v-btn>
          </v-col>
        </v-row>
      </v-form>
    </v-card>
  </v-container>
</template>

<script>
import General from '@/models/general.model';

export default {
  data() {
    return {
      valid: false,
      loading: false,
      previewUrl: null,
      attachmentFile: null,
      topics: [
        "Data Error / Incorrect Auction Info",
        "Can't Find a Vehicle",
        "Billing or Membership",
        "Login / Account Access",
        "Feature Request / Feedback",
        "Technical Bug / Other"
      ],
      formData: {
        issue_topic: null,
        issue_type: '', 
        details: '',
      },
    };
  },
  methods: {
    previewImage() {
      const file = this.attachmentFile ? (Array.isArray(this.attachmentFile) ? this.attachmentFile[0] : this.attachmentFile) : null;
      if (file) {
        this.previewUrl = URL.createObjectURL(file);
      } else {
        this.previewUrl = null;
      }
    },
    async submitTicket() {
      const { valid } = await this.$refs.form.validate();
      if (!valid) return;
      
      this.loading = true;
      try {


        const payload = { issue_topic: this.formData.issue_topic, issue_type: this.formData.issue_type, priority: this.formData.priority,details: this.formData.details,attachment: this.attachmentFile };

        await General.post("/api/user/tickets", payload);
        this.$alertStore.add("Ticket created successfully", "success");
        this.$router.push('/user/supportTicket');
      } catch (error) {
        console.error(error);
        this.$alertStore.add(error.response?.data?.message || "Failed to create ticket", "error");
      } finally {
        this.loading = false;
      }
    },
  },
};
</script>

<style scoped>
.form-label {
  color: #e2e8f0;
  font-size: 0.875rem;
  margin-bottom: 8px;
  display: block;
}
:deep(.v-field__outline) {
  --v-field-border-opacity: 0.3;
}
.v-btn {
  text-transform: none;
  font-weight: 600;
}
</style>