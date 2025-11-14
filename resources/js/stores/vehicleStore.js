import { defineStore } from "pinia";
import api from "../plugins/axios";

import { errorHandler } from "@/services/responseHandleService";

export const useVehicleStore = defineStore("vehicle", {
    state: () => ({
        platforms: [],
        showFilterArea: true,
        auctionTab: true,
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
