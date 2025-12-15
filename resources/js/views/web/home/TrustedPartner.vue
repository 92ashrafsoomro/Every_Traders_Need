<template>
    <div style="width: auto; " class="bg-background">
    <div class="d-flex flex-wrap justify-center bg-background mx-auto pa-16 ga-10" style="max-width: 1400px;">
        <div class="rightImage" style="max-width: 700px;">
            <img :src="TrustedPartnerImage" alt="" srcset="" width="500">
        </div>
        <div class="leftContent mt-10"  style="max-width: 700px; ">
            <v-chip class="mb-4 text-primary" style="  border-radius: 0px 20px 0px 0px;  padding: 6px 16px;"  >
                    Why Autoboli
                </v-chip>
            <h1 class="text-h3 mb-6" style="font-weight: bold;">Your Trusted Partner For Smarter Vehicle <br> Trading</h1>
            <p class="mb-8 text-light_text_on">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores, alias ad ducimus molestiae praesentium veniam assumenda quibusdam minima dignissimos molestias laudantium maxime id cumque distinctio deleniti placeat commodi minus facilis!</p>
            <p class="text-light_text_on">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eius in unde aperiam tenetur pariatur iste, minima ipsam recusandae quod veritatis nisi aut quidem, alias incidunt doloremque dolorem nesciunt quaerat. Consequatur.</p>
           <div class="button mt-4">
         <AppButton text="About Us" to="/about" />
           </div>  
        </div></div>
</div>
</template>

<script>
import TrustedPartnerImage from '@assets/images/hero/HomepageImageTrusted.png'
import AppButton from '../component/AppButton.vue'

export default {
  name: "TrustedPartner",
  components: {
    AppButton
  },
  data() {
    return {
      TrustedPartnerImage
    }
  }
}
</script>


<style scoped></style>