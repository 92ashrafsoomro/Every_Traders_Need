<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




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
use App\Http\Controllers\Api\Master\NewsCategoryController;
use App\Http\Controllers\Api\Master\AuctionController;
use App\Http\Controllers\Api\Master\BlogCategoryController;
use App\Http\Controllers\Api\Master\BlogController;
use App\Http\Controllers\Api\Master\MembershipController;
use App\Http\Controllers\Api\Master\NewsController;
use App\Http\Controllers\Api\Master\PlanController;
use App\Http\Controllers\Api\Master\TaskManagementController;
use App\Http\Controllers\Api\Master\StaffController;

use App\Http\Controllers\Api\Master\VehicleController as VController;


use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuctionFinderController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\InterestController;
use App\Http\Controllers\Api\Master\AuctionStatusController;
use App\Http\Controllers\Api\Master\AuctionTypeController;
use App\Http\Controllers\Api\Master\FeatureController;
use App\Http\Controllers\Api\Master\PackageController;
use App\Http\Controllers\Api\Master\PrefixController;
use App\Http\Controllers\Api\Master\SheetController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\StripeController;
use App\Http\Controllers\Api\WebController;






    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');
    
    Route::get('/defaultvariant',[VariantController::class,'createDefaultVariants']);
    //AUTH..
    Route::prefix('auth')->group(function(){

        Route::post('/login',[AuthController::class,'login']);
        Route::post('/register',[AuthController::class,'register']);
        Route::post('/verifyemail', [AuthController::class, 'verifyEmail']);
        Route::post('/forgotPassword', [AuthController::class, 'forgotPassword']);
        Route::post('/resetpassword', [AuthController::class, 'resetpasswordsubmit']);
        Route::get('/account',[AuthController::class,'profile'])->middleware(['auth:sanctum']);

    });


    // Account Dettails
    Route::prefix('profile')->middleware(['auth:sanctum'])->group(function(){
        Route::get('/account-details/{id}',[ProfileController::class,'profile'])->middleware(['auth:sanctum']);
        Route::post('/account-details/{id}',[ProfileController::class,'profileUpdate'])->middleware(['auth:sanctum']);
        Route::post('/changePassword', [ProfileController::class, 'changePassword'])->middleware(['auth:sanctum']);
    });


    
    





  

    


    // Notifications
    Route::prefix('notifications')->middleware(['auth:sanctum'])->group(function(){
        
        Route::post('/addInWatchList',[NotificationController::class,'addInWatchList']);
        Route::post('/addInVehicleAlert',[NotificationController::class,'addInVehicleAlert']);
        Route::post('/addInUserAuction',[NotificationController::class,'addInUserAuction']);
        
        Route::post('/removeInVehicleAlert',[NotificationController::class,'removeInVehicleAlert']);
        Route::post('/removeInUserAuction',[NotificationController::class,'removeInUserAuction']);
        
        Route::get('/userWatchList',[NotificationController::class,'userWatchList']);
        Route::get('/userAuctionList',[NotificationController::class,'userAuctionList']);
        Route::get('/userAlertList',[NotificationController::class,'userAlertList']);
        Route::get('/userNotification',[NotificationController::class,'userNotification']);
        Route::post('/markRead/{id}',[NotificationController::class,'markRead']);

        
        Route::get('/myNotifications',[NotificationController::class,'myNotifications']);

    });






    // Master data
    Route::prefix('cruds')->middleware(['auth:sanctum'])->group(function () {


        // Auctions
        Route::get('/auctions/getScrap/{id}',[SheetController::class,'getScrap']);
        Route::get('/auctions/csvGet/{id}',[SheetController::class,'getAuctionVehicle']);
        Route::post('/auctions/csvUpdate/{id}',[SheetController::class,'sheetUpdate']);
        Route::get('/auctions/sheetFix',[SheetController::class,'sheetFix']);


        Route::post('/auctions/updatePublishColumn',[SheetController::class,'updatePublishColumn']);


        Route::post('/features/handleStatus',[FeatureController::class,'handleStatus']);
        Route::resource('features',FeatureController::class);
        

        
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
        Route::resource('packages',PackageController::class);
        Route::resource('memberships',MembershipController::class);
        Route::resource('blogs',BlogController::class);
        Route::resource('news',NewsController::class);
        Route::resource('newsCategory',NewsCategoryController::class);
        Route::resource('blogCategory',BlogCategoryController::class);
        Route::resource('auctionType',AuctionTypeController::class);
        
        
        Route::get('/taskManagement/counters',[TaskManagementController::class,'counters']);
        Route::post('/taskManagement/changeStatus',[TaskManagementController::class,'changeStatus']);
        Route::resource('taskManagement',TaskManagementController::class);
        Route::resource('auctions',AuctionController::class);
        Route::resource('vehicles',VController::class);
        Route::resource('prefixes',PrefixController::class);
        Route::resource('auctionStatus',AuctionStatusController::class);
        Route::resource('staffs',StaffController::class);    
        Route::post('/auctions/updatestatus/{id}',[AuctionController::class,"updateStatus"]);

        // Users
        Route::get('/users/changeStatus',[UserController::class,'changeStatus']);
        Route::resource('users',UserController::class);

        
    });




    
    
    // User Panel
    Route::prefix('user')->middleware(['auth:sanctum'])->group(function () {


        Route::prefix('profile')->group(function () {
            Route::get('/userDevices',[ProfileController::class,'userDevices']);
        });

        Route::prefix('page')->group(function () {
            Route::get('/plansList',[PageController::class,'plansList']);
            Route::post('/supportForm',[PageController::class,'supportForm']);
        });


        // Dashboard
        Route::prefix('dashboard')->group(function () {
            Route::get('/counters',[DashboardController::class,'counters']);
            Route::get('/vehicleStates',[DashboardController::class,'vehicleStates']);
            Route::get('/onlineAuctions',[DashboardController::class,'onlineAuctions']);
            Route::get('/timeAuctions',[DashboardController::class,'timeAuctions']);
        });
        
        Route::get('/auction-finder/getFilter/{id}',[AuctionFinderController::class,'getFilter']);
        Route::get('/auctionList',[AuctionFinderController::class,'auctionList']);
        Route::get('/auctionList/{id}',[AuctionFinderController::class,'getVehicleDetails']);
        Route::get('/vehicleHistory/{id}',[AuctionFinderController::class,'vehicleHistory']);
        
        Route::get('/getRelatedVehicle/{id}',[AuctionFinderController::class,'getRelatedVehicle']);
        
        Route::get('/reAuctionList',[AuctionFinderController::class,'reAuctionList']);
        Route::get('/auctionSheduler',[AuctionFinderController::class,'auctionSheduler']);

        Route::get('/compareList',[AuctionFinderController::class,'compareList']);
        Route::prefix('interest')->group(function () {
            Route::get('/myInterest',[InterestController::class,'myInterest']);
        });
        
    });




    // Web Controller..
    Route::prefix('web')->group(function () {

        Route::get('/getplans',[PlanController::class,'index']);
        Route::prefix('stripe')->middleware(['auth:sanctum'])->group(function () {
            Route::post('/createPaymentIntent',[StripeController::class,'createPaymentIntent']);
        });
        Route::get('/getCardDetail',[WebController::class,'getCardDetail'])->middleware(['auth:sanctum']);

    });





    