<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Services\ReservationService;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function __invoke(ReservationRequest $request, ReservationService $reservationService)
    {
        $data = $request->validated();

    }
}
