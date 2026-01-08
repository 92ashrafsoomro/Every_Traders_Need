<template>
  <v-container max-width="1400px">
    <v-col cols="12">
      <v-card class="border">

        <div class="d-flex align-center justify-space-between px-4 py-3">
          <h3 class="text-h6 font-weight-bold">{{ title }}</h3>

          <v-btn variant="text" color="primary" @click="goBack">
            <v-icon start>mdi-arrow-left</v-icon>
            Back
          </v-btn>
        </div>

        <div class="border-b"></div>

        <v-card-text>
          <v-container fluid>
            <v-row>
                <v-col cols="4">
                <v-text-field
                  v-model="titleInput"
                  label="Title"
                  variant="outlined"
                  density="compact"
                  persistent-placeholder=""
                  color="primary"
                />
              </v-col>




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

  
              <v-col class="d-flex justify-center text-center mt-4 w-100">
                <v-img
                  v-if="imageUrl"
                  :src="imageUrl"
                  max-width="200"
                  max-height="200"
                  cover
                />
              </v-col>

   
              <v-col cols="12" class="text-center mt-3">
                <v-btn color="primary" @click="submitForm">
                  Submit
                </v-btn>
              </v-col>

            </v-row>
          </v-container>
        </v-card-text>

      </v-card>
    </v-col>
  </v-container>
</template>

<script>
import Platform from '@/models/platform.model';

export default {
  data() {
    return {
      id: '',
      titleInput: '',
      image: null,
      imageUrl: null,
    };
  },

  methods: {
    uploadImage() {

      this.$refs.uploadInput.$el
        .querySelector('input')
        .click();
    },

    handleFileChange(file) {
      if (!file) return;


      this.image = file;


      if (this.imageUrl) {
        URL.revokeObjectURL(this.imageUrl);
      }

      this.imageUrl = URL.createObjectURL(this.image);
    },

    async submitForm() {
      if (!this.id || !this.titleInput || !this.image) {
        this.$alertStore.add('All fields are required', 'error');
        return;
      }

      const formData = new FormData();
      formData.append('id', this.id);
      formData.append('name', this.titleInput);
      formData.append('image', this.image);

      const res = await Platform.create(formData);
      this.$alertStore.add(res.message, 'success');
      this.$router.push('/admin/platform');
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
