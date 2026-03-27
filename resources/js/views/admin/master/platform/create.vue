<template>
  <v-container max-width="1400px">
    <v-col cols="12">
           <v-card class="border " :disabled="loading" >

        <div class="d-flex align-center justify-space-between px-4 py-3">
          <h3 class="text-h6 font-weight-bold">Create Platform</h3>

          <v-btn variant="text" color="primary" 
                to="/admin/platform" @click="goBack">
            <v-icon start>mdi-arrow-left</v-icon>
            Back
          </v-btn>
        </div>

        <div class="border-b"></div>

        <v-card-text>
          <v-container fluid>
            <v-row>
                <v-col cols="12" lg="6" md="6">
                <v-text-field
                  v-model="form.name"
                  label="Title"
                  variant="outlined"
                  density="compact"
                   
                  color="primary"
                />
              </v-col>




              <v-col cols="12" lg="6" md="6">
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
                <v-btn color="primary"    :disabled="loading"  @click="submitForm">
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
import General from '@/models/general.model';
import Platform from '@/models/platform.model';

export default {
  data() {
    return {
      form:{
        id: '',
        name: '',
        image: null,
      },
      imageUrl: null,
      loading : false
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


      this.form.image = file;


      if (this.form.imageUrl) {
        URL.revokeObjectURL(this.form.imageUrl);
      }

      this.form.imageUrl = URL.createObjectURL(this.form.image);
    },

    async submitForm() {
       this.loading = true;
       
       try {
         //  const formData = new FormData();
         // formData.append('id', this.id);
         // formData.append('name', this.name);
         // formData.append('image', this.image);
         
         const res = await General.post("/api/cruds/platform",this.form);
         this.$alertStore.add(res.message, 'success');
         this.loading = false;
         this.$router.push('/admin/platform');
        } catch (error) {
          this.$alertStore.add(error.message, 'error');
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
