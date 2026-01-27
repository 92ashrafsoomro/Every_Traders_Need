<template>
    <user-title-bar title="Role"
        subtitle="Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi a temporibus, reiciendis, voluptatibus id natus nam repudiandae delectus vitae sit officia, laboriosam dolor numquam sed minus dolores. Itaque, illum qui.">
    </user-title-bar>
    
    <v-container style="max-width: 1400px;" class="mx-auto" fluid="">
        <div>
              <div  class="d-flex align-center py-4">
            <v-select v-model="roleStore.filter.length" :items="[10, 25, 50, 100]" density="compact"
                variant="outlined" max-width="150" class="mr-2" />
            {{ roleStore.filter.offset }} total
            {{ Math.min(roleStore.filter.length, roleStore.total) }}
            of {{ roleStore.total }} Records
        </div>
        </div>
        <div class="border">
            <v-data-table-server
             :headers="headers"
                    :loading="roleStore.loading" 
                    :items="roleStore.data" 
                    :items-length="roleStore.total" 
                    :lastPage="roleStore.last_page" 
                    item-value="id"
                    height="400px" 
                    hover 
                  @update:options="roleStore.getRoles">
                    <template v-slot:bottom>
                        <div class="py-2 d-flex justify-end border-t">
                            <custom-pagination :loading="roleStore.loading"
                                v-model:page="roleStore.filter.page" :lastPage="roleStore.last_page"
                                @page-changed="roleStore.getRoles()" />
                        </div>
                    </template>
            </v-data-table-server>
        </div>
    </v-container>
</template>

<script>
import { useRoleStore } from '@/stores/roleStore';

export default {
    data(){
        return{
           roleStore : useRoleStore(),
           headers:[
            { title: "ID", value: "id" },
            { title: "Name", value: "name" },
            { title: "Created ", value: "created_at" },
            { title: "Updated ", value: "updated_at" },
           ]
        }
    },
    mounted(){
        this.roleStore.getRoles()
    }
}
</script>