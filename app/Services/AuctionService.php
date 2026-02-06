<?php

namespace App\Services;

use App\Models\Auctions;
use App\Models\Interest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuctionService 
{

        static public function getAuctionIdbyDateRange($startDate,$endDate)
    {
        return Auctions::whereDate('auction_date', '>=', $startDate)
                ->whereDate('auction_date', '<=', $endDate)
                ->pluck('id');
    }

        static public function getAuctionIdbyDate($date)
    {
    
         return Auctions::whereDate('auction_date', '=', $date)
              ->pluck('id');
    }

    static public function getPlateformNamesByAuctionId($auctionIds)
    {

        return Auctions::join('auction_platform', 'auction_platform.id', '=', 'auctions.platform_id')
          ->whereIn('auctions.id', $auctionIds)
          ->distinct()
          ->pluck('auction_platform.name')
          ->filter()
          ->values();

    }

       static public function getCenterNamesByPlateformName($auctionIds)
    {

        return Vehicle::join('auction_center', 'auction_center.id', '=', 'vehicles.center_id')
        ->whereIn('vehicles.auction_id', $auctionIds)
        ->distinct()
        ->pluck('auction_center.name')
        ->filter()
        ->values();
    
    }

    public static function csvRowsToAssociativeArray(array $rows): array
    {
        

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

         

        return $result;
    }


       static public function fieldValueSet($value)
    {


    }


       static public function handleSheet(Auctions $auction,$csv)
    {

        
        // $header = array_shift($data);
        // $data   = array_map(fn ($row) => array_combine($header, $row), $data);

           
            $csvData = self::csvRowsToAssociativeArray($csv);
            //  dd($csvData);


            foreach ($csvData as $key => $data) {

                    $validator = Validator::make($request->all(),[
                        'name' => 'required|string|max:255',
                        'id' => 'required|string|max:255',
                        'auction_date' => 'required|date',
                        'end_date' => 'nullable',
                        'auction_type' => 'required|in:Online,Live',
                        'platform_id' => 'required|integer',
                        'status' => 'required|in:Planned,In Progress,Cancel,Update',
                        'csv_path' => 'nullable|file|mimes:csv,txt',
                    ]);

                    if($validator->fails()) {
                        return response()->json([
                            'message' => $validator->errors()->first(),
                            'errors' => $validator->errors()
                        ], 422);
                    }
                   

                // dd($data);
                   echo '<br>'.$key.'<br>';
            
                   $vehicle = Vehicle::create([

                        'auction_id' => $auction->id,
                        'title' => $data['title'] ?? null,
                        
                        // 'vehicle_id' => $this->checkVehicleType($data['vehicle_id'] ?? null),
                        // 'make_id' => $this->checkMake($data['make_id'] ?? null),
                        // 'model_id' => $this->checkModel($data['model_id'] ?? null),
                        // 'variant_id' => $this->checkVariant($data['variant_id'] ?? null),
                        // 'body_id' => $this->checkBodyType($data['body_id']  ?? null),
                        // 'color_id' => $this->checkColor($data['colour_id'] ?? null),
                        // 'center_id' => $this->checkCenter($data['center'] ?? null),

                        'year' => $data['year'] ?? null,

                        'doors' => is_numeric($data['doors']) ? (int)$data['doors'] : null,
                        'seats' => is_numeric($data['seats']) ? (int)$data['seats'] : null,
                        'fuel_type' => $data['fuel_type'] ?? null,
                        'transmission' => $data['transmission'] ?? null,
                        'cc' => is_numeric($data['cc']) ? (Float)$data['cc'] : null,
                        'keys' => $data['keys'] ?? null,

                        'euro_status' => is_numeric($data['euro_status']) ? (int)$data['euro_status'] : null,
                        'mileage' => is_numeric($data['mileage']) ? (int)$data['mileage'] : null,

                        'engine_runs' => $data['engine_runs'] ?? null,

                        'dor' => $data['d.o.r'] ?? null,
                        'reg' => $data['reg'] ?? null,
                        'former_keepers' => is_numeric($data['former_keepers']) ? (int)$data['former_keepers'] : null,
                        'mileage_warranted' => $data['mileage_warranted'] ?? null,
                        'mot_expiry_date' => !empty($data['mot_expiry_date']) ? $data['mot_expiry_date'] : null,
                        'mot_due' => null,
                        'v5' => $data['v5'] ?? null,
                        'vat_status' => $data['vat_status'] ?? null,
                        'service_history' => $data['service_history'] ?? null,
                        'no_of_services' => is_numeric($data['no_of_services']) ? (int)$data['no_of_services'] : null,
                    
                        'inspection_report' => $data['inspection_report'] ?? null,
                        'other_report' => $data['other_report'] ?? null,
                        'vendor' => $data['vendor'] ?? null,

                        'bidding_history' => $data['bidding_history'] ?? null,
                        'last_bid' => is_numeric($data['last_bid']) ? (int)$data['last_bid'] : null,
                        'bidding_status' => $data['bidding_status'] ?? null,
                        
                        'cap_new' => is_numeric($data['cap_new']) ? (int)$data['cap_new'] : null,
                        'cap_retail' => is_numeric($data['cap_retail']) ? (int)$data['cap_retail'] : null,
                        'cap_clean' => is_numeric($data['cap_clean']) ? (int)$data['cap_clean'] : null,
                        'cap_average' => is_numeric($data['cap_average']) ? (int)$data['cap_average'] : null,
                        'cap_below' => is_numeric($data['cap_below']) ? (int)$data['cap_below'] : null,
                        'glass_new' => is_numeric($data['glass_new']) ? (int)$data['glass_new'] : null,
                        'glass_retail' => is_numeric($data['glass_retail']) ? (int)$data['glass_retail'] : null,
                        'glass_trade' => is_numeric($data['glass_trade']) ? (int)$data['glass_trade'] : null,
                        'autotrader_retail_value' => is_numeric($data['autotrader_retail_value']) ? (int)$data['autotrader_retail_value'] : null,
                        'autotrader_trade_value' => is_numeric($data['autotrader_trade_value']) ? (int)$data['autotrader_trade_value'] : null,
                        'buy_now_price' => is_numeric($data['buy_now_price']) ? (int)$data['buy_now_price'] : null,

                        'start_date' => $auction->auction_date,

                        'lot' => $data['lot'] ?? null,

                        'images' => $data['images'] ?? null,
                        'vin' => $data['vin'] ?? null,
                        'service_notes' => $data['service_notes'] ?? null,
                        
                        'number_of_services_details' => $data['number_of_services_details'] ?? null,
                        'last_service' => !empty($data['last_service']) ? $data['last_service'] : null,
                        'last_service_mileage' => is_numeric($data['last_service_mileage']) ? (int)$data['last_service_mileage'] : null,
                        'dvsa_mileage' => $data['dvsa_mileage'] ?? null,

                        'grade' => is_numeric($data['grade']) ? (int)$data['grade'] : null,
                        'inspection_date' => !empty($data['inspection_date']) ? $data['inspection_date'] : null,
                        'tyres_condition' => $data['tyres_condition'] ?? null,
                        'brakes' => $data['brakes'] ?? null,
                        'hubs' => $data['hubs'] ?? null,
                        'features' => $data['features'] ?? null,
                        'equipment' => $data['equipment'] ?? null,
                        'additional_information' => $data['additional_information'] ?? null,
                        'imported' => is_numeric($data['imported']) ? (int)$data['imported'] : null,
                        'declarations' => $data['declarations'] ?? null,
                        'damaged_images' => $data['damaged_images'] ?? null,
                        'damage_details' => $data['damage_details'] ?? null,
                    
                ]);
            }

         dd($csvData);

        

  
    
    }


}
