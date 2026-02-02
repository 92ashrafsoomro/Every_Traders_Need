<template>
    <user-title-bar title="Role"
        subtitle="Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi a temporibus, reiciendis, voluptatibus id natus nam repudiandae delectus vitae sit officia, laboriosam dolor numquam sed minus dolores. Itaque, illum qui.">
    </user-title-bar>
    
    <v-container style="max-width: 1400px;" class="mx-auto" fluid="">
        <div class="d-flex align-center justify-space-between">
            <div  class="d-flex align-center py-4">
                <v-select v-model="filter.length" :items="[10, 25, 50, 100]" density="compact"
                    variant="outlined" max-width="150" class="mr-2" />
                {{ filter.offset }} total
                {{ Math.min(filter.length, total) }}
                of {{ total }} Records
            </div>
            <div class="pl-2" >
                        <v-btn to="/admin/role/create" color="primary" style="height: 44px;" variant="flat" @click="loadItems">
                            <v-icon icon="mdi-plus"></v-icon>
                        </v-btn>
            </div>
        </div>
        <div class="border">
            <v-data-table-server
             :headers="headers"
                    :loading="loading" 
                    :items="data" 
                    :items-length="total" 
                    :lastPage="last_page" 
                    item-value="id"
                    height="400px" 
                    hover 
                  @update:options="getRoleData">

                 <template #item.action="{ item }">
                    <v-icon small class="clickable-icon pa-4" color="danger" @click="deleteItems(item.id)">
                            mdi-delete
                    </v-icon>    
                    <router-link :to="'/admin/role/edit/' + item.id" >
                            <v-icon color="primary" class="editIconHover pa-4" >mdi-pencil</v-icon>
                        </router-link>
                    </template>
             <template v-slot:bottom>
                <div class="py-2 d-flex justify-end border-t">
                    <custom-pagination :loading="loading"
                        v-model:page="filter.page" :lastPage="last_page"
                        @page-changed="getRoleData()" />
                </div>
            </template>
            </v-data-table-server>
        </div>
    </v-container>
</template>

<script>
import General from '@/models/general.model';



export default {
    data(){
        return{
        filter:{
            page : 1, 
            length : 10,
            offset : 0 , 
            search : '',
        },
        data : [],
        loading : false ,
        total : 0,
        last_page :1,
           headers:[
            { title: "ID", value: "id" },
            { title: "Name", value: "name" },
            { title: "Created ", value: "created_at" },
            { title: "Updated ", value: "updated_at" },
            {title : "Action" , value: 'action'}
           ]
        }
    },
    mounted(){
        this.getRoleData()
        
    },
    methods:{
        async getRoleData(){
            this.loading = true
                try {
                    const res = await General.get("/api/cruds/roles" , this.filter);
                    this.data = res.data;
                    this.total = Number(res.total)
                    this.last_page = res.last_page;
                    this.filter.offset = Number(res.offset)
                    console.log("Role Data");
                    
                    console.log(res.data);
                    
                    return res.data
                } catch (error) {
                            
                }finally {
                    this.loading = false;
                }
        },
        async deleteItems(id){
            if (!confirm("Are you sure you want to delete this item?")) return;
            this.loading = true;
            try {
                const res = await General.delete("/api/cruds/roles/"+id);
                this.$alertStore.add(res.message || "Make deleted", "success");
                this.getRoleData()
            } catch (error) {
                console.error(error);
                 this.$alertStore.add(error.message || "Delete failed", "error");            
            }finally {
                this.loading = false;
            }
        }
    }
}
</script>