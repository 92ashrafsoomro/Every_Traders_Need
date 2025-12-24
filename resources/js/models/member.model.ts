import api from "@/plugins/axios";
import { errorHandler } from "@/services/responseHandleService";

export default class Member {
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
                const res = await api.get("/api/cruds/users", { params: options });
                return res.data;
            } catch (e) {
                throw await errorHandler(e);
            }

    }
    static async plans(options: {
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
                const res = await api.get("/api/cruds/plans", { params: options });
                return res.data;
            } catch (e) {
                throw await errorHandler(e);
            }

    }

    static async changeStatus(id: number, params: params) {
        try {
            const res = await api.get(
            `/api/cruds/users/changeStatus`,
            params
            );
            return res.data;
        } catch (error) {
            throw await errorHandler(error);
        }
    }

    
}
