import { defineStore } from "pinia";
import api from "../plugins/axios";
import {useThemeStore} from './theme';


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

            this.loading = true;
            themeStore.startLoading();

            if(!this.token) {
                this.clearAuth();
                this.loading = false;
                themeStore.endLoading();
                return false;  
            }
            
            api.get('/api/auth/profile')
            .then((res) => {
                        
                this.user = res.data.account;
                console.log(res);
                this.loading = false;
                themeStore.endLoading();
                
            }).catch((error) => {

                if (error?.response?.data?.message) {
                    alert(error.response.data.message);
                }

                this.clearAuth();
                this.loading = false;
                themeStore.endLoading();
                    
            });

        },
        clearAuth(){
            localStorage.removeItem('auth_token');
            this.user = {};
            this.is_logged_in = false;
        },
        userLogin(data){  
            localStorage.setItem('auth_token',data.token);
            this.user = data.account;
            this.is_logged_in = true;
        },

      

    },

});
