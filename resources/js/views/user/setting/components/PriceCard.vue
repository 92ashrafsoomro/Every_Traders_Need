<template>
    <v-card class="border   rounded-lg">
        <div class="rounded-lg pa-2 shadow-lg" style="background-color: rgb(var(--v-theme-primary),0.2);
        border-radius: 2px 2px 20px 20px !important ;  box-shadow: 0 10px 20px -4px rgba(var(--v-theme-primary),0.8);">
            <div class="bg-background px-2 py-4 rounded-xl">
                <div>
                    <v-chip color="primary" class="mb-4 d-flex justify-center w-25" small>
                        {{ item.planType }}
                    </v-chip>
                </div>
                <div>
                    <h2 class="text-h4 font-weight-bold text-white mb-2 pt-6">${{ item.title }} <span
                            class="text-body-1">/month</span></h2>
                </div>

            </div>
            <div class="py-2 px-1">
                <p style="color:rgb(var(--v-theme-light));" class="pb-2">{{ item.des }}</p>
                <v-btn color="primary" size="large" :to="'/checkout'" class="text-capitalize  w-100">Select Plan</v-btn>
            </div>
        </div>

        <div class="pa-4">
                <div v-for="(item, index) in problemItems" :key="index" class="d-flex align-center mb-3 d-flex align-start">
                  <v-icon color="primary" class="mr-3 mt-1">
                    mdi-check-circle
                  </v-icon>

                  <span class="text-whiteLight text-body-2">
                    {{ item }}
                  </span>
                </div>
             </div>
    </v-card>
    <!-- <v-card
    class="border bg-surface pricing-card rounded-xl pa-6 text-center"
    height="100%"
    color="#1e1e2e"
    >
    <v-chip color="primary" class="mb-4 d-flex justify-center" small>
       {{ item.planType }}
    </v-chip>

    <h2 class="text-h4 font-weight-bold text-white mb-2">{{ item.title }}</h2>
    <p style="color:rgb(var(--v-theme-light));" class=" mb-6">{{ item.des }}</p>

    <div class="text-body-1 text-white font-weight-bold mb-8">
        <small>$</small>
        <span class="font-weight-bold text-body-1 text-primary">{{ item.price }}</span>
        <small class="">/month</small>
    </div>

    <div class="w-100 border" >

    </div>

    <v-list class="bg-transparent text-left" density="comfortable">
        <v-list-item v-for="n in 5" :key="n">
            <template v-slot:prepend>
                <v-icon color="primary" class="mr-3">mdi-check-circle</v-icon>
            </template>
<v-list-item-title class="text-body-1 no-ellipsis" style="color:rgb(var(--v-theme-light));">
    100 responses a month
</v-list-item-title>
</v-list-item>
</v-list>

<v-spacer></v-spacer>


<v-btn v-if="item.id == 1" color="primary" variant="tonal" class="mt-8 text-success font-weight-bold text-capitalize">
    Current Plan</v-btn>

<v-btn v-else color="primary" variant="tonal" :to="'/checkout'"
    class="mt-8 text-white font-weight-bold text-capitalize">
    Select Plan</v-btn>

</v-card> -->

</template>

<script>
export default {
    props: {
        item: {
            type: Object,
            default: {}
        }
    },
    data(){
        return{
            problemItems: [
        'Overbidding due to incomplete market insight',
        'Missed opportunities hidden across different auction houses',
        'Losses caused by unseen condition issues or misleading valuations',
        'Hours wasted switching between platforms, spreadsheets, and guesswork'
      ]
        }
    }
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

.no-ellipsis {
    white-space: normal !important;
    overflow: visible !important;
    text-overflow: unset !important;
}
</style>