<template>
  <v-container max-width="1400px">
    <v-col cols="12">
      <v-card class="border">

        <!-- Header -->
        <div class="d-flex align-center justify-space-between px-4 py-3">
          <h3 class="text-h6 font-weight-bold">News Blog Create</h3>
          <v-btn variant="text" color="primary" class="text-capitalize">
            <v-icon start>mdi-arrow-left</v-icon>
            Back
          </v-btn>
        </div>

        <div class="border-b"></div>

     
        <v-container fluid>
          <v-row>

       
            <v-col cols="12" md="6">
              <v-text-field label="Category Id" v-model="form.category_id"  variant="outlined" density="compact"
                hide-details class="id-box" />
            </v-col>

            <v-col cols="12" md="6">
              <v-text-field label="Title" v-model="form.title"  variant="outlined" density="compact" hide-details
                class="id-box" />
            </v-col>

            <!-- Description-->
            <v-col cols="12" md="6">
              <v-text-field label="Description" v-model="form.description" variant="outlined" density="compact"
                clearable hide-details />
            </v-col>

            <v-col cols="12" md="6">
              <v-text-field label="Date" v-model="form.date" type="datetime-local" variant="outlined" density="compact"
                clearable hide-details />
            </v-col>
            
            <!-- Button -->
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
        id: '',
        category_id: '',
        title: '',
        description: '',
        date: '',
      },
      loading: false
    }
  },
 
  methods: {
    
  async submitForm() {
  try {
    const res = await General.post(
      "/api/cruds/blogs",
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