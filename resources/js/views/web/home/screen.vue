<template>
  <v-container fluid class="hero-section d-flex align-center border-b position-relative overflow-hidden" min-height="900"
    :style="{ backgroundImage: `url(${currentBg})`, backgroundSize: 'cover', backgroundPosition: 'center' }">
    <div class="hero-overlay position-absolute" style=" inset: 0;
  background: rgba(3, 20, 40, 0.85);
  backdrop-filter: blur(2px);"></div>

    <v-container fluid class="position-relative " style="max-width: 1400px; z-index: 1; ">
      <v-row align="center" >
        <v-col cols="12" md="6" style="backdrop-filter: blur(1px);" class="items-center mx-lg-0 mx-auto mt-10 text-center text-lg-start">
          <h1 class="text-h5 text-lg-h3   text-md-h3 font-weight-bold text-white mb-6">
            Smarter Vehicle Auction <br />
            Insights - All in One Place
          </h1>

          <p class="text-body-1 text-light_text_on mb-8 w-100  d-flex text-center text-lg-start justify-center">
            Stay ahead of the market with real-time UK vehicle auction data,
            transparent valuations, and powerful tools designed for dealers.
          </p>



          <div class="d-flex flex-wrap ga-4 justify-center  justify-lg-start">
            <v-btn color="primary" size="large" class="text-capitalize">Explore Auctions</v-btn>
            <v-btn variant="outlined" size="large" class="text-capitalize">Start Free Trial</v-btn>
          </div>

          <div class="d-flex mt-8  ga-2 justify-center  justify-lg-start">
            <span>We analyse:</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24" height="24"
              aria-hidden="true" data-slot="icon">
              <path fill="currentColor" fill-rule="evenodd"
                d="M9.922 7H9.471a.624.624 0 0 0-.197.031c-1.584.164-2.693.931-3.567 1.536-.275.19-.527.365-.764.5-.554.315-1.391.578-2.132.766a19.433 19.433 0 0 1-1.195.262l-.073.014-.017.003H1.52c-.301.051-.521.312-.521.617v3.501c0 .796.645 1.44 1.44 1.44h1.283a.624.624 0 0 0 .109-.009 2.341 2.341 0 0 0 1.25 1.183c.413.17.89.23 1.363.13a2.415 2.415 0 0 0 1.21-.65c.182-.19.337-.41.452-.654h7.799a2.496 2.496 0 0 0 .471.674c.32.306.733.539 1.19.63.474.1.951.04 1.364-.13a2.342 2.342 0 0 0 1.246-1.173h1.38a1.44 1.44 0 0 0 1.44-1.44v-1.688c0-.888-.524-1.733-1.4-2.054-1.272-.466-2.462-.722-3.659-.755-1.287-1.247-2.45-1.95-3.774-2.324-1.244-.352-2.597-.403-4.242-.41Zm10.462 7.42h1.173a.19.19 0 0 0 .19-.19v-1.687c0-.41-.238-.755-.58-.88-1.175-.431-2.235-.653-3.275-.68a.623.623 0 0 1-.229.042l-9.458-.044h-.002a2.457 2.457 0 0 1-2.117-1.15c-.168.11-.342.218-.525.322-.71.404-1.687.7-2.443.892-.331.084-.632.15-.868.2v2.985c0 .105.085.19.19.19h1.19a2.352 2.352 0 0 1 2.338-2.106c.468 0 .92.13 1.316.393l.01.007c.37.256.67.613.856 1.043l.007.016c.084.21.137.427.16.647H15.696c.023-.22.076-.437.16-.647l.007-.016c.186-.43.486-.787.857-1.043l.009-.007a2.352 2.352 0 0 1 1.317-.392 2.351 2.351 0 0 1 2.338 2.106ZM9.819 8.25c-1.174.016-1.953.4-2.696.882.11.207.453.599 1.082.599h.003l7.868.037c-.77-.59-1.488-.94-2.252-1.155-1.09-.308-2.31-.358-4.005-.363Zm-3.233 5.495c.18.125.323.296.414.5.08.205.1.422.059.645a1.162 1.162 0 0 1-.297.56c-.166.155-.365.26-.562.297l-.014.003c-.206.045-.427.021-.63-.063l-.006-.002a1.092 1.092 0 0 1-.501-.406l-.006-.01a1.068 1.068 0 0 1-.177-.603 1.102 1.102 0 0 1 1.102-1.102c.232 0 .44.062.618.18Zm10.427.5c.09-.204.234-.375.414-.5.179-.119.386-.18.619-.18a1.102 1.102 0 0 1 1.101 1.101c0 .228-.065.442-.177.604l-.006.009a1.092 1.092 0 0 1-.5.406l-.007.002a1.064 1.064 0 0 1-.63.063l-.015-.003a1.162 1.162 0 0 1-.56-.297 1.162 1.162 0 0 1-.298-.56 1.161 1.161 0 0 1 .06-.644Z"
                clip-rule="evenodd"></path>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24" height="24"
              aria-hidden="true" data-slot="icon">
              <path fill="currentColor" fill-rule="evenodd"
                d="M15.322 5.032a.625.625 0 0 0-.395 1.186l1.111.37.458 1.946c-1.323-.898-2.838-.757-3.894-.282a3.9 3.9 0 0 0-1.347.985H5.107c-.865 0-1.474.156-1.964.608a3.391 3.391 0 0 0-.55.697c-.078.124-.158.257-.238.392l-.005.008c-.08.135-.164.275-.256.425a.625.625 0 0 0 .483.952l6.592.508 1.432 2.504H7.986a2.983 2.983 0 0 0-.038-.1l-.007-.015a2.936 2.936 0 0 0-1.025-1.248l-.009-.006a2.804 2.804 0 0 0-1.57-.469 2.805 2.805 0 0 0-2.806 2.805 2.793 2.793 0 0 0 1.748 2.597 2.756 2.756 0 0 0 1.627.155 2.885 2.885 0 0 0 1.443-.772c.37-.387.648-.883.754-1.43v-.004c.017-.087.03-.175.038-.263h4.369c.454 0 .878-.087 1.257-.325.375-.237.644-.584.857-.994.16-.308 1.636-2.979 2.423-4.388l.707 3.006a2.843 2.843 0 0 0-.13.082l-.01.006a2.937 2.937 0 0 0-1.025 1.248l-.006.016a2.88 2.88 0 0 0-.155 1.612v.004a2.883 2.883 0 0 0 .774 1.45c.385.368.878.645 1.422.752.563.121 1.133.05 1.627-.155.517-.207.965-.569 1.277-1.035.32-.464.472-1.02.472-1.562a2.805 2.805 0 0 0-3.05-2.795l-.802-3.406h1.51a.625.625 0 0 0 0-1.25h-1.804l-.679-2.884a.625.625 0 0 0-.41-.45l-1.443-.48Zm3.164 9.872a.626.626 0 0 0 .386-.13c.104-.02.211-.03.323-.03a1.555 1.555 0 0 1 1.555 1.554c0 .318-.09.621-.253.856l-.006.009c-.172.257-.42.459-.708.573l-.007.003a1.506 1.506 0 0 1-.892.088l-.015-.003a1.632 1.632 0 0 1-.793-.42 1.632 1.632 0 0 1-.42-.792 1.63 1.63 0 0 1 .084-.908c.127-.288.33-.53.581-.705.053-.036.108-.067.165-.095Zm-3.862.358-.555-.288.555.288Zm-2.114.07h-.47l-1.95-3.413a.625.625 0 0 0-.495-.313l-5.908-.455c.12-.184.212-.303.305-.388.16-.148.4-.277 1.115-.277h6.454a.625.625 0 0 0 .515-.27c.211-.308.57-.612 1.04-.824.818-.368 1.932-.428 2.85.303.027.021.055.04.085.057l.136.076-.07.148a494.39 494.39 0 0 0-2.602 4.71c-.15.288-.287.432-.414.512-.125.078-.299.133-.591.133Zm-6.3-.333c.251.175.454.417.58.705.115.289.143.595.085.908a1.631 1.631 0 0 1-.42.792c-.23.216-.51.365-.794.42l-.014.003c-.295.065-.61.03-.893-.088l-.007-.003a1.542 1.542 0 0 1-.707-.573l-.006-.01a1.512 1.512 0 0 1-.253-.855 1.555 1.555 0 0 1 1.555-1.555c.325 0 .619.087.873.256Z"
                clip-rule="evenodd"></path>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24" height="24"
              aria-hidden="true" data-slot="icon">
              <path fill="currentColor" fill-rule="evenodd"
                d="M14.836 7.23a.626.626 0 0 1-.16.02h-1.37c.06.23.146.503.26.771.31.72.688 1.095 1.11 1.095h2.298L14.836 7.23Zm3.847 3.097a.623.623 0 0 1-.218.039H14.675c-1.262 0-1.935-1.099-2.258-1.853a6.991 6.991 0 0 1-.397-1.263H2.973l-.723 3.398v3.454a.19.19 0 0 0 .16.188l1.236.206a2.348 2.348 0 0 1 2.314-1.95c.468 0 .92.129 1.314.392l.01.006c.37.256.67.613.855 1.042l.007.017c.076.19.127.386.153.585h7.377c.025-.198.076-.395.152-.585l.007-.017c.186-.429.486-.786.856-1.042l.01-.006a2.347 2.347 0 0 1 1.314-.392 2.348 2.348 0 0 1 2.311 1.938l1.223-.198a.19.19 0 0 0 .16-.188v-.959c0-1.055-.621-1.984-1.574-2.322a48.167 48.167 0 0 0-1.314-.446l-.138-.044Zm1.515 5.444a2.339 2.339 0 0 1-1.299 1.298 2.31 2.31 0 0 1-1.361.129 2.411 2.411 0 0 1-1.209-.648 2.481 2.481 0 0 1-.477-.712h-7.73a2.484 2.484 0 0 1-.496.731 2.41 2.41 0 0 1-1.19.629 2.31 2.31 0 0 1-1.36-.129 2.34 2.34 0 0 1-1.294-1.283l-1.578-.263A1.44 1.44 0 0 1 1 14.102v-3.52c0-.043.005-.087.014-.13l.842-3.957A.625.625 0 0 1 2.467 6h12.198a.627.627 0 0 1 .107.007c.47.067.964.35 1.385.64.447.31.905.699 1.31 1.07a23.925 23.925 0 0 1 1.345 1.34l.394.125c.344.11.82.269 1.348.457 1.492.53 2.405 1.961 2.405 3.5v.96a1.44 1.44 0 0 1-1.21 1.421l-1.55.25Zm-13.21-1.296a1.203 1.203 0 0 0-.412-.5 1.099 1.099 0 0 0-.616-.179 1.098 1.098 0 0 0-1.099 1.098c0 .228.065.441.176.602l.006.01c.121.18.297.323.5.404l.007.003c.201.083.423.107.627.062l.015-.003c.196-.038.394-.141.56-.296.154-.165.258-.363.296-.558a1.157 1.157 0 0 0-.06-.643Zm9.998 0c.09-.204.233-.375.412-.5.179-.117.385-.179.617-.179a1.098 1.098 0 0 1 1.098 1.098c0 .228-.064.441-.176.602l-.006.01a1.088 1.088 0 0 1-.5.404l-.006.003a1.06 1.06 0 0 1-.627.062l-.015-.003a1.159 1.159 0 0 1-.56-.296 1.16 1.16 0 0 1-.296-.558 1.157 1.157 0 0 1 .059-.643Z"
                clip-rule="evenodd"></path>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24" height="24"
              aria-hidden="true" data-slot="icon">
              <path fill="currentColor" fill-rule="evenodd"
                d="M3.905 5C2.855 5 2 5.854 2 6.905v7.958c0 1.05.854 1.905 1.905 1.905h.847a2.355 2.355 0 0 0 2.276 1.744c1.09 0 2.008-.74 2.276-1.744H15.752a2.355 2.355 0 0 0 2.276 1.744c1.09 0 2.008-.74 2.276-1.744h.144a1.851 1.851 0 0 0 1.853-1.853v-1.889a3.33 3.33 0 0 0-.245-1.238 3.163 3.163 0 0 0-.524-.858l-1.674-1.99a1.714 1.714 0 0 0 1.529-1.704v-.841A1.405 1.405 0 0 0 19.978 5H3.905Zm16.39 6.4L18.24 8.958h-1.554l1.507 2.297.003.005a.253.253 0 0 0 .206.113h.009l1.883.027Zm-5.11-2.45h-.712v6.568h1.29a2.356 2.356 0 0 1 4.531 0h.154a.601.601 0 0 0 .603-.603v-1.889c0-.122-.012-.244-.035-.366l-2.619-.037a1.503 1.503 0 0 1-1.25-.684l-1.961-2.99Zm-5.891 6.568h3.93v-6.61a1.208 1.208 0 0 1 1.208-1.209h5.241c.254 0 .46-.204.464-.457V6.41a.156.156 0 0 0-.159-.159H3.905a.657.657 0 0 0-.655.655v7.958c0 .36.295.655.655.655h.857a2.356 2.356 0 0 1 4.532 0Zm-2.266 1.744a1.103 1.103 0 0 1-1.103-1.029.63.63 0 0 0 .002-.167 1.103 1.103 0 0 1 1.101-1.004c.612 0 1.105.494 1.105 1.1 0 .605-.493 1.1-1.105 1.1Zm-1.403-6.065V8.625h5.097v2.572H5.625Zm-.076-3.822c-.649 0-1.174.525-1.174 1.174v2.725c0 .648.525 1.173 1.174 1.173h5.25c.648 0 1.173-.525 1.173-1.173V8.549c0-.649-.525-1.174-1.173-1.174h-5.25Zm11.374 8.787c0-.606.493-1.1 1.105-1.1s1.105.494 1.105 1.1c0 .605-.493 1.1-1.105 1.1a1.103 1.103 0 0 1-1.105-1.1Z"
                clip-rule="evenodd"></path>
            </svg>
          </div>
          <div class="w-100  mt-10 lg-mt-6 ml-n4 ml-lg-0 text-center text-lg-start  ">
            <p>Autoboli intelligence can reveal:</p>
            <div class="w-100 text-light_text_on mt-2 mt-5 ">
              <ul class="d-flex flex-wrap ga-2 w-100 mb-2 pa-lg-0 pa-4 ml-10 ml-lg-0" style="list-style:none">
                <li v-for="(item, i) in featuresCol1" :key="i" class="d-flex align-center ga-1">
                  <v-icon size="18" color="primary">mdi-check</v-icon>
                  <span class="text-body-2">{{ item }}</span>
                </li>
              </ul>
            </div>
          </div>

        </v-col>
      </v-row>
    </v-container>

    <v-img :src="currentImage" class="hero-image-abs d-none  position-absolute top-1 d-lg-flex " rounded="xl" :key="currentImage"  style="  right: 0;
  margin-top: 150px;
  min-width: 1050px;
  max-width: 200px;
  box-shadow: 0 10px 200px rgba(var(--v-theme-primary), 0.3);
  transform: translate(120px, 40px);
  max-width: none;"/>

  </v-container>
  <div style=" margin-top: -100px; " class="d-lg-flex d-none justify-center ga-4">
    <v-btn icon @click="prevImage" class="rounded-sm" color="primary"><v-icon>mdi-chevron-left</v-icon></v-btn>
    <v-btn icon @click="nextImage" class="rounded-sm" color="primary"><v-icon>mdi-chevron-right</v-icon></v-btn>

  </div>
</template>


<script>
import Reauction1 from '@/assets/images/reauction/Reauction.png'
import Reauction2 from '@/assets/images/reauction/Reauction.png'


export default {
  data() {
    return {
      images: [Reauction1, Reauction2],
      currentIndex: 0,
      featuresCol1: [
        'Reauction history',
        'Previous auction results',
        'CAP & AutoTrader valuations',
        'Trade & retail value signals',
        ' Unsold & provisional flags',
        'Price movement insights',
        'Auction timing & status',
        'And more…',
      ],
    }
  },
  computed: {
    currentBg() {
      return this.images[this.currentIndex]
    },
    currentImage() {
      const nextIndex = (this.currentIndex + 1) % this.images.length
      return this.images[nextIndex]
    }
  },
  methods: {
    nextImage() {
      this.currentIndex = (this.currentIndex + 1) % this.images.length
    },
    prevImage() {
      this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length
    }
  }
}
</script>

<style scoped>
.hero-image-abs-enter-active,
.hero-image-abs-leave-active {
  transition: opacity 0.5s ease, transform 0.5s ease;
}

.hero-image-abs-enter-from {
  opacity: 0;
  transform: translateX(50px);
}

.hero-image-abs-leave-to {
  opacity: 0;
  transform: translateX(-50px);
}


@media (max-width: 960px) {
  .hero-image-abs {
    position: relative;
    width: 100%;
    margin: 20px auto;
  }
}


@media (max-width: 960px) {
  .hero-image-abs {
    display: none;
 
  }

  .hero-section {
    min-height: auto;
    padding: 60px 20px;
  }

  .hero-content {
    text-align: center;

  }
}
</style>
