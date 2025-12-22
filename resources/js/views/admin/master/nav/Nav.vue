<template> 
    <user-title-bar>
        <div>
            <h1 class="text-h3 mb-2 font-weight-bold">Master</h1>
            <!-- <p class="text-subtitle-1 mb-2 font-weight-medium">Filter, compare, and uncover vehicles that match your profit goals.</p> -->

            <div class="d-flex mt-6  ga-3">

                    <v-btn v-for="item in items" :variant="$route.path.startsWith(item.path) ? 'flat' : 'tonal'" class=" mx-1 text-none px-5 py-2 "
                    :to="item.path"
                    color="primary"
                    style="height: 50px;"> <span class="text-capitalize text-body-1">{{ item.title }}</span></v-btn>

            </div>
        </div>
    </user-title-bar>
</template>

<script>
export default {

    data() {
        
        return {

            items: [
                {
                    title: 'VehicleType',
                    path:'/admin/vehicleType'
                },
                {
                    title: 'BodyType',
                    path:'/admin/bodyType'
                },
                {
                    title: 'Platform',
                    path:'/admin/platform'
                },
                {
                    title: 'Center',
                    path:'/admin/center'
                },
                {
                    title: 'Make',
                    path:'/admin/make'
                },
                {
                    title: 'Model',
                    path:'/admin/model'
                },
                {
                    title: 'Variant',
                    path:'/admin/variant'
                }
                
            ]

        }

    },
    computed: {
        
    },
    methods: {

        getVariant(item) {

           return this.$route.path.startsWith('/admin/bodyType') === item.path ? 'tonal' : 'outlined';
        }
  
    }


    
}
</script>