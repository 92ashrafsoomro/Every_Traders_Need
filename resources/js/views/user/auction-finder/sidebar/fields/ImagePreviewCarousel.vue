<template>
  <v-dialog v-model="model" max-width="900" >

      <!-- Carousel -->
      <v-carousel
        v-model="activeIndex"
        hide-delimiters
        show-arrows="hover"
        height="500"
        
      >
        <v-carousel-item
          v-for="(img, index) in images"
          :key="index"
        >
        <v-card>
          <v-img :src="img" cover /></v-card>
        </v-carousel-item>
      </v-carousel>

      <!-- Close -->
        <v-btn icon="mdi-close"  class=" position-absolute  bg-primary ma-3"
          style="right:-20px; top: -30px; z-index: 1000;" @click="model = false" />
   
   
  </v-dialog>
</template>

<script>
export default {
  props: {
    modelValue: {
      type: Boolean,
      required: true
    },
    images: {
      type: Array,
      required: true
    },
    startIndex: {
      type: Number,
      default: 0
    }
  },

  emits: ['update:modelValue'],

  data() {
    return {
      activeIndex: this.startIndex
    };
  },

  computed: {
    model: {
      get() {
        return this.modelValue;
      },
      set(val) {
        this.$emit('update:modelValue', val);
      }
    }
  },

  watch: {
    startIndex(val) {
      this.activeIndex = val;
    }
  }
};
</script>

<style scoped>
::v-deep(.v-carousel__prev .v-btn .v-btn--elevated),
::v-deep(.v-btn--icon.v-btn--density-default) {
  background-color: rgba(var(--v-theme-primary),0.4 );
  color: white;
}

</style>