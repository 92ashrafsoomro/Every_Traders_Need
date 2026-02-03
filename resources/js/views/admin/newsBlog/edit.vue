<template>
  <v-container max-width="1400px">
    <v-col cols="12">
      <v-card class="border">

        <!-- Header -->
        <div class="d-flex align-center justify-space-between px-4 py-3">

          <h3 class="text-h6 font-weight-bold">News Blog Edit</h3>

          <v-btn variant="text" color="primary" class="text-capitalize">
            <v-icon start>mdi-arrow-left</v-icon>
            Back
          </v-btn>
        </div>

        <div class="border-b"></div>

        <v-container fluid>
          <v-row>

            <v-col cols="12" md="6">
              <v-text-field label="ID" v-model="form.id" readonly variant="outlined" density="compact" hide-details
                class="id-box" />
            </v-col>

            <v-col cols="12" md="6">
              <v-text-field label="Category Id" v-model="form.category_id"  variant="outlined" density="compact"
                hide-details class="id-box" />
            </v-col>

            <v-col cols="12" md="6">
              <v-text-field label="Title" v-model="form.title"  variant="outlined" density="compact" hide-details
                class="id-box" />
            </v-col>

            <v-col cols="12" md="6">
              <v-text-field label=" Description" v-model="form.description" variant="outlined" density="compact"
                clearable hide-details />
            </v-col>


            <v-col cols="12" md="6">
              <v-text-field label="Date" v-model="form.date" type="datetime-local" variant="outlined" density="compact"
                clearable hide-details />
            </v-col>

            <v-col cols="12" md="6">
              <v-text-field label="End Time " v-model="form.created_by" type="datetime-local" variant="outlined"
                density="compact" clearable hide-details />
            </v-col>

            <v-col cols="12" md="6">
              <v-text-field label="Created At" v-model="form.created_at" variant="outlined" density="compact" clearable
                hide-details />
            </v-col>

            <v-col>
              <v-text-field label="Updated At" v-model="form.updated_at" variant="outlined" density="compact" clearable
                hide-details />
            </v-col>


            <!-- Button -->
            <v-col cols="12" class="text-center mt-4">
              <v-btn @click="updateData" color="primary" height="40">
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


export default {
  data() {
    return {
      form: {
        id: '',
        category_id: '',
        title: '',
        description: "",
        date: "",
        created_by: "",
        created_at: '',
        updated_at: '',
      },
      loading: false
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
      "/api/cruds/news/" + this.$route.params.id
    );

    const data = res.data; 

    this.form.id = data.id;
    this.form.category_id = data.category_id;
    this.form.title = data.title;
    this.form.description = data.description;
    this.form.date = data.date;

      this.form.created_by = data.created_by;
      this.form.created_at = data.created_at;
    this.form.created_at = data.created_at;
    this.form.updated_at = data.updated_at;

  } catch (error) {
    this.$alertStore.add(
      error.message || 'Failed to fetch record',
      'error'
    );
  } finally {
    this.loading = false;
  }
},

    async updateData() {
      this.loading = true;

      try {
        const res = await General.put("/api/cruds/news/"+this.form.id, this.form);
        this.$alertStore.add(res.message || "Edit SuccessFully ", "success")
        this.$router.push('/admin/newsBlog');
      } catch (error) {
        this.$alertStore.add(error.message || 'Update failed', 'error');
      } finally {
        this.loading = false;
      }
    }
  }
}

</script>