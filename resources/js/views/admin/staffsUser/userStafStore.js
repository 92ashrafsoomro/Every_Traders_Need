import General from "@/models/general.model";
import { defineStore } from "pinia";


export const useUserStafStore = defineStore("userStafStore",{
    state:()=>({
        filter:{
            page : 1, 
            length : 10,
            offset : 0 , 
            search : '',
        },
        data: [],
        loading: false,
        total: 0,
        last_page: 1,
    }),
    actions:{
        async getUser(){
            this.loading = true;
            try {
                const res = await General.get("/api/cruds/staffs", this.filter);
                console.log("user Staf Data" , res.data);
                
                this.data = res.data ;
                this.total = Number(res.total);
                this.last_page = res.last_page;
                this.filter.offset = Number(res.offset)
                return res.data
                
            } catch (error) {
                
            }finally {
                this.loading = false;
            }
        },

        async getSingleRecord(id){
             this.loading = true;
            try {
              
                let res = await General.get("/api/cruds/staffs",{id:id});
                const data = res.data?.[0];
                return data
            } catch (error) {
                console.error(error)
            }finally {
                this.loading = false;
            }
        }
        
    }
})