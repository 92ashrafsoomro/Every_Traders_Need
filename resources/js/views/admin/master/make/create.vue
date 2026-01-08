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
                            <v-col cols="11" sm="9" class="pl-2">
                            <v-text-field
                                v-model="titleInput"    
                                label="Title"
                                variant="outlined"
                                density="compact"
                                color="primary"
                                clearable
                                persistent-placeholder=""
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
import Make from '@/models/make.model';
export default {
  props: {
    title: {   
      type: String,   
      default: 'Create Make',
    }
  },
  data() {
    return {
      id: '',      
      titleInput: '' 
    }
  },
   methods: {
    async  submitId() {
       this.loading = true;

        try {
            let formData = new FormData();
            formData.append('id', this.id);
            formData.append('name', this.titleInput);

            let res = await Make.create(formData);
            this.$alertStore.add(res.message, 'success');
            this.$router.push('/admin/make');

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
