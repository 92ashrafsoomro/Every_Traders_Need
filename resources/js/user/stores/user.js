import { defineStore } from "pinia";
import api from "../plugins/axios";

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
    }),

    getters: {},

    actions: {
        async syncUser() {
            
            this.loading = true;
            
            api.get('/api/auth/profile')
            .then((res) => {
                        
                this.user = res.data.account;
                this.loading = false;

            }).catch((error) => {

                if (error?.response?.data?.message) {
                    alert(error.response.data.message);
                }else{
                    // alert('Something Went Wrong');
                }
                this.loading = false;
                    
            });

            
        },
    },
});
