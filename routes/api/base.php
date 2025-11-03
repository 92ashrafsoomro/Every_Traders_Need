<?php

use App\Http\Controllers\ApiAuthController;
use Illuminate\Support\Facades\Route;


Route::prefix('auth')->group(function () {

    Route::get('/profile',[ApiAuthController::class,'profile'])->middleware(['auth:sanctum']);
    Route::post('/login',[ApiAuthController::class,'login']);

});
