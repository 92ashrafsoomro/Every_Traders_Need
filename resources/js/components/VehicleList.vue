<template>
  <v-data-table-server :loading="loading" :headers="headers" :items="items" :items-length="total" item-value="reg" hover
    v-model:expanded="expanded" class="border">
    <!-- Pagination -->
    <template v-slot:bottom>
      <div class="py-2 d-flex justify-end border-t">
        <custom-pagination :loading="loading" v-model:page="filter.page" :lastPage="last_page"
          @page-changed="$emit('page-changed')" />
      </div>
    </template>

    <!-- Reg column -->
    <template #item="{ item, columns }">
      <tr @mouseenter="onHover(item.reg)" class="hover-row">
        <td v-for="col in columns" :key="col.key">
          <template v-if="col.key === 'reg'">
            <router-link :to="`/admin/vehicle/show/${item.id}`" target="_blank"
              class="text-primary font-weight-bold text-decoration-none">
              {{ item.reg }}
            </router-link>
          </template>
          <template v-else-if="col.key === 'title'">
            {{ item.make_id }} {{ item.model_id }} <span v-if="item.variant_id">{{ item.variant_id }}</span>
          </template>
          <template v-else>
            {{ item[col.key] }}
          </template>
        </td>
      </tr>
    </template>

    <!-- Expanded row -->
    <template #expanded-row="{ columns, item }"  >
      <tr @mouseleave="expanded = []">
        <td :colspan="columns.length" style=" padding: 0 !important;">
          <div class="expanded-box d-flex justify-space-between">
            <div class="image-row " style="overflow: hidden;" v-if="item.images">
              <img v-for="(img, i) in splitImages(item.images)" :key="i" :src="img" width="60" height="60" cover
                class="hover-img" />
            </div>
            <div class="info-row mt-3">
              <div class="info-item"><b>Last Bid:</b> £{{ item.last_bid }}</div>
              <div class="info-item">
                <b>Status: </b>
                <v-chip :color="item.bidding_status === 'Sold' ? 'green' : 'orange'" text-color="white" small>
                  {{ item.bidding_status }}
                </v-chip>
              </div>
              <div class="info-item" v-if="item.inspection_report">
                <v-btn size="small" color="primary" variant="outlined" :href="item.inspection_report" target="_blank">
                  Inspection Report
                </v-btn>
              </div>
            </div>
          </div>
        </td>
      </tr>
    </template>
  </v-data-table-server>
</template>

<script>
export default {
  name: "VehicleList",
  props: {
    items: { type: Array, default: () => [] },
    total: { type: Number, default: 0 },
    loading: { type: Boolean, default: false },
    headers: { type: Array, default: () => [] },
    filter: { type: Object, required: true },
    last_page: { type: Number, default: 1 },
    auctionStatus: { type: Number, default: 1 },
    auctionId: { type: Number, required: true },
  },
  data() {
    return {
      expanded: [],
    };
  },
  methods: {
    onHover(reg) {
      this.expanded = [reg];
    },
    splitImages(images) {
      if (!images) return [];
      return images.split(',').map(img => img.trim()).slice(0, 4);
    },


  },
};
</script>

<style>
.expanded-box {
  background: #0f1c2b;
  /* padding: 12px;
  border-left: 4px solid #0080ff; */
}

.image-row {
  display: flex;
  gap: 10px;
  overflow-x: auto;
}

.hover-img {
  border-radius: 6px;
  cursor: pointer;
  transition: transform 0.2s ease;
}




.expanded-box {
  background: #0f1c2b;
  /* padding: 12px;
  border-left: 4px solid #0080ff; */
}

.image-row {
  display: flex;
  gap: 10px;
  overflow-x: auto;
}

.hover-img {
  border-radius: 6px;
  cursor: pointer;
  /* transition: transform 0.2s ease; */
}
/* 
.hover-img:hover {
  transform: scale(1.05);
} */

.info-row {
  display: flex;
  gap: 20px;
  align-items: center;
  flex-wrap: wrap;
}

.info-item {
  color: #ddd;
  font-size: 14px;
}

.gapin {
  gap: 12px !important;
}
</style>
