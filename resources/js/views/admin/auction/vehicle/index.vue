  <template>
    <v-app>
        <user-title-bar>
        <div>
            <h1 class="text-h4 font-weight-bold mb-2">
            {{ Auction.name || 'Not Found' }}
            </h1>
            <div class="d-flex align-center gapin flex-wrap">
            <v-chip
                size="small"
                class="text-uppercase"
                :color="statusColor(Auction.status)"
                variant="flat"
            >
                {{ Auction.status || 'N/A' }}
            </v-chip>
            <v-chip
                size="small"
                color="primary"
                variant="outlined"
            >
                <v-icon start size="16">mdi-domain</v-icon>
                {{ Auction.platform || 'N/A' }}
            </v-chip>
            <v-chip
                size="small"
                color="secondary"
                variant="outlined"
            >
                <v-icon start size="16">mdi-tag</v-icon>
                {{ Auction.auctionType || 'N/A' }}
            </v-chip>

            </div>
        </div>
        </user-title-bar>



      <v-container max-width="1400px" >
            <v-row no-gutters class="mt-3">


                <v-col cols="12" class="mt-2"  >
                    <div class="border"> 
                        <v-data-table-server 
                            :loading="loading" 
                            :headers="headers"
                            :items="items"
                            item-value="reg"
                            hover
                            v-model:expanded="expanded"
                            >
            
                            <template v-slot:bottom>
                                <div class="py-2 d-flex justify-end border-t">
                                    <custom-pagination 
                                    :loading="loading" 
                                    v-model:page="filter.page"
                                    :lastPage="last_page" 
                                    @page-changed="loadItems" />
                                </div>
                            </template>
                            <template #item="{ item, columns }">
                            <tr
                                @mouseenter="onHover(item.reg)"
                                class="hover-row"
                            >
                                <td v-for="col in columns" :key="col.key">
                                <template v-if="col.key === 'reg'">
                                <router-link
                                    :to="vehicleLink(item)"
                                    target="_blank"
                                    class="text-primary font-weight-bold text-decoration-none"
                                >
                                    {{ item.reg }}
                                </router-link>
                                </template>
                                <template v-else>
                                    {{ item[col.key] }}
                                </template>
                                </td>
                            </tr>
                            </template>

                            <template #expanded-row="{ columns, item }">
                            <tr
                                @mouseleave="expanded = []"
                            >
                                <td :colspan="columns.length">
                                <div class="expanded-box">

                                    <!-- IMAGES -->
                                    <div class="image-row" v-if="item.images">
                                    <v-img
                                        v-for="(img, i) in splitImages(item.images)"
                                        :key="i"
                                        :src="img"
                                        width="140"
                                        height="100"
                                        cover
                                        class="hover-img"
                                    />
                                    </div>

                                    <!-- INFO ROW -->
                                    <div class="info-row mt-3">
                                    <div class="info-item">
                                        <b>Last Bid:</b> £{{ item.last_bid }}
                                    </div>

                                    <div class="info-item">
                                        <b>Status:</b>
                                        <span
                                        :class="item.bidding_status === 'Sold' ? 'text-success' : 'text-warning'"
                                        >
                                        {{ item.bidding_status }}
                                        </span>
                                    </div>

                                    <div class="info-item" v-if="item.inspection_report">
                                        <v-btn
                                        size="small"
                                        color="primary"
                                        variant="outlined"
                                        :href="item.inspection_report"
                                        target="_blank"
                                        >
                                        Inspection Report
                                        </v-btn>
                                    </div>
                                    </div>

                                </div>
                                </td>
                            </tr>
                            </template>
                  
                        </v-data-table-server>
                    </div>
                </v-col>
            </v-row>
      </v-container>
    </v-app>
  </template>

<script>

import Auction from "@/models/auction.model";
import CenterDropdown from "@components/CenterDropdown.vue"
import PlateformDropdown from "@components/PlateformDropdown.vue"
import MakeDropdown from "@components/MakeDropdown.vue"
import ModelDropdown from "@components/ModelDropdown.vue"
import VariantDropdown from "@components/VariantDropDown.vue"

export default {

  components: {
    MakeDropdown,
    CenterDropdown,
    PlateformDropdown,
    ModelDropdown,
    VariantDropdown,
  },

  data() {
      return {
        expanded: [],
        Auction : [],
        showFilters: false,
            filter: {
                search: '',
                length: 10,
                page: 1,
                offset: 0,
          },
            
            last_page: 1,
            items: [],
            link:null,
            total: 0,
            loading: true,
            headers: [
                { title: "Reg", value: "reg" },  
                { title: "Center", value: "center_id" },
                { title: "Make", value: "make_id" },
                { title: "Model", value: "model_id" },
                { title: "Variant", value: "variant_id" },
                { title: "Color", value: "color" },
                { title: "Year", value: "year" },
                { title: "Body", value: "body_id" },
                { title: "Fuel Type", value: "fuel_type" },
                { title: "Transmission", value: "transmission" },
                { title: "CC", value: "cc" },
                { title: "Non Runner", value: "engine_runs" },
                { title: "Grade", value: "grade" },
            ],
            id: this.$route.params.id,
   
    };
  },
  mounted() {
    this.loadItems()
  },
  computed: {
 
    },
  methods: {   
    onHover(reg) {
        this.expanded = [reg]
    },          
    async loadItems() {
    this.loading = true;
    try {
        const response = await Auction.find(this.id, {});
        const auction = response.data;

        this.Auction.name = auction.name;
        this.Auction.status = auction.auction_status.title;
        this.Auction.platform = auction.platform.name;
        this.Auction.auctionType = auction.auction_type.title;

        this.auctionStatusId = auction.status; // IMPORTANT

        let res;
        if (this.auctionStatusId == 1) {
        res = await Auction.getScrap(this.id, {});
        } else {
        res = await Auction.csvGet(this.id, {});
        res = res.data;
        }

        this.items = res.data;
        this.total = res.recordsTotal;
        this.filter.page = Number(res.page);
        this.last_page = Number(res.last_page);

    } catch (error) {
        alert(error);
    } finally {
        this.loading = false;
    }
    },
    splitImages(images) {
        if (!images) return []
        return images.split(',').map(i => i.trim()).slice(0, 4)
    },

      statusColor(status) {
        switch (status) {
            case 'Cancel':
                return '#e51f1f';  
            case 'Done':
                return '#0080ff';  
            case 'Confirm':
                return '#96761a';
            case 'Draft':
                return '#ebff0a';
            case 'In Progress':
                return '#85e62c';
            default:
                return '#ffffff';
        }
    },
    vehicleLink(item) {
    if (this.auctionStatusId == 1) {
      return `/admin/auction/vehicle/show/${this.id}?reg=${encodeURIComponent(item.reg)}`
    } else {
      return `/admin/vehicle/show/${item.id}`
    }
  }

  }
  
};

</script>

<style>
.expanded-box {
  background: #0f1c2b;
  padding: 12px;
  border-left: 4px solid #0080ff;
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

.hover-img:hover {
  transform: scale(1.05);
}


.expanded-box {
  background: #0f1c2b;
  padding: 12px;
  border-left: 4px solid #0080ff;
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

.hover-img:hover {
  transform: scale(1.05);
}

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
    gap:12px !important;
}
</style>