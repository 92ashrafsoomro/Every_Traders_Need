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
use App\Models\BodyType;
use App\Models\Make;
use App\Models\ModelVariant;
use App\Models\UserDevice;
use App\Models\UserNotificationAlert;
use App\Models\UserVehicleAlert;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Stripe\PaymentIntent;
use Stripe\Stripe;


class WebController extends Controller
{


       public function getCardDetail(Request $request)
    {   
        $data = [];
        $user = $request->user();
        $Membership = Membership::where('user_id',$user->id)->first();
        if($Membership){
            $data = MembershipPayment::where('membership_id',$Membership->id)->first();
        }
        
        return response()->json([
            'data' => $data,
        ],200);


    }



}

