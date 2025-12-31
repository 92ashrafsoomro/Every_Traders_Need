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


class UploadController extends Controller
{


       public function make(Request $request)
    { 

            Make::query()->delete();
            VehicleModel::query()->delete();
            ModelVariant::query()->delete();
            
            $path = public_path('make.csv');
            $csv = file($path);
            $rows = array_map('str_getcsv', $csv);
            foreach ($rows as $value) {
                if ($value[1]) {

                    echo '</br>Done-'.$value[0];
                    Make::create([
                        'id' => $value[0],
                        'name' => trim($value[1]),
                        'created_at' => Carbon::now(),
                        'updated_at' => null,
                    ]);
                }
            }

    }


        public function model(Request $request)
    { 

          
            VehicleModel::query()->delete();
            ModelVariant::query()->delete();
            
            $path = public_path('model.csv');
            $csv = file($path);
            $rows = array_map('str_getcsv', $csv);
            foreach ($rows as $value) {
                if ($value[1]) {

                    $make = Make::find($value[2]);
                    if(!$make){
                         echo '</br> Not Found-'.$value[0];
                         continue;
                    }

                    echo '</br>Done-'.$value[0];
                    VehicleModel::create([
                        'id' => $value[0],
                        'name' => trim($value[1]),
                        'make_id' => $make->id,
                        'created_at' => Carbon::now(),
                        'updated_at' => null,
                    ]);

                }
            }

    }

         public function variant(Request $request)
    { 

           
            ModelVariant::query()->delete();
            
            
            $path = public_path('variant.csv');
            $csv = file($path);
            $rows = array_map('str_getcsv', $csv);
            foreach ($rows as $value) {
                if ($value[1]) {

                    $model = VehicleModel::find($value[2]);
                    if(!$model){
                         echo '</br> Not Found-'.$model[0];
                         continue;
                    }

                    echo '</br>Done-'.$value[0];
                    ModelVariant::create([
                        'id' => $value[0],
                        'name' => trim($value[1]),
                        'model_id' => $model->id,
                        'created_at' => Carbon::now(),
                        'updated_at' => null,
                    ]);

                }
            }

    }


        public function bodyType(Request $request)
    { 

            BodyType::query()->delete();
            
            $path = public_path('bodyType.csv');
            $csv = file($path);
            $rows = array_map('str_getcsv', $csv);
            foreach ($rows as $value) {
                if ($value[1]) {

                    echo '</br>Done-'.$value[0];
                    BodyType::create([
                        'id' => $value[0],
                        'name' => trim($value[1]),
                        'created_at' => Carbon::now(),
                        'updated_at' => null,
                    ]);

                }
            }

    }




}

