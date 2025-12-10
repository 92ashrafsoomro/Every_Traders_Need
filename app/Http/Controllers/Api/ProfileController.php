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
use App\Models\UserDevice;
use App\Models\UserNotificationAlert;
use App\Models\UserVehicleAlert;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Stripe\PaymentIntent;
use Stripe\Stripe;


class ProfileController extends Controller
{


       public function userDevices(Request $request)
    { 

        $perPage = (int) $request->input('length', 10);
        $page = (int) $request->input('page', 1);
        $offset = ($page - 1) * $perPage;
        $id = $request->user()->id;

        $query = UserDevice::query();
        // ->where('user_id', $id)
        // ->orderByDesc('logged_in_at');

        $total = (clone $query)->count();
        $totalNew = (clone $query)->count();
        $results = $query->select([
                '*'
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

  

    


}

