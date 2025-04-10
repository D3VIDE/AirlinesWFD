<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightController;
Route::get('/', function () {
    return redirect('/flights');
});

Route::get('/flights', [FlightController::class, 'index']);
Route::get('/flights/ticket/{id}', [FlightController::class, 'show']);
