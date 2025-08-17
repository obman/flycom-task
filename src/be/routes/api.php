<?php

use App\Models\Aircraft;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AircraftController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TaskController;
use App\Repositories\Aircraft\AircraftRepository;

Route::prefix('v1')->group(function() {
    Route::prefix('reservation')->group(function() {
        Route::get('/tasks', [TaskController::class, 'index']);
        Route::get('/aircrafts/{task}', [AircraftController::class, 'getAircraftsByTask']);
        Route::get('/{task}/{aircraft}/{date}', [ReservationController::class, 'getAvailableDates']);
        Route::post('/', [ReservationController::class, 'store']);
    });
});
