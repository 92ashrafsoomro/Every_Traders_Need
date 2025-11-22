<template>

    <CurrentPlan/>
    <div class="mt-3" ></div>
    <pricePlan/>

     <div class="mt-3" ></div>

    <PaymentForm/>
    <div class="mt-3" ></div>
    <BillingHistory/>



</template>

<script>
import CurrentPlan from './components/currentPlan.vue';
import pricePlan from './components/pricePlan.vue';
import PaymentForm from './components/PaymentForm.vue';
import BillingHistory from './components/BillingHistory.vue';


export default {
    components: {
     CurrentPlan,
     pricePlan,
     PaymentForm,
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