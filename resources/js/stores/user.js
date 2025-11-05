import { defineStore } from "pinia";
import api from "../core/plugins/axios";
import {useThemeStore} from './theme';
import authService from "@services/authService";

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

    getters: {},

    actions: {
        async syncUser() {

            const themeStore = useThemeStore();
            themeStore.startLoading();
                
            //If no token, clear auth and return
            if (this.token) {
                
                    authService.getProfile(this.token).then((res) => {
                        
                        console.log(res);
                        
                        // this.user = res.data.account;
                        // themeStore.endLoading();

                    }).catch((error) => {

                        
                        console.log(error);
                        
                        // this.user = {};
                        // this.is_logged_in = false;
                        // themeStore.endLoading();
                    });

            } else { 
                this.user = {};
                this.is_logged_in = false;
                themeStore.endLoading();
            }
                
        },
        userLogin(data) {  
            this.user = data.account;
            this.is_logged_in = true;
        },

      

    },

});
