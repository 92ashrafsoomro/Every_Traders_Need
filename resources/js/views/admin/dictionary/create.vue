<template>
  <v-container max-width="1400px">
    <v-col cols="12">
      <v-card class="border ">
        <div class="d-flex align-center justify-space-between px-4 py-3">
          <h3 class="text-h6 font-weight-bold">Create Prefixes</h3>
          <v-btn variant="text" color="primary" @click="goBack">
            <v-icon start>mdi-arrow-left</v-icon>
            Back
          </v-btn>
        </div>
        <div class="mx-6">


          <div class="border-b"></div>
          <v-card-text>
            <h3 class="text-h4 font-weight-bold mb-4">Add Prefixes</h3>

            <v-row class="mb-6">

              <v-col cols="4">
                <BaseSelect v-model="form.name" label="Prefixes Name" required :items="Dictionary.prefixName" />
              </v-col>

              <v-col cols="4">
                <BaseField v-model="form.key" label="Prefixes Key" required />

              </v-col>

              <v-col cols="4">
                <BaseField v-model="form.value" label="Prefixes Value" required />
              </v-col>
            </v-row>

          </v-card-text>


          <v-row class="mb-2">
            <v-col cols="12" class="text-end">
              <v-btn color="primary" @click="submitForm">
                Add Prefixes
              </v-btn>
            </v-col>
          </v-row>

        </div>

      </v-card>
    </v-col>
  </v-container>
</template>


<script>
import Dictionary from "@/models/dictionary";
import api from "@/plugins/axios";
import BaseField from "./component/BaseField.vue";
import BaseSelect from "./component/BaseSelect.vue";
export default {
  components: { BaseField, BaseSelect },

  data() {
    return {
        Dictionary,
      form: {
        name: "",
        key: "",
        value: ""
      },
    };
  },

  methods: {

    async submitForm() {
      try {
        let res = await api.post("/api/cruds/prefixes", {
          name: this.form.name,
          key: this.form.key,
          value: this.form.value
        });
        this.form.name = "";
        this.form.key = "",
        this.form.value = ""
        this.$alertStore.add("Prefixes Add");
      }
      catch (error) {
        this.$alertStore.add(
          error.response?.data?.message || "Something went wrong",
          "error"
        );
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
