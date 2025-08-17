<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Aircraft;
use Illuminate\Support\Carbon;
use App\Events\AircraftReserved;
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
        $dto = $request->toDto();
        $this->reservationService->reserve($dto);
        event(new AircraftReserved($dto->user));
        return response([
            'code' => 'reservation.success'
        ]);
    }
}
