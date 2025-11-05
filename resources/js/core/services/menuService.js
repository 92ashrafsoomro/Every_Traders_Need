export const getMenu = () => {
    return [
        {
            label: "Menu",
            type: "group",
        },
        {
            icon: "mdi-view-dashboard-outline",
            label: "Dashboard",
            path: "/user/dashboard",
            // children: [
            //     {
            //         icon: "gavel",
            //         label: "Auction Finder",
            //         path: "/auction-finder",
            //     },
            //     {
            //         icon: "gavel",
            //         label: "Auction Finder",
            //         path: "/auction-finder",
            //     },
            //     {
            //         icon: "gavel",
            //         label: "Auction Finder",
            //         path: "/auction-finder",
            //     },
            // ]
        },
        {
            icon: "mdi-hammer",
            label: "Auction Finder",
            path: "/user/auction-finder",
        },
        {
            icon: "mdi-thumb-up",
            label: "My Interest",
            path: "/user/interest",
        },
        {
            icon: "mdi-history",
            label: "Watchlist",
            path: "/user/watchlist",
        },
        {
            icon: "mdi-calendar-badge",
            label: "Reauction",
            path: "/user/reauction",
        },
        {
            icon: "mdi-compare-horizontal",
            label: "Compare",
            path: "/user/compare",
        },
        {
            icon: "mdi-calendar-check-outline",
            label: "Auction Scheduler",
            path: "/user/auctionscheduler",
        },
        {
            label: "Profile",
            type: "group",
        },
        {
            icon: "mdi-face-agent",
            label: "Support",
            path: "/support",
        },
        {
            icon: "mdi-newspaper",
            label: "News",
            path: "/news",
        },
        {
            icon: "mdi-account-tie",
            label: "Profile",
            path: "/profile",
        },
        {
            icon: "mdi-cog",
            label: "Settings",
            path: "/viewhsitory",
        },
    ];
};

export default {
    getMenu,
};
