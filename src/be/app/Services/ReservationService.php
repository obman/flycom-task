<?php

namespace App\Services;

use App\Models\Task;
use App\Models\Aircraft;
use App\DTO\ReservationDto;
use Illuminate\Support\Carbon;
use App\Repositories\Aircraft\AircraftRepository;
use App\Repositories\Reservation\ReservationRepository;

class ReservationService
{
    public function __construct(
        private ReservationRepository $reservationRepository,
        private AircraftRepository $aircraftRepository
    )
    {}

    public function getDates(Aircraft $aircraft, Task $task, Carbon $month): array
    {
        return $this->reservationRepository->getAvailableDatesForMonth($aircraft, $task, $month);
    }

    public function reserve(array $data)
    {
        // TODO: check if aircraft is available
        // TODO: check if equipment is for the task
        // TODO: get first empty date
        $reservationDto = new ReservationDto($data['aircraft'], $data['task'], $data['from'], $data['to'], $data['user']);
        $this->reservationRepository->store($reservationDto);
    }
}
