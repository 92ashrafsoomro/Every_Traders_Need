import { defineStore } from "pinia";
import api from "../core/plugins/axios";
import {useThemeStore} from './themeStore';
import { errorHandler } from "@services/responseHandleService";

export const useVehicleStore = defineStore("vehicle", {
    state: () => ({
        fuel_type: [
            {id: 1,title:'Petrol'},
            {id: 2,title:'Diesel'},
            {id: 3,title:'Electric'},
            {id: 4,title:'Hybrid'},
            {id: 5,title:'PHEV'},
            { id: 1, title: 'Other' }
        ]
    }),

    getters: {

    },

    actions: {
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
        }

    },

});
