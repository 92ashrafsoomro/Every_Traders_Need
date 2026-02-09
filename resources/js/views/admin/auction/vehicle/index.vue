  <template>
    <user-title-bar >
        <div>
            <h1 class="text-h3 mb-2 font-weight-bold">{{ Auction.name || 'Vehicle' }}</h1>
            <p v-if="Auction.auction_date" class="text-subtitle-1 mb-2 font-weight-medium">Auction Date <span class="text-primary"> {{ Auction.auction_date ?? "" }} </span></p>
        </div>

    </user-title-bar>

      <v-container max-width="1500px" >
            <v-row no-gutters class="mt-3">


                <v-col cols="12" class="mt-2"  >
                    <div class="border"> 
                  <vehicle-list
                        :items="items"
                        :total="total"
                        :loading="loading"
                        :headers="headers"
                        :filter="filter"
                        :last_page="last_page"
                        :auction-status="Auction.status"
                        :auction-id="id"
                        @page-changed="loadItems"
                    />
                    </div>
                </v-col>
            </v-row>
      </v-container>
    
  </template>

<script>
import Auction from "@/models/auction.model";
import Vehicle from '@/models/vehicle.model';
import CenterDropdown from "@components/CenterDropdown.vue"
import PlateformDropdown from "@components/PlateformDropdown.vue"
import MakeDropdown from "@components/MakeDropdown.vue"
import ModelDropdown from "@components/ModelDropdown.vue"
import VariantDropdown from "@components/VariantDropDown.vue"
import AuctionTypeDropdown from '@components/AuctionTypeDropdown.vue'

import vehicleList from "@/components/vehicleList.vue";
export default {

  components: {
    MakeDropdown,
    CenterDropdown,
    PlateformDropdown,
    ModelDropdown,
    VariantDropdown,
    AuctionTypeDropdown,
    vehicleList
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
                { title: "Title", value: "title" },  
                { title: "Center", value: "center_id" },
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
    watch: {
        'filter.length'(newVal, oldVal) {
            this.filter.page = 1;
            this.loadItems()
        },
        'filter.page'(newVal, oldVal) {
            this.loadItems()
        },
        'filter.make'(val) {
            this.filter.model = null
            this.filter.variant = null
        },
        'filter.model'(val) {
            this.filter.variant = null
        }

        
    },
    
     methods: {         
        async loadItems() {
                this.loading = true;
                try {
                let res;
                console.log(this.id)
                if (this.id) {
                    res = await Auction.csvGet(this.id, {});
                    res = res.data;
                } else {
                    res = await  Vehicle.all(this.filter);
                }

                this.Auction.name = res.auction?.name ?? res.defaultName ?? 'Vehicle';
                this.Auction.auction_date = res.auction?.auction_date ?? res.defaultDate ?? null;
                this.Auction.auction_type = res.auction?.auction_type ?? res.defaultType ?? 'N/A';
                this.Auction.platform_id = res.auction?.platform_id ?? res.defaultPlatform ?? 0;

                if (this.id) {
                    this.filter.platform = this.Auction.platform_id;
                    this.filter.vehicleType = this.Auction.auction_type;
                } 

                this.items = res.data;
                this.total = res.recordsTotal;
                this.filter.page = Number(res.page);
                this.last_page = Number(res.last_page);
                this.loading = false
                   
                } catch (error) {
                    alert(error)
                    this.loading = false
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
  },
      onHover(reg) {
        this.expanded = [reg]
    }, 



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