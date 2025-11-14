import { defineStore } from "pinia";
import api from "../plugins/axios";

import { errorHandler } from "@/services/responseHandleService";

export const useAuctionStore = defineStore("auction", {
    state: () => ({
        filter: {
            platform: [],
            vehicleType: [], 
            bodyType: [],
            center: [],
            make: [],
            model: [],
            variant: [],
            length:10,
            search:'',
            sort_by:'name-asc',
        },
        auctionTab: true,
        sidebar:true,
        data: [],
        fuel_type: [],

        platforms: [],
        vehicleTypes: [], 
        bodyTypes: [],
        centers: [],
        makes: [],
        models: [],
        variants: [],
        loading:false,
    }),
    getters:{

    },
    actions: {
        toggleFilter() {
            this.sidebar = !this.sidebar;
        },
        toggleAuctionTab() {
            this.auctionTab = !this.auctionTab;
        },
        async getAuctionList() {
            this.loading = true;
            try {
                let res = await api.get('/api/user/auctionList', {
                    params:this.filter
                })

                this.data = res.data.data;
                this.loading = false;
                return res.data;
            } catch (error) {
                this.loading = false;
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

        async getPlatforms(options = {}) {
            try {
                let res = await api.get('/api/master/getAuctionHouse',{
                    params:options,
                })
                this.platforms = res.data.data;
            } catch (error) {
                throw await errorHandler(error);
            }
        },
        async getVehicleTypes(options = {}) {
            try {
                let res = await api.get('/api/master/getVehicleTypes',{
                    params:options,
                })
                this.vehicleTypes = res.data.data;
            } catch (error) {
                throw await errorHandler(error);
            }
        },
        async getBodyTypes(options = {}) {
            try {
                let res = await api.get('/api/master/getBodyTypes',{
                    params:options,
                })
                this.bodyTypes = res.data.data;
            } catch (error) {
                throw await errorHandler(error);
            }
        },
        async getAuctionCenter(options = {}) {
            try {
                let res = await api.get('/api/master/getAuctionCenter',{
                    params:options,
                })
                this.centers = res.data.data;
            } catch (error) {
                throw await errorHandler(error);
            }
        },
        async getMakes(options = {}) {
            try {
                let res = await api.get('/api/master/getMakes',{
                    params:options,
                })
                this.makes = res.data.data;
            } catch (error) {
                throw await errorHandler(error);
            }
        },
        async getModels(options = {}) {
            try {
                let res = await api.get('/api/master/getModels',{
                    params: {
                        makes:this.filter.make
                    },
                })
                this.models = res.data.data;
            } catch (error) {
                throw await errorHandler(error);
            }
        },
        async getVariants(options = {}) {
            try {
                let res = await api.get('/api/master/getVariants',{
                    params: {
                        model:this.filter.model
                    },
                })
                this.variants = res.data.data;
            } catch (error) {
                throw await errorHandler(error);
            }
        },
        

    },

});
