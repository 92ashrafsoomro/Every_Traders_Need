import { defineStore } from "pinia";

export const useUserStore = defineStore("user", {
    state: () => ({
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

    actions: {},
});
