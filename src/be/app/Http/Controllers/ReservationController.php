<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Aircraft;
use Illuminate\Support\Carbon;
use App\Services\ReservationService;
use App\Http\Requests\ReservationRequest;

class ReservationController extends Controller
{
    public function __construct(
        private ReservationService $reservationService
    )
    {}

    public function getAvailableDates(Aircraft $aircraft, Task $task, Carbon $date)
    {
        // TODO: get available dates for given month
        $dates = $this->reservationService->getDates($aircraft, $task, $date);
    }

    public function store(ReservationRequest $request, ReservationService $reservationService)
    {
        $data = $request->validated();
        $reservationService->reserve($data);
        // TODO: api resource response with data
        return true;
    }
}
