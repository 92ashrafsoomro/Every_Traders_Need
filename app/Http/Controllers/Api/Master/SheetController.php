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

            try {

                    $jsons = json_decode($request->payload,true);
                    foreach ($jsons as $key => $value){
                        
                        Log::info(json_encode(['action' => 'updatePublishColumn' , 'data' => $value],true));

                        Vehicle::where('auction_id',$auction->id)
                            ->where('reg',$value['reg'])
                            ->update([
                            'last_bid' => $value['last_bid'],
                            'bidding_history' => $value['bidding_history'],
                            'bidding_status' => $value['bidding_status'],
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
