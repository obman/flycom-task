<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Aircraft;
use Illuminate\Support\Carbon;
use App\Services\ReservationService;
use App\Http\Requests\ReservationRequest;
use App\Http\Resources\ReservationDaysResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ReservationController extends Controller
{
    public function __construct(
        private ReservationService $reservationService
    )
    {}

    public function getAvailableDates(Task $task, Aircraft $aircraft, Carbon $date): AnonymousResourceCollection
    {
        $datesWithIds = $this->reservationService->getDates($task, $aircraft, $date);
        return ReservationDaysResource::collection($datesWithIds);
    }

    public function store(ReservationRequest $request)
    {
        $this->reservationService->reserve($request->toDto());
        return response([
            'code' => 'reservation.success'
        ]);
    }
}
