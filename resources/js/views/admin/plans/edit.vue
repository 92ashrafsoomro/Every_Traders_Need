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
                                <v-select :items="['month', 'year']" label="Duration Unit" v-model="form.duration_unit"
                                    variant="outlined" density="compact" hide-details />
                            </v-col>

                            <v-col cols="12" md="6">
                                <v-text-field label="Duration Value" v-model="form.duration_value" type="number"
                                    variant="outlined" density="compact" />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-select :items="statusItems" label="Status" v-model="form.status" item-title="value"
                                    item-value="id" variant="outlined" density="compact" hide-details />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-text-field label="Price" v-model="form.price" variant="outlined" type="number"
                                    density="compact" />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-text-field label="Discount" v-model="form.discount" variant="outlined"
                                    density="compact" />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-select :items="offer" label="offer" v-model="form.is_officer" item-title="value"
                                    item-value="id" variant="outlined" density="compact" hide-details />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-text-field label="Sort By" v-model="form.sort_by" type="number" variant="outlined"
                                    density="compact" />
                            </v-col>

                            <!-- Input for adding new description point -->
                            <v-col cols="12" md="12">
                                <v-text-field label="Add Description Point" v-model="newPoint" variant="outlined"
                                    density="compact" @keyup.enter="addDescriptionPoint" />
                                <v-btn color="primary" class="mt-2" @click="addDescriptionPoint">
                                    Add Point
                                </v-btn>
                            </v-col>

                            <!-- Display existing description points -->
                            <v-col cols="12" md="12">
                                <v-subheader>Description Points</v-subheader>

                                <div class="d-flex flex-wrap gap-2">
                             <v-chip 
                                    v-for="(point, index) in points" 
                                    :key="index" 
                                    color="primary"
                                    variant="outlined" 
                                    class="ma-1"
                                >
                                    {{ point }}
                                    
                                    <v-btn 
                                        icon="mdi-close" 
                                        size="x-small" 
                                        variant="text" 
                                        class="ml-2"
                                        style="font-size: 10px;"
                                        @click.stop="remove(index)" 
                                    />
                                </v-chip>
                                </div>
                            </v-col>


                            <v-col cols="12" md="12">
                                <v-textarea label="Short Description" v-model="form.short_desc" variant="outlined"
                                    density="compact" />
                            </v-col>
                            <v-col cols="12" class="text-center mt-4">
                                <v-btn @click="editPlans" color="primary" height="40">
                                    Update
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
            statusItems: [
                { value: 'No', id: 0 },
                { value: 'Yes', id: 1 },
            ],
            offer: [
                { value: 'No', id: 0 },
                { value: 'Yes', id: 1 },
            ],
            form: {
                id: '',
                plan_name: '',
                short_desc: '',
                price: '',
                status: '',
                discount: '',
                is_officer: '',
                sort_by: '',
                duration_unit: '',
                description: "[]",
                duration_value: '',
                created_at: '',
                updated_at: ''
            },
            newPoint: '',
            loading: false,
        }
    },
    mounted() {
        this.form.id = this.$route.params.id;
        this.fetchSingleRecord();
    },
    computed:{
        points(){
            return JSON.parse(this.form.description);
        }
    },
    methods: {
        addDescriptionPoint() {
            let arr = [...this.points];
            arr.push(this.newPoint);

            this.form.description = JSON.stringify(arr)
            this.newPoint = ''
        },
         remove(index) {
            let arr = [...this.points];
            arr.splice(index, 1);
            this.form.description = JSON.stringify(arr);

        },
        async fetchSingleRecord() {
            this.loading = true;
            try {
                let res = await General.get("/api/cruds/plans/" + this.form.id);;
                console.log(res);
                this.form.plan_name = res.data.plan_name;
                this.form.short_desc = res.data.short_desc;
                this.form.price = res.data.price;
                this.form.description = res.data.description || "[]";
                this.form.status = res.data.status;
                this.form.discount = res.data.discount;
                this.form.duration_unit = res.data.duration_unit;
                this.form.duration_value = res.data.duration_value;
                this.form.created_at = res.data.created_at;
                this.form.sort_by = res.data.sort_by
                this.form.is_officer = res.data.is_officer
                this.form.updated_at = res.data.updated_at;

            } catch (error) {
                console.error(error)
            } finally {
                this.loading = false;
            }
        },

        async editPlans() {
            this.loading = true;
    
            try {
                let res = await General.put("/api/cruds/plans/" + this.form.id, this.form);
                this.$alertStore.add(res.message, 'success');
                // this.$router.push("/admin/plans")


            } catch (error) {
                this.$alertStore.add(error.message || 'Some Thing went wrong', error)
            } 
        }
    }
}
</script>