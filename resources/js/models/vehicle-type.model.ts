import api from "@/plugins/axios";
import { errorHandler } from "@/services/responseHandleService";

export default class VehicleType {



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
                const res = await api.get("/api/cruds/vehicleType", { params: options });
                return res.data;
            } catch (e) {
                throw await errorHandler(e);
            }

    }



    
    /**
     * Fetches the Get All.
     */
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
                const res = await api.get("/api/master/getVehicleTypes", { params: options });
                return res.data;
            } catch (e) {
                throw await errorHandler(e);
            }

    }
        static async find(id) {
        
        try {
            const res = await api.get("/api/cruds/vehicleType/?id="+id);
            return res.data;
        
        } catch (error) {
            throw await errorHandler(error);
        }
    }
    static async update(id: number | string, formData: FormData) {
        try {
            formData.append("_method", "PUT");

            const res = await api.post(`/api/cruds/vehicleType/${id}`, formData);
            return res.data;

        } catch (error) {
            throw await errorHandler(error);
        }
    }
    static async create(options:any) {

        try {
            console.log("options in model",options);
            const res = await api.post("/api/cruds/vehicleType",options);
            return res.data;
        
        } catch (error) {
            throw await errorHandler(error);
        }

    }
    static async delete(id){
        try{
            const res = await api.delete(`/api/cruds/vehicleType/${id}`);
            return res.data;

        }
        catch(error){
            throw await errorHandler(error);
        }
    }
    
}
