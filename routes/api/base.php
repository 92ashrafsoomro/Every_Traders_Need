<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuctionFinderController;
use App\Http\Controllers\Api\InterestController;
use App\Http\Controllers\Api\MasterController;
use Illuminate\Support\Facades\Route;


Route::prefix('auth')->group(function () {

    Route::get('/profile',[AuthController::class,'profile'])->middleware(['auth:sanctum']);
    Route::post('/login',[AuthController::class,'login']);
    Route::post('/register',[AuthController::class,'register']);

});


Route::prefix('master')->middleware(['auth:sanctum'])->group(function () {

    Route::get('/getVehicleTypes',[MasterController::class,'getVehicleTypes']);
    Route::get('/getBodyType',[MasterController::class,'getBodyType']);
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


Route::prefix('user')->middleware(['auth:sanctum'])->group(function () {

    Route::get('/auctionList',[AuctionFinderController::class,'auctionList']);
    Route::get('/auctionList/{id}',[AuctionFinderController::class,'getVehicleDetails']);
    Route::get('/getRelatedVehicle/{id}',[AuctionFinderController::class,'getRelatedVehicle']);

    

    Route::get('/reAuctionList',[AuctionFinderController::class,'reAuctionList']);
    Route::get('/userWatchList',[AuctionFinderController::class,'userWatchList']);
    Route::get('/userAlertList',[AuctionFinderController::class,'userAlertList']);
    Route::get('/compareList',[AuctionFinderController::class,'compareList']);
    Route::prefix('interest')->group(function () {
         Route::get('/myInterest',[InterestController::class,'myInterest']);
    });

});


