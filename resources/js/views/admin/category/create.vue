<template>
  <v-container max-width="1400px">
    <v-col cols="12">
      <v-card class="border">
        <div class="d-flex align-center justify-space-between px-4 py-3">
          <h3 class="text-h6 font-weight-bold">News Blog Category Create</h3>
          <v-btn variant="text" color="primary" class="text-capitalize" to="/admin/category">
            <v-icon start>mdi-arrow-left</v-icon>
            Back
          </v-btn>
        </div>

        <div class="border-b"></div>

     
        <v-container fluid>
          <v-row>

            <v-col cols="12" md="6">
              <v-text-field label="Title" v-model="form.title"  variant="outlined" density="compact" hide-details
                class="id-box" />
            </v-col>

            <v-col cols="12" md="6">
                <v-select
                    label="Category Type"
                    v-model="form.type"
                    :items="[
                    { title: 'Blog', value: 'blog' },
                    { title: 'News', value: 'news' }
                    ]"
                    item-title="title"
                    item-value="value"
                    variant="outlined"
                    density="compact"
                    hide-details
                />
            </v-col>



            <v-col cols="12" class="text-center mt-4">
              <v-btn @click="submitForm" color="primary" height="40">
                Create
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


export default {
  data() {
    return {
   
      form: {
        title: '',
        type: '',

      },
      loading: false
    }
  },
 
  methods: {
    
  async submitForm() {
  try {
    const res = await General.post(
      "/api/cruds/blogCategory",
      this.form
    );

    this.$alertStore.add("News Created Successfully", "success");


  } catch (error) {
    this.$alertStore.add(
      error.response?.data?.message || "Something went wrong",
      "error"
    );
  }
}



  }
}

</script>