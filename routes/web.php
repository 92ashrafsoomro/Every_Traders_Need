<?php

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

use App\Http\Controllers\Auth\GoogleController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Broadcast::routes(['middleware' => ['auth:sanctum']]);
// ya agar session auth use kar rahe ho to
Broadcast::routes(['middleware' => ['auth']]);

Route::get('/{any?}', function () {
    return view('user.test');
})->where('any', '.*');


