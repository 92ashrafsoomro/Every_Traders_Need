<template>
  <v-container max-width="1400px">
    <v-col cols="12">
      <v-card class="border" :disabled="loading" >

        <div class="d-flex align-center justify-space-between px-4 py-3">
          <h3 class="text-h6 font-weight-bold">Edit Variant</h3>

          <v-btn variant="text" color="primary"    to="/admin/variant" @click="goBack">
            <v-icon start>mdi-arrow-left</v-icon>
            Back
          </v-btn>
        </div>

        <div class="border-b"></div>

        <v-card-text>
          <v-container fluid>
            <v-row>


              <v-col cols="4">
                <v-text-field v-model="form.id" label="ID" disabled="" variant="outlined" density="compact"
                  color="primary" hide-details />
              </v-col>


              <v-col cols="4" class="pl-2">
                <MakeDropdown label="Select Make" variant="outlined" item-title="name" item-value="id"
                  v-model="form.makeid" color="primary" density="compact" hide-details clearable/>
              </v-col>

              <v-col cols="4" class="pl-2">
                <ModelDropdown label="Select Model" variant="outlined" color="primary" item-title="name" item-value="id"
                  v-model="form.model_id" :make="form.makeid" density="compact" hide-details  clearable/>
              </v-col>


              <v-col cols="12" class="mt-3">
                <v-text-field v-model="form.name" clearable label="Title" variant="outlined" density="compact" color="primary"
                  hide-details />
              </v-col>


              <v-col cols="12" class="text-center mt-3">
                <v-btn color="primary" variant="flat" @click="update">
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
import General from '@/models/general.model';
import { useVariantStore } from '@/stores/variantStore';

export default {
  components: {
    MakeDropdown,
    ModelDropdown,
  },
  data() {
    return {
      variantStore: useVariantStore(),
      form: {
        id: '',
        name: '',
        makeid: null,
        model_id: null,
      },
      loading: false,
    };
  },
  async mounted() {
    this.fetchSingleRecord();
  },
  methods: {
    async fetchSingleRecord() {
      this.loading = true;
      try {
        let data = await this.variantStore.getSingleVariant(this.$route.params.id);
        this.form.id = data.id;
        this.form.name = data.name;
        this.form.makeid = data.makeId;
        this.form.model_id = data.modelId;
      } catch (error) {
        this.$alertStore.add(error.message);
      } finally {
        this.loading = false;
      }
    },

    async update() {
      this.loading = true;
      try {
        if (!this.form.id) {
          this.$alertStore.add('Id not found' , 'error');
          return false
        }
        const res = await General.put("/api/cruds/variant/" + this.form.id, this.form);
          console.log(res);
          
          this.$alertStore.add(res.message || 'variant updated', 'success');
          this.loading = false;
          this.$router.push('/admin/variant');
          
        } catch (error) {
          this.$alertStore.add(error.message || 'Update failed', 'error');
          this.loading = false;
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
