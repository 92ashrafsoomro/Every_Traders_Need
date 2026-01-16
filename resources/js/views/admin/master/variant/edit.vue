<template>
  <v-container max-width="1400px">
    <v-col cols="12">
      <v-card class="border">

        <div class="d-flex align-center justify-space-between px-4 py-3">
          <h3 class="text-h6 font-weight-bold">Edit Variant</h3>

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
                  v-model="id"
                  label="ID"
                  variant="outlined"
                  density="compact"
                  color="primary"
                  hide-details
                />
              </v-col>

  
              <v-col cols="4" class="pl-2">
                <MakeDropdown
                  label="Select Make"
                  variant="outlined"
                  item-title="name"
                  item-value="id"
                  color="primary"
                  v-model="makeid"
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
                  v-model="model_id"
                  :make="makeid"        
                  density="compact"
                  hide-details
                />
              </v-col>


              <v-col cols="12" class="mt-3">
                <v-text-field
                  v-model="titleInput"
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
                  @click="update"
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
      id: '',
      titleInput: '',
      makeid: null,
      model_id: null,
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

        
        const res = await Variant.find(id);

        if (res.data) {
          const record = res.data;

          this.id = record.id;
          this.titleInput = record.name;
          this.makeid = record.make_id;
          await this.$nextTick();
          this.model_id = record.modelId;
        } else {
          this.$alertStore.add('Record not found', 'error');
        }
      } catch (error) {
        this.$alertStore.add(error.message || 'Failed to fetch record', 'error');
      } finally {
        this.loading = false;
      }
    },
    async update() {
      this.loading = true;
      try {
        let formData = new FormData();
        formData.append('id', this.id);
        formData.append('name', this.titleInput);
        formData.append('model_id', this.model_id);
        const res = await Variant.update(this.id, formData);
        this.$alertStore.add(res.message || 'variant updated', 'success');
        this.$router.push('/admin/variant');
      } catch (error) {
        this.$alertStore.add(error.message || 'Update failed', 'error');
      } finally {
        this.loading = false;
      }
    },
    goBack() {
      this.$router.back();
    },
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
