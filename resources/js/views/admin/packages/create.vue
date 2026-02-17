<template>
    <v-container max-width="1400px">
        <v-col cols="12" md="12">
            <v-card class="border">
                <div class="d-flex align-center justify-space-between px-4 py-3">
                    <h3 class="text-h6 font-weight-bold">
                        Create Packages
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

                            <v-col cols="12" md="6">
                                <PlansDropDown v-model="form.plan_id" label="Select Plan" variant="outlined" density="compact" />
                           
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-text-field label="Packages Name" v-model="form.title" variant="outlined"
                                    density="compact" />
                            </v-col>


                            <v-col cols="12" md="6">
                                <v-select :items="['month', 'year']" label="Duration Unit" v-model="form.duration_unit"
                                    variant="outlined" density="compact" hide-details />
                            </v-col>

                            <v-col cols="12" md="6">
                                <v-text-field label="Duration Value" v-model="form.duration_value" type="number"
                                    variant="outlined" density="compact" />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-select :items="[
                                    { value: 'No', id: 0 },
                                    { value: 'Yes', id: 1 }]" label="Status" v-model="form.status" item-title="value"
                                    item-value="id" variant="outlined" density="compact" hide-details />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-text-field label="Price" v-model="form.price" variant="outlined" type="number"
                                    density="compact" />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-text-field label="Discount" type="number" v-model="form.discount" variant="outlined"
                                    density="compact" />
                            </v-col>

                            <v-col cols="12" md="6">
                                <v-select :items="[
                                    { value: 'No', id: 0 },
                                    { value: 'Yes', id: 1 },
                                ]" label="offer" v-model="form.is_officer" item-title="value" item-value="id"
                                    variant="outlined" density="compact" hide-details />
                            </v-col>

                            <v-col cols="12" md="6">
                                <v-text-field label="Sort By" v-model="form.sort_by" type="number" variant="outlined"
                                    density="compact" />
                            </v-col>
                            <v-col cols="12" md="12">
                                <v-text-field label="Add Description Point" v-model="newPoint" variant="outlined"
                                    density="compact" @keyup.enter="addDescriptionPoint" />
                                <v-btn color="primary" class="mt-2" @click="addDescriptionPoint">
                                    Add Point
                                </v-btn>
                            </v-col>
                            <v-col cols="12" md="12">
                                <v-subheader>Description Points</v-subheader>
                                <div class="d-flex flex-wrap gap-2">
                                   <v-chip 
                                        v-for="(point, index) in form.description"
                                        :key="index" 
                                        color="primary"
                                        variant="outlined" 
                                        class="ma-1">
                                        {{ point }}
                                        <v-btn icon="mdi-close" size="x-small" variant="text" @click.stop="remove(index)"/>
                                    </v-chip>
                                </div>
                            </v-col>
                            <v-col cols="12" md="12">
                                <v-textarea label="Short Description" v-model="form.short_desc" variant="outlined"
                                    density="compact" />
                            </v-col>
                            <v-col cols="12" class="text-center mt-4">
                                <v-btn @click="createPlans" color="primary" height="40">
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
import { toRaw } from 'vue';
import PlansDropDown from '@/components/PlansDropDown.vue';
export default {
    components: {
        PlansDropDown
    },
    data() {
        return {
        points: [],
            form: {
                id: '',
                plan_id: '',
                title: '',
                short_desc: '',
                description:[],
                price: '',
                status: '',
                discount: '',
                is_officer: '',
                sort_by: '',
                duration_unit: '',
                duration_value: '',
            },
            newPoint: '',
            loading: false,
        }
    },
    mounted() {
    },
    computed:{

    },
    methods: {
  addDescriptionPoint() {
        if (!this.newPoint) return;
        this.form.description.push(this.newPoint);
        this.newPoint = '';
    },

    remove(index) {
        this.form.description.splice(index, 1);
    },
        async createPlans() {
            this.loading = true;
            
            try {

                console.log(this.form);
             
                const res = await General.post("/api/cruds/packages",  this.form);
                this.$alertStore.add(res.message || 'Package Created', 'success');
                // this.$router.push("/admin/packages");

            } catch (error) {
                this.$alertStore.add(error.message || 'Something went wrong', 'error');
            } 

        }
    }

}
</script>
