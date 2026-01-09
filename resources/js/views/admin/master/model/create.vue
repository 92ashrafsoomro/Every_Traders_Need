<template>
<v-container  max-width="1400px">
    <v-col cols="12" md="12">
        <v-card class="border " >
            <div class="d-flex align-center justify-space-between px-4 py-3">
                <h3 class="text-h6 font-weight-bold">
                {{ title }}
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
            <v-card-text>
                <v-container fluid>
                <v-row>
                    <v-col cols="12">
                        <v-row align="center" no-gutters>
                            <v-col cols="4" sm="4" class="pl-2">
                                <MakeDropdown label="Select Make" variant="outlined" color="primary"class="id-box" v-model="makeid" 
                                   
                                  hide-details
                                  density="compact"  />
                            </v-col>
                            <v-col cols="4" sm="4" class="pl-2">
                              <v-text-field
                                  v-model="titleInput"    
                                  label="Title"
                                  variant="outlined"
                                  density="compact"
                                  color="primary"
                                  clearable
                                   
                                  class="custom-input"
                                  
                                  hide-details
                              />
                            </v-col>

                        </v-row>
                    </v-col>
                    <v-col cols="12" class="mt-3 text-center">
                    <v-btn
                        @click="submitId"
                        class="buttonBorder bg-primary"
                        variant="flat"
                        style="height: 40px;"
                    >
                        <span class="text-capitalize text-body-1 text-white">
                        Submit
                        </span>
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
import Model from '@/models/vehicle-model.model';
import MakeDropdown from "@components/MakeDropdown.vue"
export default {
  components:{
    MakeDropdown,
  },
  props: {
    title: {   
      type: String,   
      default: 'Create Model',
    }
  },
  data() {
    return {
      id: '',      
      titleInput: '',
      makeid:"", 
    }
  },
   methods: {
    async  submitId() {
       this.loading = true;

        try {
            let formData = new FormData();
            console.log(this.makeid)
            formData.append('id', this.id);
            formData.append('name', this.titleInput);
            formData.append('make_id', this.makeid);

            let res = await Model.create(formData);
            this.$alertStore.add(res.message, 'success');
            this.$router.push('/admin/model');

        } catch (error) {
            console.error(error);
            this.$alertStore.add(error.message, 'error');
        } finally {
            this.loading = false;
            this.resetForm();
        }

    },
    goBack() {
      this.$router.back();
    }
  }
}
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
