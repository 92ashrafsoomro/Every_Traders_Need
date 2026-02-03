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
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class DashboardController extends Controller
{


      public function counters(Request $request)
    {   
            DB::statement("SET SESSION sql_mode = (SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");
          
            $id  =  $request->user()->id;

    
            $stats = Vehicle::when($request->start_date, function($q) use ($request) {
                            return $q->whereDate('auctions.auction_date','>=',$request->start_date);
                        })
                        ->when($request->end_date, function($q) use ($request) {
                            return $q->whereDate('auctions.auction_date','<=',$request->end_date);
                        })
                        ->leftJoin('auctions', 'vehicles.auction_id', '=', 'auctions.id')
                        ->selectRaw("
                            COUNT(DISTINCT auctions.id) as total_auctions,

                            COUNT(DISTINCT CASE WHEN auctions.auction_type = 2 THEN auctions.id END) as live_auctions,

                            COUNT(DISTINCT CASE WHEN auctions.auction_type = 1 THEN auctions.id END) as time_auctions,

                            COUNT(DISTINCT CASE WHEN auctions.status = 4 THEN auctions.id END) as in_progress_auction,

                            COUNT(vehicles.id) as total_vehicles,
                            
                            SUM(CASE WHEN vehicles.bidding_status = 'Sold' THEN 1 ELSE 0 END) as sold_vehicles,

                            SUM(CASE WHEN auctions.status = 4 THEN 1 ELSE 0 END) as in_progress_vehicle,
                            
                            /* Subquery for Re-auctions */
                            (SELECT COUNT(*) FROM (
                                        SELECT reg FROM vehicles 
                                        GROUP BY auction_id, reg 
                                        HAVING COUNT(reg) > 1
                                    ) as re_table) as vehicles_in_reauction,

                            /* Subquery for Remaining Re-auctions (Status 5) */
                            (SELECT COUNT(*) FROM (
                                SELECT v.reg FROM vehicles v
                                JOIN auctions a ON v.auction_id = a.id
                                WHERE a.status = 5
                                GROUP BY v.auction_id, v.reg 
                                HAVING COUNT(v.reg) > 1
                            ) as rem_table) as vehicles_in_remaining
                        ")
                        ->first();
                    
            return response()->json([
                'success' => true,
                'data' => $stats,
            ], 200);
            
    }


        public function vehicleStates(Request $request)
    {
            
            $data = Vehicle::leftJoin('auctions', 'vehicles.auction_id', '=', 'auctions.id')
                ->when($request->start_date, function($q) use ($request) {
                            return $q->whereDate('auctions.auction_date','>=',$request->start_date);
                        })
                        ->when($request->end_date, function($q) use ($request) {
                            return $q->whereDate('auctions.auction_date','<=',$request->end_date);
                        })
                ->select([
                    DB::raw("COUNT(vehicles.id) as total_vehicles"),
                    DB::raw("COUNT(CASE WHEN auctions.status = 4 THEN vehicles.id END) as inprogress_vehicles"),
                    DB::raw("COUNT(CASE WHEN auctions.status = 5 THEN vehicles.id END) as done_vehicles"),
                    DB::raw("COUNT(CASE WHEN auctions.status != 5 THEN vehicles.id END) as remaining_vehicles"),

                    DB::raw("COUNT(CASE WHEN vehicles.bidding_status = 'Sold' THEN vehicles.id END) as sold_vehicles"),
                    DB::raw("COUNT(CASE WHEN vehicles.bidding_status = 'Not Sold' THEN vehicles.id END) as not_sold_vehicles"),
                    DB::raw("COUNT(CASE WHEN vehicles.bidding_status = 'Provisional' THEN vehicles.id END) as provisional_vehicles"),
                ])
                ->first();

            // 🧩 Calculate sold_vehicles dynamically
            // $data->sold_vehicles = $data->onsale_vehicles + $data->provisional_vehicles;

            return response()->json([
                'data' => $data,
            ], 200);
    }


        public function onlineAuctions(Request $request)
    {   

        $length = (int) $request->input('length',1000);
        $page = (int) $request->input('page', 1);
        $offset = ($page - 1) * $length;
    
        $query = AuctionPlatform::leftJoin('auctions','auctions.platform_id','=','auction_platform.id')
                ->where('auctions.auction_type',$request->type)
                ->when($request->start_date, function($q) use ($request) {
                            return $q->whereDate('auctions.auction_date','>=',$request->start_date);
                })
                ->when($request->end_date, function($q) use ($request) {
                            return $q->whereDate('auctions.auction_date','<=',$request->end_date);
                })
                ->when($request->platform, function($q) use ($request) {
                    return $q->where('auction_platform.id',$request->platform);
                });


        $count = (clone $query)->count();

        $data =  $query->select([
                    'auction_platform.id AS auction_platform_id',        
                    'auction_platform.name AS auction_platform_name',
                    'auctions.auction_type',
                    'auctions.end_date',
                    DB::raw('(SELECT COUNT(*)  FROM vehicles v  JOIN auctions a ON v.auction_id = a.id  WHERE a.platform_id = auctions.platform_id  ) as car_count'),
                    DB::raw("(SELECT COUNT(*) FROM vehicles WHERE vehicles.auction_id = auctions.id AND vehicles.bidding_status = 'on sale') as remaining"),
                    DB::raw('(SELECT COUNT(*) FROM vehicles WHERE vehicles.auction_id = auctions.id) as lots'),
                ])
                ->skip($offset)
                ->take($length)
                ->get()
                ->map(function ($item) {
                    return $item;
                });

        return response()->json([
            'total' => $count,
            'page' => $page,
            'offset' => $offset,
            'last_page' => ceil($count / $length),
            'data' => $data,
        ]);
        
    }


        public function timeAuctions(Request $request)
    {
            $timeData = Auctions::leftJoin('auction_platform', 'auction_platform.id', '=', 'auctions.platform_id')
                ->whereRaw("LOWER(auctions.auction_type) = 'time auction'")
                ->when($request->platform, function($q) use ($request) {
                    return $q->where('auction_platform', $request->platform);
                })
                ->select(
                    'auction_platform.name AS auction_platform_name',
                    'auctions.auction_type',
                    DB::raw('(  SELECT COUNT(*)  FROM vehicles v  JOIN auctions a ON v.auction_id = a.id  WHERE a.platform_id = auctions.platform_id  ) as car_count'),
                    'auctions.end_date'
                )
                ->get()
                ->map(function ($item) {
                    return $item;
                });

            return response()->json(['data' => $timeData]);   
    }






}

