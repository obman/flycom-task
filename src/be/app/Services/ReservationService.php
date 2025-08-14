<?php

namespace App\Services;

use App\Repositories\ReservationRepository;

class ReservationService
{
    public function __construct(
        private ReservationRepository $repository
    )
    {}

    // TODO: refactor array to DTO
    public function reserve(array $data)
    {
        // TODO: check if aircraft is available
        // TODO: check if equipment is for the task
        // TODO: get first empty date
    }
}
