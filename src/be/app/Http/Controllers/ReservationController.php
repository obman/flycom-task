<?php

namespace App\Http\Controllers;

use App\Services\ReservationService;
use App\Http\Requests\ReservationRequest;

class ReservationController extends Controller
{
    public function __invoke(ReservationRequest $request, ReservationService $reservationService)
    {
        $data = $request->validated();
        $reservationService->reserve($data);

        return true;
    }
}
