<template>
  <aboutscreen />
  <div class="bg-surface">
    <Dealer />
  </div>
  <div class="bg-background">
    <exists />
    <different />
    <!-- <card /> -->
  </div>
  <helping />
  <vision />
  <glance/>
  <!-- <problem />
  <autodifferent />
  <div>
    <promise />
  </div>
  <bidSmarter /> -->
</template>

<script>

import aboutscreen from './aboutscreen.vue';
import Dealer from './dealer.vue';
import exists from './exists.vue';
import glance from './glance.vue';
import different from './different.vue';
import helping from './helping.vue';
import card from './card.vue';
import vision from './vision.vue';
import problem from './problem.vue';
import autodifferent from './autodifferent.vue';
import promise from './promise.vue';
import bidSmarter from './bidSmarter.vue';


export default {
  components: {
    name: 'About',
    aboutscreen,
    Dealer,
    glance,
    exists,
    different,
    card,
    helping,
    vision,
    problem,
    autodifferent,
    promise,
    bidSmarter,
  }
}
</script>