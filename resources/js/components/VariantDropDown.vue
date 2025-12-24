<template>
  <v-select
    v-bind="$attrs"
    :model-value="modelValue"
    :items="items"
    item-title="label"
    item-value="id"
    :loading="loading"
    clearable
    :disabled="!modelId || loading"
    @update:model-value="updateValue"
    outlined
    dense
  />
</template>

<script>
import variant from "@/models/variant.model";

export default {
  name: "VariantDropdown",

  props: {
    modelValue: {
      type: [String, Number, Boolean],
      default: null,
    },

    modelId: {
      type: [String, Number, Boolean],
      default: null,
    },
  },

  data() {
    return {
      items: [],
      loading: false,
    };
  },

  watch: {
    modelId: {
      immediate: true,
      handler(newVal) {
        this.$emit("update:modelValue", null);

        if (newVal) {
          this.fetchVariants();
        } else {
          this.items = [];
        }
      },
    },
  },

  methods: {
    async fetchVariants() {
      this.loading = true;

      try {
        const response = await variant.get({
          model: this.modelId,   
        });


        this.items = (response?.data || []).map(item => ({
          id: item.id,
          label: item.label,   
        }));

      } catch (error) {
        console.error("VariantDropdown error:", error);
        this.items = [];
      } finally {
        this.loading = false;
      }
    },


  
    updateValue(value) {
      this.$emit("update:modelValue", value);
    },
  },

  emits: ["update:modelValue"],
};
</script>

<style scoped>
.v-select {
  min-width: 200px;
}
</style>
