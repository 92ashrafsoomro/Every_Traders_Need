import { defineStore } from "pinia";
import _ from 'lodash';
import pageService from "@/services/pageService";


export const usePageStore = defineStore("page", {
    state: () => ({
        reauction: {
            reg: '',
            year: null,
            length: 10,
            page: 1,
            offset: 0,
            data: [],
            total: 0,
            offset:0,
            last_page:1,
            loading:false,
        },
    }),
    getters:{

    },
    actions: {
        async getreAuctionList() {

            try {

                this.reauction.loading = true;
                const res = await pageService.reAuctionList(_.pick(this.reauction, ['reg', 'year', 'page','length']))
                this.reauction.data = res.data || [];
                this.reauction.total = res.recordsTotal;
                this.reauction.offset = res.offset;
                this.reauction.page = res.page;
                this.reauction.last_page = res.last_page;
                this.reauction.loading = false;

                // return res.data;
            } catch (error) {
                alert(error)
                  this.reauction.loading = false;
            }
        },  
        


    },

});
