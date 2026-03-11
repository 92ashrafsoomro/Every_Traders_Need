<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Auction;
use App\Models\AuctionPlatform;
use App\Models\Auctions;
use App\Models\RecentView;
use App\Models\Notification;
use App\Models\Membership;
use App\Models\MembershipPayment;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Interest;
use App\Models\AuctionCenter;
use App\Models\UserAuction;
use App\Models\UserNotificationAlert;
use App\Models\UserNotificationSetting;
use App\Models\UserVehicleAlert;
use App\Models\Vehicle;
use App\Models\NotificationList;
use App\Services\NotificationService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class NotificationController extends Controller
{



        public function myNotifications(Request $request)
    { 


        return response()->json(NotificationService::GetNotification($request),200);

        // $perPage = (int) $request->input('length', 10);
        // $page = (int) $request->input('page', 1);
        // $offset = ($page - 1) * $perPage;
        // $id = $request->user()->id;

        // $query = UserNotificationAlert::query();

        // $total = (clone $query)->count();
        // $totalNew = (clone $query)->count();
        // $results = $query->select([
        //         'user_notifications_alert.*'
        //     ])
        //     ->offset($offset)
        //     ->limit($perPage)
            
        //     ->get()
        //     ->map(function ($item) {

        //         $item->ago =  $item->created_at->diffForHumans();

        //     return $item;
        // });

        // return response()->json([
        //     'offset' => $offset,
        //     'total' => $total,
        //     'totalNew' => $totalNew,
        //     'per_page' => $perPage,
        //     'current_page' => $page,
        //     'last_page' => ceil($total / $perPage),
        //     'data' => $results,
        // ]);

    }



       public function userNotification(Request $request)
    { 

        $perPage = (int) $request->input('length', 10);
        $page = (int) $request->input('page', 1);
        $offset = ($page - 1) * $perPage;
        $id = $request->user()->id;

        $query = UserNotificationAlert::query();

        $total = (clone $query)->count();
        $totalNew = (clone $query)->count();
        $results = $query->select([
                'user_notifications_alert.*'
            ])
            ->offset($offset)
            ->limit($perPage)
            
            ->get()
            ->map(function ($item) {

                $item->ago =  $item->created_at->diffForHumans();

            return $item;
        });

        return response()->json([
            'offset' => $offset,
            'total' => $total,
            'totalNew' => $totalNew,
            'per_page' => $perPage,
            'current_page' => $page,
            'last_page' => ceil($total / $perPage),
            'data' => $results,
        ]);

    }

    
        public function markRead(Request $request,$id)
    { 

        $query = UserNotificationAlert::where('id',$id)->first();
        if(!$query){
            return response()->json(['message' => 'Record Not Found'],500);
        }

        $query->is_read = 1;
        $query->save();

        return response()->json([
            'message' => 'Success',
            'data' => $query
        ],200);
    }


       public function userAlertList(Request $request)
    {

        $userId = $request->user()->id;
        // $length = $request->input('length', 50);
        // $page   = $request->input('page', 1);
        // $offset = ($page - 1) * $length;

        $baseQuery = UserVehicleAlert::join('vehicles','vehicles.id','=','user_vehicle_alerts.vehicle_id')
            ->leftJoin('auctions','auctions.id', '=','vehicles.auction_id')
            ->leftJoin('auction_status','auction_status.id','=','auctions.status') 
            ->leftJoin('auction_center','auction_center.id', '=','vehicles.center_id')    
            ->where('user_vehicle_alerts.user_id', $userId);

            // Apply filters
            if($request->has('make') && $request->make != '') {
                $baseQuery->where('vehicles.make_id',$request->make);
            }

            if($request->has('model') && $request->model != '') {
                $baseQuery->where('vehicles.model_id',$request->model);
            }

            if($request->has('year') && $request->year != '') {
                $baseQuery->where('vehicles.year',$request->year);
            }

            if($request->has('reg_search') && $request->reg_search != '') {
                $baseQuery->where('vehicles.reg', 'like', '%'.$request->reg_search.'%');
            }

            if($request->has('vehicle_id') && $request->vehicle_id != '') {
                $baseQuery->where('vehicles.id',$request->vehicle_id);
            }

        

            // ✅ Clone the query before using count()
            $countQuery = (clone $baseQuery)->count(DB::raw('distinct user_vehicle_alerts.id'));
            $alerts = $baseQuery->select([
                    'user_vehicle_alerts.id as notification_id',
                    'user_vehicle_alerts.created_at as notified_at',
                    
                    'vehicles.id as vehicle_id',
                    'vehicles.title as vehicle',
                    'vehicles.year',
                    'vehicles.cc',
                    'vehicles.images as image',
                    'vehicles.reg',
                    'vehicles.mileage',
                    'vehicles.transmission',
                    'vehicles.auction_id',
                    'vehicles.last_bid',
                    'vehicles.cap_clean',
                    'vehicles.cap_below',
                    'vehicles.cap_average',
                    'vehicles.autotrader_retail_value',

                    'auctions.name as auction_name',
                    'auctions.auction_date',
                    'auctions.auction_type',
                    'auctions.end_date',
                    'auction_status.title as auction_status',
                    'auction_center.name as auction_center',
                ])
                ->orderByDesc('user_vehicle_alerts.id')
                // ->skip($offset)
                // ->take($length)
                ->get();

            return response()->json([
                'recordsTotal' => $countQuery,
                'recordsFiltered' => $countQuery,
                'data' => $alerts,
            ]);

    }



       public function userAuctionList(Request $request)
    {

        DB::statement("SET SESSION sql_mode = (SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");
        $userId = $request->user()->id;
        // $length = $request->input('length', 50);
        // $page   = $request->input('page', 1);
        // $offset = ($page - 1) * $length;

        $baseQuery = UserAuction::leftJoin('auctions','auctions.id', '=','user_auctions.auction_id')
             ->leftJoin('auction_platform','auction_platform.id', '=','auctions.platform_id')
             ->leftJoin('auction_status','auction_status.id','=','auctions.status')
             ->leftJoin('vehicles','vehicles.auction_id','=','auctions.id')
            ->where('user_auctions.user_id', $userId);

            // Apply filters
            if($request->has('make') && $request->make != ''){
                $baseQuery->where('vehicles.make_id',$request->make);
            }

            if($request->has('model') && $request->model != ''){
                $baseQuery->where('vehicles.model_id',$request->model);
            }

            if($request->has('year') && $request->year != ''){
                $baseQuery->where('vehicles.year',$request->year);
            }

            if($request->has('reg_search') && $request->reg_search != ''){
                $baseQuery->where('vehicles.reg', 'like', '%'.$request->reg_search.'%');
            }

            if($request->has('vehicle_id') && $request->vehicle_id != ''){
                $baseQuery->where('vehicles.id',$request->vehicle_id);
            }

            // ✅ Clone the query before using count()
            $countQuery = (clone $baseQuery)->count(DB::raw('distinct user_auctions.id'));
            $alerts = $baseQuery->select([
                 'auctions.*',
                 'auction_platform.name as platform_name',
                 'auction_status.title as auction_status',
                 DB::raw('COUNT(vehicles.id) as vehicles_count'),
                ])
                ->groupby('user_auctions.id')
                ->orderByDesc('user_auctions.id')
                // ->skip($offset)
                // ->take($length)
                ->get();

            return response()->json([
                'recordsTotal' => $countQuery,
                'recordsFiltered' => $countQuery,
                'data' => $alerts,
            ]);

    }


        public function userWatchList(Request $request)
    {

        $user = $request->user();
        $userId = $user->id;
        $length = $request->input('length', 50);
        $page   = $request->input('page', 1);
        $offset = ($page - 1) * $length;

        $userMembership = $user->memberships()->where('membership_status', 1)->first();

        if ($userMembership->plan_id == 1) {
            $length = 10;
            $offset = 0;
        }

        $baseQuery = RecentView::join('vehicles','vehicles.id','=','recent_views.vehicle_id')
            ->leftJoin('auctions','auctions.id', '=','vehicles.auction_id')
            ->leftJoin('auction_platform','auction_platform.id', '=','auctions.platform_id')
            ->where('recent_views.user_id', $userId);

            // Apply filters
            if($request->has('make') && $request->make != '') {
                $baseQuery->where('vehicles.make_id',$request->make);
            }

            if($request->has('model') && $request->model != '') {
                $baseQuery->where('vehicles.model_id',$request->model);
            }

            if($request->has('year') && $request->year != '') {
                $baseQuery->where('vehicles.year',$request->year);
            }

            if($request->has('reg_search') && $request->reg_search != '') {
                $baseQuery->where('vehicles.reg', 'like', '%'.$request->reg_search.'%');
            }


            // ✅ Clone the query before using count()
            $countQuery = (clone $baseQuery)->count(DB::raw('distinct recent_views.id'));
            $data = $baseQuery->select([
                        'vehicles.id', 
                        'vehicles.title as vehicle', 
                        'vehicles.year', 
                        'vehicles.cc', 
                        'vehicles.images as image',
                        'vehicles.reg',
                        'vehicles.mileage', 
                        'vehicles.transmission', 
                        'vehicles.auction_id', 
                        'vehicles.last_bid',
                        'vehicles.cap_clean',
                        'vehicles.cap_below',
                        'vehicles.cap_average',
                        'vehicles.autotrader_retail_value',
                        'vehicles.bidding_status as bidding_status',                      
                        'auction_platform.name as platform_title',
                        'auctions.auction_date as auction_date',                      
                ])
                ->orderByDesc('recent_views.id')
                ->skip($offset)
                ->take($length)
                ->get();

            if ($userMembership->plan_id == 1) {
                $displayCount = ($countQuery > 10) ? 10 : $countQuery;
            } else {
                $displayCount = $countQuery;
            }

            return response()->json([
                'recordsTotal' => $displayCount,
                'recordsFiltered' => $displayCount,
                
                'page' => $page,
                'offset' => $offset,
                'last_page' => ceil($displayCount / $length),
                'data' => $data,
            ]);

    }


        public function addInWatchList(Request $request)
    { 

        $validator = Validator::make($request->all(),[
            'vehicle_id' => 'required|exists:vehicles,id',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }

        $checkExisting = RecentView::where(['user_id' => $request->user()->id, 'vehicle_id' => $request->vehicle_id])->first();
        if($checkExisting){
            return response()->json([
                'message' => 'Success',
                'data' => $checkExisting
            ],200);
        }

        $query = RecentView::create([
            'user_id' => $request->user()->id,
            'vehicle_id' => $request->vehicle_id,
            'created_at' => Carbon::now(),
        ]);

        return response()->json([
            'message' => 'Success',
            'data' => $query
        ],200);
        
    }


    public function addInVehicleAlert(Request $request)
    { 


        $validator = Validator::make($request->all(),[
            'vehicle_id' => 'required|exists:vehicles,id',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }

        $checkExisting = UserVehicleAlert::where(['user_id' => $request->user()->id, 'vehicle_id' => $request->vehicle_id])->first();
        if($checkExisting){
            return response()->json([
                'message' => 'Success',
                'data' => $checkExisting
            ],200);
        }
        $user = $request->user();
        $currentMembership = $user->memberships()->where('membership_status', 1)->first();
   

        if ($currentMembership && $currentMembership->plan_id == 1) {
            $alertCount = UserVehicleAlert::where('user_id', $user->id)->count();

            if ($alertCount >= 10) {
                return response()->json([
                    'message' => 'Limit reached. Basic plan allows only 10 vehicle alerts. Please upgrade your plan.',
                ], 422); 
            }
        }

        $query = UserVehicleAlert::create([
            'user_id' => $request->user()->id,
            'vehicle_id' => $request->vehicle_id,
            'created_at' => Carbon::now(),
        ]);

        return response()->json([
            'message' => 'Success',
            'data' => $query
        ],200);
        
    }


    public function addInUserAuction(Request $request)
    { 

        $validator = Validator::make($request->all(),[
            'auction_id' => 'required|exists:auctions,id',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }

        $checkExisting = UserAuction::where([
            'user_id' => $request->user()->id, 
            'auction_id' => $request->auction_id
        ])->first();
        if($checkExisting){
            return response()->json([
                'message' => 'Success',
                'data' => $checkExisting
            ],200);
        }

        $query = UserAuction::create([
            'user_id' => $request->user()->id,
            'auction_id' => $request->auction_id,
            'created_at' => Carbon::now(),
        ]);

        return response()->json([
            'message' => 'Success',
            'data' => $query
        ],200);
        
    }




      public function removeInVehicleAlert(Request $request)
    { 

        $validator = Validator::make($request->all(),[
            'vehicle_id' => 'required|exists:vehicles,id',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }

        $checkExisting = UserVehicleAlert::where(['user_id' => $request->user()->id, 'vehicle_id' => $request->vehicle_id])->delete();

        return response()->json([
            'message' => 'Record Removed',
            'data' => $checkExisting
        ],200);
        
    }


      public function removeInUserAuction(Request $request)
    { 

        $validator = Validator::make($request->all(),[
            'auction_id' => 'required|exists:auctions,id',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }

        $checkExisting = UserAuction::where(['user_id' => $request->user()->id, 'auction_id' => $request->auction_id])->delete();

        return response()->json([
            'message' => 'Record Removed',
            'data' => $checkExisting
        ],200);
        
    }


public function notificationSettings(Request $request)
{
    $userId = $request->user()->id;

    $data = NotificationList::leftJoin('user_notification_settings as uns', function ($join) use ($userId) {
        $join->on('notifications_list.id', '=', 'uns.type')
            ->where('uns.user_id', $userId);
    })
    ->select(
        'notifications_list.id',
        'notifications_list.name',
        \DB::raw('COALESCE(uns.email,0) as email'),
        \DB::raw('COALESCE(uns.browser,0) as browser'),
        \DB::raw("COALESCE(uns.send_preference,'online') as send_preference")
    )
    ->get();

    return response()->json([
        'status' => true,
        'data' => $data
    ]);
}

public function saveNotificationSettings(Request $request)
{
 
    $userId = $request->user()->id;

    $settings = $request->input('settings', []);

    foreach ($settings as $s) {
        // Validate minimal required fields
        if (!isset($s['notification_id'])) continue;

        UserNotificationSetting::updateOrCreate(
            [
                'user_id' => $userId,
                'type' => $s['notification_id'],
            ],
            [
                'email' => isset($s['email']) ? $s['email'] : 0,
                'browser' => isset($s['browser']) ? $s['browser'] : 0,
                'send_preference' => 'online', 
            ]
        );
    }

    return response()->json([
        'status' => true,
        'message' => 'Notification settings saved successfully'
    ]);
}
    


}

