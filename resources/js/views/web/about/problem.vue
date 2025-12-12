<template>
  <section >
    <v-container max-width="1500px" style="margin-top: 100px; margin-bottom: 100px;">
      <v-row align="center" justify="center" class="min-vh-100" no-gutters>

        <!-- Left Big Card -->
        <v-col cols="12" lg="6" class="d-flex justify-center mb-8 mb-lg-0">
          <v-card elevation="0" class="pa-16 text-start border-xl border-opacity-75 border-danger" max-width="860" :border="true"
            style="border-radius: 90px;">

            <h1 class="text-h2 text-md-h1 font-weight-bold text-white mb-4 " style="line-height: 1.3;" >
              
              The <span class="text-white bg-danger px-4">Real</span>
               <span class="bg-danger text-white px-4 my-4 "> Problem</span>
              <span> in Auctions</span>
            </h1>
            
            <!-- <h1 class="text-h2 text-md-h1 font-weight-bold text-white mb-4" >
              The <span class="text-white bg-danger">Real</span>
            </h1>
            
            <h1 class="text-h2 text-md-h1 font-weight-black text-white mb-6">
              <span class="bg-danger text-white px-6 py-2" style="display: inline-block;">Problem</span>
            </h1>

            <h2 class="text-h2 text-md-h1 font-weight-black text-white mb-6">
              in Auctions
            </h2> -->
          </v-card>
        </v-col>

        <!-- Right Side Content -->
        <v-col cols="12" lg="6" class="d-flex justify-center">
          <div class="text-center" style="max-width: 600px; width: 100%;">
            <!-- Top Text -->
            <p class="text-body-1 text-start text-light_text_on mb-2">The truth is simple:</p>
            <p class="text-h6 text-start text-white font-weight-medium mb-10">
              People don’t lose money because the market is bad.<br>
              They lose money because they bid blind.
            </p>

            <!-- Problem Cards -->
            <div v-for="(item, i) in problems" :key="i" class="mb-6">
              <v-card elevation="0" class=" text-start d-flex align-center pa-5 position-relative bg-surface mx-auto" >
                <!-- Red Minus Icon -->
                <v-icon
               size="33"
              class="bg-danger  text-white mr-4 pa-6"
              style="font-size: 34px; border-radius: 25%; "
              >
                mdi-minus-thick
              </v-icon>


                <p class="text-body-1 text-white mb-0 ">
                  {{ item.text }}
                </p>
              </v-card>
            </div>

            <v-card class="d-flex align-center pa-5 position-relative bg-primary mx-auto"
              elevation="0">
            <v-icon
              size="33"
              class="bg-black  text-white mr-4 pa-6"
              style="font-size: 34px; border-radius: 25%; "
            >
              mdi-plus-thick
            </v-icon>

              <p class="text-start text-body-1 text-white mb-0">{{ solution.text }}</p>
            </v-card>
          </div>
        </v-col>

      </v-row>
    </v-container>
  </section>
</template>

<script>
import problem from '@/json/realproblem.json'

export default {
  name: "ProblemPage",
  data() {
    return {
      problems: problem.problems,
      solution: problem.solution
    }
  }
}
</script>