<template>
  <v-container max-width="1400px">
    <v-col cols="12">
      <v-card class="border">

        <!-- Header -->
        <div class="d-flex align-center justify-space-between px-4 py-3">

          <h3 class="text-h6 font-weight-bold">Blog & News Category Edit</h3>

          <v-btn variant="text" color="primary" class="text-capitalize" to="/admin/category">
            <v-icon start>mdi-arrow-left</v-icon>
            Back
          </v-btn>
        </div>

        <div class="border-b"></div>

        <v-container fluid>
          <v-row>

            <v-col cols="12" md="6">
              <v-text-field label="Title" v-model="form.title" variant="outlined" density="compact" hide-details
                class="id-box" />
            </v-col>

            <v-col cols="12" md="6">
              <v-select label="Category Type" v-model="form.type" :items="[
                { title: 'Blog', value: 'blog' },
                { title: 'News', value: 'news' }
              ]" item-title="title" item-value="value" variant="outlined" density="compact" hide-details />
            </v-col>

            <!-- Button -->
            <v-col cols="12" class="text-center mt-4">
              <v-btn :disabled="loading" @click="updateData" color="primary" height="40">
                Update
              </v-btn>
            </v-col>

          </v-row>

        </v-container>

      </v-card>
    </v-col>
  </v-container>

</template>

<script>
import General from '@/models/general.model';


export default {
  data() {
    return {
      form: {
        title: '',
        type: '',
      },
      id: this.$route.params.id,
      loading: false
    }
  },
  async mounted() {
    await this.fetchSignleRecord()
  },
  methods: {

    async fetchSignleRecord() {
      this.loading = true;
      try {
        const res = await General.get(
          "/api/cruds/blogCategory/" + this.id
        );

        const data = res.data;
        this.form.title = data.title;
        this.form.type = data.type;
        this.loading = false

      } catch (error) {
        this.$alertStore.add(
          error.message || 'Failed to fetch record',
          'error'
        );
        this.loading = false
      } finally {
        this.loading = false;
      }
    },

    async updateData() {
      this.loading = true;

      try {
        const res = await General.put("/api/cruds/blogCategory/" + this.id, this.form);
        this.$alertStore.add(res.message || "Edit SuccessFully ", "success")
      } catch (error) {
        this.$alertStore.add(error.message || 'Update failed', 'error');
      } finally {
        this.loading = false;
      }
    }
  }
}

</script>