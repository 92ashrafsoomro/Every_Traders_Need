import { defineStore } from "pinia";
import api from "../core/plugins/axios";
import {useThemeStore} from './themeStore';
import { errorHandler } from "@services/responseHandleService";

export const useUserStore = defineStore("user", {
    state: () => ({
        is_logged_in: false,        
        user: {},
        notification: [
            {
                title: "New Message",
                description: "You received a new message from Admin.",
                time: "2 mins ago",
            },
            {
                title: "Payment Successful",
                description: "Your premium plan has been activated.",
                time: "10 mins ago",
            },
            {
                title: "System Update",
                description: "A new system update is available.",
                time: "1 hour ago",
            },
        ],
        loading: false,
        token: localStorage.getItem('auth_token'),
    }),

    getters: {

    },

    actions: {
        async syncUser() {

            const themeStore = useThemeStore();
            themeStore.startLoading();
            let token = await localStorage.getItem('auth_token');
                
            //If no token, clear auth and return
            if (token) {
                
                    this.getProfile(token).then((res) => {
                        this.is_logged_in = true;
                        this.user = res.data.account;
                        themeStore.endLoading();
                        
                        console.log('User Logged In');
                        
                    }).catch((error) => {

                        // console.log(error);
                        console.log('User Logged Out');
                        this.user = {};
                        this.is_logged_in = false;
                        token = null;
                        localStorage.removeItem('auth_token');
                        api.defaults.headers.common["Authorization"] = '';
                        themeStore.endLoading();

                    });
                
            } else { 
                this.user = {};
                this.is_logged_in = false;
                themeStore.endLoading();
            }
                
        },
        async loginUser(data){
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
        },
        async getProfile(token = null)
        {   
            if (!token) {
                token = localStorage.getItem('auth_token');
            }

            if (!token) {
                throw new Error("Token Not Found");
            }

            try {
                api.defaults.headers.common["Authorization"] = `Bearer ${token}`;
                let res = await api.get('/api/auth/profile');
                return res.data;
            } catch (error) {
                throw await errorHandler(error);
            }
        },
        initializeUserSession(data) {  
            this.user = data.account;
            this.is_logged_in = true;
        },
        async setToken(token){
            try {
                api.defaults.headers.common["Authorization"] = `Bearer ${token}`;
                localStorage.setItem("auth_token", token);
                return token;
            } catch (error) {
                throw await errorHandler(error);
            }
        },
        async removeToken(token){
            try {
                api.defaults.headers.common["Authorization"] = '';
                localStorage.removeItem("auth_token", token);
                return token;
            } catch (error) {
                throw await errorHandler(error);
            }
        },
        async registerUser(data){
            try {

                // const form = new FormData();
                // form.append("email", data.email);
                // form.append("password", data.password);
                const res = await api.post("/api/auth/register",data);
                
                console.log(res);
                
                return res.data;
            } catch (error) {
                throw await errorHandler(error);
            }
        },

    },

});
