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
use App\Models\UserNotificationAlert;
use App\Models\UserVehicleAlert;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class StripeController extends Controller
{


    public function createPaymentIntent(Request $request)
    {




        
            dd($request->all());   
        

            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

            try {
                $paymentIntent = PaymentIntent::create([
                    'amount'   => $request->amount * 100,     // £50 → 5000
                    'currency' => 'gbp',
                    'payment_method' => $request->payment_method_id,
                    'confirm' => true,
                    'automatic_payment_methods' => [
                        'enabled' => true,
                        'allow_redirects' => 'never'   // THIS LINE KILLS THE ERROR FOREVER
                    ],
                ]);

                return response()->json([
                    'success'       => true,
                    'clientSecret'  => $paymentIntent->client_secret,  // Send this to frontend
                ]);

            } catch (\Exception $e) {
                return response()->json([
                    'error' => $e->getMessage()
                ], 400);
            }


            
    }


}