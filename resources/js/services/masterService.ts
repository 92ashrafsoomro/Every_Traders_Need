import api from "@/plugins/axios";
import _ from "lodash";
import { errorHandler } from "@/services/responseHandleService";


/**
 * Fetches the Makes list for a user.
 */

export async function getMakes(options: {
    search?: string;
    page?: number;
    length?: number;

}): Promise<{
    data: unknown[];
    recordsFiltered: number;
    recordsTotal: number;
    page: number;
    length: number;
    last_page: number;
    offset: number;
}> {

    try {
        const res = await api.get("/api/master/getMakes", { params: options });
        return res.data;
    } catch (e) {
        throw await errorHandler(e);
    }

}


/**
 * Fetches the Models.
 */
export async function getModels(options: {
    makes:unknown[],
    search?: string;
    page?: number;
    length?: number;
    id?: number;
}): Promise<{
    data: unknown[];
    recordsFiltered: number;
    recordsTotal: number;
    page: number;
    length: number;
    last_page: number;
    offset: number;
}> {

    try {
        const res = await api.get("/api/master/getModels", { params: options });
        return res.data;
    } catch (e) {
        throw await errorHandler(e);
    }

}


/**
 * Fetches the Makes list for a user.
 */

export async function getPlateforms(options: {
    search?: string;
    page?: number;
    length?: number;

}): Promise<{
    data: unknown[];
    recordsFiltered: number;
    recordsTotal: number;
    page: number;
    length: number;
    last_page: number;
    offset: number;
}> {

    try {
        const res = await api.get("/api/master/getAuctionHouse", { params: options });
        return res.data;
    } catch (e) {
        throw await errorHandler(e);
    }

}

export async function getAuctionCenter(options: {
    search?: string;
    page?: number;
    length?: number;

}): Promise<{
    data: unknown[];
    recordsFiltered: number;
    recordsTotal: number;
    page: number;
    length: number;
    last_page: number;
    offset: number;
}> {

    try {
        const res = await api.get("/api/master/getAuctionCenter", { params: options });
        return res.data;
    } catch (e) {
        throw await errorHandler(e);
    }

}




export default {
    getMakes,
    getModels
}