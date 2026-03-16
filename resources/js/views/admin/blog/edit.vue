<template>
  <v-container max-width="1400px">
    <v-col cols="12">
      <v-card class="border">

        <!-- Header -->
        <div class="d-flex align-center justify-space-between px-4 py-3">
          <h3 class="text-h6 font-weight-bold">Update Blog</h3>
          <v-btn variant="text" color="primary" class="text-capitalize" to="/admin/blog/">
            <v-icon start>mdi-arrow-left</v-icon>
            Back
          </v-btn>
        </div>

        <div class="border-b"></div>

     
        <v-container fluid>
          <v-row>

       
            <v-col cols="12" md="6">
                <Blogcategory
                  label="Category"
                  v-model="form.category_id"
                  type="blog"
                  variant="outlined"
                  density="compact"
                  hide-details
                  class="id-box"
                  clearable
                />
            </v-col>

            <v-col cols="12" md="6">
              <v-text-field label="Title" v-model="form.title"  variant="outlined" density="compact" hide-details clearable
                class="id-box" />
            </v-col>

            <v-col cols="12" md="6">
              <v-text-field label="Date" v-model="form.date" type="date" variant="outlined" density="compact"
                 hide-details />
            </v-col>
                          
            <v-col cols="6">
                <v-btn
                  variant="outlined"
                  class="w-100"
                  color="primary"
                  @click="uploadImage"
                >
                  <v-icon class="mr-2">mdi-upload</v-icon>
                  Upload
                </v-btn>

                <v-file-input
                  ref="uploadInput"
                  accept="image/*"
                  @update:modelValue="handleFileChange"
                  style="position:absolute; left:-9999px; width:0; height:0;"
                />
            </v-col>

            <v-col cols="12">
              <QuillEditor
                  v-model:content="form.description"
                  content-type="html"
                  :modules="editorOptions.modules"
                  theme="snow"
              />  
            </v-col>

            <v-col class="d-flex justify-center text-center mt-4 w-100">
              <v-img
                v-if="imageUrl"
                :src="imageUrl"
                max-width="200"
                max-height="200"
                cover
              />

            </v-col>
            
            <v-col cols="12">
              <BlogSections v-model="form.sections" />
            </v-col>

            <v-col cols="12" class="text-center mt-4">
              <v-btn @click="submitForm" color="primary" height="40">
                Update
              </v-btn>
            </v-col>

          </v-row>
        </v-container>

      </v-card>
    </v-col>
  </v-container>

</template>

<script>
import General from '@/models/general.model';
import Blogcategory from '@/components/blogcategory.vue';
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import BlogSections from './BlogSections.vue';
export default {
  components: {
      Blogcategory,
      QuillEditor,
      BlogSections
  },
  data() {
    return {
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
      form: {
        category_id: null,
        title: '',
        description: '',
        date: '',
        sections: [],
      },
      loading: false,
      imageUrl: null,  
      
    }
  },
  async mounted() {
    await this.fetchSignleRecord()
  },
  methods: {
    
   async fetchSignleRecord() {
      this.loading = true;
      try {
        const res = await General.get(
          "/api/cruds/blogs/" + this.$route.params.id
        );

        const data = res.data; 

        this.form.id = data.id;
        this.form.category_id = data.category_id;
        this.form.title = data.title;
        this.form.description = data.description;
        this.form.date = data.date;
        this.imageUrl = data.image_preview || null;
        this.form.sections = data.details.map(section => ({
          distitle: section.title,
          disdescription: section.description,
          alignment: section.alignment,
          disimage: section.image || null, 
          preview: section.preview_image || null, 
        }));


   

      } catch (error) {
        this.$alertStore.add(
          error.message || 'Failed to fetch record',
          'error'
        );
      } finally {
        this.loading = false;
      }
    },

    async submitForm() {
      this.loading = true;

      try {
        const res = await General.put("/api/cruds/blogs/"+this.form.id, this.form);
        this.$alertStore.add(res.message || "Edit SuccessFully ", "success")
        // this.$router.push('/admin/blog');
      } catch (error) {
        this.$alertStore.add(error.message || 'Update failed', 'error');
      } finally {
        this.loading = false;
      }
    },
    uploadImage() {
      this.$refs.uploadInput.$el
        .querySelector('input')
        .click();
    },

    handleFileChange(file) {
      if (!file) return;

      this.form.image = file;

      if (this.imageUrl) {
        URL.revokeObjectURL(this.imageUrl);
      }

      this.imageUrl = URL.createObjectURL(file);
    },

    goBack() {
      this.$router.back();
    }
  }
}

</script>

<style scoped>

:deep(.ql-container) {
  min-height: 300px; 
  font-size: 16px;
}


:deep(.ql-editor) {
  min-height: 300px;
}
</style>