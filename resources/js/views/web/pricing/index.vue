<template>
<div class="bg-background ">
    
      <div class="text-center justify-center pt-12 mt-10"> 
          <h1 class="text-lg-h2 text-md-h3 font-weight-bold mb-3">VeePN has been updated</h1>
          <p class="text-lg-h5 text-md-h6 opacity-70">Support us today and boost your digital safety with VeePN Premium</p>    
      </div>

      <div style="max-width: 1400px;" class=" mt-10 mb-10 mx-auto d-lg-flex justify-center " >

            <div class="left align-self-center " >
                <div class="px-10 pb-10 pb-lg-0" >
                      <p>Hi there!</p>
                      <p>We at VeePN believe that Internet journeys should be safe and private for everyone. Our product is designed to protect you on public Wi-Fi, shield your data, and provide access to your favorite content.</p>
                      <p>Our VPN service has a free version, letting users enjoy the Internet with full protection. No wonder VeePN has become a trusted choice of millions around the globe. If you share our values, please support our product and enjoy premium benefits.</p>
                </div>
            </div>
            <div class="right bg-surfaceBright mr-lg-10 "style=" border-radius:15px; box-shadow:0px 0px 20px 0px rgb(var(--v-theme-shadow));">

              <div class="child d-flex flex-wrap  py-5 px-5 " >
                  <div class="pr-2">
                          <h3 class="text-lg-h5 text-md-h5">All Premium plans include:</h3>
                          <ul style="list-style: none ;"  class="d-flex flex-column ga-5 flex-wrap my-5" >
                            <li> <v-icon color="green">mdi-check</v-icon> <span class="px-2 " >2,600+ VPN servers in 85 countries</span>  </li>
                            <li><v-icon color="green">mdi-check</v-icon> <span class="px-2" >10 devices for any subscription</span>  </li>
                            <li><v-icon color="green">mdi-check</v-icon> <span class="px-2" >Unlimited bandwidth and speed</span>  </li>
                            <li><v-icon color="green">mdi-check</v-icon> <span class="px-2" >Optimized servers for streaming</span>  </li>
                            <li><v-icon color="green">mdi-check</v-icon> <span class="px-2" > Full traffic encryption</span>  </li>
                          </ul>
                      </div>
                      <div class=" text-center">
                            <div class="bg-verticalLineBlue pt-1 d-flex flex-column justify-lg-end mb-5" style="width:240px; height:260px; border-radius:15px; border:2px solid rgb(var(--v-theme-verticalLineBlue));">
                                    <p class="text-center mb-2" style="font-weight: bold ;">BEST VALUE</p>

                                    <div class="bg-white d-flex flex-column align-center justify-space-evenly "style="width:100%; height:220px; border-radius:15px; bottom:0px;">
                                          <p>24 Months</p>
                                          <div class="d-flex align-center">
                                            <p>USD</p>
                                            <h1>2.49</h1>
                                            <p>/mo</p>
                                          </div>

                                          <v-btn variant="flat" color="warning " style="border-radius:10px; width: 80%; height:40px;"  >Get Premium</v-btn>
                                            <p class="text-body-2 opacity-70" >
                                              30-day money-back guarantee
                                              </p>

                                    </div>
                                          
                            </div>
                      <a href="#" ><p class="text-h6">See more plans</p></a>
                      </div>
              </div>
                    
                      
            
            </div>
        

      </div>
      <!-- <div class="text-h2 text-center " style="margin-top: 100px;">52 million users, 10 000+ positive reviews</div> -->
      </div>
  <!--<pricingplain/> -->
  <!-- <featureTable/> -->
</template>


<script>
  import pricingplain from './pricingplain.vue';
  import featureTable from './featureTable.vue';
  
  export default {
      components: {
        name: 'pricing',
        pricingplain,
        featureTable
      }
  }
</script>

<style scoped >

    .right{
          width: 1938px;
    }
    .child{
      justify-content: space-between;
    }



    @media (max-width: 1279px) {
    
       .right{
          width: 80%!important;
      
          margin: auto;
        }
      
    }
        @media (max-width: 754px) {
    
       .right{
          width: 60%!important;
          
          margin: auto;
        }
        
        .child{
          justify-content: center !important;
        }
    }
     @media (max-width: 605px) {
    .right{
          width: 90%!important;
          
          margin: auto;
        }
       
    }




</style>