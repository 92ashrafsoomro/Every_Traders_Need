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
                            variant="outlined" 
                            item-title="label" 
                            item-value="value"
                            :model-value="form[field.key]"
                            @update:model-value="handleValue($event,field.key)"
                            :return-object="false" />
                    </v-col>
                </v-row>
            </v-card-text>
            <v-card-actions>
                <v-btn variant="tonal" @click="submitForm" type="submit" color="primary">Save</v-btn>
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
      fields:fields,
      form: {},
    };
    },
  mounted() {

      fields.map(item => {
          this.form[item.key] = '';
      });
 
  },

  methods: {
    handleFile(event, key) {
      this.form[key] = event.target.files[0];
      },
      handleValue(value,key) {

          
          this.form[key] = value;
        
    },
    submitForm() {

        console.log(this.form);
        
    }
  }
};
</script>
