<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Auctions;
use App\Models\AuctionPlatform;
use App\Models\AuctionCenter;
use App\Models\BodyType;
use App\Models\Color;
use App\Models\Make;
use App\Models\ModelVariant;
use App\Models\Vehicle;
use App\Models\UserNotificationSetting;
use App\Models\Interest;
use App\Models\VehicleModel;
use App\Models\VehicleType;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use App\Mail\InterestAlertMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Mail\AuctionStatusUpdatedMail;
use App\Models\UserNotificationAlert;
use App\Events\NotificationEvent;
use App\Http\Requests\Api\Master\UpdateCsvAuctionRequest;
use App\Models\Auction;
use App\Models\Prefix;
use App\Models\ScrapedVehicle;
use App\Services\AuctionService;
use App\Services\SheetColumnSetter;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;


class AuctionController extends Controller
{


        public function index(Request $request)
    {

        $length = $request->input('length', 50);
        $page   = $request->input('page', 1);
        $offset = ($page - 1) * $length;

        //Query
        $query = Auctions::with('platform','auctionType','auctionStatus');

        //Filter
        if($request->has('id') && $request->id != '') {
            $query->where('id',$request->id);
        }

        if($request->has('table_id') && $request->table_id != '') {
            $query->where('table_id',$request->table_id);
        }

        if($request->has('platform') && $request->platform != '') {
            $query->where('platform_id',$request->platform);
        }

        if($request->has('status') && $request->status != '') {
            $query->where('status',$request->status);
        }

        if($request->has('auction_type') && $request->auction_type != '') {
            $query->where('auction_type',$request->auction_type);
        }

        if($request->has('auction_date') && $request->auction_date != '') {
            $query->whereDate('auction_date',$request->auction_date);
        }

        $count = (clone $query)->count();
        $data = $query->select([
                    '*'
                ])
                ->skip($offset)
                ->take($length)
                ->orderByDesc('id')
                ->get()
                ->map(function($item){

                    $item->created_date = Carbon::parse($item->created_at)->format('Y-m-d');
                    return $item;

                });
            
        return response()->json([
            'recordsTotal' => $count,
            'recordsFiltered' => $count,
            'page' => $page,
            'offset' => $offset,
            'last_page' => ceil($count / $length),
            'data' => $data,
        ],200);
        
    }

    
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'id' => 'required|string|max:255|unique:auctions,table_id',
            'name' => 'required|string|max:255',
            'auction_date' => 'required|date',
            'end_date' => 'nullable|date',
            'platform_id' => 'required|exists:auction_platform,id',
            'auction_type' => 'required|exists:auction_types,id',
            'payload' => 'nullable',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }
        
        //Online Auction
        if($request->auction_type != 2 ){
            if(empty($request->end_date)){
                return response()->json([
                   'message' => 'End Date Is Required',
                ], 422);
            }
        }

        DB::beginTransaction();
        try {

            // Creation Process
            $auction = Auctions::create([
                'name' => $request->name,
                'table_id' => $request->id,
                'auction_date' => Carbon::parse($request->auction_date),
                'end_date' => $request->auction_type == 2 ? null : Carbon::parse($request->end_date),
                'auction_type' => $request->auction_type,
                'platform_id' => $request->platform_id,
                'status' => 1,
            ]);

            if($request->payload){
                ScrapedVehicle::create([
                    'auction_id' => $auction->id,
                    'payload' => $request->payload,
                ]);
            }

            Log::info('Auction Added #'.$auction->id);
            DB::commit();
            return response()->json([
                'data' => $auction,
                'message' => 'Record Created',
            ],200);

        } catch (\Throwable $th) {

            Log::error('Create Auction failed', [
                'message' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine(),
            ]);

            DB::rollBack();
            return response()->json([
                'message' => $th->getMessage(),
            ],500);
        }


    }


     public function update(Request $request,$id)
    {

        $model = Auctions::find($id);
        if(!$model){
            return response()->json([
                'message' => 'Record Not Found',
            ], 422);
        }

        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'auction_date' => 'required|date',
            'end_date' => 'nullable|date',
            'platform_id' => 'required|exists:auction_platform,id',
            'auction_type' => 'required|exists:auction_types,id',
            'status' => ['required','exists:auction_status,id'],
            'payload' => 'nullable',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }

        //Online Auction
        if($request->auction_type != 2 ){
            if(empty($request->end_date)){
                return response()->json([
                    'message' => 'End Date Is Required',
                ], 422);
            }
        }

        DB::beginTransaction();
        try {

            // Updation Process
            $model->update([
                'name' => $request->name,
                'auction_date' => Carbon::parse($request->auction_date),
                'end_date' => $request->auction_type == 2 ? null : Carbon::parse($request->end_date),
                'auction_type' => $request->auction_type,
                'platform_id' => $request->platform_id,
                'status' => $request->status,
            ]);

            if($request->payload){
                ScrapedVehicle::where(['auction_id' => $model->id])
                ->update([
                    'payload' => $request->payload,
                ]);
            }
            
             Log::info('Auction Updated #'.$model->id);
            
            DB::commit();
            return response()->json([
                'message' => 'Record Updated',
                'data' => $model
            ],200);

         
            
        } catch (\Throwable $th) {

            Log::error('Auction Update failed', [
                'message' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine(),
            ]);

            DB::rollBack();

            return response()->json([
                'message' => $th->getMessage(),
            ],500);

        }


    }



        public function show(Request $request,$id)
    {


        $model = Auctions::with(['auctionStatus', 'platform','auctionType'])->find($id);
  
        if(!$model){
            return response()->json([
                'message' => 'Record Not Found',
            ], 422);
        }
        
        return response()->json([
            'message' => 'Record Updated Successfully',
            'data' => $model
        ],200);

    }



 



    public function destroy($id)
    {

        $auction = Auctions::find($id);
        if($auction ==  false){
            return response()->json([
                'message' => 'Record Not Found'
            ],400);
        }

        DB::beginTransaction();
        try {

            $auction->delete();
            DB::commit();
            return response()->json([
                'message' => 'Record Deleted'
            ],200);

            ScrapedVehicle::where('auction_id',$auction->id)->delete();
           

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage()
            ],400);
        }

    }




    public function updateStatus(Request $request,$id)
    {

        $validator = Validator::make($request->all(),[
            'status_id' => 'required|integer',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }

        $auction = Auctions::find($id);
        if($auction == false){
               return response()->json([
                'message' => 'Auction Not Found',
            ], 422);
        }
        

        DB::beginTransaction();
        try {


            $auction->status = $request->status_id;
            $auction->save();

            DB::commit();
            return response()->json([
                'data' => $auction,
                'message' => 'Status Updated',
            ],200);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => $th->getMessage(),
            ],500);
        }

    }

}
