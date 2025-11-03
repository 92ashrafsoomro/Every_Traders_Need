import api from "../plugins/axios";
import { errorHandler } from "./responseHandleService";


    export const Login = async (data) => { 
        
        try {
                const form = new FormData();
                form.append("email", data.email);
                form.append("password", data.password);
            
                const res = await api.post("/api/auth/login", form);
                if(!res.data.token) {
                  throw new Error("Token Not Found");
                }
            
                return res.data;
            
        } catch (error) {
            throw await errorHandler(error);
        }

    }


    export const getProfile = async (token) => {

            try {
                
                api.defaults.headers.common["Authorization"] = `Bearer ${token}`;
                let res = await api.get('/api/auth/profile');
                return res.data;
                    
            } catch (error) {
              throw await errorHandler(error);
            }
        
    }
    
    
export default {
    Login,
    getProfile,
}