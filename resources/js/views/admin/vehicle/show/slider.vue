<template>
  <v-col cols="12" md="12" class="mt-4">
    <v-card elevation="0">


      <v-img
        :src="currentImage"
        height="320"
        class="rounded-lg position-relative"
        contain
      >
        <div
          v-if="damageList.length"
          class="damage-overlay"
        >
          <div class="font-weight-bold mb-1">
            Damage Details
          </div>

          <div
            v-for="(d, i) in damageList"
            :key="i"
            class="text-caption"
          >
            • {{ d.key }} → {{ d.value }}
          </div>
        </div>
      </v-img>

      <div class="text-center py-2 d-flex flex-wrap justify-center">
        <v-avatar
          v-for="(img, index) in images"
          :key="index"
          size="34"
          class="ma-1 thumb"
          tile
          :class="{ active: index === activeIndex }"
          @click="activeIndex = index"
        >
          <v-img :src="img" contain />
        </v-avatar>
      </div>

    </v-card>


    <div class="mt-6" v-if="auction">
      <h3 class="text-h6 mb-2">Platfrom at {{ vehicle.auction_name }}</h3>
      <div class="text-h5 font-weight-bold">
        Lot: {{ vehicle.lot}} |
        {{ vehicle.auction_date }} |
        {{ vehicle.auction_status }} 
        {{ vehicle.center_name  }} 
      
      </div>

      <div class="text-subtitle-1 font-weight-medium">
        {{ vehicle.user ?? "Unknow" }}
      </div>
    </div>
  </v-col>
</template>

<script>
export default {
  name: "Slider",

  props: {
    vehicle: {
      type: Object,
      required: false,
    },
    images: {
      type: Array,
      default: () => [],
    },
    damage_details: {
      type: Array,
      default: "",
    },
    auction: {
      type: Boolean,
      default: false,
    },
  },

  data() {
    return {
      activeIndex: 0,
    };
  },

  computed: {
    currentImage() {

      return this.images.length
        ? this.images[this.activeIndex]
        : "/placeholder.svg";
    },


    damageList() {
      if (!this.damage_details) return [];
      if (Array.isArray(this.damage_details)) {
        return this.damage_details.map(item => ({
          key: item.key || "",
          value: item.value || "",
        }));
      }
      return this.damage_details.split(",").map(item => {
        const parts = item.split("|").map(p => p.trim());
        return {
          key: parts[0] || "",
          value: parts.slice(1).join(" ") || "",
        };
      });
    },


  },

  watch: {
    images(val) {
      if (val.length) this.activeIndex = 0;
    },
  },
};
</script>

<style scoped>
.v-card {
  border-radius: 10px;
  overflow: hidden;
}
.thumb {
  cursor: pointer;
  border: 2px solid transparent;
  transition: 0.2s;
}

.thumb.active {
  border-color: #009688;
}
.damage-overlay {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(183, 28, 28, 0.92);
  color: #fff;
  padding: 10px;
}
</style>
