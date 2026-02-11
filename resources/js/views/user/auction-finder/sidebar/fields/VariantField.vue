<template>
   <div v-for="(variants, modelName) in groupedVariantsByModel" :key="modelName" class="mb-4">

  <p class="text-subtitle-2 text-grey mb-2 mt-2">
    {{ modelName }} ({{ variants.length }})
  </p>

  <div v-for="(item, index) in variants" :key="item.id" class="d-flex align-center justify-space-between">
    <v-checkbox 
      v-if="showAll || index <= 3"
      v-model="auctionStore.filter.variant" 
      :label="item.label"
      :value="item.id" 
      @change="handleChange" 
    />
    <div 
      v-if="showAll || index <= 3"
      class="d-flex ml-2 align-center px-2 rounded-lg text-body-1 text-whiteLite mb-2"
      style="border: 1px solid rgba(var(--v-theme-primary),0.3);">
      <p>{{ item.count }}</p>
    </div>
  </div>

  <!-- Show More / Show Less -->
  <div class="py-4" v-if="variants.length > 3">
    <p style="text-decoration: underline; cursor: pointer;"
       @click="showAll = !showAll">
      {{ showAll ? "Show Less" : "Show More" }}
    </p>
  </div>

</div>


</template>

<script>

import { useAuctionStore } from "@/stores/auctionStore";
import { useMasterStore } from "@/stores/masterStore";

export default {
    components: {
    },
    data() {
        return {
            auctionStore: useAuctionStore(),
            masterStore: useMasterStore(),
            showAll: false
        }
    },
    methods: {
        handleChange(e) {
            this.auctionStore.getAuctionList();
        }
    },
    computed: {
        groupedVariantsByModel() {
            const groups = {};

            this.masterStore.variants.data.forEach(variant => {
                const modelName = variant.model || "Variant Name";

                if (!groups[modelName]) {
                    groups[modelName] = [];
                }

                groups[modelName].push(variant);
            });

            return groups;
        }
    },
};

</script>