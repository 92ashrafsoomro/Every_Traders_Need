
export default class UserModel {


    // -------------------------------
    // 1. Field definitions (like $fillable)
    // -------------------------------
    static fields = [
        // Personal
        { key: "firstName", label: "First Name", type: "text", group: "personal" },
        { key: "surname", label: "Surname", type: "text", group: "personal" },
        { key: "jobTitle", label: "Job Title", type: "text", group: "personal" },
        { key: "avatar", label: "Avatar", type: "file", accept: "image/*", group: "personal" , placeholder:'Avatar Allowed JPG, GIF or PNG. Max size of 800K' },
        { key: "phone", label: "Phone", type: "text", group: "personal" },
        { key: "personalEmail", label: "Personal Email", type: "email", group: "personal" },

        // Business Info
        { key: "companyName", label: "Company Name", type: "text", group: "bussiness" },
        { key: "businessType", label: "Business Type", type: "text", group: "bussiness" },
        { key: "companyReg", label: "Company Reg", type: "text", group: "bussiness" },
        { key: "businessEmail", label: "Business Email", type: "email", group: "bussiness" },
        { key: "country", label: "Country", type: "text", group: "bussiness" },
        { key: "townCity", label: "Town / City", type: "text", group: "bussiness" },
        { key: "postcode", label: "Postcode", type: "text", group: "bussiness" },
        { key: "companyAddress1", label: "Company Address 1", type: "text", group: "bussiness" },
        { key: "companyAddress2", label: "Company Address 2", type: "text", group: "bussiness" },
        { key: "motorTradeInsurance", label: "Motor Trade Insurance", type: "select", group: "bussiness" },
        { key: "vatNumber", label: "VAT Number", type: "text", group: "bussiness" },
        { key: "telephone", label: "Telephone", type: "text", group: "bussiness" },
        { key: "website", label: "Website", type: "text", group: "bussiness" },

        // Proof
        { key: "uploadID", label: "Upload ID", type: "file", accept: "image/*,.pdf", group: "proof" },
        { key: "motorTradeProof", label: "Motor Trade Proof", type: "file", accept: "image/*,.pdf", group: "proof" },
        { key: "addressProof", label: "Address Proof", type: "file", accept: "image/*,.pdf", group: "proof" },
    ];


     static getFields() {
        return { ...this.fields };
    }


    // --------------------------------
    // Get all fields EXCEPT some keys
    // --------------------------------
    static getFieldsExcept(except: string[] = []) {
        return Object.entries(UserModel.fields)
            .filter(([key]) => !except.includes(key))
            .reduce((obj, [key, value]) => {
                obj[key] = value;
                return obj;
            }, {} as Record<string, any>);
    }

       // ---------------------------------------------------
    // ✔ Get only specific fields
    // ---------------------------------------------------
    static getFieldsOnly(keys: string[]) {
        const result: any = {};
        keys.forEach(key => {
            if (this.fields[key]) {
                result[key] = this.fields[key];
            }
        });
        return result;
    }


    // ---------------------------------------------------
    // ✔ Get a single field definition
    // ---------------------------------------------------
    static getField(key: string) {
        return this.fields.find((data) => data.key == key );
    }


    // ---------------------------------------------------
    // ✔ Get a single field definition
    // ---------------------------------------------------
    static groupByFields(group): unknown[] {
      
        return this.fields.filter((res) => res.group == group);
        
    }


}
