  <template>
    <v-app>
        <user-title-bar>
            <div>
                <!-- <h1 class="text-h3 mb-2 font-weight-bold">{{ vehicle.title ?? "Not Found" }}</h1> -->
                <h1 class="text-h3 mb-2 font-weight-bold">Not Found </h1>
               

            </div>
        </user-title-bar>

      <v-container max-width="1400px" >
            <v-row no-gutters class="mt-3">


                <v-col cols="12" class="mt-2"  >
                    <div class="border"> 
                        <v-data-table-server 
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
                                @mouseenter="expanded = [item.reg]"
                                @mouseleave="expanded = []"
                                class="hover-row"
                            >
                                <td v-for="col in columns" :key="col.key">
                                <template v-if="col.key === 'reg'">
                                    <router-link
                                    :to="`/admin/auction/vehicle/show/${id}?reg=${encodeURIComponent(item.reg)}`"
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
                            <tr>
                                <td :colspan="columns.length">
                                <div class="expanded-box">
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
                                    <div v-else>No images</div>
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
        vehicle : null,
        showFilters: false,
            filter: {
                search: '',
                length: 10,
                page: 1,
                offset: 0,
          },
            
            last_page: 1,
            items: [],
            total: 0,
            loading: true,
            headers: [
                { title: "Reg", value: "reg" },  
                { title: "Make", value: "make_id" },
                { title: "Model", value: "model_id" },
                { title: "Variant", value: "variant_id" },
                { title: "Color", value: "color" },
                { title: "Year", value: "year" },
                { title: "Body", value: "body_id" },
                { title: "Center", value: "center_id" },
                { title: "Bidding Status", value: "bidding_status" },  
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
        async loadItems() {
                this.loading = true;
                try {
                    let res =  await Auction.getScrap(this.id, {});
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
    return images.split(',').map(img => img.trim())
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

</style>