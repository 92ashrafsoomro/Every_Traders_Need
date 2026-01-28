<template>
    <v-container max-width="1400px">
        <v-col cols="12" md="12">
            <v-card class="border">
                <div class="d-flex align-center justify-space-between px-4 py-3">
                    <h3 class="text-h6 font-weight-bold">
                        Create Role
                    </h3>
                    <router-link :to="'/admin/role/'">
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
                            <v-col cols="12" md="6">
                                <v-text-field label="Name" v-model="form.name" variant="outlined"
                                    density="compact" hide-details class="id-box" />
                            </v-col>
                            <v-col cols="12" class="text-center mt-4">
                                <v-btn @click="createUser" color="primary" height="40">
                                    create
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
import UserTypeDropDown from '@/components/UserTypeDropDown.vue';
export default {
    components:{
        UserTypeDropDown
    },
    data() {
        return {
            
            form: {
                id: '',
                name: '',
            },
            loading: false,
        }
    },
    methods: {
        async createUser() {
            this.loading = true;
            try {
                let res = await General.post("/api/cruds/roles", this.form);
                this.$alertStore.add(res.message, 'success');
                this.$router.push('/admin/role')
            } catch (error) {
                this.$alertStore.add(error.message || 'Some Thing went wrong', error)
            } finally {
                this.loading = false;
            }
        }
    }
}
</script>