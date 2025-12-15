<?php

use App\Http\Controllers\Api\Master\RoleController;
use App\Http\Controllers\Api\Master\UserController;
use App\Http\Controllers\Api\Master\CenterController;
use App\Http\Controllers\Api\Master\ColorController;
use App\Http\Controllers\Api\Master\MakeController;
use App\Http\Controllers\Api\Master\ModelController;
use App\Http\Controllers\Api\Master\PlatformController;
use App\Http\Controllers\Api\Master\VariantController;
use App\Http\Controllers\Api\Master\VehicleTypeController;
use App\Http\Controllers\Api\Master\BodyTypeController;


use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuctionFinderController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\InterestController;
use App\Http\Controllers\Api\Master\BlogController;
use App\Http\Controllers\Api\Master\MembershipController;
use App\Http\Controllers\Api\Master\NewsController;
use App\Http\Controllers\Api\Master\PlanController;
use App\Http\Controllers\Api\MasterController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\StripeController;
use App\Models\Membership;
use Illuminate\Support\Facades\Route;


    Route::prefix('auth')->group(function () {

        Route::get('/profile',[AuthController::class,'profile'])->middleware(['auth:sanctum']);
        Route::post('/profile',[AuthController::class,'profileUpdate'])->middleware(['auth:sanctum']);
        Route::post('/login',[AuthController::class,'login']);
        Route::post('/register',[AuthController::class,'register']);
        Route::post('/changePassword', [AuthController::class, 'changePassword'])->middleware(['auth:sanctum']);

    });

    
    // Master data
    Route::prefix('master')->middleware(['auth:sanctum'])->group(function () {

        Route::get('/getVehicleTypes',[MasterController::class,'getVehicleTypes']);
        Route::get('/getBodyTypes',[MasterController::class,'getBodyTypes']);
        Route::get('/getAuctionHouse',[MasterController::class,'getAuctionHouse']);
        Route::get('/getAuctionCenter',[MasterController::class,'getAuctionCenter']);
        Route::get('/getMakes',[MasterController::class,'getMakes']);
        Route::get('/getModels',[MasterController::class,'getModels']);
        Route::get('/getVariants',[MasterController::class,'getVariants']);
        
        Route::get('/getColors',[MasterController::class,'getColors']);
        Route::get('/getV5',[MasterController::class,'getV5']);
        Route::get('/getGrade',[MasterController::class,'getGrade']);
        Route::get('/getEngineSize',[MasterController::class,'getEngineSize']);
        Route::get('/getFormerKeepers',[MasterController::class,'getFormerKeepers']);
        Route::get('/getNoOfServices',[MasterController::class,'getNoOfServices']);
        Route::get('/getYears',[MasterController::class,'getYears']);
        Route::get('/getTransmissions',[MasterController::class,'getTransmissions']);
        Route::get('/getFuelType',[MasterController::class,'getFuelType']);
        Route::get('/getDoors',[MasterController::class,'getDoors']);
        Route::get('/getSeats',[MasterController::class,'getSeats']);
        Route::get('/getDates',[MasterController::class,'getDates']);

    });




    // User Panel
    Route::prefix('user')->middleware(['auth:sanctum'])->group(function () {


        Route::prefix('profile')->group(function () {

            Route::get('/userDevices',[ProfileController::class,'userDevices']);
            
        });
        
        Route::prefix('notifications')->group(function () {

            Route::get('/userNotification',[NotificationController::class,'userNotification']);
            Route::get('/markRead/{id}',[NotificationController::class,'markRead']);

            
            Route::get('/userWatchList',[NotificationController::class,'userWatchList']);
            Route::get('/userAlertList',[NotificationController::class,'userAlertList']);
            
        });

        

        Route::prefix('page')->group(function () {

            Route::get('/userWatchList',[PageController::class,'userWatchList']);
            Route::get('/userAlertList',[PageController::class,'userAlertList']);
            Route::get('/plansList',[PageController::class,'plansList']);

            Route::post('/supportForm',[PageController::class,'supportForm']);
            
        });


        Route::get('/userWatchList',[NotificationController::class,'userWatchList']);
        Route::get('/userAlertList',[NotificationController::class,'userAlertList']);



        // Dashboard
        Route::prefix('dashboard')->group(function () {
            Route::get('/counters',[DashboardController::class,'counters']);
            Route::get('/vehicleStates',[DashboardController::class,'vehicleStates']);
            Route::get('/onlineAuctions',[DashboardController::class,'onlineAuctions']);
            Route::get('/timeAuctions',[DashboardController::class,'timeAuctions']);
        });
        

        Route::get('/auctionList',[AuctionFinderController::class,'auctionList']);
        Route::get('/auctionList/{id}',[AuctionFinderController::class,'getVehicleDetails']);
        Route::get('/getRelatedVehicle/{id}',[AuctionFinderController::class,'getRelatedVehicle']);
        
        Route::get('/reAuctionList',[AuctionFinderController::class,'reAuctionList']);
        Route::get('/auctionShedule',[AuctionFinderController::class,'auctionShedule']);

    
        Route::get('/compareList',[AuctionFinderController::class,'compareList']);
        Route::prefix('interest')->group(function () {
            Route::get('/myInterest',[InterestController::class,'myInterest']);
        });
        
    });

    Route::prefix('stripe')->middleware(['auth:sanctum'])->group(function () {
        Route::post('/createPaymentIntent',[StripeController::class,'createPaymentIntent']);
    });

    // Master data
    Route::prefix('cruds')->middleware(['auth:sanctum'])->group(function () {

        Route::resource('bodyType',BodyTypeController::class);
        Route::resource('vehicleType',VehicleTypeController::class);
        Route::resource('platform',PlatformController::class);
        Route::resource('center',CenterController::class);
        Route::resource('color',ColorController::class);
        Route::resource('make',MakeController::class);
        Route::resource('model',ModelController::class);
        Route::resource('variant',VariantController::class);
        Route::resource('roles',RoleController::class);
        Route::resource('plans',PlanController::class);
        Route::resource('memberships',MembershipController::class);
        
        Route::resource('blogs',BlogController::class);
        Route::resource('news',NewsController::class);
        
        Route::get('/users/changeStatus',[UserController::class,'changeStatus']);
        Route::resource('users',UserController::class);

        // Route::resource('platform',PlatformController::class);

    });


