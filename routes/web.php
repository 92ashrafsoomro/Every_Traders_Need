<?php

use App\Http\Controllers\Api\UploadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ProfileSettingController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\PaymentController; // Import the controller
use App\Http\Controllers\TestPaymentController;
use App\Http\Controllers\UiSettingController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\InterestController;
use App\Http\Controllers\AuctionFinderController;
use App\Http\Controllers\AuctionFinderDataController;
use App\Http\Controllers\ReauctionController;
use App\Http\Controllers\CompareController;
use App\Http\Controllers\UserAlertController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\InvoiceController;
use App\Http\Middleware\CheckUserStatus;
use App\Models\BodyType;
use App\Models\Color;
use App\Models\Make;
use App\Models\ModelVariant;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use App\Models\VehicleType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Broadcast;
use App\Http\Controllers\NotifyIntrestController;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Auth\GoogleController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Broadcast::routes(['middleware' => ['auth:sanctum']]);
// ya agar session auth use kar rahe ho to
Broadcast::routes(['middleware' => ['auth']]);


Route::get('/uploads/make',[UploadController::class,'make']);
Route::get('/uploads/model',[UploadController::class,'model']);
Route::get('/uploads/variant',[UploadController::class,'variant']);
Route::get('/uploads/bodyType',[UploadController::class,'bodyType']);


Route::get('/uploading1', function (Request $request) {

    Vehicle::query()->delete();
    BodyType::query()->delete();
    VehicleType::query()->delete();
    Color::query()->delete();
    ModelVariant::query()->delete();
    VehicleModel::query()->delete();
    Make::query()->delete();


    $path = public_path('color.csv');
    $csv = file($path);
    $rows = array_map('str_getcsv', $csv);
    foreach ($rows as $value) {
        if ($value[1]) {
            Color::create([
                'id' => $value[0],
                'name' => $value[1],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }

    $path = public_path('body.csv');
    $csv = file($path);
    $rows = array_map('str_getcsv', $csv);
    foreach ($rows as $value) {
        if ($value[1]) {
            BodyType::create([
                'id' => $value[0],
                'name' => $value[1],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }


    $path = public_path('vehicle.csv');
    $csv = file($path);
    $rows = array_map('str_getcsv', $csv);
    foreach ($rows as $value) {
        if ($value[1]) {
            VehicleType::create([
                'id' => $value[0],
                'name' => $value[1],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }


    //Path
    $path = public_path('make.csv');
    $csv = file($path);
    $rows = array_map('str_getcsv', $csv);
    foreach ($rows as $value) {
        if ($value[1]) {
            Make::create([
                'id' => $value[0],
                'name' => $value[1],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }


    //Path
    $path = public_path('model.csv');
    $csv = file($path);
    $rows = array_map('str_getcsv', $csv);
    foreach ($rows as $value) {
        if ($value[1]) {
            VehicleModel::create([
                'id' => $value[0],
                'name' => $value[1],
                'make_id' => $value[2],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }

});


Route::get('/invoice', function () {

    $pdf = Pdf::loadView('invoice.vieww', []);
    return $pdf->stream();
    
});


Route::get('/{any?}', function () {
    return view('main');
})->where('any', '.*');






