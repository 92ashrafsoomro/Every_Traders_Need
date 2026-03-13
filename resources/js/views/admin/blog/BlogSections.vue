<template>
  <div class="mt-6">
    <div class="d-flex align-center justify-space-between mb-4 px-2">
      <h4 class="text-subtitle-1 font-weight-bold text-primary">
        <v-icon start>mdi-layers-triple</v-icon> Additional Content Sections
      </h4>
      <v-btn color="primary" prepend-icon="mdi-plus" variant="tonal" @click="addSection">
        Add Section
      </v-btn>
    </div>

    <v-divider class="mb-6"></v-divider>

    <v-card v-for="(section, index) in modelValue" :key="index" class="pa-4 mb-6 border-dashed" variant="outlined">
      <div class="d-flex justify-space-between align-center mb-4">
        <v-chip color="grey" size="small" label font-weight-bold>SECTION #{{ index + 1 }}</v-chip>
        <v-btn icon="mdi-delete-outline" color="error" variant="text" @click="removeSection(index)"></v-btn>
      </div>

      <v-row>
        <v-col cols="12" md="8">
          <v-text-field v-model="section.distitle" label="Section Title" variant="outlined" density="compact" />
        </v-col>

        <v-col cols="12" md="4">
          <v-select v-model="section.alignment" :items="['left', 'center', 'right']" label="Alignment" variant="outlined" density="compact" />
        </v-col>

        <v-col cols="12" class="mb-4">
          <p class="text-caption mb-1">Section Description</p>
          <QuillEditor
            v-model:content="section.disdescription"
            content-type="html"
            :toolbar="[
                ['bold', 'italic', 'underline', 'strike'],
                ['link', 'image', 'video'],
                [{ list: 'ordered' }, { list: 'bullet' }],
                [{ header: [1, 2, 3, false] }],
                [{ align: [] }],
                ['clean']
            ]"
            theme="snow"
          />
        </v-col>

        <v-col cols="12" class="mt-12">
          <v-file-input
            label="Section Image"
            variant="outlined"
            density="compact"
            prepend-icon="mdi-camera"
            accept="image/*"
            @update:modelValue="(file) => handleFile(file, index)"
          />
          <v-img 
            v-if="section.preview || section.disimage_url" 
            :src="section.preview || section.disimage_url" 
            max-height="150" 
            class="mt-2 rounded border"
            width="200"
            cover
          ></v-img>
        </v-col>
      </v-row>
    </v-card>
  </div>
</template>

<script>
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';

export default {
  components: { QuillEditor },
  props: {
    modelValue: { type: Array, default: () => [] }
  },
  emits: ['update:modelValue'],
  methods: {
    addSection() {
      const newList = [...this.modelValue, {
        distitle: '',
        disdescription: '',
        disimage: null,
        disimage_url: '', 
        alignment: 'left',
        preview: null
      }];
      this.$emit('update:modelValue', newList);
    },
    removeSection(index) {
      const newList = [...this.modelValue];
      newList.splice(index, 1);
      this.$emit('update:modelValue', newList);
    },
    handleFile(file, index) {
      const newList = [...this.modelValue];
      if (file) {
        newList[index].disimage = file;
        newList[index].preview = URL.createObjectURL(file);
      } else {
        newList[index].disimage = null;
        newList[index].preview = null;
      }
      this.$emit('update:modelValue', newList);
    }
  }
}
</script>

<style scoped>
.border-dashed { border: 1px dashed #ccc !important; }
:deep(.ql-container) { min-height: 150px; }
</style>