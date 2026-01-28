<template>
    <user-title-bar title="Staf"
        subtitle="Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi a temporibus, reiciendis, voluptatibus id natus nam repudiandae delectus vitae sit officia, laboriosam dolor numquam sed minus dolores. Itaque, illum qui.">
    </user-title-bar>

   
    <v-container style="max-width: 1400px;" class="mx-auto" fluid="">
         <div class="d-flex justify-space-between align-center">
        <div  class="d-flex align-center py-4">
                <v-select v-model="userStaf.filter.length" :items="[10, 25, 50, 100]" density="compact"
                    variant="outlined" max-width="150" class="mr-2" />
                {{ userStaf.filter.offset }} total
                {{ Math.min(userStaf.filter.length, userStaf.total) }}
                of {{ userStaf.total }} Records
         </div>
        <div class="pl-2" >
                    <v-btn to="/admin/stafUser/create" color="primary" style="height: 44px;" variant="flat" @click="loadItems">
                        <v-icon icon="mdi-plus"></v-icon>
                    </v-btn>
        </div>
    </div>
        <div class="border">
            <v-data-table-server
             :headers="headers"
                    :loading="userStaf.loading" 
                    :items="userStaf.data" 
                    :items-length="userStaf.total" 
                    :lastPage="userStaf.last_page" 
                    item-value="id"
                    height="400px" 
                    hover 
                  @update:options="userStaf.getUser">

                   <template #item.action="{ item }">
                    <v-icon small class="clickable-icon pa-4" color="danger" @click="deleteItems(item.id)">
                            mdi-delete
                    </v-icon>    
                    <router-link :to="'/admin/stafUser/edit/' + item.id" target="_blank">
                            <v-icon color="primary" class="editIconHover pa-4" >mdi-pencil</v-icon>
                        </router-link>
                    </template>

                <template v-slot:bottom>
                    <div class="py-2 d-flex justify-end border-t">
                        <custom-pagination :loading="userStaf.loading"
                            v-model:page="userStaf.filter.page" :lastPage="userStaf.last_page"
                            @page-changed="userStaf.getUser()" />
                    </div>
            </template>

            </v-data-table-server>
        </div>
    </v-container>
</template>

<script>
import General from '@/models/general.model';
import { useUserStafStore } from './userStafStore';


export default {
    data(){
        return{
           userStaf : useUserStafStore(),
           headers:[
            { title: "ID", value: "id" },
            { title: "FirstName", value: "firstName" },
            { title: "Email", value: "personalEmail" },
            { title: "Phone", value: "phone" },
            { title: "Role", value: "role_name" },
            { title: "Create At", value: "created_at" },
            { title: "Type Of user", value: "user_type" },
            { title: "Status", value: "status" },
            {title : "Action" , value : "action" , }
            // { title: "Updated ", value: "updated_at" },
           ]
        }
    },
    mounted(){
        this.userStaf.getUser()
        // this.delete()
    },
    methods:{
        async deleteItems(id){
            if (!confirm("Are you sure you want to delete this item?")) return;
            this.loading = true;
            try {
                const res = await General.delete('/api/cruds/staffs/'+id);
                this.$alertStore.add(res.message || "Make deleted", "success");
                this.userStaf.getUser()
            }   catch(error){
                console.error(error);
                this.$alertStore.add(error.message || "Delete failed", "error");
                // this.loadItems(); 
                } finally {
                this.loading = false;
                }
        }
    }
}
</script>