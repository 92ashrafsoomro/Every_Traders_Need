<template>
    <v-col cols="12" >
        <CurrentPlan/>
   
        <!-- <PaymentForm/> -->
    </v-col>

    <!-- <v-col cols="12">
        <pricePlan/>
    </v-col> -->

      <v-col cols="12" >
        <BillingHistory/>
    </v-col>
</template>

<script>
import CurrentPlan from './components/currentPlan.vue';
// import pricePlan from './components/pricePlan.vue';
// import PaymentForm from './components/PaymentForm.vue';
import BillingHistory from './components/BillingHistory.vue';


export default {
    components: {
     CurrentPlan,
    //  pricePlan,
    //  PaymentForm,
     BillingHistory
    },
    data() {
        return {
            
        };
    },
    computed: {
        
    },
};
</script>