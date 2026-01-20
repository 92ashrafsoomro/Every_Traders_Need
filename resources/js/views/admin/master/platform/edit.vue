<template>
  <v-container max-width="1400px">
    <v-col cols="12">
      <v-card class="border">

        <div class="d-flex align-center justify-space-between px-4 py-3">
          <h3 class="text-h6 font-weight-bold">Edit Platform</h3>

          <v-btn variant="text" color="primary" @click="goBack">
            <v-icon start>mdi-arrow-left</v-icon>
            Back
          </v-btn>
        </div>

        <div class="border-b"></div>

        <v-card-text v-if="!loading">
          <v-container fluid>
            <v-row>

              <!-- ID -->
              <v-col cols="4">
                <v-text-field
                  v-model="form.id"
                  label="ID"
                  variant="outlined"
                  density="compact"
                  color="primary"
                  readonly
                />
              </v-col>

              <!-- TITLE -->
              <v-col cols="4">
                <v-text-field
                  v-model="form.name"
                  label="Title"
                  variant="outlined"
                  density="compact"
                  color="primary"
                />
              </v-col>

              <!-- UPLOAD (SAME AS CREATE) -->
              <v-col cols="4">
                <v-btn
                  variant="outlined"
                  class="w-100"
                  color="primary"
                  @click="uploadImage"
                >
                  <v-icon class="mr-2">mdi-upload</v-icon>
                  Upload
                </v-btn>

                <v-file-input
                  ref="uploadInput"
                  accept="image/*"
                  @update:modelValue="handleFileChange"
                  style="position:absolute; left:-9999px; width:0; height:0;"
                />
              </v-col>

              <!-- PREVIEW -->
              <v-col cols="12" class="text-center mt-4">
                <v-img
                  v-if="imageUrl"
                  :src="imageUrl"
                  max-width="200"
                  max-height="200"
                  cover
                />
              </v-col>

              <!-- UPDATE -->
              <v-col cols="12" class="text-center mt-3">
                <v-btn color="primary" @click="updatePlatform">
                  Update
                </v-btn>
              </v-col>

            </v-row>
          </v-container>
        </v-card-text>

        <v-card-text v-else class="text-center">
          Loading...
        </v-card-text>

      </v-card>
    </v-col>
  </v-container>
</template>

<script>
import General from '@/models/general.model';
import Platform from '@/models/platform.model';
import { usePlatformStore } from '@/stores/platformStore';
export default {
  data() {
    return {
      platformStore : usePlatformStore(),
      form:{
        id: '',
        name: '',
        image: null, 
        imageUrl: null,   // preview (old or new)
      },     // NEW image (File)
      loading: false,
    };
  },

  async mounted() {
    await this.fetchPlatform();
  },

  methods: {
    async fetchPlatform() {
      this.loading = true;
      try {
        const res = await this.platformStore.getSinglePlatform(this.$route.params.id);

          this.form.id = res.id;
          this.form.name = res.name;
          // OLD image preview
          this.form.imageUrl = res.image_preview || null;
      } catch (e) {
        this.$alertStore.add('Failed to load platform', 'error');
      } finally {
        this.loading = false;
      }
    },

    uploadImage() {
      this.$refs.uploadInput.$el
        .querySelector('input')
        .click();
    },

    handleFileChange(file) {
      if (!file) return;

      // remove old preview url
      if (this.imageUrl) {
        URL.revokeObjectURL(this.form.imageUrl);
      }

      this.form.image = file;
      this.form.imageUrl = URL.createObjectURL(file);
    },

    async updatePlatform() {
      if (!this.form.name) {
        this.$alertStore.add('Title is required', 'error');
        return;
      }

      this.loading = true;
      try {
        // const formData = new FormData();
        // formData.append('name', this.name);

        // image sirf jab new select ho
        // if (this.image) {
        //   formData.append('image', this.image);
        // }

        const res = await General.put("/api/cruds/platform/"+this.form.id, this.form);
        this.$alertStore.add(res.message || 'Platform updated', 'success');
        this.$router.push('/admin/platform');
      } catch (e) {
        this.$alertStore.add('Update failed', 'error');
      } finally {
        this.loading = false;
      }
    },

    goBack() {
      this.$router.back();
    }
  }
};
</script>



<style scoped>
.buttonBorder {
  border-radius: 2px;
}

.custom-input :deep(input) {
  text-transform: capitalize;
  font-weight: 500;
}
</style>
