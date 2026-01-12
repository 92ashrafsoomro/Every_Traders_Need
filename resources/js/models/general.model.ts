import api from "@/plugins/axios";
import { errorHandler } from "@/services/responseHandleService";
import { toFormData } from "@/utils/helper";


export default class General {

    


    /**
     * Fetches the Get All.
     */
       static async get(url:any,options:any){

            try {
                const res = await api.get(url,{ params: options });
                return res.data;
            } catch (e) {
                throw await errorHandler(e);
            }

    }



    
}
