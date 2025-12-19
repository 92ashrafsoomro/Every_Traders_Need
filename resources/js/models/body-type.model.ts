import api from "@/plugins/axios";
import { errorHandler } from "@/services/responseHandleService";


export default class BodyType {
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
                const res = await api.get("/api/cruds/bodyType", { params: options });
                return res.data;
            } catch (e) {
                throw await errorHandler(e);
            }

    }
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
                const res = await api.get("/api/master/getBodyTypes", { params: options });
                return res.data;
            } catch (e) {
                throw await errorHandler(e);
            }

    }
    static async find(id) {
        
        try {
            const res = await api.get("/api/cruds/bodyType/?id="+id);
            return res.data;
        
        } catch (error) {
            throw await errorHandler(error);
        }
    }
    static async update(id: number | string, formData: FormData) {
        try {
            formData.append("_method", "PUT");

            const res = await api.post(`/api/cruds/bodyType/${id}`, formData);
            return res.data;

        } catch (error) {
            throw await errorHandler(error);
        }
    }
    static async create(options:any) {

        try {
            console.log("options in model",options);
            const res = await api.post("/api/cruds/bodyType",options);
            return res.data;
        
        } catch (error) {
            throw await errorHandler(error);
        }

    }
    static async delete(id){
        try{
            const res = await api.delete(`/api/cruds/bodyType/${id}`);
            return res.data;

        }
        catch(error){
            throw await errorHandler(error);
        }
    }
    
}
