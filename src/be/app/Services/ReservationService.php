<?php

namespace App\Services;

use App\DTO\ReservationDto;
use App\Models\User;
use App\Models\Reservation;
use App\Repositories\Aircraft\AircraftRepository;

class ReservationService
{
    public function __construct(
        private AircraftRepository $repository
    )
    {
        dump('In constructor');
    }

    // TODO: refactor array to DTO
    public function reserve(array $data)
    {
        // TODO: check if aircraft is available
        // TODO: check if equipment is for the task
        // TODO: get first empty date
        $reservationDto = new ReservationDto($data['aircraft'], $data['task'], $data['from'], $data['to']);
        $this->store($reservationDto);
    }

    private function store(ReservationDto $dto): void
    {
        $reservation = new Reservation();
        $reservation->aircraft_id = $dto->aircraftId;
        $reservation->task_id = $dto->taskId;
        $reservation->reserved_from = $dto->from;
        $reservation->reserved_to = $dto->to;
        $reservation->createdBy()->associate(User::find(1));
        $reservation->save();
    }
}
