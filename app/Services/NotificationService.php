<?php

namespace App\Services;

use App\Models\Auctions;
use App\Models\Interest;
use App\Models\Membership;
use App\Models\MembershipPayment;
use App\Models\Plan;
use Illuminate\Http\Request;
use App\Models\User;
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
            'auctions.auction_date'
            ])
            ->join('vehicles','vehicles.id','=','user_vehicle_alerts.vehicle_id')
            ->leftJoin('auctions','auctions.id', '=','vehicles.auction_id')
            ->where('user_vehicle_alerts.user_id', $user->id)
            ->get()
            ->map(function ($value, $key) {

                return [
                    'id' => $value->id,
                    'image' => null,
                    'type' => 'vehicle',
                    'title' => $value->title,
                    'message' => 'Vehicle Description',
                    'date' => $value->auction_date
                ];

            })
            ->toArray();

            return array_merge($vehicles);

    }



}
