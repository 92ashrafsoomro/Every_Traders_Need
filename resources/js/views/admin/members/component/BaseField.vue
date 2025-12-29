<template>
  <v-text-field
    :model-value="modelValue"
    @update:model-value="updateValue"
    variant="outlined"
    density="compact"
    color="primary"
    persistent-placeholder
    hide-details
  >
    <template #label>
      {{ label }}
      <span v-if="required" class="text-red">*</span>
    </template>
  </v-text-field>
</template>

<script>
export default {
  name: "BaseField",

  props: {
    modelValue: {
      type: [String, Number],
      default: ""
    },
    label: {
      type: String,
      required: true
    },
    required: {
      type: Boolean,
      default: false
    }
  },

  emits: ["update:modelValue"],

  methods: {
    updateValue(value) {
      this.$emit("update:modelValue", value);
    }
  }
};
</script>

<style scoped>
.text-red {
  color: red;
  font-weight: 600;
}
</style>
