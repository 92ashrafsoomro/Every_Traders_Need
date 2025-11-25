<template>

    <custom-card title="Auctions" class="h-100 overflow-y-auto" >
        <div class="card-content ">
            <div class="py-2 px-2">
                    <v-select 
                        v-if="vehicleStore.platforms" 
                        :items="vehicleStore.platforms" 
                        v-model="filters.platform"
                        @update:model-value="loadRelativeVehichle" 
                        item-title="label" 
                        item-value="id" 
                        color="primary"
                        label="Select Platform" 
                        density="compact" 
                        variant="outlined" 
                        clearable />

            </div>
            <div class="border"></div>

            <router-link to="/dashboard" class="link text-decoration-none" v-for="item in data" :key="item.id" >
                <div  class=" d-flex align-center w-100 item">
                    <div class="py-3 px-3 " >
                        <img src="https://www1.bcaimage.com/Document?DocType=VehicleImage&width=300&docId=613522131"
                            class="rounded border  object-fit" width="50px" height="50px" />
                    </div>
                    <div class="py-3 px-3" >
                        <div class="flex-grow-1">
                            <div class="title text-subtitle-1 font-weight-medium">
                                {{ item.make_name }} {{ item.model_name }} {{ item.variant_name }}
                            </div>
                            <div class="subtitle text-body-2 ">{{ item.platform_name }}</div>
                          
                            <div class="subtitle text-body-2 ">{{ item.date }}</div>
                        </div>
                    </div>
                </div>
            </router-link>
        </div>
    </custom-card>
</template>

<script>
import { useVehicleStore } from '@/stores/vehicleStore';


export default {
    components: {

    },
    data() {
        return {
            filters: {
                platform: null,
                id: '',
            },

            items: [],
            data: [],
            loading: false,
            vehicleStore: useVehicleStore(),
        };
    },
    mounted() {

        this.loadRelativeVehichle();
        this.vehicleStore.getPlatforms({});

    },
    beforeUnmount() {

    },
    computed: {
        titleStyle() {
            return {
                color:"rgb(var(--v-theme-primary))"
            }
        }
    },
    methods: {
        loadRelativeVehichle() {

            this.loading = true;
            this.filters.id = this.$route.params.id;

            this.vehicleStore.getRelatedVehicle(this.filters).then((res) => {
                this.data = res.data;
                this.loading = false;
            }).catch(() => {
                this.loading = false;

            });
        },





    },
};
</script>

<style scoped>
::-webkit-scrollbar {
    display: none;
}

.item{
    border-bottom: 1px solid rgba(var(--v-theme-background)) ;
}

.item:hover .title{
    color: rgb(var(--v-theme-primary)); /* normal color */
    transition: color 0.2s;
}

.item:hover .subtitle{
    color: rgb(var(--v-theme-primary)); /* normal color */
    transition: color 0.2s;
}

.title {
    color: rgb(var(--v-theme-on-primary));
}

.subtitle {
    color: rgb(var(--v-theme-light));
}

</style>