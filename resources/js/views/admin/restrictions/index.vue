<template>
    <user-title-bar title="Restrictions" subtitle="Restrictions Page">

    </user-title-bar>
    <v-container fluid="" max-width="1400px">
        <div class="pa-4 " style="height: 200px;">
            <div class="d-flex align-start mb-3  ">
                <ul style="list-style: none;" class="d-flex ga-6 ">

                    <li v-for="plan in items" :key="plan.id">
                        <h3>{{ plan.title }}</h3>
                        <ul class="mt-4">
                            <li v-for="feature in plan.features" :key="feature.id" class="d-flex align-center mb-2 ">
                                <v-chip :color="feature.status ? 'primary' : 'gray'">
                                    <v-icon @click="toggleStatus(plan, feature)"
                                        :color="feature.status ? 'primary' : 'gray'" class="mr-3">
                                        mdi-check-decagram
                                    </v-icon>
                                    <div class="text-body-2 text-light_text_on">
                                        {{ feature.title }}
                                    </div>
                                </v-chip>
                            </li>
                        </ul>
                    </li>


                </ul>

            </div>
        </div>
    </v-container>
</template>

<script>
import General from '@/models/general.model';
import api from '@/plugins/axios';

export default {
    data() {
        return {
            items: [],


        }
    },

    methods: {
        async getFeature() {
            this.loading = true;
            try {
                let res = await General.get("/api/cruds/features")
                this.items = res.data

                this.loading = false

            } catch (error) {
                alert("Data Not Fetch ")
                this.loading = false
            }
        },
        async toggleStatus(plan, feature) {
            let newStatus = !feature.status;
            let options = {
                plan_id: plan.id,
                feature_id: feature.id,
                feature_title: feature.title,
                status: newStatus
            };

            try {
                let res = await General.post("/api/cruds/features/handleStatus", options);
                feature.status = newStatus;
                console.log(res);
                this.getFeature()
            } catch (error) {
                this.$alertStore.add(error.message || "Could not update status", "error");
            }
        }
    },
    mounted() {
        this.getFeature()
    }
}
</script>