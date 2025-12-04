<template>
    <div v-if="vehicleStore.overView.images">
        <v-responsive>
            <v-img v-if="image" :src="image" class="rounded" />
            <v-row class="ga-2 pa-5">
                <v-img  
                   @click="image = item" 
                   v-for="item in vehicleStore.overView.images" 
                   :src="item" class="rounded" :class="{'active border':image == item}"  />
            </v-row>
        </v-responsive>
    </div>
</template>

<script>
import { useVehicleStore } from '@/stores/vehicleStore';
import { image } from '@vee-validate/rules';

export default {
    components: {

    },
    data() {
        return {
            image:'',
            vehicleStore: useVehicleStore(),
        };
    },
    mounted() {

        if (this.vehicleStore.overView.images) {
            
            
            this.image = this.vehicleStore.overView.images[0];
        }

    },
    beforeUnmount() {

    },
    methods: {
        

    },
};
</script>

<style scoped>

.active{
    border-color: rgb(var(--v-theme-primary))!important;
}

</style>