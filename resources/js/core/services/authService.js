import { useThemeStore } from "@/stores/themeStore";
import api from "../plugins/axios";
import { errorHandler } from "./responseHandleService";
import { useAuthStore } from '@stores/authStore'



export const Login = async (data) => {

    try {
        
        const form = new FormData();
        form.append("email", data.email);
        form.append("password", data.password);

        const res = await api.post("/api/auth/login", form);
        if (!res.data.token) {
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


export const setToken = async (token) => {

    try {
        api.defaults.headers.common["Authorization"] = `Bearer ${token}`;
        localStorage.setItem("auth_token", token);
        return token;
    } catch (error) {
        throw await errorHandler(error);
    }

}

export const removeToken = async (token) => {

    try {

        api.defaults.headers.common["Authorization"] = '';
        localStorage.removeItem("auth_token", token);
        return token;

    } catch (error) {
        throw await errorHandler(error);
    }

}


const syncUser = async () => {

    const themeStore = useThemeStore();
    const authStore = useAuthStore();
    themeStore.startLoading();


        //If no token, clear auth and return
        if (this.token) {

            
                getProfile(this.token).then((res) => {

                    // console.log(res);

                    authStore.is_logged_in = true;
                    authStore.user = res.data.account;
                    themeStore.endLoading();
                    console.log('User Logged In');


                }).catch((error) => {

                    // console.log(error);
                    console.log('User Logged Out');
                    authStore.user = {};
                    authStore.is_logged_in = false;
                    authStore.token = null;
                    localStorage.removeItem('auth_token');
                    api.defaults.headers.common["Authorization"] = '';
                    themeStore.endLoading();

                });


        } else {
            this.user = {};
            this.is_logged_in = false;
            themeStore.endLoading();
        }

}



export default {
    Login,
    getProfile,
    setToken,
    removeToken,
    syncUser
}
