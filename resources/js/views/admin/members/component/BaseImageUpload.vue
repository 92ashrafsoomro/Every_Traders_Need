<template>
  <div class="image-upload">
    <v-btn
      variant="outlined"
      color="primary"
      class="w-100"
      @click="openFilePicker"
    >
      <v-icon class="mr-2">mdi-upload</v-icon>
      {{ label }}
    </v-btn>

    <v-file-input
      ref="fileInput"
      accept="image/*"
      style="display: none"
      @update:model-value="onFileChange"
    />

    <div v-if="preview" class="mt-2 text-center">
      <v-img
        :src="preview"
        max-width="150"
        aspect-ratio="1"
        class="rounded"
        cover
      />
    </div>
  </div>
</template>

<script>
export default {
  name: "BaseImageUpload",

  props: {
    modelValue: {
      type: File,
      default: null,
    },
    label: {
      type: String,
      default: "Upload Image",
    },
  },

  emits: ["update:modelValue"],

  data() {
    return {
      preview: null,
    };
  },

  watch: {
    modelValue(newVal) {
      if (!newVal) {
        this.clearPreview();
      }
    },
  },

  methods: {
    openFilePicker() {
      this.$refs.fileInput.$el.querySelector("input").click();
    },

    onFileChange(file) {
      if (!file) return;

      if (this.preview) {
        URL.revokeObjectURL(this.preview);
      }

      this.preview = URL.createObjectURL(file);


      this.$emit("update:modelValue", file);
    },

    clearPreview() {
      if (this.preview) {
        URL.revokeObjectURL(this.preview);
        this.preview = null;
      }
    },
  },

  beforeUnmount() {
    this.clearPreview();
  },
};
</script>

<style scoped>
.image-upload {
  position: relative;
}

</style>
