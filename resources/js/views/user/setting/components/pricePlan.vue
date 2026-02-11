<template>
    <v-container style="max-width: 1400px ; margin: 100px ;" class="mx-auto ">
        <div class="d-flex  text-center items-center justify-center mb-12">
            <h1 class="text-h2 font-weight-bold">Pricing</h1>
        </div>
        <div class="d-flex justify-center mb-8">
            <v-btn-toggle v-model="billingType" mandatory rounded color="primary">
                <v-btn value="month">Monthly</v-btn>
                <v-btn value="year">Yearly</v-btn>
            </v-btn-toggle>
        </div>
        <v-row justify="center" dense="" class=" mt-20">
            <v-col v-for="item in filteredPlans" :key="item.id" cols="12" sm="6" md="3"
                style=" width: 300px !important; ">
                <v-card v-if="item.plan_name === 'Plus'" class="border  ma-3 bg-background  "
                    style="border-radius: 30px;  min-height: 500px;" :class="{ 'plus-plan': item.plan_name === 'Plus' }">
                    <div class="bg-primary">

                    </div>
                    <div class="rounded-lg  bg-surface pa-4 shadow-lg" style="
                            border-radius: 20px !important ;">
                        <div class="bg-background pa-4 rounded-xl" style=" height: 175px">
                            <div class="d-flex justify-center  items-center  ">
                                <v-chip color="primary" class="mb-4 d-flex  position-absolute top-0 justify-center px-2"
                                    small>
                                    {{ item.discount || 0 }} % off
                                </v-chip>
                            </div>
                            <div class="mt-12">

                                <h3 class="text-body-1 font-weight-bold text-white ">{{ item.plan_name }} </h3>
                                <p class="text-body-subtitle mt-2 text-light_text_on"
                                    style="text-decoration: line-through;">${{ item.price }}</p>
                                <h3 class="text-h5 font-weight-bold text-white d-inline-block pt-2"> ${{
                                    discountPrice(item) }} </h3>
                                <span class="text-body-1 ml-0  text-light_text_on">/{{ item.duration_unit }}</span>
                            </div>

                        </div>
                        <div class="py-2 px-1">
                            <p style="color:rgb(var(--v-theme-light));" class="py-4">{{ item.short_desc }}</p>
                            <v-btn color="primary" size="large" :to="'/checkout'" class="text-capitalize  w-100">Select
                                Plan</v-btn>
                        </div>


                    </div>
                
                    <div class="pa-4 " style="height: 200px;">
                        <div class="d-flex align-start mb-3  ">
                            <ul style="list-style: none;">
                                <li v-for="desc in buildPlanDescription(item.description)" :key="desc.id"
                                    class="mb-4 d-flex">
                                    <v-icon style="color: rgb(var(--v-theme-primary));" class="mr-3">
                                        mdi-check-decagram
                                    </v-icon>

                                    <div class="d-flex items-center text-body-2 text-light_text_on">
                                        {{ desc.label }}
                                    </div>
                                </li>
                            </ul>

                        </div>
                    </div>
                </v-card>


                <v-card v-else class="border ma-3 bg-background" style="border-radius: 30px;   min-height: 500px;">
                    <div class="rounded-lg  bg-surface pa-4 shadow-lg" style="
                            border-radius: 2px 2px 20px 20px !important ;">
                        <div class="bg-background pa-4 rounded-xl">
                            <div class="d-flex justify-end">
                                <v-chip color="primary" class="mb-4 d-flex justify-center px-2" small>
                                    {{ item.discount || 0 }} % off
                                </v-chip>
                            </div>
                            <div>

                                <h3 class="text-body-1 font-weight-bold text-white ">{{ item.plan_name }} </h3>
                                <p class="text-body-subtitle mt-2 text-light_text_on"
                                    style="text-decoration: line-through;">${{ item.price }}</p>
                                <h3 class="text-h5 font-weight-bold text-white d-inline-block pt-2"> ${{
                                    discountPrice(item) }} </h3>
                                <span class="text-body-1 ml-0  text-light_text_on">/{{ item.duration_unit }}</span>
                            </div>

                        </div>
                        <div class="py-2 px-1">
                            <p style="color:rgb(var(--v-theme-light));" class="py-4">{{ item.short_desc }}</p>
                            <v-btn color="primary" size="large" :to="'/checkout'" class="text-capitalize  w-100">Select
                                Plan</v-btn>
                        </div>
                    </div>

                    <div class="pa-4 " style="height: 200px;">
                        <div class="d-flex align-start mb-3  ">
                            <ul style="list-style: none;">
                                <li v-for="desc in buildPlanDescription(item.description)" :key="desc.id"
                                    class="mb-4 d-flex">
                                    <v-icon style="color: rgb(var(--v-theme-primary));" class="mr-3">
                                        mdi-check-decagram
                                    </v-icon>

                                    <div class="d-flex items-center text-body-2 text-light_text_on">
                                        {{ desc.label }}
                                    </div>
                                </li>
                            </ul>

                        </div>
                    </div>
                </v-card>
            </v-col>
        </v-row>
    </v-container>

</template>


<script>
import General from '@/models/general.model';
import { useUserStore } from '@/stores/userStore';
// import pricingplain from './pricingplain.vue';
// import featureTable from './featureTable.vue';
export default {
    name: "pricingCard",
    data() {
        return {
            userStore: useUserStore(),
            data: [],
            billingType: 'month',
            loading: false,


        }
    },
    mounted() {
        this.getPlan()
    },
    methods: {
        async getPlan() {
            this.loading = false
            try {
                let res = await General.get("/api/cruds/plans")
                this.data = res.data.filter(plan => plan.status === 1);
                this.loading = true
            } catch (error) {
                console.error(error)
            } finally {
                this.loading = false
            }
        },
        discountPrice(item) {
            if (!item.discount) return item.price

            return (
                item.price - (item.price * item.discount) / 100
            ).toFixed(2)
        },
        buildPlanDescription(description) {
    if (!description) return [];

    return description
        .split(/\r?\n/) 
        .filter(line => line.trim() !== '')
        .map((line, index) => ({
            id: index + 1,
            label: line.trim()
        }));
}
    },
    computed: {
        filteredPlans() {
            return this.data.filter(
                plan => plan.duration_unit === this.billingType
            )
        }
    }

}
</script>

<style scoped>
.plus-plan {
    border: 2px solid rgb(var(--v-theme-primary)) !important;
    

}
</style>