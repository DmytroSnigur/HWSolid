<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/geocoderSolid', [App\Http\Controllers\TestController::class, 'index']);
