export const getMenu = () => {
    return [
        {
            label: "Menu",
            type: "group",
        },
        {
            icon: "dashboard",
            label: "Dashboard",
            path: "/dashboard",
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
            icon: "gavel",
            label: "Auction Finder",
            path: "/auction-finder",
        },
        {
            icon: "thumb_up",
            label: "My Interest",
            path: "/interest",
        },
        {
            icon: "history",
            label: "Watchlist",
            path: "/watchlist",
        },
        {
            icon: "edit_calendar",
            label: "Reauction",
            path: "/reauction",
        },
        {
            icon: "compare_arrows",
            label: "Compare",
            path: "/compare",
        },
        {
            icon: "calendar_check",
            label: "Auction Scheduler",
            path: "/auctionscheduler",
        },
        {
            label: "Profile",
            type: "group",
        },
        {
            icon: "support_agent",
            label: "Support",
            path: "/support",
        },
        {
            icon: "newspaper",
            label: "News",
            path: "/news",
        },
        {
            icon: "account_circle",
            label: "Profile",
            path: "/profile",
        },
        {
            icon: "settings",
            label: "Settings",
            path: "/viewhsitory",
        },
    ];
};

export default {
    getMenu,
};
