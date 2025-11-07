<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuctionFinderController;
use Illuminate\Support\Facades\Route;


Route::prefix('auth')->group(function () {

    Route::get('/profile',[AuthController::class,'profile'])->middleware(['auth:sanctum']);
    Route::post('/login',[AuthController::class,'login']);

});

Route::prefix('user')->middleware(['auth:sanctum'])->group(function () {

    Route::get('/auctionList',[AuctionFinderController::class,'auctionList']);
    Route::get('/reAuctionList',[AuctionFinderController::class,'reAuctionList']);
    
    Route::get('/userWatchList',[AuctionFinderController::class,'userWatchList']);
    Route::get('/userAlertList',[AuctionFinderController::class,'userAlertList']);
    Route::get('/compareList',[AuctionFinderController::class,'compareList']);

    

    

    

});


