import { defineStore } from "pinia";
import api from "../core/plugins/axios";

import { errorHandler } from "@services/responseHandleService";

export const useVehicleStore = defineStore("vehicle", {
    state: () => ({
        showFilterArea: true,
        auctionTab: true,
        length:10,
        sort_by: 'name-asc',
        data:[],
        fuel_type: [],
    }),
    getters: {

    },
    actions: {
        toggleFilter() {
            this.showFilterArea = !this.showFilterArea
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
        }

    },

});
