<template>


    <!-- Switch -->
    <!-- <div class="d-flex align-center mt-6">
      <v-switch
        :model-value="options.enableCurrent"
        color="primary"
        density="compact"
        hide-details
        @change="handleInput($event, 'enableCurrent')"
      />
      <span class="ml-3">In Progress</span>
    </div> -->

    <!-- Large Devices -->
    <div class="pt-4 d-lg-flex d-md-flex d-none ga-3 mt-4">
        <div v-for="(value, key, index) in days" :key="index"
            class="border rounded bg-surface-variant-1 pa-3 cursor-pointer" :class="{ active: options.day === key }"
            style="width:13.5%" @click="handleTab(key)">
            <div class="d-flex justify-space-between ">
                 <div class="d-flex align-center">
                    <small>{{ value.day }}</small>
                </div>
                <div class="d-flex align-center">
                    <HammerIcon/>
                    <span class="ml-1">{{ value.auction }}</span>
                </div>
               
            </div>
        </div>
    </div>

    <!-- Small Devices -->
    <div class="d-lg-none d-md-none mt-4">
        <v-slide-group>
            <v-slide-item v-for="(value, key, index) in days" :key="index">
                <div class="border rounded pa-3 mr-4 cursor-pointer" style="width:250px"
                    :class="{ active: options.day === key }" @click="handleTab(key)">
                    <div class="text-center pb-2" style="border-bottom:1px solid #343E4B">
                        {{ key }}
                    </div>

            <div class="d-flex justify-space-between ">
                 <div class="d-flex align-center">
                    <small>{{ value.day }}</small>
                </div>
                <div class="d-flex align-center">
                    <HammerIcon/>
                    <span class="ml-1">{{ value.auction }}</span>
                </div>
                    </div>
                </div>
            </v-slide-item>
        </v-slide-group>
    </div>


</template>
<script>
import Auction from "@/models/auction.model";
import { auctionSheldulerList } from "@/services/pageService";
import { useUserStore } from "@/stores/userStore";
import HammerIcon from '@/views/admin/taskManagement/component/Icon.vue'
export default {
    name: "AuctionSolution",
    components:{
        HammerIcon
    },

    data() {
        return {
            userStore: useUserStore(),

            days: {},

            options: {
                day: "today",
                enableCurrent: false,
                date: "",
                page: 1,
                offset: 0,
                last_page: 1,
            },

            data: [],
            total: 0,
            loading: false,
        };
    },

    mounted() {
        this.getRecords();
    },

    methods: {
        /* ================================
         Generate next 7 days (Today + 6)
        ================================= */
        generateDays() {
            const days = {};
            const today = new Date();

            for (let i = 0; i < 7; i++) {
                const d = new Date(today);
                d.setDate(today.getDate() + i);

                const key =
                    i === 0
                        ? "today"
                        : d.toISOString().split("T")[0]; // yyyy-mm-dd

                days[key] = {
                    auction: 0,
                    day:
                        i === 0
                            ? "Today"
                            : d.toLocaleDateString("en-GB", {
                                  day: "2-digit",
                                  month: "short",
                              }),
                    date: d.toISOString().split("T")[0],
                };
            }

            return days;
        },

        /* ================================
         Map API data to days by date
        ================================= */
        prepareDays(data) {
            const days = this.generateDays();

            data.forEach(item => {
                if (!item.auction_date) return;

                const itemDate = item.auction_date.split(" ")[0];

                Object.keys(days).forEach(key => {
                    if (days[key].date === itemDate) {
                        days[key].auction += 1;
                    }
                });
            });

            this.days = days;
        },

        /* ================================
         Switch / Filters
        ================================= */
        async handleInput(event, field) {
            if (field === "enableCurrent") {
                this.options.enableCurrent = event.target.checked;

                if (event.target.checked) {
                    this.options.day = "today";
                }

                await this.getRecords();
            }
        },

        /* ================================
         Day tab click
        ================================= */
        async handleTab(day) {
            if (!this.userStore.is_logged_in) {
                this.$router.push("/login");
                return;
            }

            if (!this.options.enableCurrent) {
                this.options.day = day;
                await this.getRecords();
            }
        },

        /* ================================
         API Call
        ================================= */
        async getRecords() {
            this.loading = true;

            try {
                const res = await Auction.find(this.options);

                this.data = res.data || [];
                this.total = res.recordsTotal || 0;

                // 🔥 dynamic cards logic
                this.prepareDays(this.data);

                this.options.page = Number(res.page || 1);
                this.options.offset = res.offset || 0;
                this.options.last_page = res.last_page || 1;
            } catch (error) {
                console.error(error);

                this.data = [];
                this.total = 0;
                this.days = this.generateDays();
            } finally {
                this.loading = false;
            }
        },
    },
};
</script>


<style scoped>
.active {
    border: 1px solid rgb(var(--v-theme-primary)) !important;
}

.cursor-pointer {
    cursor: pointer;
}
</style>
