<template>
    <v-container max-width="1400px">
        <v-col cols="12" md="12">
            <v-card class="border">
                <div class="d-flex align-center justify-space-between px-4 py-3">
                    <h3 class="text-h6 font-weight-bold">
                        Edit Plans
                    </h3>
                    <router-link :to="'/admin/plans/'">
                        <v-btn variant="text" color="primary" class="text-capitalize">
                            <v-icon start>mdi-arrow-left</v-icon>
                            Back
                        </v-btn>
                    </router-link>
                </div>

                <div class="border-b"></div>
                <v-card-text>
                    <v-container fluid>
                        <v-row>
                            <!-- 
                    <v-col cols="12" md="6">
                    <v-text-field
                        label="ID"
                        v-model="form.id"
                        readonly
                        variant="outlined"
                        density="compact"
                        
                    />
                    </v-col> -->
                            <v-col cols="12" md="6">
                                <v-text-field label="Plan Name" v-model="form.plan_name" variant="outlined"
                                    density="compact" />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-text-field label="Short Description" v-model="form.short_desc" variant="outlined"
                                    density="compact" />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-text-field label="Price" v-model="form.price" variant="outlined" density="compact" />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-text-field label="Status" v-model="form.status" variant="outlined" density="compact" />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-text-field label="officer" v-model="form.is_officer" variant="outlined" density="compact" />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-text-field label="Sorted by" v-model="form.sort_by" variant="outlined" density="compact" />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-text-field label="Duration Unit" v-model="form.duration_unit" variant="outlined"
                                    density="compact" />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-text-field label="Revenue" v-model="form.revenue" variant="outlined"
                                    density="compact" />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-text-field label="Duration Value" v-model="form.duration_value" variant="outlined"
                                    density="compact" />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-text-field label="Create At" type="datetime-local" v-model="form.created_at"
                                    variant="outlined" density="compact" />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-text-field label="Update " v-model="form.updated_at" type="datetime-local" variant="outlined"
                                    density="compact" />
                            </v-col>

                            <v-col cols="12" class="text-center mt-4">
                                <v-btn @click="createPlans" color="primary" height="40">
                                    Create
                                </v-btn>
                            </v-col>

                        </v-row>
                    </v-container>
                </v-card-text>

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
                plan_name: '',
                short_desc: '',
                price: '',
                status : '',
                renew : '',
                is_officer : '',
                sort_by : '',
                duration_unit: '',
                duration_value: '',
                created_at: '',
                updated_at: ''
            },
            loading: false,
        }
    },
    mounted() {
    },
    methods: {
     
      async createPlans() {
  this.loading = true;
  try {
    const res = await General.post("/api/cruds/plans", this.form);
    this.$alertStore.add(res.message || 'Plan Created', 'success');
    this.$router.push("/admin/plans");
  } catch (error) {
    console.error(error);
    this.$alertStore.add(error.message || 'Something went wrong', 'error');
  } finally {
    this.loading = false;
  }
}

    }
}
</script>