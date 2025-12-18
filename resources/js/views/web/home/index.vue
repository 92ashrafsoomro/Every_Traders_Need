<template>

  <div>
    <screen />
    <TrustedPartner/>
    <SmartBuyer/>
    <BeforeAutoboli/>
    <AfterAutoboli/>
    <GainAutoboli/>
    <FAQ/>
    <!-- <vision />
    <Trusted />
    <wining/> -->
  </div>
</template>

<script>
import screen from './screen.vue'
import TrustedPartner from './TrustedPartner.vue';
import SmartBuyer from './SmartBuyer.vue';
import BeforeAutoboli from './BeforeAutoboli.vue';
import AfterAutoboli from './AfterAutoboli.vue';
import GainAutoboli from './GainAutoboli.vue';
import FAQ from './FAQ.vue';

// import vision from './vision.vue';
// import Trusted from './Trusted.vue';
// import wining from './wining.vue';

export default {
  name: 'Home',
  components: {
    screen,
    TrustedPartner,
    SmartBuyer,
    BeforeAutoboli,
    AfterAutoboli,
    GainAutoboli,
    FAQ
    // vision,
    // Trusted,
    // wining
  }
}
</script>
