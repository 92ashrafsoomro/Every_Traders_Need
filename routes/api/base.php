<?php

use Illuminate\Support\Facades\Route;



Route::prefix('admin')->group(function () {

    Route::get('/', function () {

        dd('test');
    });
});



Route::prefix('user')->group(function () {

    Route::get('/', function () {

        dd('test');
    });
});


Route::prefix('web')->group(function () {

    Route::get('/', function () {

        dd('test');
    });
});
