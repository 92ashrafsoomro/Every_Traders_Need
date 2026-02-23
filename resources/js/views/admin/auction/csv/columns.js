// export default [
//     // { title: 'id', key: 'id' },
//     // { title: 'auction_id', key: 'auction_id' },
//     { title: 'Reg', key: 'reg' ,disabled: true },
//     { title: 'Title', key: 'title', disabled: true,  },
//     { title: 'Make', key: 'make_id', required:true },
//     { title: 'Model', key: 'model_id',required:true },
//     { title: 'Derivative', key: 'derivative',disabled: true },
//     { title: 'Variant', key: 'variant_id',required:true },

//     { title: 'Vehicle', key: 'vehicle_id',required:true },
//     { title: 'Body Type', key: 'body_id',required:true },
  
//     { title: 'Center', key: 'center_id',required:true },
//     { title: 'FuelType', key: 'fuel_type', disabled: true },
    

//     { title: 'Fuel Details', key: 'fuel_details' , disabled: true },
//     { title: 'Transmission', key: 'transmission',disabled: true },
//     { title: 'Transmission_details', key: 'transmission_details' , disabled: true },
//     { title: 'CC', key: 'cc' , disabled: true },


//     { title: 'Year', key: 'year' , disabled: true },
    

//     { title: 'Color', key: 'color' , disabled:true },
//     { title: 'doors', key: 'doors' , disabled:true },
//     { title: 'seats', key: 'seats', disabled: true },
   
    

//     { title: 'Keys', key: 'keys' , disabled: true  },
//     { title: 'Euro Status', key: 'euro_status' , disabled: true  },
//     { title: 'Mileage', key: 'mileage', disabled: true },
    
//     { title: 'Non Runner', key: 'engine_runs' , disabled: true },

//     { title: 'Bidding History', key: 'bidding_history' , disabled: true },
//     { title: 'Last bid', key: 'last_bid' , disabled: true},

//     { title: 'Bidding Status', key: 'bidding_status',disabled: true },

//     { title: 'Cap New', key: 'cap_new' , disabled: true },

//     { title: 'Cap Retail', key: 'cap_retail' , disabled: true },
    
//     { title: 'Cap_clean', key: 'cap_clean' , disabled: true },
//     { title: 'Cap_average', key: 'cap_average' , disabled: true },
//     { title: 'Cap_below', key: 'cap_below' , disabled: true },
//     { title: 'Glass_new', key: 'glass_new' , disabled: true },
//     { title: 'Glass_Retail', key: 'glass_retail' , disabled: true },
//     { title: 'Glass Trade', key: 'glass_trade' , disabled: true },
//     { title: 'Autotrader Retail Value', key: 'autotrader_retail_value' , disabled: true },
//     { title: 'Autotrader Trade Value', key: 'autotrader_trade_value' , disabled: true },
    


//     { title: 'Lot', key: 'lot' ,disabled: true },

//     { title: 'DOR', key: 'dor' ,disabled: true },

    

//     { title: 'Former Keepers', key: 'former_keepers' ,disabled: true },

//     { title: 'Mileage Warranted', key: 'mileage_warranted' ,disabled: true },

//     { title: 'Mot Expiry Date', key: 'mot_expiry_date' ,disabled: true },

//     { title: 'Mot Due', key: 'mot_due' ,disabled: true },

//     { title: 'V5', key: 'v5' ,disabled: true },
    
//     { title: 'Vat Status', key: 'vat_status' ,disabled: true },
    
//     { title: 'Service History', key: 'service_history' ,disabled: true },
    

//     { title: 'No of Services', key: 'no_of_services' ,disabled: true },
    
//     { title: 'Inspection Report', key: 'inspection_report' ,disabled: true },
    
//     { title: 'Other_report', key: 'other_report' ,disabled: true },
    
//     { title: 'Service_notes', key: 'service_notes' ,disabled: true },
    
//     { title: 'Vendor', key: 'vendor' ,disabled: true },
    
  
    
//     { title: 'Vin', key: 'vin' ,disabled: true },
    


    
//     // { title: 'number_of_services_details', key: 'number_of_services_details' },

//     { title: 'Last Service', key: 'last_service' ,disabled: true },
//     { title: 'Last Service_mileage', key: 'last_service_mileage' ,disabled: true },
//     { title: 'Dvsa Mileage', key: 'dvsa_mileage' ,disabled: true },
//     { title: 'Grade', key: 'grade' ,disabled: true },
//     { title: 'Buy_now_price', key: 'buy_now_price' ,disabled: true },
//     { title: 'Inspection date', key: 'inspection_date' ,disabled: true },
//     { title: 'Tyres condition', key: 'tyres_condition' ,disabled: true },
//     // { title: 'brakes', key: 'brakes' ,disabled: true },
//     // { title: 'hubs', key: 'hubs' },

//     { title: 'Features', key: 'features', disabled: true },
    
//     { title: 'Equipment', key: 'equipment', disabled: true },
    
//     { title: 'Additional information', key: 'additional_information' ,disabled: true },
    
//     { title: 'Imported', key: 'imported' ,disabled: true },
    
//     { title: 'Declarations', key: 'declarations' ,disabled: true },
    
//     { title: 'images', key: 'images', disabled: true },
     
//     { title: 'damaged_images', key: 'damaged_images' ,disabled: true},
    
//     { title: 'Damage_details', key: 'damage_details' ,disabled: true },
    

// ]
export default [

    { title: 'Reg', key: 'reg', disabled: true,group:'basic' },
    { title: 'Title', key: 'title', disabled: true,group:'basic' },
    { title: 'Make', key: 'make_id', required: true,group:'basic' },
    { title: 'Model', key: 'model_id', required: true,group:'basic' },
    { title: 'Derivative', key: 'derivative', disabled: true,group:'basic' },
    { title: 'Variant', key: 'variant_id', required: true,group:'basic' },
    { title: 'Vehicle', key: 'vehicle_id', required: true,group:'basic' },
    { title: 'Body Type', key: 'body_id', required: true,group:'basic' },
    { title: 'Center', key: 'center_id', required: true,group:'basic' },
    { title: 'FuelType', key: 'fuel_type', disabled: true,group:'basic' },
    { title: 'Fuel Details', key: 'fuel_details', disabled: true,group:'basic' },
    { title: 'Transmission', key: 'transmission', disabled: true,group:'basic' },
    { title: 'Transmission_details', key: 'transmission_details', disabled: true,group:'basic' },
    { title: 'CC', key: 'cc', disabled: true,group:'basic' },
    { title: 'Year', key: 'year', disabled: true,group:'basic' },
    { title: 'Color', key: 'color', disabled: true,group:'basic' },
    { title: 'Doors', key: 'doors', disabled: true,group:'basic' },
    { title: 'Seats', key: 'seats', disabled: true,group:'basic' },


    { title: 'Bidding History', key: 'bidding_history', disabled: true ,group:'pricings'},
    { title: 'Last bid', key: 'last_bid', disabled: true,group:'pricings' },
    { title: 'Bidding Status', key: 'bidding_status', disabled: true,group:'pricings' },
    { title: 'Cap_clean', key: 'cap_clean' , disabled: true,group:'pricings' },
    { title: 'Cap_average', key: 'cap_average' , disabled: true,group:'pricings' },
    { title: 'Cap_below', key: 'cap_below' , disabled: true,group:'pricings' },
    { title: 'Glass_new', key: 'glass_new' , disabled: true,group:'pricings' },
    { title: 'Glass_Retail', key: 'glass_retail' , disabled: true,group:'pricings' },
    { title: 'Glass Trade', key: 'glass_trade' , disabled: true,group:'pricings' },
    { title: 'Autotrader Retail Value', key: 'autotrader_retail_value' , disabled: true,group:'pricings' },
    { title: 'Autotrader Trade Value', key: 'autotrader_trade_value' , disabled: true,group:'pricings' },
    


    { title: 'Service History', key: 'service_history', disabled: true,group:'Service_History' },
    { title: 'No of Services', key: 'no_of_services', disabled: true,group:'Service_History' },
    { title: 'Inspection Report', key: 'inspection_report', disabled: true,group:'Service_History' },
    { title: 'Other Report', key: 'other_report', disabled: true,group:'Service_History' },
    { title: 'Service Notes', key: 'service_notes', disabled: true,group:'Service_History' },
    { title: 'Vendor', key: 'vendor', disabled: true,group:'Service_History' },
    { title: 'Vin', key: 'vin', disabled: true,group:'Service_History' },
    { title: 'Last Service', key: 'last_service', disabled: true,group:'Service_History' },
    { title: 'Last Service Mileage', key: 'last_service_mileage', disabled: true,group:'Service_History' },
    { title: 'DVSA Mileage', key: 'dvsa_mileage', disabled: true,group:'Service_History' },
    { title: 'Grade', key: 'grade', disabled: true,group:'Service_History' },
    



    { title: 'Keys', key: 'keys', disabled: true,group:'specs' },
    { title: 'Euro Status', key: 'euro_status', disabled: true,group:'specs' },
    { title: 'Mileage', key: 'mileage', disabled: true,group:'specs' },
    { title: 'Non Runner', key: 'engine_runs', disabled: true,group:'specs' },
    { title: 'Lot', key: 'lot', disabled: true,group:'specs' },
    { title: 'DOR', key: 'dor', disabled: true,group:'specs' },
    { title: 'Former Keepers', key: 'former_keepers', disabled: true,group:'specs' },
    { title: 'Mileage Warranted', key: 'mileage_warranted', disabled: true,group:'specs' },
    { title: 'MOT Expiry', key: 'mot_expiry_date', disabled: true,group:'specs' },
    { title: 'MOT Due', key: 'mot_due', disabled: true,group:'specs' },
    { title: 'V5', key: 'v5', disabled: true,group:'specs' },
    { title: 'Vat Status', key: 'vat_status', disabled: true,group:'specs' },
    { title: 'Buy Now Price', key: 'buy_now_price', disabled: true,group:'specs' },
    { title: 'Inspection Date', key: 'inspection_date', disabled: true,group:'specs' },
    { title: 'Tyres Condition', key: 'tyres_condition', disabled: true,group:'specs' },
    { title: 'Features', key: 'features', disabled: true,group:'specs' },
    { title: 'Equipment', key: 'equipment', disabled: true,group:'specs' },
    { title: 'Additional Info', key: 'additional_information', disabled: true,group:'specs' },
    { title: 'Imported', key: 'imported', disabled: true,group:'specs' },
    { title: 'Declarations', key: 'declarations', disabled: true,group:'specs' },
    { title: 'Images', key: 'images', disabled: true,group:'specs' },
    { title: 'Damaged Images', key: 'damaged_images', disabled: true,group:'specs' },
    { title: 'Damage Details', key: 'damage_details', disabled: true,group:'specs' },

]