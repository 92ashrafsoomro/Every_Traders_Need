<template>
  <v-container max-width="1400px">
    <v-col cols="12">
      <v-card class="border ">
        <div class="d-flex align-center justify-space-between px-4 py-3">
          <h3 class="text-h6 font-weight-bold">Create Dictionary</h3>
          <v-btn variant="text" color="primary" @click="goBack">
            <v-icon start>mdi-arrow-left</v-icon>
            Back
          </v-btn>
        </div>
     


          <div class="border-b"></div>
        
        <v-card-text>
          <v-container fluid="">
     
            <v-row class="mb-6">

              <v-col cols="4">

                <v-select label="Select" 
                :items="Dictionary.prefixName"
                 item-title="label" 
                 item-value="value"
                 density="compact"
                variant="outlined"
                  v-model="form.name" />
              </v-col>


              <v-col cols="4">
              <v-text-field
                v-model="form.key"
                label="Prefixes Key"
                density="compact"
                variant="outlined"
                clearable
                required
              />


              </v-col>
              <v-col cols="4">
                <v-text-field  v-model="form.value"
                  label="Prefixes Value"
                  clearable
                  required
                   density="compact"
                variant="outlined"
                  :disabled="!form.name"
                  @input="suggestion"  :hint="!form.name ? 'Please select prefix type first' : ''"  persistent-hint />


                <v-card v-if="showList" v-click-outside="closeList" style="height: 200px; overflow-y: auto;">
                  <v-list-item v-for="item in searchItem" :key="item.id" @click="selectItem(item)"
                    style="cursor: pointer;">
                    {{ item.name }}
                  </v-list-item>
                </v-card>
              </v-col>


            </v-row>
          </v-container >
       
          <v-row class="mb-2">
            <v-col cols="12" class="text-end">
              <v-btn color="primary" @click="submitForm" :disabled="loading">
                Add Dictionary
              </v-btn>
            </v-col>
          </v-row>
          </v-card-text>




      </v-card>
    </v-col>
  </v-container>
</template>


<script>
import Dictionary from "@/models/dictionary";
import api from "@/plugins/axios";
import BaseField from "./component/BaseField.vue";
import BaseSelect from "./component/BaseSelect.vue";
import BodyType from "@/models/body-type.model";
import Center from "@/models/center.model";
import Make from "@/models/make.model";
import Model from '@/models/vehicle-model.model';
import Variant from "@/models/variant.model";
import PlateformDropdown from "@/components/PlateformDropdown.vue";
import VehicleType from "@/models/vehicle-type.model";

export default {
  components: { BaseField, BaseSelect, PlateformDropdown },

  data() {
    return {
      Dictionary,
      showList: false,
      loading : false,
      searchItem: [

      ],
      form: {
        name: "",
        key: "",
        value: ""
      },
    };
  },

  methods: {
    selectItem(item) {
      this.form.value = item.name
    },
   async suggestion() {
  if (!this.form.value || !this.form.name) {
    this.showList = false
    this.searchItem = []
    return
  }

  this.showList = true

  switch (this.form.name) {
    case "vehicleType":
      this.searchItem = (await VehicleType.all({
        search: this.form.value
      })).data
      break

    case "bodyType":
      this.searchItem = (await BodyType.all({
        search: this.form.value
      })).data
      break
    
    case "center":
      this.searchItem = (await Center.all({
        search: this.form.value
      })).data
      break

    case "make":
      this.searchItem = (await Make.all({
        search: this.form.value
      })).data
      break

    case "model":
      this.searchItem = (await Model.all({
        search: this.form.value
      })).data
      break

    case "variant":
      this.searchItem = (await Variant.all({
        search: this.form.value
      })).data
      break
  }
},
    selectItem(item) {
      this.form.value = item.name
      this.showList = false
    },
    closeList() {
      this.showList = false
    },

    async submitForm() {
      this.loading = true
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
       this.loading = false
      }
      catch (error) {
        this.$alertStore.add(
          error.response?.data?.message || "Something went wrong",
          "error"
        );
        this.loading = false
      }
    },
    goBack() {
      this.$router.back();
    }
  },
  watch: {
    'form.name'(newVal, oldVal) {
      if (newVal !== oldVal) {
        this.form.value = ""
        this.form.key = ""
        this.searchItem = []
        this.showList = false
      }
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
