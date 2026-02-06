<template>

  <v-card
    class="rounded-xl overflow-hidden position-relative"
    width="400"
    height="250"
    elevation="12"
  >
    <v-img
      :src="bgImage"
      height="100%"
      cover
      class="align-end"
      style="background: linear-gradient(
        to top right,
        rgb(var(--v-theme-primaryDark)) 20%,
        rgb(var(--v-theme-primary)) 60%
      );"
    >
      <!-- overlay -->
      <div
        class="d-flex flex-column fill-height pa-6 position-absolute"
        style="top: 0; left: 0; width: 100%;"
      >
        <div class="d-flex justify-end">
          <h3 class="text-h6 font-weight-bold text-uppercase">visa</h3>
        </div>

        <div class="d-flex justify-space-between mt-16 align-center flex-grow-1">
          <div class="text-white">
            <h3
              class="cardNumber text-h5 font-weight-bold"
              style="word-spacing: 10px;"
            >
              123 1234 1234 1344
            </h3>
            <p class="mt-2 font-weight-bold">AutoBoli</p>
          </div>
        </div>
      </div>
    </v-img>
  </v-card>


    <!-- Rest of your commented code can stay as is -->
</template>

<script>
import bgImage from '@/assets/images/billiing/bg.png'

export default {
    name: 'PaymentMethods',
    data() {
        return {
            bgImage,
            selectedMethod: 'card',
            cardNumber: '1356 3215 6548 7898',
            cardName: 'John Doe',
            expDate: '12/24',
            cvv: '654'
        }
    }
}
</script>

<style scoped>
/* Ensure the overlay sits on top */
.position-relative {
    position: relative;
}

.position-absolute {
    position: absolute;
}

/* Your existing styles */
.v-application {
    /* background: #0f0f1e !important; */
}

.mastercard-logo {
    width: 60px;
    filter: brightness(0) invert(1);
}

.opacity-80 {
    opacity: 0.8;
}

.cardNumber {
    font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif !important;
}
</style>