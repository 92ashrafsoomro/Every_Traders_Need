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

use App\Models\TaskManagement;

use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;


class TaskManagementController extends Controller
{



        public function index(Request $request)
    {

        $length = $request->input('length', 50);
        $page   = $request->input('page', 1);
        $offset = ($page - 1) * $length;

        //Query
        $query = TaskManagement::with(['auctionHouse','auctionType']);

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

    
       public function laodSheet()
    {

            TaskManagement::query()->delete();
                $path = "C:\Users\USER\Downloads\csv.csv";
                $rows = array_map('str_getcsv', file($path));
                foreach ($rows as $key => $value) {
                        //  dd($rows);

                        if(!$value[0]){
                        continue;
                        }

                        if($key == 0){
                        continue;
                        }

                        
                        $platform = AuctionPlatform::where('name',$value[2])->first();

                        if(!$platform){
                            echo $value[2].'</br>';
                            dd($value);
                        }

                        
                        TaskManagement::create([
                            'id' => $value[0],
                            'auction_type'  => $value[1] == 'Live Auction' ? 2 : 1,
                            'platform'  => $platform->id,
                            'auction_name'  => $value[3],
                            'date'  => Carbon::parse($value[4].$value[5]),
                            'pak_time'  => Carbon::parse($value[6]),
                            'lots'   => $value[7],
                            'scr_lots'  => $value[8],
                            'status'  => $value[9],
                            'assign_to'  => $value[10],
                            'final_sheet'  => $value[11],
                            'notes'  => $value[12],
                            'created_by'  => 1,
                            'created_at'  => Carbon::now(),
                            'updated_at'  => null,
                        ]);
                }

    }

    


}
