<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Master\UpdateCsvAuctionRequest;
use App\Models\Auctions;
use App\Models\Prefix;
use App\Models\ScrapedVehicle;
use App\Models\Vehicle;
use App\Services\SheetColumnSetter;
use App\Services\SheetService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SheetController extends Controller
{

    //
         public function getScrapperDataBySheetId(Request $request,$id)
    {
            $model = Auctions::where('id',$id)->first();
            if(!$model){
                return response()->json([
                    'message' => 'Record Not Found',
                ], 422);
            }

            return response()->json([
                'message' => 'Record Updated Successfully',
                'data' => SheetService::getScrapperDataByAuction($request,$model)
            ],200);
    }



          public function getAuctionVehicle(Request $request,$id)
    {

            return response()->json([
                'message' => 'Record Get Successfully',
                'data' => SheetService::getAuctionVehicle($request,$id)
            ],200);

    }


           public function sheetUpdate(UpdateCsvAuctionRequest $request,$id)
    {

            DB::beginTransaction();
            try {

                $res = SheetService::sheetUpdate($request,$id);
                DB::commit();
                return response()->json([
                    'message' => 'Record Updated Successfully',
                    'data' => $res
                ],200);

            } catch (\Throwable $e) {
                DB::rollBack();
                throw $e; // or handle error
            }

    }



        public function sheetFix(Request $request)
    {

        try {

            return response()->json([
                'message' => 'Record Get Successfully',
                'data' => SheetService::sheetFix($request)
            ],200);

        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ],400);
        }
    }



        public function updatePublishColumn(Request $request)
    {

            $auction = Auctions::where('table_id',$request->table_id)->first();
            if(!$auction){
                return response()->json([
                    'message' => 'Record Not Found',
                ],400);
            }
            
            if(Vehicle::where('auction_id',$auction->id)->count() == 0){
                return response()->json([
                    'message' => 'Record Not Found',
                ],400);
            }

            Log::info(json_encode([
                'action' => 'updatePublishColumn' , 
                'data' => json_decode($request->payload,true)
            ],true));

            try {

                    $jsons = json_decode($request->payload,true);
                    foreach ($jsons as $key => $value){

                        Vehicle::where('auction_id',$auction->id)
                            ->where('reg',$value['reg'])
                            ->update([
                                'last_bid' => $value['last_bid'],
                                'bidding_history' => $value['bidding_history'],
                                'bidding_status' => $value['bidding_status'],
                                'cap_new' => $value['cap_new'],
                                'cap_retail' => $value['cap_retail'],
                                'cap_clean' => $value['cap_clean'],
                                'cap_average' => $value['cap_average'],
                                'cap_below'  => $value['cap_below'],
                                'glass_new' => $value['glass_new'],
                                'glass_retail' => $value['glass_retail'],
                                'glass_trade' => $value['glass_trade'],
                                'autotrader_retail_value' => $value['autotrader_retail_value'],
                                'autotrader_trade_value' => $value['autotrader_trade_value'],
                                'buy_now_price' => $value['buy_now_price'],
                            ]);
                    }

                return response()->json([
                    'message' => 'Record Get Successfully',
                    'data' => $auction
                ],200);

            } catch (\Throwable $e) {
                return response()->json([
                    'message' => $e->getMessage(),
                ],400);
            }

    }


    

}
