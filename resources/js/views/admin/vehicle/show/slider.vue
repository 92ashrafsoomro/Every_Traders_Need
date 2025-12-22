<template>
  <v-col cols="12" md="12" class="mt-4">
    <v-card elevation="0" class="">

      <v-img
        :src="currentImage"
        height="300"
        class="rounded-lg"
        contain
      >




        <!-- <v-btn
          icon
          class="position-absolute top-1/2 left-0 transform -translate-y-1/2 ma-2"

          @click.stop="prevImage"
        >
          <v-icon>mdi-chevron-left</v-icon>
        </v-btn>
        <v-btn
          icon
          class="position-absolute top-1/2 right-0 transform -translate-y-1/2 ma-2"
   
          @click.stop="nextImage"
        >
          <v-icon>mdi-chevron-right</v-icon>
        </v-btn> -->
      </v-img>

      <!-- Thumbnails -->
      <div class="text-center py-2 flex flex-wrap justify-center gap-1">
        <v-avatar
          v-for="(img, index) in images"
          :key="index"
          size="30"
          class="ma-1"
          tile
          :color="index === activeIndex ? 'teal lighten-4' : 'grey lighten-2'"
          @click="activeIndex = index"
        >
          <v-img :src="img" contain />
        </v-avatar>
      </div>
    </v-card>

      <div class="mt-6">
            <h3 class="text-h6 mb-2">Available at auction</h3>
            <div class="text-h5 font-weight-bold">
              Lot: 1000 | 21:00 | 22/12/2025
            </div>
            <div class="text-subtitle-1 font-weight-medium">
              Chelmsford (18040)
            </div>
          </div>
  </v-col>
</template>

<script>
export default {
  name: "Slider",
  props: {
    images: {
      type: Array,
      default: () => [],
    },
  },
  data() {
    return {
      activeIndex: 0,
    };
  },
  computed: {
    currentImage() {
      return this.images.length ? this.images[this.activeIndex] : "/placeholder.svg";
    },
  },
  watch: {

    images(newVal) {
      if (newVal.length > 0) this.activeIndex = 0;
    },
  },
  methods: {
    nextImage() {
      if (!this.images.length) return;
      this.activeIndex = (this.activeIndex + 1) % this.images.length;
    },
    prevImage() {
      if (!this.images.length) return;
      this.activeIndex = (this.activeIndex - 1 + this.images.length) % this.images.length;
    },
  },
};
</script>

<style scoped>
.v-card {
  border-radius: 8px;
  overflow: hidden;
}

.v-avatar {
  cursor: pointer;
  border: 2px solid transparent;
  transition: all 0.2s;
}

.v-avatar:hover {
  transform: scale(1.1);
}

.bg-dark {
  background-color: #0E1B2B;
  color: white;
}

.bg-light {
  background-color: #1F2A3A; 
  color: white;
}

.v-list-item.rounded {
  margin-bottom: 4px;
}
</style>
