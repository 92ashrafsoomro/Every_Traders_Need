import api from "@/plugins/axios";
import { errorHandler } from "@/services/responseHandleService";

export default class Model {
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
                const res = await api.get("/api/cruds/model", { params: options });
                return res.data;
            } catch (e) {
                throw await errorHandler(e);
            }

    }
       static async get(options: {
            makes:unknown[],
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
                const res = await api.get("/api/master/getModels", { params: options });
                return res.data;
            } catch (e) {
                throw await errorHandler(e);
            }

    }

    static async find(id) {
        
        try {
            const res = await api.get("/api/cruds/model/"+id);
            return res.data;
        
        } catch (error) {
            throw await errorHandler(error);
        }
    }
    static async update(id: number | string, formData: FormData) {
        try {
            formData.append("_method", "PUT");

            const res = await api.post(`/api/cruds/model/${id}`, formData);
            return res.data;

        } catch (error) {
            throw await errorHandler(error);
        }
    }
    static async create(options:any) {

        try {
            console.log("options in model",options);
            const res = await api.post("/api/cruds/model",options);
            return res.data;
        
        } catch (error) {
            throw await errorHandler(error);
        }

    }
    static async delete(id){
        try{
            const res = await api.delete(`/api/cruds/model/${id}`);
            return res.data;

        }
        catch(error){
            throw await errorHandler(error);
        }
    }
    
}
