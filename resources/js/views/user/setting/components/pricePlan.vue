<template>
    <v-container fluid class="pa-8 pa-md-16 bg-surface" max-height="700px">
        <v-row justify="center" class="gap-5">
            <v-col v-for="item in data" :key="item.id" cols="12" sm="6" md="3">
                <v-card class="border rounded-lg ma-3">
                    <div class="rounded-lg  pa-2 shadow-lg" style="background-color: rgb(var(--v-theme-primary),0.2);
        border-radius: 2px 2px 20px 20px !important ;  box-shadow: 0 10px 20px -4px rgba(var(--v-theme-primary),0.8);">
                        <div class="bg-background px-2 py-4 rounded-xl">
                            <div>
                                <v-chip color="primary" class="mb-4 d-flex justify-center w-25" small>
                                    {{ item.discount || 0 }} % off
                                </v-chip>
                            </div>
                            <div>

                                <h3 class="text-h5 font-weight-bold text-white  pt-6">${{ item.plan_name }} </h3>
                                <h3 class="text-h5 font-weight-bold text-white  pt-2"> <span
                                        style="text-decoration: line-through;">${{ item.price }}</span>
                                    <span class="text-h4 font-weight-bold text-white mb-2">${{ discountPrice(item) }}
                                        <span class="text-body-1">/{{ item.duration_unit }}</span>
                                    </span>
                                </h3>


                            </div>

                        </div>
                        <div class="py-2 px-1">
                            <p style="color:rgb(var(--v-theme-light));" class="pb-2">{{ item.short_desc }}</p>
                            <v-btn color="primary" size="large" :to="'/checkout'" class="text-capitalize  w-100">Select
                                Plan</v-btn>
                        </div>
                    </div>

                    <div class="pa-4">
                        <div class="d-flex align-center mb-3 d-flex align-start">
                            <span class="text-whiteLight text-body-2">
                                {{ item.description }} Lorem ipsum dolor sit amet consectetur adipisicing elit. Et,
                                blanditiis vero nemo tenetur repudiandae, impedit odio adipisci doloremque culpa
                                consectetur maxime odit, soluta quibusdam aut id. Temporibus repellendus assumenda
                                architecto?
                            </span>
                        </div>
                    </div>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import General from '@/models/general.model';
import PriceCard from './PriceCard.vue';


export default {
    components: {
        PriceCard
    },
    data() {
        return {
            data: [],
            loading: false,
            price: [
                {
                    id: 1,
                    planType: 'Most Popular',
                    title: 'Free',
                    des: 'For small dealers.',
                    price: '0.00',
                },
                {
                    id: 2,
                    planType: 'Most Popular',
                    title: 'Ulta',
                    des: 'For medium-sized businesses.',
                    price: '100.00',
                },
                {
                    id: 3,
                    planType: 'Most Popular',
                    title: 'Plus',
                    des: 'For larger operations.',
                    price: '50.00',
                },

            ],
            problemItems: [
                'Overbidding due to incomplete market insight',
                'Missed opportunities hidden across different auction houses',
                'Losses caused by unseen condition issues or misleading valuations',
                'Hours wasted switching between platforms, spreadsheets, and guesswork'
            ]
        };
    },
    mounted() {
        this.getPlan()
    },
    methods: {
        async getPlan() {
            this.loading = false
            try {
                let res = await General.get("/api/cruds/plans")
                this.data = res.data
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
        }
    },

}

</script>

<style scoped>
.pricing-card {
    display: flex;
    flex-direction: column;
}

.v-application {
    background: #0f0f1e !important;
}
</style>