import papaparse from "papaparse";
import columns from '@/views/admin/auction/Csv/columns';


export const rowRender = (rows) => {

    let output = [];

    rows.forEach(row => {
        output.push(ColRender(row))
    });

    return output;
}

export const ColRender = (row) => {


    
    let item = {}
    columns.forEach((col) => {     
        let v = row?.[col.key];
        item[col.key] = v ? String(v).trim() : null;

    });

    return item;
    
};



export default async (file) => { 


        if (!file) return;
    
    

    return new Promise((resolve, reject) => {
            
                
                papaparse.parse(file, {
                    header: true,
                    skipEmptyLines: true,
                    transformHeader: (header) => {

                        let name = header.toLowerCase().trim().replace(/\s+/g, '_');
                        switch (name) {
                                
                            default:
                                return name;
                        }
                            
                    },
                    transform: (value, field) => {
                        switch (field) {
                            default:
                                return value;
                        }

                        
                    },
                    complete: async (results) => {

                         let res = await rowRender(results.data);
                        resolve(res);
                            
                        // console.log(results);
                        // data = results.data;

                        // let data = [];
                        // results.data.forEach(async (row) => {
                        //     let res = await this.renderColumn(row);
                        //     data.push(res);
                        // });
                        // this.data = data;
                        // console.log(data);
                        // this.csv = results.data;

                    }

                });

            
        });
    
    
}