<?php

use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function() {
    Route::post('/reservation', ReservationController::class);
});
