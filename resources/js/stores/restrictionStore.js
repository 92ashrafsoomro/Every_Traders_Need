import { defineStore } from "pinia";

export const useRestrictionStore  = defineStore('restriction',{
    state:()=>({
         showDialog: false,
         message : '',
         currentPage: "", 
    }),
    action:{
            getPageAccessMap() {
    return {
        "auction-finder": { allowedPlans: [1,2,3], upgradeMessage: "This page is not available on your plan" },
        "auctionscheduler": { allowedPlans: [3], upgradeMessage: "Upgrade your plan to access Auction Scheduler" },
        "reauction": { allowedPlans: [3], upgradeMessage: "Upgrade your plan to access Reauction Tracker" },
        "alert": { allowedPlans: [3], upgradeMessage: "Upgrade your plan to access Reminder" },
        "watchlist": { allowedPlans: [1,2,3], upgradeMessage: "This page is not available on your plan" },
      };
    },
    checkAccess(){}
    }
})