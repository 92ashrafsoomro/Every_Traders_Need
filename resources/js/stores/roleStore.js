import General from "@/models/general.model"
import { defineStore } from "pinia";

export const useRoleStore = defineStore("useRoleStore" , {
    state:()=>({
        filter:{
            page : 1, 
            length : 10,
            offset : 0 , 
            search : '',
        },
        data : [],
        loading : false ,
        total : 0,
        last_page :1
    }),
    actions:{
        async getRoles(){
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
        }
    }
})