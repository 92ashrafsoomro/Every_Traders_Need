<template>
    <user-title-bar title="Master">
        <div>
            <!-- <p class="text-subtitle-1 mb-2 font-weight-medium">Filter, compare, and uncover vehicles that match your profit goals.</p> -->

          <div class="content-scroll d-flex mt-6 w-100 ga-3">
  <v-btn
    v-for="item in items"
    :key="item.path"
    :to="item.path"
    class="mx-1 text-none px-5 py-2 mb-3 master-btn"
    style="height: 50px;"
    :color="$route.path.startsWith(item.path) ? 'primary' : undefined"
    :variant="$route.path.startsWith(item.path) ? 'flat' : 'tonal'"
  >
    <span class="text-capitalize text-body-1">
      {{ item.title }}
    </span>
  </v-btn>
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
                    path: '/admin/vehicleType'
                },
                {
                    title: 'BodyType',
                    path: '/admin/bodyType'
                },
                {
                    title: 'Platform',
                    path: '/admin/platform'
                },
                {
                    title: 'Center',
                    path: '/admin/center'
                },
                {
                    title: 'Make',
                    path: '/admin/make'
                },
                {
                    title: 'Model',
                    path: '/admin/model'
                },
                {
                    title: 'Variant',
                    path: '/admin/variant'
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
<style scoped>
.inactive-btn {
  background-color: rgba(var(--v-theme-background), 0.4) !important;
}

.master-btn {
  transition: background-color 0.2s ease;
}

</style>