<template>
  <v-card class="feedback-card pa-4" theme="adminDark">
    <div class="d-flex justify-end">
        <v-btn icon="mdi-close" variant="text" density="compact" @click="$emit('close')"></v-btn>
    </div>

    <v-card-title class="d-flex align-center justify-center flex-column pb-2 pt-0">
      <v-avatar color="primaryDark" size="64" class="mb-3">
        <v-icon icon="mdi-message-draw" color="white" size="32"></v-icon>
      </v-avatar>
      <span class="text-h5 font-weight-bold text-center">We Value Your Feedback!</span>
      <p class="text-caption text_light mt-1 text-center">
        Ticket #{{ ticket?.id }} - How was your experience?
      </p>
    </v-card-title>

    <v-card-text class="mt-4">
      <v-form ref="feedbackForm">
        <div class="d-flex flex-column align-center mb-6">
          <v-rating
            v-model="form.rating"
            hover
            color="warning"
            active-color="warning"
            size="x-large"
          ></v-rating>
          <span class="text-caption mt-2" :style="{ color: getRatingColor }">
            {{ getRatingText }}
          </span>
        </div>

        <label class="form-label">Your Comments</label>
        <v-textarea
          v-model="form.feedback"
          placeholder="Tell us what we can improve..."
          variant="outlined"
          bg-color="inputBg"
          rows="4"
          class="mt-2 custom-input"
          no-resize
          hide-details
        ></v-textarea>
      </v-form>
    </v-card-text>

    <v-card-actions class="pb-4 px-4">
      <v-btn
        block
        color="primary"
        size="large"
        variant="flat"
        :loading="loading"
        @click="submitFeedback"
      >
        Submit Feedback
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
import General from '@/models/general.model';

export default {
  props: ['ticket'],
  data() {
    return {
      loading: false,
      form: {
        rating: 5,
        feedback: ''
      }
    }
  },
  computed: {
    getRatingText() {
      if (this.form.rating >= 5) return 'Excellent!';
      if (this.form.rating >= 4) return 'Very Good';
      if (this.form.rating >= 3) return 'Good';
      return 'Could be better';
    },
    getRatingColor() {
      if (this.form.rating >= 4) return '#4CAF50';
      if (this.form.rating >= 3) return '#FB8C00';
      return '#FF5252';
    }
  },
  methods: {
    async submitFeedback() {
      this.loading = true;
      try {
        // Backend API endpoint ke mutabiq adjust karein
        await General.post(`/api/user/tickets/${this.ticket.id}/feedback`, this.form);
        this.$emit('submitted');
      } catch (error) {
        console.error(error);
        alert("Failed to submit feedback");
      } finally {
        this.loading = false;
      }
    }
  }
}
</script>