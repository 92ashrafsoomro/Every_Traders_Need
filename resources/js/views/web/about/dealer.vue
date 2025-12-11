<template>
  <v-container max-width="1500px"  class="bg-surface main-container mx-auto">
    <div class="pt-16"  >
      <div class="left-border-box d-flex items-start">

        <div v-for="(item, i) in data" :key="i" class="ml-5">

          <h2 class="text-h4 text-on-primary  mb-4 font-weight-bold">
            {{ item.title }}
          </h2>

          <p class="paragraph mb-6 mt-5 text-text_light font-weight-light">
            {{ item.paragraph }}
          </p>

          <p class=" text-text_light font-weight-light">
            {{ item.ltd }}
          </p>

        </div>

      </div>

    </div>

    
    <!-- IMAGE -->
    <div  class="bgImage mt-16 mb-2 d-flex justify-center">
      <img class="" :src="gridImage" alt="">
    </div>

  </v-container>
</template>

<script>

import gridImage from '@assets/images/tabs/about2.png';
import dealerContent from "@/json/dealer.json";

export default {
    data(){      
        return{
             gridImage,
             data :  dealerContent
            }    
    }
}

</script>

<style scoped>
.main-container {
  padding-top: 80px;
  padding-bottom: 80px;
}
.left-border-box {
  border-left: 5px solid #0080FF;
  padding-left: 20px;
}
.bgImage {
  /* padding-bottom: 150px; */
}
.paragraph {
  max-width: 900px;
  line-height: 1.7;
}
.bgImage img {
  width: 100%;
  max-width: 1000px;
}


@media (max-width: 600px) {
  .bgImage img{
        max-width: 292px;
  }

}
</style>
