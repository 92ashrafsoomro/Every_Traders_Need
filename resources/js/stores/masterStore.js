import { defineStore } from "pinia";
import api from "../plugins/axios";

import { errorHandler } from "@/services/responseHandleService";
import General from "@/models/general.model";

export const useMasterStore = defineStore("master", {
    state: () => ({
        platforms: {
            data: [],
            loading:false,
        },
        vehicleTypes: {
            data: [],
            loading:false,
        }, 
        bodyTypes: {
            data: [],
            loading:false,
            
        },
        centers: {
            data: [],
            loading:false,
        },
        makes: {
            data: [],
            loading:false,
        },
        models: {
            data: [],
            loading:false,
        },
        variants: {
            data: [],
            loading:false,
        },
        years: {
            data: [],
            loading:false,
        },
        transmissions: {
            data: [],
            loading:false,
        },
        fuelType: {
            data: [],
            loading:false,
        },
        grades: {
            data: [],
            loading:false,
        },
        v5: {
            data: [],
            loading:false,
        },
        cc: {
            data: [],
            loading:false,
        },
        formerKeepers: {
            data: [],
            loading:false,
        },
        noOfServices: {
            data: [],
            loading:false,
        },
        doors: {
            data: [],
            loading:false,
        },
        seats: {
            data: [],
            loading:false,
        },
        mileage: {
            data: [],
            loading:false,
        },
        dates: {
            data: [],
            loading:false,
        },

    }),
    getters:{

    },
    actions: {
        async getAlertList(options) {
            try {
                let res = await General.get('/api/user/userAlertList', {
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
                let res = await General.get('/api/user/auction-finder/getFilter/platform', options)
                this.platforms.data = res.data;
            } catch (error) {
                throw await errorHandler(error);
            }
        },
        async getVehicleTypes(options = {}) {
            try {
                let res = await General.get('/api/user/auction-finder/getFilter/vehicle', options)
                this.vehicleTypes.data = res.data;
            } catch (error) {
                throw await errorHandler(error);
            }
        },
        async getBodyTypes(options = {}) {
            try {
                let res = await General.get('/api/user/auction-finder/getFilter/body', options)
                this.bodyTypes.data = res.data;
            } catch (error) {
                throw await errorHandler(error);
            }
        },
        async getAuctionCenter(options = {}) {
            try {
                let res = await General.get('/api/user/auction-finder/getFilter/center', options)
                this.centers.data = res.data;
            } catch (error) {
                throw await errorHandler(error);
            }
        },
        async getMakes(options = {}) {
            try {
                let res = await General.get('/api/user/auction-finder/getFilter/make', options)
                this.makes.data = res.data;
            } catch (error) {
                throw await errorHandler(error);
            }
        },
        async getModels(options = {}) {
            try {
                let res = await General.get('/api/user/auction-finder/getFilter/model', options)
                this.models.data = res.data;
            } catch (error) {
                throw await errorHandler(error);
            }
        },
        async getVariants(options = {}) {
            try {
                let res = await General.get('/api/user/auction-finder/getFilter/variant', options)
                this.variants.data = res.data;
            } catch (error) {
                throw await errorHandler(error);
            }
        },
        async getYears(options = {}) {
            try {
                let res = await General.get('/api/user/auction-finder/getFilter/year', options)
                console.log('New Api' , res.data);
                
                this.years.data = res.data;
            } catch (error) {
                throw await errorHandler(error);
            }
        },
        async getTransmissions(options = {}) {
            try {
                let res = await General.get('/api/user/auction-finder/getFilter/transmission', options)
                this.transmissions.data = res.data;
            } catch (error) {
                throw await errorHandler(error);
            }
        },
        async getFuelType(options = {}) {
            try {
                let res = await General.get('/api/user/auction-finder/getFilter/fuel_type', options)
                this.fuelType.data = res.data;
            } catch (error) {
                throw await errorHandler(error);
            }
        },
         async getDoors(options = {}) {
            try {
                let res = await General.get('/api/user/auction-finder/getFilter/doors', options)
                this.doors.data = res.data;
            } catch (error) {
                throw await errorHandler(error);
            }
        },
        async getSeats(options = {}) {
            try {
                let res = await General.get('/api/user/auction-finder/getFilter/seats', options)
                
                this.seats.data = res.data;
            } catch (error) {
                throw await errorHandler(error);
            }
        },
        async getDates(options = {}) {
            try {
                let res = await General.get('/api/master/getDates', options)
                this.dates.data = res.data;
            } catch (error) {
                throw await errorHandler(error);
            }
        },
        async getGrades(options = {}) {
            try {
                let res = await General.get('/api/user/auction-finder/getFilter/grade', options)
                this.grades.data = res.data;
            } catch (error) {
                throw await errorHandler(error);
            }
        },

        async getEngineSize(options = {}) {
            try {
                let res = await General.get('/api/user/auction-finder/getFilter/cc', options)
                this.cc.data = res.data;
            } catch (error) {
                throw await errorHandler(error);
            }
        },
        async getV5(options = {}) {
            try {
                let res = await General.get('/api/user/auction-finder/getFilter/v5', options)
                this.v5.data = res.data;
            } catch (error) {
                throw await errorHandler(error);
            }
        },
        async getNoOfServices(options = {}) {
            
            try {
                let res = await General.get('/api/user/auction-finder/getFilter/no_of_services', options)
                this.noOfServices.data = res.data;
            } catch (error) {
                throw await errorHandler(error);
            }
        },
        async getFormerKeepers(options = {}) {
            
            try {
                let res = await General.get('/api/user/auction-finder/getFilter/former_keepers', options)
                this.formerKeepers.data = res.data;
            } catch (error) {
                throw await errorHandler(error);
            }
        },

        

        

        
          
          
         
         

        

        
    },

});
