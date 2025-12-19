<template>
  <v-container max-width="1400px">
    <v-col cols="12" md="12">
      <v-card class="border">
        <div class="d-flex align-center justify-space-between px-4 py-3">
          <h3 class="text-h6 font-weight-bold">
           Edit Platform
          </h3>
          <v-btn
            variant="text"
            color="primary"
            class="text-capitalize"
            @click="goBack"
          >
            <v-icon start>mdi-arrow-left</v-icon>
            Back
          </v-btn>
        </div>

        <div class="border-b"></div>

        <v-card-text v-if="!loading">
          <v-container fluid>
            <v-row>
              <v-col cols="12">
                <v-row align="center" no-gutters>
                  <v-col cols="4" sm="4">
                    <v-text-field
                      v-model="id"
                      label="ID"
                      variant="outlined"
                      density="compact"
                      color="primary"
                      readonly
                      class="id-box"
                      persistent-placeholder
                      hide-details
                    />
                  </v-col>
                  <v-col cols="4" sm="4" class="pl-2">
                    <v-text-field
                      v-model="titleInput"
                      label="Title"
                      variant="outlined"
                      density="compact"
                      color="primary"
                      clearable
                      persistent-placeholder
                      class="custom-input"
                      hide-details
                    />
                  </v-col>
                  <v-col cols="4" sm="4" class="pl-2">
                            <v-file-input
                                v-model="image"    
                                label="Image"
                                accept="image/*"
                                variant="outlined"
                                density="compact"
                                color="primary"
                                prepend-icon=""
                                persistent-placeholder=""
                                @change="previewImage"
                            />
                            </v-col>
                </v-row>
              </v-col>
              <div class="d-flex w-100">

                <v-img v-if="imageUrl" :src="imageUrl" width="50" height="50"></v-img>
              </div>
              <v-col cols="12" class="mt-3 text-center">
                <v-btn
                  @click="updateBodyType"
                  class="buttonBorder bg-primary"
                  variant="flat"
                  style="height: 40px;"
                >
                  <span class="text-capitalize text-body-1 text-white">
                    Update
                  </span>
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
import Platform from '@/models/platform.model';
export default {
  data() {
    return {
      id: '',
      titleInput: '',
      image:"",
      imageUrl:"",
      loading: false,
    };
  },
  async mounted() {
    await this.fetchSingleRecord();
  },
  methods: {
    async fetchSingleRecord() {
    this.loading = true;
    try {
        const id = this.$route.params.id;
        const res = await Platform.find(id);
        if (res.data && res.data.length > 0) {
        const record = res.data[0];  
        console.log(res.data[0])
        this.id = record.id;
        this.titleInput = record.name;
        this.image =record.image
        this.imageUrl = record.image_preview;
        } else {
        this.$alertStore.add('Record not found', 'error');
        }
    } catch (error) {
      
        this.$alertStore.add(error.message || 'Failed to fetch record', 'error');
    } finally {
        this.loading = false;
    }
    },



    async updateBodyType() {
      this.loading = true;
      try {
        let formData = new FormData();
        formData.append('name', this.titleInput);
        const res = await Platform.update(this.id, formData);
        this.$alertStore.add(res.message || 'platform updated', 'success');
        this.$router.push('/admin/platform');
      } catch (error) {
        this.$alertStore.add(error.message || 'Update failed', 'error');
      } finally {
        this.loading = false;
      }
    },
    goBack() {
      this.$router.back();
    },
    previewImage(){
      if(this.image){
        this.imageUrl = URL.createObjectURL(this.image)
        console.log(this.imageUrl)
      }else{
        this.imageUrl=null
      }
    }
  },
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
