<?php

namespace App\Http\Controllers;

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
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class DashboardController extends Controller
{

      public function dashboard(Request $request)
    {
            $totalVehicles = DB::table('vehicles')->count();
            $totalSoldVehicles= DB::table('vehicles')
            ->whereRaw("LOWER(bidding_status) = 'on sale'")
            ->count();

            $notSoldVehicles= DB::table('vehicles')
            ->whereRaw("LOWER(bidding_status) = 'Reserve not met'")
            ->count();

            $provisionalVehicles= DB::table('vehicles')
            ->whereRaw("LOWER(bidding_status) = 'provisional'")
            ->count();

            $totalAuctions = DB::table('auctions')->count();

            $onlineAuctions = DB::table('auctions')
                ->whereRaw("LOWER(auction_type) = 'Online Auction'")
                ->where('auction_date', '<=', Carbon::now())
                ->where('end_date', '>=', Carbon::now())
                ->count();

            $timeAuctions = DB::table('auctions')
                ->whereRaw("auction_type = 'time auction'")
                ->where('auction_date', '<=', Carbon::now())
                ->where('end_date', '>=', Carbon::now())
                ->count();

            $inProgressAuctions = DB::table('auctions')
            ->whereRaw("LOWER(status) = 'In Progress'")
            ->where('auction_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())
            ->count();

            $inProgressVehicles = DB::table('vehicles')
            ->join('auctions', 'vehicles.auction_id', '=', 'auctions.id')
            ->whereRaw("LOWER(status) = 'In Progress'")
            ->where('auctions.auction_date', '<=', Carbon::now())
            ->where('auctions.end_date', '>=', Carbon::now())
            ->count();

            $userId = auth()->id();

           $recentVehicles = RecentView::with(['vehicle.make', 'vehicle.model', 'vehicle.variant'])
            ->where('user_id', auth()->id())
            ->where('created_at', '>=', now()->subDays(2))
            ->get()
            ->pluck('vehicle');

            $alertVehicles = Notification::with(['vehicle.make', 'vehicle.model', 'vehicle.variant'])
                ->where('user_id', auth()->id())
                ->latest()
                ->get()
                ->pluck('vehicle')
                ->unique('id'); // sirf unique vehicles


            $data = [
                'notSoldVehicles' => $notSoldVehicles,
                'provisionalVehicles' => $provisionalVehicles,
                'inProgressVehicles' => $inProgressVehicles,
                'totalSoldVehicles' => $totalSoldVehicles, 
                'totalVehicles' => $totalSoldVehicles, 
                'totalAuctions' => $totalSoldVehicles, 
                'inProgressAuctions' => $totalSoldVehicles, 
                'onlineAuctions' => $totalSoldVehicles, 
                'timeAuctions' => $totalSoldVehicles, 
                'recentVehicles'      => $recentVehicles, 
                'alertVehicles'      => $alertVehicles, 
            ];

            return view('user.dashboard.dashboard',$data);

    }

    

     public function getTotalAuctions(Request $request)
    {

        $data = Vehicle::leftJoin('auctions', 'vehicles.auction_id', '=', 'auctions.id')
        ->select([
            DB::raw("COUNT(DISTINCT auctions.id) as total_auctions"),
             DB::raw("COUNT(DISTINCT CASE WHEN auctions.auction_type = 'Time Auction' THEN auctions.id END) as time_auctions"),
            DB::raw("COUNT(DISTINCT CASE WHEN auctions.status = 'In Progress' THEN auctions.id END) as inprogress_auctions"),
            DB::raw("COUNT(vehicles.id) as total_vehicles"),
            DB::raw("COUNT(CASE WHEN auctions.status = 'In Progress' THEN vehicles.id END) as inprogress_vehicles"),
            DB::raw("COUNT(CASE WHEN vehicles.bidding_status = 'On Sale' THEN vehicles.id END) as onsale_vehicles"),
            DB::raw("COUNT(CASE WHEN vehicles.bidding_status = 'Provisional' THEN vehicles.id END) as provisional_vehicles"),
            DB::raw("COUNT(*) - COUNT(DISTINCT vehicle_id) as duplicate_vehicles")
        ]);


        if($request->type == 'Intrest'){
            $intrest = Auth::user()->intrest->where('status','1')->first();
            if($intrest){
                $data = $data->where('vehicles.make_id',$intrest->make_id);
                $data = $data->where('vehicles.model_id',$intrest->model_id);
                $data = $data->where('vehicles.variant_id',$intrest->variant_id);
            }
        }


        $data = $data->first();
        $data['sold_vehicles'] =   $data['onsale_vehicles'] +  $data['provisional_vehicles'];
        return response()->json($data,200);

    }

      public function vehicleStates()
    {

        $data = Vehicle::leftJoin('auctions', 'vehicles.auction_id', '=', 'auctions.id')->select([      
            DB::raw("COUNT(vehicles.id) as total_vehicles"),
            DB::raw("COUNT(CASE WHEN auctions.status = 'Not sold' THEN vehicles.id END) as inprogress_vehicles"),
            DB::raw("COUNT(CASE WHEN vehicles.bidding_status = 'Sold' THEN vehicles.id END) as onsale_vehicles"),
            DB::raw("COUNT(CASE WHEN vehicles.bidding_status = 'Provisional' THEN vehicles.id END) as provisional_vehicles"),
            DB::raw("COUNT(*) - COUNT(DISTINCT vehicle_id) as duplicate_vehicles")
        ])->first();
          
        $data['sold_vehicles'] =   $data['onsale_vehicles'] +  $data['provisional_vehicles'];

        return response()->json($data,200);

    }


      public function getOnlineAuctions(Request $request)
    {

        DB::statement("SET SESSION sql_mode = (SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");

        $data = Vehicle::join('auctions','auctions.id', '=', 'vehicles.auction_id')
        ->join('auction_platform', 'auction_platform.id', '=', 'auctions.platform_id')
        ->where('auctions.auction_type','Online Auction');

        if($request->has('platform_id') && $request->platform_id != ''){
            $data = $data->whereIn('auction_platform.id',$request->platform_id);
        }

        $data = $data->select([
          "auction_platform.id",
          "auction_platform.name",
          DB::raw("COUNT(DISTINCT auctions.id) as total_auctions"),
          DB::raw("COUNT(CASE WHEN auctions.status = 'Update' THEN auctions.id END) as complete_auctions"),
          
          DB::raw("COUNT(DISTINCT vehicles.id) as vehicles_total"),
          DB::raw("COUNT(CASE WHEN vehicles.bidding_status = 'On Sale' THEN vehicles.id END) as onsale_vehicles"),
          DB::raw("COUNT(CASE WHEN vehicles.bidding_status = 'Provisional' THEN vehicles.id END) as provisional_vehicles"),
        ])
        ->groupBy('auction_platform.id')
        ->get();

        return response()->json($data,200);

    }


          public function getTimeAuctions(Request $request)
    {

        DB::statement("SET SESSION sql_mode = (SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");

        $data = Vehicle::join('auctions','auctions.id', '=', 'vehicles.auction_id')
        ->join('auction_platform', 'auction_platform.id', '=', 'auctions.platform_id')
        ->where('auctions.auction_type','Time Auction');


        if($request->has('platform_id') && $request->platform_id != ''){
            $data = $data->whereIn('auction_platform.id',$request->platform_id);
        }

        $data = $data->select([
          "auction_platform.id",
          "auction_platform.name",
          
          DB::raw("COUNT(DISTINCT auctions.id) as total_auctions"),
          "auctions.end_date",
        ])
        ->groupBy('auction_platform.id')
        ->get()
        ->map(function ($row) {
        if ($row->end_date) {
            $row->end_date = "<span>" . date('d-m-Y', strtotime($row->end_date)) . "</span><br><span>" . date('h:i A', strtotime($row->end_date)) . "</span>";
        } else {
            $row->end_date = "<span>N/A</span>";
        }

            return $row;
        });
        

        return response()->json($data,200);

    }


      public function onlineAuctions(Request $request)
    {
        if ($request->ajax()) {
            $onlineData = AuctionPlatform::leftJoin('auctions', 'auction_platform.id', '=', 'auctions.platform_id')
                ->whereRaw("LOWER(auctions.auction_type) = 'online auction'")
                ->select(
                    'auction_platform.name AS auction_platform_name',
                    'auctions.auction_type',
                    DB::raw('(  SELECT COUNT(*)  FROM vehicles v  JOIN auctions a ON v.auction_id = a.id  WHERE a.platform_id = auctions.platform_id  ) as car_count'),
                    DB::raw("(SELECT COUNT(*) FROM vehicles WHERE vehicles.auction_id = auctions.id AND vehicles.bidding_status = 'on sale') as remaining"),
                    DB::raw('(SELECT COUNT(*) FROM vehicles WHERE vehicles.auction_id = auctions.id) as lots'),
                )
                ->get()
                ->map(function ($auction) {
                    return [
                        $auction->auction_platform_name,
                        $auction->car_count,
                        $auction->remaining ?? 'N/A',
                        $auction->lots ?? 'N/A',
                    ];
                });

            return response()->json(['data' => $onlineData]);
        }
    }

    public function timeAuctions(Request $request)
    {
            if ($request->ajax()) {
                $timeData = Auctions::leftJoin('auction_platform', 'auction_platform.id', '=', 'auctions.platform_id')
                    ->whereRaw("LOWER(auctions.auction_type) = 'time auction'")
                    ->select(
                        'auction_platform.name AS auction_platform_name',
                        'auctions.auction_type',
                        DB::raw('(  SELECT COUNT(*)  FROM vehicles v  JOIN auctions a ON v.auction_id = a.id  WHERE a.platform_id = auctions.platform_id  ) as car_count'),
                        'auctions.end_date'
                    )
                    ->get()
                    ->map(function ($auction) {
                        return [
                            $auction->auction_platform_name,
                            $auction->car_count,
                            $auction->end_date,
                        ];
                    });

                return response()->json(['data' => $timeData]);
            }
    }


       public function lookbestauction(Request $request)
    {
            // if ($request->ajax()) {
                
                  $data = AuctionPlatform::join('auctions', 'auctions.platform_id', '=', 'auction_platform.id')
                  ->join('vehicles','vehicles.auction_id','=','auctions.id')
                  ->select(
                     'auction_platform.name AS label',
                      DB::raw("COUNT(vehicles.id) as total")
                  );

                  $intrest = Auth::user()->intrest->where('status','1')->first();
                  if($intrest){
                        $data = $data->where('vehicles.make_id',$intrest->make_id);
                        $data = $data->where('vehicles.model_id',$intrest->model_id);
                        $data = $data->where('vehicles.variant_id',$intrest->variant_id);
                  }


                  if($request->has('platform_id') && $request->platform_id != ''){
                    $data = $data->whereIn('auctions.platform_id',$request->platform_id);
                  }


                   $data = $data->groupBy('auction_platform.id', 'auction_platform.name')
                   ->get();

                    $colors = ['#9b5de5','#00bbf9','#00f5d4','#ef233c'];
                    $res = [];
                   
                    foreach ($data as $value) {

                        $randomKey = array_rand($colors);
                        $color = $colors[$randomKey];
                        
                        array_push($res,[
                            "color" => $color,
                            "label" => $value['label'],
                            "total" => $value['total'],
                            "borderColor" => "red",
                            "backgroundColor" => "red",
                        ]);

                    }

                return response()->json([
                    'colors' => array_column($res,'color'),
                    'labels' => array_column($res,'label'),
                    'total' => array_column($res,'total'),
                    'data' => $res,
                ]);

            // }
    }


        public function previousLots(Request $request)
    {
            // if ($request->ajax()) {

                DB::statement("SET SESSION sql_mode = (SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");
                    
                $data = AuctionPlatform::join('auctions', 'auctions.platform_id', '=', 'auction_platform.id')
                ->join('vehicles','vehicles.auction_id','=','auctions.id')
                ->groupBy('auction_platform.id')
                ->select(
                    'auction_platform.name AS auction_platform_name',
                    'auctions.auction_type',
                     DB::raw("COUNT(CASE WHEN vehicles.bidding_status = 'On Sale' THEN 1 END) as onSale"),
                     DB::raw("COUNT(CASE WHEN vehicles.bidding_status = 'Provisional' THEN 1 END) as onProvisional"),
                     DB::raw("COUNT(CASE WHEN vehicles.bidding_status = 'Reserve not met' THEN 1 END) as onReserve")
                );


                $intrest = Auth::user()->intrest->where('status','1')->first();
                if($intrest){
                    $data = $data->where('vehicles.make_id',$intrest->make_id);
                    $data = $data->where('vehicles.model_id',$intrest->model_id);
                    $data = $data->where('vehicles.variant_id',$intrest->variant_id);
                }

                if($request->has('platform_id') && $request->platform_id != ''){
                    $data = $data->whereIn('auction_platform.id',$request->platform_id);
                }

                $data = $data->get()->map(function($row){
                    return $row;
                });

                return response()->json([
                    'data' => $data,
                ]);

                // }

    }


       public function upComingVehicles(Request $request)
    {

            //Base Query
            $query = Vehicle::leftjoin('make','make.id','=','vehicles.make_id')
            ->leftjoin('model','model.id','=','vehicles.model_id')
            ->leftjoin('model_variant','model_variant.id','=','vehicles.variant_id');

            $intrest = Auth::user()->intrest->where('status','1')->first();
            if($intrest){
                $data = $query->where('vehicles.make_id',$intrest->make_id);
                $data = $query->where('vehicles.model_id',$intrest->model_id);
                $data = $query->where('vehicles.variant_id',$intrest->variant_id);
            }


            // Count total BEFORE limit/offset
            $total = $query->count(); 

            //Results
            $results = (clone $query)
                ->limit(10)
                ->select([
                 'vehicles.*',
                 'make.name as make_name',
                 'model.name as model_name',
                 'model_variant.name as variant_name',
                ])
                ->get()
                ->map(function ($item) {
                    
                    return [
                        'id' => $item->id,
                        'make_name' => $item->make_name,
                        'model_name' => $item->model_name,
                        'variant_name' =>  $item->variant_name,
                        'mileage' => $item->mileage,
                        'report' => $item->inspection_report,
                        'auto_boli' => 0,
                    ];

                });

            return response()->json([
                'data'         => $results,
                'total'        => $total,
            ]);


            return response()->json($data, 200);

    }




public function getInterestSummary(Request $request)
{
    $userId = auth()->id();
    $interestId = $request->id;

    $interest = Interest::where('interest.user_id', $userId)
        ->where('interest.id', $interestId)
        ->leftJoin('make', 'make.id', '=', 'interest.make_id')
        ->leftJoin('model', 'model.make_id', '=', 'make.id')
        ->leftJoin('model_variant', 'model_variant.model_id', '=', 'model.id')
        ->select(
            'interest.*',
            'make.name as make_name',
            'model.name as model_name',
            'model_variant.name as variant_name'
        )
        ->first();

    if (!$interest) {
        return response()->json([
            'success' => false,
            'message' => 'Interest not found.',
        ], 404);
    }



    $today = Carbon::today(); 

    $query = Vehicle::query()
        ->join('auctions', 'vehicles.auction_id', '=', 'auctions.id') 
        ->where('vehicles.make_id', $interest->make_id)
        ->where('vehicles.model_id', $interest->model_id)
         ->whereDate('auctions.auction_date', '>=', $today);

    if ($request->year) {
        $result = $this->year($query, $request->year);
    } elseif ($request->grade) {
        $result = $this->grade($query, $request->grade);
    } 
    // elseif ($request->mileage) {
    //     $result = $this->mileage($query, $request->mileage);
    // } 
    else {
        $vehicles = $query->get();
        $result = [
            'success' => true,
            'name'    => trim("{$interest->make_name} > {$interest->model_name} > {$interest->variant_name}", " >"),
            'years'    => $vehicles->pluck('year')->unique()->sort()->values(),
            'mileages' => $vehicles->pluck('mileage')->unique()->sort()->values(),
            'grades'   => $vehicles->pluck('grade')->unique()->sort()->values(),
        ];
    }

    return response()->json([
        'success' => true,
        'name'    => trim("{$interest->make_name} > {$interest->model_name} > {$interest->variant_name}", " >"),
        'years'   => $result['years'] ?? [],
        'mileages'=> $result['mileages'] ?? [],
        'grades'  => $result['grades'] ?? [],
    ]);



}




public function year($query, $year)
{
    
    $baseQuery = clone $query;

    if ($year) {
        $query->where('year', $year);
    }

 
    $years = $baseQuery->pluck('year')->unique()->sort()->values();


    $mileages = $query->pluck('mileage')->unique()->sort()->values();
    $grades   = $query->pluck('grade')->unique()->sort()->values();

    return [
        'query'    => $query,
        'years'    => $years,
        'mileages' => $mileages,
        'grades'   => $grades,
    ];
}


public function grade($query, $grade)
{

    $baseQuery = clone $query;

    if ($grade) {
        $query->where('grade', $grade);
    }



    $grades = $baseQuery->pluck('grade')->unique()->sort()->values();


    $years    = $query->pluck('year')->unique()->sort()->values();
    $mileages = $query->pluck('mileage')->unique()->sort()->values();

    return [
        'query'    => $query,
        'years'    => $years,
        'mileages' => $mileages,
        'grades'   => $grades,
    ];
}


// public function mileage($query, $mileage)
// {

//     $baseQuery = clone $query;

//     if ($mileage) {
//         $query->where('mileage', $mileage);
//     }

 

//     $mileages = $baseQuery->pluck('mileage')->unique()->sort()->values();
//     $years  = $query->pluck('year')->unique()->sort()->values();
//     $grades = $query->pluck('grade')->unique()->sort()->values();

//     return [
//         'query'    => $query,
//         'years'    => $years,
//         'mileages' => $mileages,
//         'grades'   => $grades,
//     ];
// }


public function stockAuctionHouse(Request $request)
{
    $userId = auth()->id();
    $interests = Interest::where('user_id', $userId)->get();

    if ($interests->isEmpty()) {
        return response()->json(['labels' => [], 'values' => [], 'colors' => []]);
    }

    $today = Carbon::now()->startOfDay();

    // ✅ Base for ALL vehicles (no year/grade filters)
    $totalVehiclesQuery = Vehicle::query()
        ->select(
            'vehicles.id',
            'vehicles.make_id',
            'vehicles.model_id',
            'auctions.platform_id',
            'auction_platform.name as platform_name'
        )
        ->join('auctions', 'vehicles.auction_id', '=', 'auctions.id')
        ->join('auction_platform', 'auctions.platform_id', '=', 'auction_platform.id')
        ->where('auctions.auction_date', '>=', $today);

    $totalVehicles = $totalVehiclesQuery->get();

    // ✅ Now filtered dataset (interest + year + grade)
    $filteredQuery = clone $totalVehiclesQuery;

    if ($request->filled('year')) {
        $filteredQuery->where('vehicles.year', $request->year);
    }
    if ($request->filled('grade')) {
        $filteredQuery->where('vehicles.grade', $request->grade);
    }

    $interestMakeIds = [];
    $interestModelIds = [];

    if ($request->filled('id')) {
        $selectedInterest = Interest::find($request->id);
        if ($selectedInterest) {
            $interestMakeIds = [$selectedInterest->make_id];
            $interestModelIds = [$selectedInterest->model_id];
        }
    } else {
        $interestMakeIds = $interests->pluck('make_id')->toArray();
        $interestModelIds = $interests->pluck('model_id')->toArray();
    }

    $filteredVehicles = $filteredQuery->get();

    // ✅ Combine total + interest
    $platformData = $totalVehicles->groupBy('platform_id')->map(function ($allItems) use ($filteredVehicles, $interestMakeIds, $interestModelIds) {
        $platformName = $allItems->first()->platform_name;
        $platformId = $allItems->first()->platform_id;

        $totalCount = $allItems->count();

        // Interest count only from filtered dataset
        $interestCount = $filteredVehicles
            ->filter(fn($v) =>
                $v->platform_id == $platformId &&
                in_array($v->make_id, $interestMakeIds) &&
                in_array($v->model_id, $interestModelIds)
            )
            ->count();

        return [
            'label' => $platformName,
            'total' => $totalCount,
            'interest' => $interestCount,
        ];
    })
    ->sortByDesc('interest')
    ->values();

    $labels = $platformData->pluck('label')->toArray();
    $values = $platformData->map(fn($p) => [
        'total' => $p['total'],
        'interest' => $p['interest'],
    ])->toArray();

    // ✅ Color generation
    $baseBlue = '#0789e0';
    $colors = [];
    foreach ($labels as $i => $label) {
        $ratio = 0.4 - (0.8 * ($i / max(1, count($labels) - 1)));
        [$r, $g, $b] = [7, 137, 224]; // base RGB
        $r = min(max(0, $r * (1 + $ratio)), 255);
        $g = min(max(0, $g * (1 + $ratio)), 255);
        $b = min(max(0, $b * (1 + $ratio)), 255);
        $colors[] = sprintf("#%02x%02x%02x", round($r), round($g), round($b));
    }

    return response()->json([
        'labels' => $labels,
        'values' => $values,
        'colors' => $colors,
    ]);
}




public function getInterestDashboard(Request $request)
{
    $userId = auth()->id();
    $interestId = $request->id;


    $interest = Interest::where('user_id', $userId)
        ->where('id', $interestId)
        ->first();

    if (!$interest) {
        return response()->json([
            'success' => false,
            'message' => 'Interest not found.',
        ], 404);
    }

    $now = now();
    $vehicleBaseQuery = Vehicle::leftJoin('auctions', 'vehicles.auction_id', '=', 'auctions.id')
        ->where('vehicles.make_id', $interest->make_id)
        ->where('vehicles.model_id', $interest->model_id)
        ->whereDate('auctions.auction_date', '>=', $now);


    if ($request->year) {
        $vehicleBaseQuery->where('vehicles.year', $request->year);
    }
    if ($request->grade) {
        $vehicleBaseQuery->where('vehicles.grade', $request->grade);
    }
    // if ($request->mileage) {
    //     $vehicleBaseQuery->where('vehicles.mileage', '<=', $request->mileage);
    // }


    $totalVehicles = (clone $vehicleBaseQuery)->count();


    $soldVehicles = (clone $vehicleBaseQuery)
        ->where('bidding_status', 'sold')
        ->count();

 
    $unsoldVehicles = (clone $vehicleBaseQuery)
        ->where('bidding_status', 'Not sold')
        ->count();

    $totalAuctions = (clone $vehicleBaseQuery)
        ->distinct('auction_id')
        ->count('auction_id');


    $onlineAuctions = (clone $vehicleBaseQuery)
        ->where('auction_type', 'Online Auction')
        ->distinct('auction_id')
        ->count('auction_id');


    $offlineAuctions = (clone $vehicleBaseQuery)
        ->where('auction_type', 'Time Auction')
        ->distinct('auction_id')
        ->count('auction_id');

    $totalVehiclesInProgress = (clone $vehicleBaseQuery)
        ->where('auctions.status', 'In Progress')
        ->count();


    $vehiclesInProgress = (clone $vehicleBaseQuery)
        ->where('auctions.status', 'In Progress')
        ->get(['vehicles.id']);


    $totalVehiclesInProgressCheck = $vehiclesInProgress->count();
    
    $pastVehicleRegs = Vehicle::join('auctions', 'vehicles.auction_id', '=', 'auctions.id')
        ->whereDate('auctions.auction_date', '<', $now)
        ->pluck('vehicles.reg') 
        ->toArray();

 
    $vehiclesInReauction = (clone $vehicleBaseQuery)
        ->whereIn('vehicles.reg', $pastVehicleRegs)
        ->count();


    return response()->json([
        'success' => true,
        'stats' => [
            'total_auctions' => $totalAuctions,
            'online_auctions' => $onlineAuctions,
            'offline_auctions' => $offlineAuctions,
            'vehicles_in_progress_auctions' => $totalVehiclesInProgress,
            'totalVehiclesInProgress' => $totalVehiclesInProgressCheck,
            'total_vehicles' => $totalVehicles,
            'sold_vehicles' => $soldVehicles,
            'unsold_vehicles' => $unsoldVehicles,
            'vehicles_in_reauction' => $vehiclesInReauction,
        ],
    ]);
}


public function getValuation(Request $request)
{
    $userId = auth()->id();
    $interestId = $request->id;

    $interest = Interest::where('user_id', $userId)
        ->where('id', $interestId)
        ->first();

    if (!$interest) {
        return response()->json([
            'success' => false,
            'message' => 'Interest not found.',
        ], 404);
    }

    $today = now()->startOfDay();

    $data = Vehicle::leftJoin('auctions', 'vehicles.auction_id', '=', 'auctions.id')
        ->leftJoin('auction_platform', 'auctions.platform_id', '=', 'auction_platform.id')
        ->leftJoin('auction_center', 'vehicles.center_id', '=', 'auction_center.id')
        ->where('vehicles.make_id', $interest->make_id)
        ->where('vehicles.model_id', $interest->model_id)
        ->whereDate('auctions.auction_date', '>=', $today)
        ->when($request->year, fn($q) => $q->where('vehicles.year', $request->year))
        ->when($request->grade, fn($q) => $q->where('vehicles.grade', $request->grade))
        ->select([
            'auctions.id as auction_id',
            'auctions.name as auction_name',
            'auction_platform.name as platform_name',
            'auction_platform.image as platform_image',
            DB::raw('MIN(auction_center.name) as center_name'),
            DB::raw('COUNT(vehicles.id) as total_vehicles'),
            DB::raw('MIN(vehicles.cap_clean) as min_cap_clean'),
            DB::raw('MAX(vehicles.cap_clean) as max_cap_clean'),
            DB::raw('MIN(vehicles.cap_average) as min_cap_average'),
            DB::raw('MAX(vehicles.cap_average) as max_cap_average'),
            DB::raw('ROUND(AVG(vehicles.cap_average)) as one_week_average')
        ])
        ->groupBy('auctions.id', 'auctions.name', 'auction_platform.name' , 'auction_platform.image')
        ->orderByDesc('total_vehicles') 
        ->get();

    $formatted = $data->map(function ($row) {
          $formatMoney = function ($value) {
        if (!$value) return '£0';
        return '£' . number_format($value / 1000, 1) . 'k';
    };
        return [
            'auction_name' => $row->auction_name,
            'platform_name' => $row->platform_name,
            'platform_image' => $row->platform_image,
            'center_name' => $row->center_name,
            'total_vehicles' => $row->total_vehicles,
            'cap_clean_range' => $formatMoney($row->min_cap_clean) . ' - ' . $formatMoney($row->max_cap_clean),
            'cap_average_range' => $formatMoney($row->min_cap_average) . ' - ' . $formatMoney($row->max_cap_average),
            'one_week_average' => $formatMoney($row->one_week_average),
        ];
    });

    return response()->json([
        'success' => true,
        'total_auctions' => $formatted->count(),
        'data' => $formatted,
    ]);
}







}

