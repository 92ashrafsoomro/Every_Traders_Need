import api from "@/plugins/axios";
import _ from "lodash";
import { errorHandler } from "@/services/responseHandleService";



/**
 * Fetches the Makes list for a user.
 */

export async function getProfile(options: {
    search?: string;
    page?: number;
    length?: number;

}): Promise<{
    data: unknown[];
}> {

    try {
        const res = await api.get("/api/auth/profile", { params: options });
        return res.data;
    } catch (e) {
        throw await errorHandler(e);
    }

}



/**
 * Update Profile.
 */
export async function updateProfile(data: unknown[]) {
      
        try {
            const form = new FormData();
            for (const key in data) {
                if (!Object.hasOwn(data, key)) continue;
                form.append(key,data[key]);
            }
            const res = await api.post("/api/auth/register",form);
            return res.data.data;

        } catch (error) {
            throw await errorHandler(error);
        }
}









export default {
    getProfile,

}