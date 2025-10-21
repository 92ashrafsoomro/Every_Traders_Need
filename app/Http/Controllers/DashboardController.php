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
          "auctions.auction_date",
        ])
        ->groupBy('auction_platform.id')
        ->get()
        ->map(function ($row) {
            $row->end_date =  "<span>".date('d-m-Y',strtotime($row->auction_date))."</span><br><span>".date('h:s A',strtotime($row->auction_date))."</span>";
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



      public function getValuation(Request $request)
    {

              DB::statement("SET SESSION sql_mode = (SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");

              $month1 = now()->subMonths(2)->format('M Y'); // e.g. May 2025
              $month2 = now()->subMonths(1)->format('M Y'); // e.g. Jun 2025
              $month3 = now()->format('M Y');  

              $data = AuctionPlatform::join('auctions', 'auctions.platform_id', '=', 'auction_platform.id')
               ->join('vehicles', 'vehicles.auction_id', '=', 'auctions.id')
               ->groupBy('auction_platform.id')  
               ->select(
                   'auction_platform.name AS platform_name',
                    DB::raw("COUNT(vehicles.id) as Total"),
                    DB::raw("MIN(vehicles.last_bid) as min_price"),
                    DB::raw("MAX(vehicles.last_bid) as max_price"),
                    DB::raw("AVG(vehicles.last_bid) as avg_price"),
                    DB::raw("AVG(CASE WHEN DATE_FORMAT(auctions.auction_date, '%Y-%m') = '" . now()->subMonths(2)->format('Y-m') . "' THEN vehicles.last_bid END) AS price_month_1"),
                    DB::raw("AVG(CASE WHEN DATE_FORMAT(auctions.auction_date, '%Y-%m') = '" . now()->subMonths(1)->format('Y-m') . "' THEN vehicles.last_bid END) AS price_month_2"),
                    DB::raw("AVG(CASE WHEN DATE_FORMAT(auctions.auction_date, '%Y-%m') = '" . now()->format('Y-m') . "' THEN vehicles.last_bid END) AS price_month_3")
               );


               if($request->has('platform_id') && $request->platform_id != ''){
                    $data = $data->whereIn('auction_platform.id',$request->platform_id);
               }


               $intrest = Auth::user()->intrest->where('status','1')->first();
               if($intrest){
                    $data = $data->where('vehicles.make_id',$intrest->make_id);
                    $data = $data->where('vehicles.model_id',$intrest->model_id);
                    $data = $data->where('vehicles.variant_id',$intrest->variant_id);
               }
             

              //Editing
               $data = $data->get()->map(function($row){
              
                    $month2 = $row->price_month_2 ?? 0;
                    $month3 = $row->price_month_3 ?? 0;

                    if($month2 == 0 && $month3 == 0){
                        $percentageChange = 0;
                    }elseif($month2 == 0){
                        $percentageChange = 100;
                    }else{
                        $percentageChange = (($month2 - $month3) / $month2) * 100;
                    }
                    $row->percent = $percentageChange;

                    if ($percentageChange > 0) {
                        $row->icon = '<span style="color: green;">&#9650; '.number_format($percentageChange, 1).'%</span>';
                    } elseif ($percentageChange < 0) {
                        $row->icon = '<span style="color: red;">&#9660; '.number_format(abs($percentageChange), 1).'%</span>';
                    } else {
                        $row->icon = '<span style="color: gray;">0%</span>';
                    }

                    return $row;
            });


            return response()->json([
                'labels' => [$month1, $month2, $month3],
                'data' => $data,
            ]);

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



    $query = Vehicle::query()
        ->where('make_id', $interest->make_id)
        ->where('model_id', $interest->model_id);

    if ($request->year) {
        $result = $this->year($query, $request->year);
    } elseif ($request->grade) {
        $result = $this->grade($query, $request->grade);
    } elseif ($request->mileage) {
        $result = $this->mileage($query, $request->mileage);
    } else {
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


public function mileage($query, $mileage)
{

    $baseQuery = clone $query;

    if ($mileage) {
        $query->where('mileage', $mileage);
    }

 

    $mileages = $baseQuery->pluck('mileage')->unique()->sort()->values();
    $years  = $query->pluck('year')->unique()->sort()->values();
    $grades = $query->pluck('grade')->unique()->sort()->values();

    return [
        'query'    => $query,
        'years'    => $years,
        'mileages' => $mileages,
        'grades'   => $grades,
    ];
}


public function stockAuctionHouse()
{
    $userId = auth()->id();

    $interests = Interest::where('user_id', $userId)->get();

    if ($interests->isEmpty()) {
        return response()->json([
            'labels' => [],
            'values' => [],
            'colors' => [],
            'ratios' => [],
        ]);
    }

    // Calculate one month ago
   $today = Carbon::now()->startOfDay();

    $allVehicles = Vehicle::query()
        ->select(
            'vehicles.id',
            'vehicles.make_id',
            'vehicles.model_id',
            'auctions.platform_id',
            'auction_platform.name as platform_name',
            'auctions.auction_date'
        )
        ->join('auctions', 'vehicles.auction_id', '=', 'auctions.id')
        ->join('auction_platform', 'auctions.platform_id', '=', 'auction_platform.id')
         ->where('auctions.auction_date', '>=', $today)
        ->get();

    if ($allVehicles->isEmpty()) {
        return response()->json([
            'labels' => [],
            'values' => [],
            'colors' => [],
            'ratios' => [],
        ]);
    }

    $platformData = $allVehicles->groupBy('platform_id')->map(function ($items) use ($interests) {
        $platformName = $items->first()->platform_name;
        $totalVehicles = $items->count();

        $interestCount = $items->filter(function ($vehicle) use ($interests) {
            foreach ($interests as $interest) {
                if ($vehicle->make_id == $interest->make_id && $vehicle->model_id == $interest->model_id) {
                    return true;
                }
            }
            return false;
        })->count();

        $ratio = $totalVehicles > 0
            ? round(($interestCount / $totalVehicles) * 100, 2)
            : 0;

        return [
            'label' => $platformName,
            'total' => $totalVehicles,
            'interest' => $interestCount,
            'ratio' => $ratio,
        ];
    })
    ->sortByDesc('interest')
    ->values(); 

    $labels = $platformData->pluck('label')->toArray();
    $values = $platformData->map(fn($p) => [
        'total' => $p['total'],
        'interest' => $p['interest'],
    ])->toArray();
    $ratios = $platformData->pluck('ratio')->toArray();
$baseBlue = '#0789e0';
$colors = [];
$totalLabels = count($labels);


for ($i = 0; $i < $totalLabels; $i++) {

    $ratio = 0.4 - (0.8 * ($i / max(1, $totalLabels - 1)));

    $hex = str_replace('#', '', $baseBlue);
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));


    $r = min(max(0, $r * (1 + $ratio)), 255);
    $g = min(max(0, $g * (1 + $ratio)), 255);
    $b = min(max(0, $b * (1 + $ratio)), 255);

    $colors[] = sprintf("#%02x%02x%02x", round($r), round($g), round($b));
}



    return response()->json([
        'labels' => $labels,
        'values' => $values,
        'colors' => $colors,
        'ratios' => $ratios,
    ]);
}


public function getInterestDashboard(Request $request)
{
    $userId = auth()->id();
    $interestId = $request->id;

    // 1️⃣ Get the user interest
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
    if ($request->mileage) {
        $vehicleBaseQuery->where('vehicles.mileage', '<=', $request->mileage);
    }

    // 2️⃣ Total Vehicles
    $totalVehicles = (clone $vehicleBaseQuery)->count();

    // 3️⃣ Sold Vehicles
    $soldVehicles = (clone $vehicleBaseQuery)
        ->where('bidding_status', 'sold')
        ->count();

    // 4️⃣ Unsold Vehicles
    $unsoldVehicles = (clone $vehicleBaseQuery)
        ->where('bidding_status', 'Not sold')
        ->count();

    // 5️⃣ Vehicles in Re-auction
$vehiclesInReauction =0;
    // 6️⃣ Total Auctions
    $totalAuctions = (clone $vehicleBaseQuery)
        ->distinct('auction_id')
        ->count('auction_id');

    // 7️⃣ Online Auctions
    $onlineAuctions = (clone $vehicleBaseQuery)
        ->where('auction_type', 'Online Auction')
        ->distinct('auction_id')
        ->count('auction_id');

    // 8️⃣ Offline Auctions
    $offlineAuctions = (clone $vehicleBaseQuery)
        ->where('auction_type', 'offline')
        ->distinct('auction_id')
        ->count('auction_id');

    // 9️⃣ Vehicles in progress auctions
$totalVehiclesInProgress = (clone $vehicleBaseQuery)
    ->where('auctions.status', 'In Progress')
    ->count();


    return response()->json([
        'success' => true,
        'stats' => [
            'total_auctions' => $totalAuctions,
            'online_auctions' => $onlineAuctions,
            'offline_auctions' => $offlineAuctions,
            'vehicles_in_progress_auctions' => $totalVehiclesInProgress,
            'total_vehicles' => $totalVehicles,
            'sold_vehicles' => $soldVehicles,
            'unsold_vehicles' => $unsoldVehicles,
            'vehicles_in_reauction' => $vehiclesInReauction,
        ],
    ]);
}







}

