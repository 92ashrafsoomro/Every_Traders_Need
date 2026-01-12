<?php

namespace App\Services;

use App\Models\AuctionCenter;
use App\Models\Auctions;
use App\Models\BodyType;
use App\Models\Interest;
use App\Models\Prefix;
use App\Models\ScrapedVehicle;
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

    
        static  public function getScrapperDataByAuction(Request $request,Auctions $model)
    {

            $prefixes = [];
            $prefix = Prefix::orderBy('prefix_key')->get();
            foreach ($prefix as $key => $value) {
                $prefixes[$value->name][strtolower($value->prefix_key)] = $value->prefix_value;
            }

    
            $data = [];
            $scraps = json_decode(ScrapedVehicle::select('payload')->where('auction_id',$model->id)->pluck('payload')->first());
            foreach ($scraps  as $key => $item){
               
                $SheetColumnSetter = new SheetColumnSetter(json_decode(json_encode($item),true));
                $SheetColumnSetter->prefixes = $prefixes;
                array_push($data,$SheetColumnSetter->get());
            }

            
            return $data;


    }


    static public function getAuctionVehicle(Request $request,$auctionId)
    {

            $model = Auctions::where('id',$auctionId)->first();
            if(!$model){
                return response()->json([
                    'message' => 'Record Not Found',
                ], 422);
            }


            $data = Vehicle::where('auction_id',$auctionId)
                    ->leftJoin('auction_center', 'auction_center.id', '=', 'vehicles.center_id')
                    ->leftJoin('make', 'make.id', '=', 'vehicles.make_id')
                    ->leftJoin('model', 'model.id', '=', 'vehicles.model_id')
                    ->leftJoin('model_variant', 'model_variant.id', '=', 'vehicles.variant_id')
                    ->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'vehicles.vehicle_id')
                    ->leftJoin('body_types', 'body_types.id', '=', 'vehicles.body_id')
                    ->select([
                        'vehicles.*',
                        'auction_center.name as center_name',
                        'make.name as make_name',
                        'model.name as model_name',
                        'model_variant.name as variant_name',
                        'vehicle_type.name as vehicle_name',
                        'body_types.name as body_name',
                    ])
                    ->get()
                    ->map(function ($item, $key) {

                        $item->center_id = $item->center_name;
                        $item->vehicle_id = $item->vehicle_name;
                        $item->body_id = $item->body_name;
                        $item->make_id = $item->make_name;
                        $item->model_id = $item->model_name;
                        $item->variant_id = $item->variant_name;
                        

                        return $item;

                    });

            return [
                'auction'=> $model,
                'data' => $data,
            ];

    }


    

    static public function sheetUpdate(Request $request,$id)
    {

            // dd($request->all());
            $model = Auctions::where('id',$id)->first();
            if(!$model){
                return response()->json([
                    'message' => 'Record Not Found',
                ], 422);
            }


            DB::beginTransaction();
            try {

                Vehicle::where('auction_id',$id)->delete();
                foreach ($request->data as $key => $item){

                    $item['auction_id'] = $model->id;
                    $item['last_bid'] = floatval($item['last_bid']);

                    Vehicle::create($item);
                }

                DB::commit();
                return response()->json([
                    'message' => 'Record Updated Successfully',
                    'data' => $model
                ],200);

            } catch (\Throwable $e) {
                DB::rollBack();
                throw $e; // or handle error
            }

    }



      static public function sheetFix(Request $request)
    {

        $prefixes = [];
        $prefix = Prefix::orderBy('prefix_key')->get();
        foreach ($prefix as $key => $value) {
            $prefixes[$value->name][strtolower($value->prefix_key)] = $value->prefix_value;
        }

        $response = [];
        foreach (ScrapedVehicle::limit(10)->get() as $key => $scrap) {

                $payloads = json_decode($scrap->payload);
             
                foreach ($payloads  as $key => $item){

                    $obj = json_decode(json_encode($item),true);
                    $columns = ['title', 'make_id','model_id','variant_id','derivative','center_id','body_id','reg'];
                    $filtered = array_intersect_key($obj, array_flip($columns));
                    $filtered['auction_id'] = $scrap->auction_id;
                    $filtered['id'] = $key;
                    $filtered['table_id'] = $scrap->auction->table_id;


                    $SheetColumnSetter = new SheetColumnSetter($filtered);
                    $SheetColumnSetter->prefixes = $prefixes;
                    $filtered = $SheetColumnSetter->get();

                    if(count($filtered['errors']) > 0){
                        array_push($response,$filtered);
                    }

                }

        }


        return [
            'count' => count($response),
            'data' => $response
        ];


    }


    


  




}
