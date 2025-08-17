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
        Route::get('/aircrafts', [AircraftController::class, 'index']);
        Route::get('/task/{aircraft}', [TaskController::class, 'getTasksByAircraft']);
        Route::get('{aircraft}/{task}/{date}', [ReservationController::class, 'getAvailableDates']);
        Route::post('/', [ReservationController::class, 'store']);

        Route::get('/reservation', function(Request $request, AircraftRepository $repository) {
            $from = Carbon::parse($request->from);
            $to = Carbon::parse($request->to);
            $aircrafts = $repository->availableAircraftsByDate($from, $to);
            dd($aircrafts);
        });
    });
});
