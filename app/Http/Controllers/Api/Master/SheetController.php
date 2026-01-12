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


    

}
