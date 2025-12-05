<template>
  <v-container class="pa-0 mx-auto " style=" max-width:1400px; max-height: 403px;">
    <div class="py-16  ">

      <div style="display:flex; gap:16px; align-items:flex-start;">

        <!-- VERTICAL LINE -->
        <div
          class="vertical-line bg-verticalLineBlue" style="width: 4px; min-height: 180px;"
        ></div>

        <!-- TEXT BLOCK -->
        <div v-for="(data, i) in data" :key="i">

       
          <h2 class="text-h6 text-sm-h5 text-md-h4 text-lg-h4 text-text_light mb-4 font-weight-light">
         {{ data.title }}
          </h2>

          <!-- RESPONSIVE PARAGRAPH -->
          <p style="max-width: 1000px;"
             class="mt-4 mb-4 text-body-2 text-sm-body-1 text-md-body-1 text-text_light font-weight-light line-height-relaxed">
           {{ data.paragraph }}
          </p>

          <!-- SMALL BOTTOM LINE TEXT -->
          <p class="text-body-2 text-sm-body-1 text-md-body-1 text-text_light font-weight-medium">
            {{ data.ltd }}
          </p>

        </div>
       

      </div>

    </div>
    
  </v-container>
  <div class="bgImage d-flex justify-center pb-16 mb-16">
     <img :src="gridImage" alt=""></img>
  </div>
</template>
<script>

import gridImage from '@assets/images/tabs/gridImage.png';
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
/* .vertical-line {
  width: 4px;
  background: #0080ff;
  min-height: 180px; 
} */

.line-height-relaxed {
  line-height: 1.7;
}

/* Mobile adjustments */
@media (max-width: 600px) {
  .bgImage img{
    /* display: none; */
        max-width: 292px;
  }
  .vertical-line {
    min-height: 220px;
    margin-left: 10px;
  }
}
</style>
