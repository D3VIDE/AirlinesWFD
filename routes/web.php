<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightController;
Route::get('/', function () {
    return redirect('/flights');
});

Route::get('/flights', [FlightController::class, 'index']);