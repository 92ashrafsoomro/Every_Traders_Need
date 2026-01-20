<template>
  <v-container max-width="1400px">
    <v-col cols="12">
      <v-card class="border">

        <div class="d-flex align-center justify-space-between px-4 py-3">
          <h3 class="text-h6 font-weight-bold">Create Variant</h3>

          <v-btn variant="text" color="primary" @click="goBack">
            <v-icon start>mdi-arrow-left</v-icon>
            Back
          </v-btn>
        </div>

        <div class="border-b"></div>

        <v-card-text>
          <v-container fluid>
            <v-row>
              <v-col cols="4" class="pl-2">
                <MakeDropdown
                  label="Select Make"
                  variant="outlined"
                  item-title="name"
                  item-value="id"
                  clearable
                  color="primary"
                  v-model="form.makeid"
                  density="compact"
                  hide-details
                />
              </v-col>

              <v-col cols="4" class="pl-2">
                <ModelDropdown
                  label="Select Model"
                  variant="outlined"
                  color="primary"
                  item-title="name"
                  item-value="id"
                  v-model="form.model_id"
                  :make="form.makeid"        
                  density="compact"
                  hide-details
                />
              </v-col>


              <v-col cols="4" class="">
                <v-text-field
                  v-model="form.name"
                  label="Title"
                  variant="outlined"
                  density="compact"
                  color="primary"
                  hide-details
                />
              </v-col>

   
              <v-col cols="12" class="text-center mt-3">
                <v-btn
                  color="primary"
                  variant="flat"
                  @click="submitId"
                >
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
import Variant from '@/models/variant.model';
import MakeDropdown from "@components/MakeDropdown.vue";
import ModelDropdown from "@components/ModelDropdown.vue";

export default {
  components: {
    MakeDropdown,
    ModelDropdown,
  },

  data() {
    return {
    form:{
      id: '',
      name: '',
      makeid: null,
      model_id: null,
    },
      loading: false,
    };
  },

  methods: {
    async submitId() {
      if (!this.form.makeid || !this.form.model_id || !this.form.name) {
        this.$alertStore.add('All fields are required', 'error');
        return;
      }

      this.loading = true;
      try {
        // const formData = new FormData();
        // formData.append('id', this.id);
        // formData.append('name', this.name);
        // formData.append('model_id', this.model_id);

        const res = await General.post("api/cruds/variant", this.form);
        this.$alertStore.add(res.message, 'success');
        this.$router.push('/admin/variant');
      } catch (err) {
        this.$alertStore.add(err.message || 'Failed', 'error');
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
