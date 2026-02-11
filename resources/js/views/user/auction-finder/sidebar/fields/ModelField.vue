<template>
  <div v-for="(models, makeName) in groupedModelsMake" :key="makeName" class="mb-4">

    <!-- Make Name -->
    <p class="text-subtitle-2 text-grey mb-2 mt-4">
      {{ makeName }} {{ models.length }}
    </p>

    <!-- Models -->
    <div v-for="(item, index) in models" :key="item.id" class="d-flex align-center justify-space-between">
      <v-checkbox
        v-if="showAll || index <= 3"
        v-model="auctionStore.filter.model"
        :label="item.label"
        :value="item.id"
        @change="handleChange"
      />

      <div
        v-if="showAll || index <= 3"
        class="d-flex ml-2 align-center px-2 rounded-lg text-body-2 mb-2"
        style="border: 1px solid rgba(var(--v-theme-primary),0.3);"
      >
        {{ item.count }}
      </div>
    </div>

    <!-- Show More / Show Less -->
    <div class="py-2" v-if="models.length > 3">
      <p
        style="text-decoration: underline; cursor: pointer;"
        @click="showAll = !showAll"
      >
        {{ showAll ? "Show Less" : "Show More" }}
      </p>
    </div>

  </div>
</template>

<script>
import { useAuctionStore } from "@/stores/auctionStore";
import { useMasterStore } from "@/stores/masterStore";

export default {
  data() {
    return {
      auctionStore: useAuctionStore(),
      masterStore: useMasterStore(),
      showAll: false, 
    };
  },
  methods: {
    handleChange() {
      this.auctionStore.getAuctionList();
      this.masterStore.getVariants({
        model: this.auctionStore.filter.model,
      });
    },
  },
  computed: {
    groupedModelsMake() {
      const groups = {};
      this.masterStore.models.data.forEach(item => {
        if (!groups[item.make]) {
          groups[item.make] = [];
        }
        groups[item.make].push(item);
      });
      return groups;
    },
  },
};
</script>
