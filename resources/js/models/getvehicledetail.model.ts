import api from "@/plugins/axios";
import { errorHandler } from "@/services/responseHandleService";
import { de } from "vuetify/locale";

export default class GetVehicleDetail {

    static async get(id) {
        
        try {
            const res = await api.get("/api/user/auctionList/"+id);
            return res.data;
        
        } catch (error) {
            throw await errorHandler(error);
        }
    }


}
