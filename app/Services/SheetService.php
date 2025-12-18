<?php

namespace App\Services;

use App\Models\AuctionCenter;
use App\Models\Auctions;
use App\Models\BodyType;
use App\Models\Interest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class SheetService 
{   

  

    public Auctions $auction ;
    public $data = [];


    public function __construct(Auctions $auction,$data) 
    {

         $this->data = $data;
         $this->auction = $auction;

         $this->intilaize();

                //    dd($this->data); 

         $this->sanitization();
         $this->validation();
        

        //    dd($this->data[400]);
         $this->save();
         dd($this->data);

    }

    
    
    public function intilaize()
    {

            $rows = $this->data;
            if (count($rows) < 2) {
                return []; // No data
            }

            $headers = array_map(function ($header) {
                return strtolower(str_replace(' ', '_', trim($header)));
            }, $rows[0]);

            $result = [];
            foreach (array_slice($rows, 1) as $key => $value) {

                    
                foreach ($headers as $hk => $hval) {
                    $result[$key][$hval] = isset($value[$hk]) ? $value[$hk] : '';
                }
            }

            $this->data = $result;
    }


    public function sanitization(){

        $rows = $this->data;
        foreach ($rows as $key => $data) {
            $rows[$key] = $this->DataFields($data);
        }

        $this->data = $rows;
    }


    public function validation(){

        $result = [];
        $data = $this->data;
        foreach ($data as $key => $row) {
            foreach ($row as $col => $value) {
                $result[$key][$col] =  $this->Field($col,$value);
             
            }
        }

        $this->data = $result;

    }


    public function save(){

        $data = $this->data;
        foreach ($data as $key => $row) {
            Vehicle::create($row);
        }

    }

    
     public function DataFields($data)
    {   

        return [

            'auction_id' => $this->auction->id,

            // -------------------------
            // Basic Info
            // -------------------------
            'title' => $data['title'] ?? null,

            'vehicle_id' => $data['vehicle_id'] ? (int) $data['vehicle_id'] : null,
            
            'make_id' => $data['make_id'] ? (int) $data['make_id'] : null,

            'model_id' => $data['model_id'] ? (int) $data['model_id'] : null,
            
            'variant_id' => $data['variant_id'] ? (int) $data['variant_id'] : null,

            'body_id' => $data['body_id'] ? (int) $data['body_id'] : null,

            'year' => $data['year'] ?? null,

            'center_id' => $data['center'] ? (int) $data['center'] : null,
          
            'color' => $data['colour'] ?? null,
            
            'vin' => $data['vin'] ?? null,
            
            'lot' => $data['lot'] ?? null,

            

            // -------------------------
            // Vehicle Specs
            // -------------------------
            'doors' => $data['doors'] ? (int) $data['doors'] : null,
            'seats' => $data['seats'] ? (int) $data['seats'] : null,
            'fuel_type' => $data['fuel_type'] ?? null,
            'fuel_details' => $data['fuel_details'] ?? null,
            'transmission' => $data['transmission'] ?? null,
            'transmission_details' => $data['transmission_details'] ?? null,
            'cc' => $data['cc'] ? (float) $data['cc'] : null,
            'keys' => (int) ($data['keys'] ?? 0),
            'engine_runs' => $data['non_runner'] ?? null,
            'mileage' => (int) ($data['keys'] ?? 0),
            'mileage_warranted' => $data['mileage_warranted'] ?? null,
            'former_keepers' => (int) ($data['former_keepers'] ?? 0),
            'vat_status' => $data['vat_status'] ?? null,

            // -------------------------
            // Bidding & Pricing
            // -------------------------
            'bidding_history' => $data['bidding_history'] ?? null,
            'last_bid' => (int) ($data['last_bid'] ?? 0),
            'bidding_status' => $data['bidding_status'] ?? null,
            'cap_new' => (int) ($data['cap_new'] ?? 0),
            'cap_retail' => (int) ($data['cap_retail'] ?? 0),
            'cap_clean' => (int) ($data['cap_clean'] ?? 0),
            'cap_average' => (int) ($data['cap_average'] ?? 0),
            'cap_below' => (int) ($data['cap_below'] ?? 0),
            'glass_new' => (int) ($data['glass_new'] ?? 0),
            'glass_retail' => (int) ($data['glass_retail'] ?? 0),
            'glass_trade' => (int) ($data['glass_trade'] ?? 0),
            'autotrader_retail_value' => (int) ($data['autotrader_retail_value'] ?? 0),
            'autotrader_trade_value' => (int) ($data['autotrader_trade_value'] ?? 0),
            'buy_now_price' => $data['buy_now_price'] ?? null,

            // -------------------------
            // Dates
            // -------------------------
            'start_date' => $data['start_date'] ?? null,
            'end_date' => $data['end_date'] ?? null,
            'mot_expiry_date' => $data['mot_expiry_date'] ?? null,
            'mot_due' => $data['mot_due'] ?? null,
            'inspection_date' => $data['inspection_date'] ?? null,
            'dor' => $data['dor'] ?? null,

            // -------------------------
            // Documents & Reports
            // -------------------------
            'v5' => $data['v5'] ?? null,
            'reg' => $data['reg'] ?? null,
            'service_history' => $data['service_history'] ?? null,
            'no_of_services' => (int) ($data['no_of_services'] ?? 0),
            'number_of_services_details' => $data['number_of_services_details'] ?? null,
            'last_service' => $data['last_service'] ?? null,
            'last_service_mileage' => (int) ($data['last_service_mileage'] ?? 0),
            'dvsa_mileage' => $data['dvsa_mileage'] ?? null,
            'inspection_report' => $data['inspection_report'] ?? null,
            'other_report' => $data['other_report'] ?? null,
            'service_notes' => $data['service_notes'] ?? null,
            'vendor' => $data['vendor'] ?? null,

            // -------------------------
            // Condition & Features
            // -------------------------
            'grade' => (int) ($data['grade'] ?? 0),
            'tyres_condition' => $data['tyres_condition'] ?? null,
            'brakes' => $data['brakes'] ?? null,
            'hubs' => $data['hubs'] ?? null,
            'features' => $data['features'] ?? null,
            'equipment' => $data['equipment'] ?? null,
            'additional_information' => $data['additional_information'] ?? null,
            'imported' => (int) ($data['imported'] ?? 0),
            'declarations' => $data['declarations'] ?? null,
            'damaged_images' => $data['damaged_images'] ?? null,
            'damage_details' => $data['damage_details'] ?? null,

            // -------------------------
            // Media
            // -------------------------
            'images' => $data['images'] ?? null,
        ];

    }


       public function Field($key, $value)
    {

        $value = is_string($value) ? trim($value) : $value;
             
        switch ($key) {

            case 'center_id':{
                 if($value){
                     $model = AuctionCenter::where(['id' => $value])->first();
                     if($model){
                        return $model->id;
                     }
                }
                return null;
            }

            case 'body_id':{

                if($value){
                     $model = BodyType::where(['id' => $value])->first();
                     if($model){
                        return $model->id;
                     }
                }
               return null;
            }

            case 'model_id':{

                if($value){
                     $model = VehicleModel::where(['id' => $value])->first();
                     if($model){
                        return $model->id;
                     }
                }

               return null;
            }



            case 'mot_expiry_date':{
               return null;
            }

            case 'mot_due':{
               return null;
            }

            case 'inspection_date':{
               return null;
            }

            case 'last_service':{
               return null;
            }

            

            
            default:

            return $value;
        }

    }



}
