import api from "@/plugins/axios";
import { errorHandler } from "@/services/responseHandleService";

export default class Dictionary {
    static prefixName = [
        { label: "VehicleType", value: "vehicleType" },
        { label: "BodyType", value: "bodyType" },
        { label: "Center", value: "center" },
        { label: "Make", value: "make" },
        { label: "Model", value: "model" },
        { label: "Variant", value: "variant" },
    ];

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

    static async delete(id: any, options: any) {
        console.log(options);
        debugger;
        try {
            const res = await api.delete(`/api/cruds/prefixes/${id}`, { params: options });
            return res.data;
        } catch (error) {
            throw await errorHandler(error);
        }
    }

    // Optional: you can also make a static getter if you like
    static getPrefixNames() {
        return this.prefixName;
    }
}
