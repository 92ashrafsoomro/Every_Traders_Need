<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AuctionPlatform;
use App\Models\Auctions;
use App\Models\Interest;
use App\Models\Notification;
use App\Models\RecentView;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


use App\Services\AuctionService;
use Carbon\Carbon;

class AuctionFinderController extends Controller
{


      public function getVehicleDetails(Request $request,$id)
    {


        $vehicle = Vehicle::query()
            ->leftJoin('auctions', 'auctions.id', '=', 'vehicles.auction_id')
            ->leftJoin('auction_platform', 'auction_platform.id', '=', 'auctions.platform_id')
            ->leftJoin('auction_center', 'auction_center.id', '=', 'vehicles.center_id')
            ->leftJoin('make', 'make.id', '=', 'vehicles.make_id')
            ->leftJoin('model', 'model.id', '=', 'vehicles.model_id')
            ->leftJoin('model_variant', 'model_variant.id', '=', 'vehicles.variant_id')
            ->where('vehicles.id',$id)
            ->select(
                'vehicles.*',
                'auctions.name as auction_name',
                'auctions.auction_date',
                'auctions.status as auction_status',
                'auction_platform.name as platform_name',
                'auction_center.name as center_name',
                'make.name as make_name',
                'model.name as model_name',
                'model_variant.name as variant_name'
            )
            ->first();

        if (!$vehicle) {
            return response()->json(['message' => 'Vehicle not found'],400);
        }

        $previousVehicle = DB::table('vehicles')
            ->leftJoin('auctions', 'auctions.id', '=', 'vehicles.auction_id')
            ->leftJoin('auction_platform', 'auction_platform.id', '=', 'auctions.platform_id')
            ->leftJoin('make', 'make.id', '=', 'vehicles.make_id')
            ->leftJoin('model', 'model.id', '=', 'vehicles.model_id')
            ->leftJoin('model_variant', 'model_variant.id', '=', 'vehicles.variant_id')
            ->where('vehicles.reg', $vehicle->reg)
            ->where('vehicles.id', '!=', $request->id)
            ->whereDate('auctions.auction_date', '<=', $vehicle->auction_date)
            ->orderBy('auctions.auction_date', 'desc')
            ->select(
                'vehicles.*',
                'auctions.name as auction_name',
                'auctions.auction_date',
                'auction_platform.name as platform_name',
                'make.name as make_name',
                'model.name as model_name',
                'model_variant.name as variant_name'
            )
            ->get();

        $viewCount = DB::table('recent_views')
            ->where('vehicle_id', $vehicle->id)
            ->count();

        $priceSymbol = config('app.custom.price_symbol', env('PRICE_SYMBOL', '£'));

        return response()->json([
            'status' => true,
            'data' => [
                 'vehicle' => $vehicle,
                 'previous_vehicle' => $previousVehicle,
                 'views' => $viewCount,
                 'priceSymbol' => $priceSymbol,
            ],
        ],200);
    }

    public function auctionList(Request $request)
    {
        $perPage = (int) $request->input('length', 10);
        $page = (int) $request->input('page', 1);
        $offset = ($page - 1) * $perPage;

        // Base Query
        $query = Vehicle::join('auctions', 'auctions.id', '=', 'vehicles.auction_id')
        ->join('auction_platform', 'auction_platform.id', '=', 'auctions.platform_id')
        ->join('make', 'make.id', '=', 'vehicles.make_id')
        ->join('model', 'model.id', '=', 'vehicles.model_id')
        ->join('model_variant', 'model_variant.id', '=', 'vehicles.variant_id');

        
        // ==== FILTERS ====
        if ($request->has('platform') && $request->platform != '') {
            $query->where('auctions.platform_id', $request->platform);
        }

        if ($request->has('type') && $request->type != '') {
            $query->whereIn('vehicles.vehicle_id', explode(',', $request->type));
        }

        if ($request->has('make') && $request->make != '') {
            $query->whereIn('vehicles.make_id', explode(',', $request->make));
        }

        if ($request->has('model') && $request->model != '') {
            $query->whereIn('vehicles.model_id', explode(',', $request->model));
        }

        if ($request->has('variant') && $request->variant != '') {
            $query->whereIn('vehicles.variant_id', explode(',', $request->variant));
        }

        if ($request->has('year') && $request->year != '') {
            $query->whereIn('vehicles.year', explode(',', $request->year));
        }

        if ($request->has('transmission') && $request->transmission != '') {
            $query->whereIn('vehicles.transmission', explode(',', $request->transmission));
        }

        if ($request->has('fuel_type') && $request->fuel_type != '') {
            $query->whereIn('vehicles.fuel_type', explode(',', $request->fuel_type));
        }

        if ($request->has('body') && $request->body != '') {
            $query->whereIn('vehicles.body_id', explode(',', $request->body));
        }

        if ($request->has('color') && $request->color != '') {
            $query->whereIn('vehicles.color_id', explode(',', $request->color));
        }

        if ($request->has('doors') && $request->doors != '') {
            $query->whereIn('vehicles.doors', explode(',', $request->doors));
        }

        if ($request->has('seat') && $request->seat != '') {
            $query->whereIn('vehicles.seats', explode(',', $request->seat));
        }

        if ($request->has('grade') && $request->grade != '') {
            $query->whereIn('vehicles.grade', explode(',', $request->grade));
        }

        if ($request->has('v5') && $request->v5 != '') {
            $query->whereIn('vehicles.v5', explode(',', $request->v5));
        }

        if ($request->has('cc') && $request->cc != '') {
            $query->whereIn('vehicles.cc', explode(',', $request->cc));
        }

        if ($request->has('former_keeper') && $request->former_keeper != '') {
            $query->whereIn('vehicles.former_keepers', explode(',', $request->former_keeper));
        }

        if ($request->has('no_of_service') && $request->no_of_service != '') {
            $query->whereIn('vehicles.no_of_services', explode(',', $request->no_of_service));
        }

        if ($request->has('auction_house') && $request->auction_house != '') {
            $query->whereIn('auctions.platform_id', explode(',', $request->auction_house));
        }

        if ($request->has('auction_center') && $request->auction_center != '') {
            $query->whereIn('vehicles.center_id', explode(',', $request->auction_center));
        }

        if ($request->has('mileage_from') && $request->mileage_from != '') {
            $query->where('vehicles.mileage', '>=', $request->mileage_from);
        }

        if ($request->has('mileage_to') && $request->mileage_to != '') {
            $query->where('vehicles.mileage', '<=', $request->mileage_to);
        }

        $now = \Carbon\Carbon::now();
        $column = 'auctions.auction_date';
        $datesInput = $request->input('date', '');
        $dates = is_array($datesInput) ? $datesInput : explode(',', $datesInput);

        $fromDate = $now->copy()->subDays(30)->startOfDay();
        $toDate = $now->copy()->addDays(4)->endOfDay();

        $query->where(function ($q) use ($dates, $now, $column, &$fromDate, &$toDate) {
            $hasValid = false;

            foreach ($dates as $d) {
                $d = trim($d);
                if (empty($d)) {
                    continue;
                }

                $hasValid = true;

                if ($d === 'previous') {
                    $fromDate = $now->copy()->subMonths(3)->startOfDay();
                    $toDate = $now->copy()->endOfDay();
                } elseif ($d === 'today') {
                    $fromDate = $now->copy()->startOfDay();
                    $toDate = $now->copy()->endOfDay();
                } elseif ($d === 'upcoming') {
                    $fromDate = $now->copy()->startOfDay();
                    $toDate = $now->copy()->addWeek()->endOfDay();
                } elseif (preg_match('/^\d{4}-\d{2}-\d{2}$/', $d)) {
                    try {
                        $fromDate = \Carbon\Carbon::parse($d)->startOfDay();
                        $toDate = \Carbon\Carbon::parse($d)->endOfDay();
                    } catch (\Exception $e) {
                        continue;
                    }
                } else {
                    continue;
                }

                $q->orWhereBetween($column, [$fromDate, $toDate]);
            }

            if (!$hasValid) {
                $fromDate = $now->copy()->subDays(30)->startOfDay();
                $toDate = $now->copy()->addDays(4)->endOfDay();
                $q->whereBetween($column, [$fromDate, $toDate]);
            }
        });


        $sortBy = $request->input('sort_by', 'auction_date');
        switch ($sortBy) {
            case 'name-asc':
                $query->orderBy('make.name','asc');
                break;

            case 'name-desc':
                $query->orderBy('make.name','desc');
                break;

            case 'grade-desc':
                $query->orderBy('vehicles.grade','desc');
                break;

            case 'grade-asc':
                $query->orderBy('vehicles.grade','asc');
                break;

            case 'date-desc':
                $query->orderBy('auctions.auction_date','desc');
                break;

            case 'date-asc':
                $query->orderBy('auctions.auction_date','asc');
                break;

            default:
                $query->orderBy('auctions.auction_date', 'desc');
                break;
        }

    


        // ==== PAGINATION ====
        $total = $query->count();

        $results = (clone $query)
            ->offset($offset)
            ->limit($perPage)
            ->select(['vehicles.*', 'auction_platform.name', 'auction_platform.image as platefrom_image', 'auctions.auction_date as auction_date', 'make.name as make_name', 'model.name as model_name', 'model_variant.name as variant_name'])
            ->get()
            ->map(function ($item) {
                $images = explode(',', $item->images);
                $previous = $this->getPreviousAuctionDate($item->reg, $item->id);

                return [
                    'id' => $item->id,
                    'make_name' => $item->make_name,
                    'model_name' => $item->model_name,
                    'variant_name' => $item->variant_name,
                    'year' => $item->year,
                    'cc' => $item->cc,
                    'mileage' => $item->mileage,
                    'transmission' => $item->transmission,
                    'color' => $item->colorname ?? '',
                    'grade' => $item->grade,
                    'previousdate' => $previous ?? '',
                    'auction_name' => $item->name,
                    'platefrom_image' => $item->platefrom_image,
                    'auction_date' => date('d-M-Y', strtotime($item->auction_date)),
                    'auction_time' => date('h:i A', strtotime($item->auction_date)),
                    'last_bid' => $item->last_bid,
                    'cap_clean' => $item->cap_clean ?? '',
                    'cap_average' => $item->cap_average ?? '',
                    'cap_below' => $item->cap_below ?? '',
                    'autotrader_retail_value' => $item->autotrader_retail_value ?? '',
                    'autotrader_trade_value' => $item->autotrader_trade_value ?? '',
                    'auto_boli' => 0,
                    'image1' => $images[0] ?? '',
                    'image2' => $images[1] ?? '',
                    'image3' => $images[2] ?? '',
                    'inspection_report' => $item->inspection_report,
                ];
            });

        return response()->json([
            'toDate' => $toDate,
            'fromDate' => $fromDate,
            'offset' => $offset,
            'data' => $results,
            'total' => $total,
            'per_page' => $perPage,
            'current_page' => $page,
            'last_page' => ceil($total / $perPage),
        ]);
    }

    public function getPreviousAuctionDate($reg, $vehicleId)
    {
        if (!$reg || !$vehicleId) {
            return null;
        }

        $previousRecord = Vehicle::join('auctions', 'auctions.id', '=', 'vehicles.auction_id')->where('vehicles.reg', $reg)->wherenot('vehicles.id', $vehicleId)->orderByDesc('vehicles.id')->select('auctions.auction_date')->first();

        return $previousRecord ? date('Y-m-d', strtotime($previousRecord->auction_date)) : null;
    }

    public function getIntrest(Request $request)
    {
        $auctionId = $request->auction_id;
        $platformId = $request->platform_id;

        $interests = Interest::all();
        $totalVehicles = Vehicle::where('auction_id', $auctionId)->count();

        $result = [];

        foreach ($interests as $interest) {
            // Get all matching vehicles (with their auction)
            $vehicles = Vehicle::with('auction')
                ->where('auction_id', $auctionId)
                ->when($interest->make_id, fn($q) => $q->where('make_id', $interest->make_id))
                ->when($interest->model_id, fn($q) => $q->where('model_id', $interest->model_id))
                ->when($interest->variant_id, fn($q) => $q->where('variant_id', $interest->variant_id))
                ->when($interest->year_from, fn($q) => $q->where('year', '>=', $interest->year_from))
                ->when($interest->year_to, fn($q) => $q->where('year', '<=', $interest->year_to))
                ->when($interest->mileage_from, fn($q) => $q->where('mileage', '>=', $interest->mileage_from))
                ->when($interest->mileage_to, fn($q) => $q->where('mileage', '<=', $interest->mileage_to))
                ->when($interest->fuel_type, fn($q) => $q->where('fuel_type', $interest->fuel_type))
                ->when($interest->transmission, fn($q) => $q->where('transmission', $interest->transmission))
                ->when($interest->cc_from, fn($q) => $q->where('cc', '>=', $interest->cc_from))
                ->when($interest->cc_to, fn($q) => $q->where('cc', '<=', $interest->cc_to))
                ->when($interest->price_from, fn($q) => $q->where('buy_now_price', '>=', $interest->price_from))
                ->when($interest->price_to, fn($q) => $q->where('buy_now_price', '<=', $interest->price_to))
                ->get();

            $interestVehicles = $vehicles->count();

            // ✅ Auction date (from the first matching vehicle’s auction)
            $auctionDate = optional($vehicles->first()?->auction)->auction_date;

            if ($auctionDate) {
                $today = date('Y-m-d');
                $auctionDateFormatted = date('Y-m-d', strtotime($auctionDate));

                if ($auctionDateFormatted < $today) {
                    $status_data = 'previous';
                } elseif ($auctionDateFormatted == $today) {
                    $status_data = 'today';
                } else {
                    $status_data = $auctionDateFormatted; // upcoming date (e.g. 2025-10-18)
                }
            } else {
                $status_data = null;
            }

            $result[] = [
                'interest_name' => $interest->title,
                'make_id' => $interest->make_id,
                'model_id' => $interest->model_id,
                'variant_id' => $interest->variant_id,
                'platform_id' => $platformId ?? null,
                'status_data' => $status_data,
                'make_name' => optional($interest->make)->name,
                'model_name' => optional($interest->model)->name,
                'variant_name' => optional($interest->variant)->name,
                'total_vehicles' => $totalVehicles,
                'interest_vehicles' => $interestVehicles,
            ];
        }

        return response()->json($result);
    }


    public function reAuctionList(Request $request)
    {   

            DB::statement("SET SESSION sql_mode = (SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");

            $today = now()->toDateString();
            $auctionFilter = $request->auction_date ?? $today;

            $auctionIds = AuctionService::getAuctionIdbyDate($auctionFilter);
            $platforms = AuctionService::getPlateformNamesByAuctionId($auctionIds);
            $centers = AuctionService::getCenterNamesByPlateformName($platforms);
            
            $query = DB::table('vehicles')
                ->leftJoin('auctions', 'auctions.id', '=', 'vehicles.auction_id')
                ->leftJoin('auction_platform', 'auction_platform.id', '=', 'auctions.platform_id')
                ->leftJoin('auction_center', 'auction_center.id', '=', 'vehicles.center_id')
                ->leftJoin('make', 'make.id', '=', 'vehicles.make_id')
                ->leftJoin('model', 'model.id', '=', 'vehicles.model_id')
                ->leftJoin('model_variant', 'model_variant.id', '=', 'vehicles.variant_id')

                // ->whereIn('vehicles.auction_id', $auctionIds)
                // ->whereExists(function ($subQuery) use ($auctionFilter) {
                //     $subQuery->select(DB::raw(1))
                //         ->from('vehicles as v2')
                //         ->join('auctions as a2', 'a2.id', '=', 'v2.auction_id')
                //         ->whereColumn('v2.reg', 'vehicles.reg')
                //         ->whereDate('a2.auction_date', '<', $auctionFilter)
                //         ->whereColumn('a2.platform_id', '!=', 'auctions.platform_id');
                // })
                // ->whereIn('vehicles.id', function ($sub) use ($auctionFilter) {
                //     $sub->select(DB::raw('MAX(v3.id)'))
                //         ->from('vehicles as v3')
                //         ->join('auctions as a3', 'a3.id', '=', 'v3.auction_id')
                //         ->whereDate('a3.auction_date', '=', $auctionFilter)
                //         ->groupBy('v3.reg');
                // })
                ->select([
                    'vehicles.*',
                    'auctions.auction_date',
                    'auction_platform.name as platform_name',
                    'auction_center.name as center_name',
                    'make.name as make_name',
                    'model.name as model_name',
                    'model_variant.name as model_variant_name',
                    DB::raw('( SELECT COUNT(DISTINCT v2.auction_id) FROM vehicles v2 WHERE v2.reg = vehicles.reg ) AS auction_count'), 
                ]);


                if ($request->filled('interest_id')) {
                    $interest = Interest::find($request->interest_id);
                    if ($interest) {
                        $query->when($interest->make_id, fn($q) => 
                            $q->where('vehicles.make_id', $interest->make_id))
                               ->when($interest->model_id, fn($q) => $q->where('vehicles.model_id', $interest->model_id))
                               ->when($interest->variant_id, fn($q) => $q->where('vehicles.variant_id', $interest->variant_id));
                    }
                }

                if($request->filled('search')){
                    $search = $request->search;
                    $query->where(function ($q) use ($search) {
                        $q->where('vehicles.reg', 'LIKE', "%{$search}%")
                            ->orWhere('make.name', 'LIKE', "%{$search}%")
                            ->orWhere('model.name', 'LIKE', "%{$search}%")
                            ->orWhere('model_variant.name', 'LIKE', "%{$search}%")
                            ->orWhere('auction_center.name', 'LIKE', "%{$search}%")
                            ->orWhere('auction_platform.name', 'LIKE', "%{$search}%");
                    });
                }

                if($request->inprogress_check == 1){
                    $query->where('vehicles.bidding_status', 'inprogress');
                }

                $totalRecords = (clone $query)->count();
                $vehicles     = $query->skip($request->input('start', 0))
                                ->take($request->input('length', 10))
                                ->get()
                                ->map(function($vehicle) use ($today) {

                                // $bids = DB::table('vehicles')
                                //     ->join('auctions', 'auctions.id', '=', 'vehicles.auction_id')
                                //     ->where('vehicles.reg', $vehicle->reg)
                                //     ->orderBy('auctions.auction_date', 'asc')
                                //     ->get(['vehicles.cap_clean', 'vehicles.cap_average']);

                                // $first = $bids->first();
                                // $last = $bids->last();

                                // // CAP %
                                // if ($first && $last) {
                                //     $capCleanText = $capAvgText = "<span style='color:gray;'>No Data</span>";

                                //     if ($first->cap_clean > 0 && $last->cap_clean > 0) {
                                //         $capCleanChange = (($last->cap_clean - $first->cap_clean) / $first->cap_clean) * 100;
                                //         $capCleanText = $vehicle->cap_clean . ($capCleanChange > 0 ? "<span style='color:green;'> ▲ " . number_format($capCleanChange, 2) . '%</span>' : ($capCleanChange < 0 ? "<span style='color:red;'> ▼ " . number_format(abs($capCleanChange), 2) . '%</span>' : "<span style='color:gray;'> 0 </span>"));
                                //     }

                                //     if ($first->cap_average > 0 && $last->cap_average > 0) {
                                //         $capAvgChange = (($last->cap_average - $first->cap_average) / $first->cap_average) * 100;
                                //         $capAvgText = $vehicle->cap_average . ($capAvgChange > 0 ? "<span style='color:green;'> ▲ " . number_format($capAvgChange, 2) . '%</span>' : ($capAvgChange < 0 ? "<span style='color:red;'> ▼ " . number_format(abs($capAvgChange), 2) . '%</span>' : "<span style='color:gray;'> 0 </span>"));
                                //     }
                                // }

                                // $encryptedId = Crypt::encryptString($vehicle->id);

                                // $previousCount = DB::table('vehicles')->join('auctions', 'auctions.id', '=', 'vehicles.auction_id')->where('vehicles.reg', $vehicle->reg)->whereDate('auctions.auction_date', '<', $today)->count();

                                // $PreviousBtn ='
                                //     <div class="PreviousBtnRec d-flex justify-content-center">
                                //         <button type="button" class="btn btn-sm btn-primary PreviousBtnRec" 
                                //         data-ref="' .$vehicle->reg.'" data-vehid="' .$encryptedId .'">'.$previousCount .' ↑ 
                                //         </button>
                                //     </div>';

                                // $actions = '<a href="'.url("/auction-finder/vehicle/{$vehicle->id}?reg").'" class="btn btn-sm btn-primary me-1"><i class="fas fa-eye"></i>
                                // </a>
                                // <a class="btn btn-sm btn-danger add-notification" data-auction-id="' .$vehicle->id .'">
                                //         <i class="fas fa-bell"></i>
                                // </a>';

                                // $auctionDateTime = \Carbon\Carbon::parse($vehicle->auction_date)->format('D, d M Y') . '<br><small class="text-muted">' . \Carbon\Carbon::parse($vehicle->auction_date)->format('h:i A') . '</small>';

                                // return [strtoupper($vehicle->make_name) . ' - ' . $vehicle->model_name, $vehicle->reg ?? 'N/A', $PreviousBtn, $vehicle->platform_name ?? 'N/A', $vehicle->center_name ?? 'N/A', $capCleanText, $capAvgText, $vehicle->mileage ?? 'N/A', $vehicle->bidding_status ?? 'N/A', $auctionDateTime, $actions];


                                    return $vehicle;
                                });


            // 🔹 Final response
            return response()->json([
                    'recordsTotal' => $totalRecords,
                    'recordsFiltered' => $totalRecords,
                    'data' => $vehicles,
                    'platforms' => $platforms,
                    'centers' => $centers,
            ]);
        
    }


  
    public function userWatchList(Request $request)
    {

        $userId = $request->user()->id;
        $length = $request->input('length', 50);
        $page   = $request->input('page', 1);
        $offset = ($page - 1) * $length;

        $baseQuery = RecentView::join('vehicles','vehicles.id','=','recent_views.vehicle_id')
            ->leftJoin('auctions','auctions.id', '=','vehicles.auction_id')
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
                        'vehicles.autotrader_retail_value'
                ])
                ->orderByDesc('recent_views.id')
                ->skip($offset)
                ->take($length)
                ->get();

            return response()->json([
                'recordsTotal' => $countQuery,
                'recordsFiltered' => $countQuery,
                'data' => $data,
            ]);

    }


    public function userAlertList(Request $request)
    {

        $userId = $request->user()->id;
        $length = $request->input('length', 50);
        $page   = $request->input('page', 1);
        $offset = ($page - 1) * $length;

        $baseQuery = Notification::join('vehicles','vehicles.id','=','notifications.vehicle_id')
            ->leftJoin('auctions','auctions.id', '=','vehicles.auction_id')
            ->where('notifications.user_id', $userId);

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
            $countQuery = (clone $baseQuery)->count(DB::raw('distinct notifications.id'));
            $alerts = $baseQuery->select([
                        'notifications.id as notification_id',
                        'notifications.created_at as notified_at',
                        
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
                ])
                ->orderByDesc('notifications.id')
                ->skip($offset)
                ->take($length)
                ->get();

            return response()->json([
                'recordsTotal' => $countQuery,
                'recordsFiltered' => $countQuery,
                'data' => $alerts,
            ]);

    }


      public function compareList(Request $request)
    {
        
        DB::statement("SET SESSION sql_mode = (SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");

        $validator = Validator::make($request->all(), [
            'make_id' => 'required|integer',
            'model_id' => 'required|integer',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 422);
        }

        $query = Vehicle::join('auctions', 'vehicles.auction_id', '=', 'auctions.id')
            ->leftJoin('make', 'make.id', '=', 'vehicles.make_id')
            ->leftJoin('model', 'model.id', '=', 'vehicles.model_id')
            ->leftJoin('model_variant', 'model_variant.id', '=', 'vehicles.variant_id')
            ->leftJoin('auction_platform', 'auction_platform.id', '=', 'auctions.platform_id')
            ->whereIn('auctions.id', function($q) {
                $q->selectRaw('MAX(id)')
                ->from('auctions')
                ->groupBy('platform_id');
            });


            if ($request->filled('make_id')) {
                $query->where('vehicles.make_id', $request->make_id);
            }

            if ($request->filled('model_id')) {
                $query->where('vehicles.model_id', $request->model_id);
            }
            
            if ($request->filled('variant_id')) {
                $query->where('vehicles.variant_id', $request->variant_id);
            }
            
            if ($request->filled('year')) {
                $query->where('vehicles.year', $request->year);
            }

            if ($request->filled('platform_id')) {
                $query->whereIn('auctions.platform_id', (array) $request->platform_id);
            }

            if ($request->filled('mileage_from') && $request->filled('mileage_to')) {
                $query->whereBetween('vehicles.mileage', [$request->mileage_from, $request->mileage_to]);
            } elseif ($request->filled('mileage_from')) {
                $query->where('vehicles.mileage', '>=', $request->mileage_from);
            } elseif ($request->filled('mileage_to')) {
                $query->where('vehicles.mileage', '<=', $request->mileage_to);
            }
            
            if ($request->filled('transmission')) {
                $query->where('vehicles.transmission', $request->transmission);
            }
            
            if ($request->filled('fuel')) {
                $query->where('vehicles.fuel_type', $request->fuel);
            }
            
            if ($request->filled('grade')) {
                $query->where('vehicles.grade', $request->grade);
            }
        
            $data = $query->groupBy('auctions.id')->select([
                'auctions.id as auction_id',
                'auctions.name as auction_name',
                'auctions.auction_date',
                'auction_platform.name as platform_name',
                'auction_platform.image as platform_image',

                'vehicles.id',
                'vehicles.images',
                'vehicles.inspection_report',
                'vehicles.year',
                'vehicles.make_id',
                'vehicles.model_id',
                'vehicles.variant_id',
                'vehicles.mileage',
                'vehicles.transmission',
                'vehicles.grade',
                'make.name as make_name',
                'model.name as model_name',
                'model_variant.name as variant_name',
            ])
            ->orderBy('auctions.auction_date', 'desc')
            ->get()
            ->map(function ($group) use ($request) {


                    //     if ($request->filled('auction_id') && $request->filled('vehicle_id')) {
                            
                    //         $latestVehicle = $group->firstWhere('id', $request->vehicle_id);
                    //         if (!$latestVehicle) {
                    //             $latestVehicle = $group->sortByDesc('id')->first();
                    //         }

                    //     } else {
                    //         $latestVehicle = $group->sortByDesc('id')->first();
                    //     }

                    //    $otherCars = $group->filter(function ($v) use ($latestVehicle) {

                    //         if ($v->id == $latestVehicle->id) return false;

                    //         if ($v->make_id != $latestVehicle->make_id || $v->model_id != $latestVehicle->model_id) {
                    //             return false;
                    //         }

                    //         $optionalFields = ['variant_id', 'auction_id'];
                    //         foreach ($optionalFields as $field) {
                    //             $latestValue = $latestVehicle->$field ?? null;
                    //             $value = $v->$field ?? null;
                    //             if (!is_null($latestValue) && $latestValue != $value) {
                    //                 return false;
                    //             }
                    //         }

                    //         return true;

                    //    })->values();

                    //     $latestVehicle->other_vehicles = $otherCars;

                return $group;
        });


        return response()->json([
            'status' => 'success',
            'data' => $data,
        ],200);

    }


    

}
