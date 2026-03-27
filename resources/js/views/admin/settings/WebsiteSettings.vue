<template>
  <v-row>
    <v-col cols="12" >
      <label class="text-body-2 font-weight-medium mb-2 d-block">
        Footer Text
      </label>
      <QuillEditor
        v-model:content="form.footertext"
        content-type="html"
        :modules="editorOptions.modules"
        theme="snow"
      />
    </v-col>
    <v-col cols="12" md="12" class="mb-8">

    </v-col>

    <v-col cols="6"  class="mb-8">
      <label class="text-body-2 font-weight-medium mb-2 d-block">
        Dark Logo
      </label>
      <v-btn variant="outlined" class="w-100" color="primary" @click="uploadImage('dark')">
        <v-icon class="mr-2">mdi-upload</v-icon>
        Upload
      </v-btn>
      <v-file-input
        ref="darkInput"
        accept="image/*"
        @update:modelValue="handleFileChange('dark', $event)"
        style="position:absolute; left:-9999px; width:0; height:0;"
      />
    </v-col>
    <v-col class="d-flex mt-4 w-100 bg-black">
      <v-img v-if="darkLogoUrl" :src="darkLogoUrl" max-width="200" max-height="200" cover />
    </v-col>

    <v-col cols="6">
      <label class="text-body-2 font-weight-medium mb-2 d-block">
        Light Logo
      </label>
      <v-btn variant="outlined" class="w-100" color="primary" @click="uploadImage('light')">
        <v-icon class="mr-2">mdi-upload</v-icon>
        Upload
      </v-btn>
      <v-file-input
        ref="lightInput"
        accept="image/*"
        @update:modelValue="handleFileChange('light', $event)"
        style="position:absolute; left:-9999px; width:0; height:0;"
      />
    </v-col>
    <v-col class="d-flex mt-4 w-100 bg-white">
      <v-img v-if="lightLogoUrl" :src="lightLogoUrl" max-width="200" max-height="200" cover />
    </v-col>
  </v-row>
</template>

<script>
import { QuillEditor } from '@vueup/vue-quill';
import { object } from 'yup';
export default {
  components: { QuillEditor },
  props: {
    form: Object,
    darkLogoUrl: String,
    lightLogoUrl: String,
  },
  data: () => ({
    editorOptions: {
          toolbar: [
            ['bold', 'italic', 'underline', 'strike'],
            ['link', 'image', 'video'],
            [{ list: 'ordered' }, { list: 'bullet' }],
            [{ header: [1, 2, 3, false] }],
            [{ align: [] }],
            ['clean']
          ]
      },
}),
  methods: {
    uploadImage(type) {
      this.$refs[type + 'Input'].$el.querySelector('input').click();
    },

    handleFileChange(type, file) {
      if (!file) return;
      this.form[type + 'Logo'] = file;
      if (this[type + 'LogoUrl']) URL.revokeObjectURL(this[type + 'LogoUrl']);
      this[type + 'LogoUrl'] = URL.createObjectURL(file);
    },
  },
};
</script>