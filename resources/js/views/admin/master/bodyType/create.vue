<template>

    <v-container>
        <v-card title="Create BodyType">
            <div class="border"></div>
            <v-card-text>
                 <v-row>
                    <v-col v-for="field in fields" :key="field.key" :sm="field.col"> 
                        <DynmaicInput 
                            :field="field.type" 
                            :label="field.label" 
                            :items="field.options" 
                            item-text="label" 
                            item-value="value" />
                    </v-col>
                </v-row>
            </v-card-text>
            <v-card-actions>
                <v-btn variant="tonal" type="submit" color="primary">Save</v-btn>
            </v-card-actions>
        </v-card>

    </v-container>

</template>

<script>
import fields from "./fields.js";
import DynmaicInput from "./DynmaicInput.vue";

export default {
  props: {
        modelValue: Object, 
    },
    components: {
    DynmaicInput
  },

  data() {
    return {
      fields,
      form: { ...this.modelValue }, // local copy
    };
  },

  methods: {
    handleFile(event, key) {
      this.form[key] = event.target.files[0];
    },

    submitForm() {
      this.$emit("update:modelValue", this.form); // send back updated form
      this.$emit("submit");
    }
  }
};
</script>
