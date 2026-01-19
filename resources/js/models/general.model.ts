import api from "@/plugins/axios";
import { errorHandler } from "@/services/responseHandleService";
import { toFormData } from "@/plugins/helper";


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
    
    static async put(url:any,options:any) {
        try {

           let req = await toFormData(options);
            req.append("_method","put");
            const res = await api.post(url, req);
            console.log(res);
            
            return res.data;
    
        } catch (error) {
            throw await errorHandler(error);
        }
    }
    
    static async post(url:any,options:any) {
        try {

           let req = await toFormData(options);
            const res = await api.post(url, req);
            return res.data;
    
        } catch (error) {
            throw await errorHandler(error);
        }
    }




    
}
