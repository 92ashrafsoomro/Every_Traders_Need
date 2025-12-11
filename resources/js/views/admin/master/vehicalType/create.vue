  <template>
    <v-card class="bg-surface mx-auto mt-10 border rounded" max-width="1600px">
      <!-- Header -->
      <v-card-title class="d-flex justify-space-between align-center pa-4 border-b">
        <span class="text-h6 text-white">Platform</span>
        <v-btn color="primary" prepend-icon="mdi-plus">
          <router-link to="addnew" style="text-decoration: none; color: white;">Add New Platform</router-link>
        </v-btn>
      </v-card-title>

      <v-card-text class="pa-0">
        <!-- Toolbar -->
        <div class="d-flex flex-wrap align-center pa-4 gap-4 bg-surface border-b">
          <div class="d-flex align-center">
            <v-select v-model="itemsPerPage" :items="[10, 25, 50, 100]" density="compact" variant="outlined"
              hide-details style="width: 80px;" class="mr-2" />
            <span class="text-grey-lighten-1 text-caption">
              Showing 1 to {{ Math.min(itemsPerPage, platforms.data.length) }} of
              {{ platforms.data.length }} entries
            </span>
          </div>

          <v-spacer />

          <v-text-field v-model="search" prepend-inner-icon="mdi-magnify" placeholder="Search..." density="compact"
            variant="solo" hide-details class="max-width-300 " clearable />
        </div>


        <div class="table-container pa-4" style="height: 600px; overflow-y: scroll; overflow-x: hidden;">

          <table class="w-100 text-white">
            <thead>
              <tr>
                <th>Id</th>
                <th>Image</th>
                <th>Name</th>
                <th>Count</th>
                <th>test</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-if="platforms.isLoading">
                <td colspan="6">
                  <v-progress-linear color="primary" indeterminate />
                </td>
              </tr>
              <tr v-else-if="filteredPlatforms.length" v-for="(item, index) in filteredPlatforms" :key="item.id">
                <td>{{ item.id }}</td>
                <td>
                  <img src="@/assets/images/avatar/user.png" width="60" height="40" class="bg-white rounded" />
                </td>
                <td>{{ item.label }}</td>
                <td>{{ item.count }}</td>
                <td>{{ item.test }}</td>
                <td>
                  <v-btn size="small" color="warning "><router-link :to="`edit/${item.id}`" style="text-decoration: none; color: white;">Edit</router-link></v-btn>
                  <v-btn size="small" color="error" @click="deleteData(item.id)">Delete</v-btn>
                </td>
              
              </tr>

              <tr v-else>
                <td colspan="6" class="text-center py-4 text-grey">No data found</td>
              </tr>

            </tbody>
          </table>
        </div>
      </v-card-text>
     
    </v-card>
  </template>

<script>
import api from '@/plugins/axios';

export default {
  name: "create",
  components: {
  },
  data() {
    return {
      itemsPerPage: 10,
      search: '',
      platforms: {
        isLoading: null,
        data: []
      }
    };
  },
  mounted() {
    this.getDataplatform()
  },
  computed: {
    filteredPlatforms() {
      if (!this.search) {
        return this.platforms.data;
      }
      return this.platforms.data.filter(item =>
        item.label.toLowerCase().includes(this.search.toLowerCase())
      );
    }
  },
  methods: {

    
    async getDataplatform() {
      this.platforms.isLoading = true;
      try {
        let res = await api.get("/api/master/getVehicleTypes");
        this.platforms.data = res.data.data
        this.platforms.isLoading = false
        console.log("This is Platform Data" + res.data.data);
      } catch (error) {
        alert(error)
        this.platforms.isLoading = false
      }
    },




    async deleteData(id){
      if(!confirm("Delete")) return;

      try {
        await api.delete(`/api/master/getVehicleTypes${id}`);
        this.platforms.data  = this.platforms.data.filter (item => item.id !== id);
        alert("data Delete SuccesFully!")
      } catch (error) {
        alert("Feild to delete ")
      }
    }
  }
};

</script>

<style scoped>
table {
  border-collapse: collapse;

}
th,
td {
  border: 1px solid rgb(146, 146, 146);
  padding: 12px;
  text-align: left;
}
</style>