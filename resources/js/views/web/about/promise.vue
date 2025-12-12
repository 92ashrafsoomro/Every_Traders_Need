<template>
  <section>
    <v-row no-gutters class="min-vh-100">

      <!-- LEFT: Blue Half -->
      <v-col cols="12" lg="6" class="bg-primary d-flex align-center justify-center " style="padding: 180px 180px;">
        <div class="text-white" style="width: 500px;">
          <h1 class="text-h2 mb-4 font-weight-bold">
            Our Promise
          </h1>

          <!-- Black Vertical Line + Points -->
          <div class="position-relative">

            <div class="mb-1" style="border-left:5px solid black ; ">
              <p class="text-body-1  ml-5">
                We don't sell cars. <br>
                We don't push deals. <br>
                <b>We give you the truth behind every auction.</b>
              </p>
            </div>
          </div>

          <!-- Footer Text -->
          <p class="mt-10">
            {{ data.footer }}
          </p>
        </div>
      </v-col>

      <!-- RIGHT: Dark Gradient Half -->
      <v-col class="image-container" cols="12" lg="6">
       
      </v-col>


    </v-row>
  </section>
</template>

<script setup>

import { reactive } from 'vue'
import promiseData from '@/json/promise.json'

const data = reactive(promiseData)
</script>


<style  >
  .image-container {
  width: 100%;
  background-size: cover !important;
  background:url("https://i.pinimg.com/736x/77/2e/be/772ebe0e93b9d934c992f867f998d0c5.jpg") no-repeat; /* image */
}




</style>