<template>
    <v-container  class="m-auto">
        <!-- <VariantMapping ref="VariantMapping"/> -->
         <CSVTable   />
    </v-container>
</template>

<script>

import CSVTable from './Csv/index.vue';
import VariantMapping from '@/components/VariantMapping.vue';


export default {

    components: {
   
        CSVTable
    },
    data() {

        return {
       
        }
    },
    mounted() {
  

       
    },
    methods: {



    }


    
}

</script>