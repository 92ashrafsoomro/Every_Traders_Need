import { defineStore } from "pinia";
import api from "../plugins/axios";

import { errorHandler } from "@/services/responseHandleService";

export const useVehicleStore = defineStore("vehicle", {
    state: () => ({
        sidebar: true,
        isMobile: false,
        isVehicle: true,
        tab: 'details',


        
        auctionTab: true,
        platforms: [],
        length: 10,
        sort_by: 'name-asc',
        data: [],
        fuel_type: [],
        v: false,
        relatedVehicle: {
            total: 18,
            per_page: 10,
            current_page: 1,
            last_page: 2,
            data: [],
        },
        vehichleDetail: {
            sidebar: true,
            isMobile: false,
            tab: 'details'
        },
        overView: {
            title:'ABARTH 595 1.4 T-JET 165 TURISMO Hatchback',
            images: [
                "https://bcamediaprod.blob.core.windows.net/public/images/vehicle/GB/OV21FFE/610237700/600",
                "https://www1.bcaimage.com/Document?DocType=VehicleImage&width=600&docId=610237703",
                "https://www1.bcaimage.com/Document?DocType=VehicleImage&width=600&docId=610232526",
                "https://www1.bcaimage.com/Document?DocType=VehicleImage&width=600&docId=610237708",
            ],
            vehicleType: 'Car',
            make: 'BMW',
            model: '3 Series',
            variant: '330e',
            cc: '2.0',
            year: '2022',
            color: 'red',
            fuelType: 'Hybrid',
            transmission: 'Automatic',
            keys: '2',
            doors: '4',
            seats: '4',
            reg: 'RO70 VDP',
            dor: '2020 (70 reg)',
            mileage: '300',
            grade: '5',
            v5: 'Not Present',
            inspection: '',
            biddingStatus: 'Sold',
            
            lot: 'MC103',
            previousAuction: '',
            auctionType:'Online Auction',
            dateTime:'2025-10-18 14:34:04',
            auction: {
                title:'Central Car Auctions'
            },
            center: {
              title:'Bedford',  
            },
            disclaimer: 'AUTOBILI LTD aggregates vehicle auction data from third-party sources providing it as-is to help users make informed decisions, without guaranteeing data accuracy or completeness. learn more',
            
            // Additional Info
            formerKeepers:1,
            vendors:2,
            vatType:'No',
            euroStatus:'No',
            engineRuns: 'No'
            
        }
    }),
    getters: {

    },
    actions: {
        toggleFilter() {
            this.vehichleDetail.sidebar = !this.vehichleDetail.sidebar
        },
        toggleAuctionTab() {
            this.auctionTab = !this.auctionTab
        },
        async getAuctionList(options) {
            try {
                let res = await api.get('/api/user/auctionList', {
                    params: {
                        length: this.length,
                        search: options?.search,
                        sort_by: this.sort_by,
                    },
                })
                this.data = res.data.data;
                return res.data;
            } catch (error) {
                throw await errorHandler(error);
            }
        },
        async getVehicleDetail(options) {
            try {
                let res = await api.get('/api/user/auctionList/' + options.id, {
                    params: {
                    },
                })
                return res.data;
            } catch (error) {
                throw await errorHandler(error);
            }
        },
        async getRelatedVehicle(options) {
            try {
                let res = await api.get('/api/user/getRelatedVehicle/' + options.id, {
                    params: options,
                })
                return res.data;
            } catch (error) {
                throw await errorHandler(error);
            }
        },
        async getreAuctionList(options) {
            try {
                let res = await api.get('/api/user/reAuctionList', {
                    params: {
                        length: options.length,
                        search: options.search
                    },
                })
                return res.data;
            } catch (error) {
                throw await errorHandler(error);
            }
        },
        async getWatchList(options) {
            try {
                let res = await api.get('/api/user/userWatchList', {
                    params: {
                        length: options.length,
                        search: options.search
                    },
                })
                return res.data;
            } catch (error) {
                throw await errorHandler(error);
            }
        },
        async getAlertList(options) {
            try {
                let res = await api.get('/api/user/userAlertList', {
                    params: {
                        length: options.length,
                        search: options.search
                    },
                })
                return res.data;
            } catch (error) {
                throw await errorHandler(error);
            }
        },

        async getPlatforms(options) {
            try {
                let res = await api.get('/api/master/getAuctionHouse', {
                    params: {
                    },
                })

                this.platforms = res.data.data;


            } catch (error) {
                throw await errorHandler(error);
            }
        },


    },

});
