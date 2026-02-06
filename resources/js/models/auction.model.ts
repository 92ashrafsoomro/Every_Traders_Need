import api from "@/plugins/axios";
import { errorHandler } from "@/services/responseHandleService";
import { toFormData } from "@/utils/helper";


export default class Auction {

    
    /**
     * Fetches the Get All.
     */
       static async all(options: {
            search?: string;
            page?: number;
            length?: number;
            id?: number;
        }): Promise<{
            data: unknown[];
            recordsFiltered: number;
            recordsTotal: number;
            page: number;
            length: number;
            last_page: number;
            offset: number;
        }> {

            try {
                const res = await api.get("/api/cruds/auctions", { params: options });
                return res.data;
            } catch (e) {
                throw await errorHandler(e);
            }

    }


    /**
     * Fetches the Get All.
     */
       static async get(options: {
            search?: string;
            page?: number;
            length?: number;
            id?: number;
        }): Promise<{
            data: unknown[];
            recordsFiltered: number;
            recordsTotal: number;
            page: number;
            length: number;
            last_page: number;
            offset: number;
        }> {

            try {
                const res = await api.get("/api/master/auctionList", { params: options });
                return res.data;
            } catch (e) {
                throw await errorHandler(e);
            }

    }


     static async create(options:any) {

        try {
            
            let req = await toFormData(options);
            const res = await api.post("/api/cruds/auctions",req);
            return res.data;
        
        } catch (error) {
            throw await errorHandler(error);
        }

    }


    static async find(id:any,options:any) {

        try {
            const res = await api.get("/api/cruds/auctions/"+id,{
                params:options,
            });
            return res.data;
        
        } catch (error) {
            throw await errorHandler(error);
        }

    }

    static async getScrap(id:any,options:any) {

        try {
            const res = await api.get("/api/cruds/auctions/getScrap/"+id,{
                params:options,
            });
            return res.data;
        
        } catch (error) {
            throw await errorHandler(error);
        }

    }

    static async csvGet(id:any,options:any) {

        try {
            const res = await api.get("/api/cruds/auctions/csvGet/"+id,{
                params:options,
            });
            console.log(res.data[0]);
            
            return res.data;
        
        } catch (error) {
            throw await errorHandler(error);
        }

    }

     static async csvUpdate(id:any,options:any) {

         try {
             
          
            const res = await api.post("/api/cruds/auctions/csvUpdate/"+id,{data:options.data});
            return res.data;
        
        } catch (error) {
            throw await errorHandler(error);
        }

    }

    

    static async update(id:any,options:any) {

        try {
            
            let req = await toFormData(options);
            req.append("_method", "put");
            const res = await api.post("/api/cruds/auctions/"+id,req);
            return res.data;
        
        } catch (error) {
            throw await errorHandler(error);
        }

    }

    static async delete(id:any){
        try{
            const res = await api.delete(`/api/cruds/auctions/${id}`);
            return res.data;

        }
        catch(error){
            throw await errorHandler(error);
        }
    }
    


    
    /**
     * Fetches the Models.
     */
       static async getYears(options: {
        
        }): Promise<{
            data: unknown[];
        }> {

            try {
                const res = await api.get("/api/master/getYears", { params: options });
                return res.data;
            } catch (e) {
                throw await errorHandler(e);
            }

    }



    /**
     * Fetches the Get All.
     */
       static async auctionType(options: {
            search?: string;
            page?: number;
            length?: number;
            id?: number;
        }): Promise<{
            data: unknown[];
            recordsFiltered: number;
            recordsTotal: number;
            page: number;
            length: number;
            last_page: number;
            offset: number;
        }> {

            try {
                const res = await api.get("/api/cruds/auctionType", { params: options });
                return res.data;
            } catch (e) {
                throw await errorHandler(e);
            }

    }

       static async auctionStatus(){

            try {
                const res = await api.get("/api/cruds/auctionStatus");
                return res.data;
            } catch (e) {
                throw await errorHandler(e);
            }

    }

    static async UpdateStatus(id,payload){
        try{
           const res =  await api.post(`/api/cruds/auctions/updatestatus/${id}`, payload)
           return res.data;

        }catch(e){
           throw await errorHandler(e); 
        }
    }
    
}
