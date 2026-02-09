<?php

namespace App\Services;

use App\Models\Auctions;
use App\Models\Interest;
use App\Models\Membership;
use App\Models\MembershipPayment;
use App\Models\Plan;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserAuction;
use App\Models\UserVehicleAlert;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class NotificationService 
{
    

        static public function GetNotification(Request $request)
    {

           $user = $request->user();
           $data = [];

           $vehicles = UserVehicleAlert::select([
            'vehicles.*',
            'auctions.auction_date',
            'make.name as make_name', 
            'model.name as model_name', 
            'model_variant.name as variant_name'
            ])
            ->join('vehicles','vehicles.id','=','user_vehicle_alerts.vehicle_id')
            ->join('make', 'make.id', '=', 'vehicles.make_id')
            ->join('model', 'model.id', '=', 'vehicles.model_id')
            ->join('model_variant', 'model_variant.id', '=', 'vehicles.variant_id')
            ->join('auctions','auctions.id', '=','vehicles.auction_id')
            ->where('user_vehicle_alerts.user_id', $user->id)
            ->get()
            ->map(function ($value, $key) {

                $images = explode(",",$value->images);
                return [
                    'id' => $value->id,
                    'image' => $images ? $images[0] : null,
                    'type' => 'vehicle',
                    'title' => $value->title,
                    'message' => 'Vehicle Description',
                    'date' => $value->auction_date
                ];

            })
            ->toArray();


            $auctions = UserAuction::select([
                    'auctions.*',
                    'auction_platform.image',
                    'auction_platform.name'
                 ])
                 ->leftJoin('auctions','auctions.id', '=','user_auctions.auction_id')
                 ->leftJoin('auction_platform','auction_platform.id', '=','auctions.platform_id')
                //  ->leftJoin('auction_status','auction_status.id','=','auctions.status')
                //  ->leftJoin('vehicles','vehicles.auction_id','=','auctions.id')
                 ->where('user_auctions.user_id', $user->id)
                 ->get()
                 ->map(function ($value, $key) {
                    
                    $image = $value->image ? asset('/uploads/'.$value->image) : null;
                    return [
                        'id' => $value->id,
                        'image' => $image,
                        'type' => 'auction',
                        'title' => $value->name,
                        'message' => 'Auction Description',
                        'date' => $value->auction_date
                    ];

                })
                ->toArray();


            $data = array_merge($vehicles,$auctions);

            usort($data, function ($a, $b) {
                return strtotime($b['date']) <=> strtotime($a['date']);
            });

            return $data;

    }











}
