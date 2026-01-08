<template>
  <v-select
    :model-value="modelValue"
    @update:model-value="updateValue"
    :items="items"
    item-title="label"
    item-value="value"
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
  </v-select>
</template>

<script>
export default {
  name: "BaseSelect",

  props: {
    modelValue: {
      type: [String, Number],
      default: null
    },
    label: {
      type: String,
      required: true
    },
    items: {
      type: Array,
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
