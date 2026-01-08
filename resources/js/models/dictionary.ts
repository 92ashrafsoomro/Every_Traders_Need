import api from "@/plugins/axios";
import { errorHandler } from "@/services/responseHandleService";

export default class Prefixes {
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
            const res = await api.get("/api/cruds/prefixes", { params: options });
            return res.data;
        } catch (e) {
            throw await errorHandler(e);
        }

    }
    static async delete(id :any, options:any){
        console.log(options)
        debugger
        try {
            const res = await api.delete(`/api/cruds/prefixes/${id}`,{params: options});
                return res.data;
        } catch(error) {
            throw await errorHandler(error);
        }
    }
    // 
    // static async update(id: number | string, formData: FormData) {
    //     try {


    //         const res = await api.post(`/api/cruds/prefixes/${id}`, formData);
    //         return res.data;

    //     } catch (error) {
    //         throw await errorHandler(error);
    //     }
    // }
}