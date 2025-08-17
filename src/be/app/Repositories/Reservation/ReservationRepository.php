<?php

namespace App\Repositories\Reservation;

use App\Models\Task;
use App\Models\Aircraft;
use App\DTO\ReservationDto;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

interface ReservationRepository {
    public function getAvailableDatesForMonth(array $taskIds, array $aircraftIds, Carbon $month): array;
    public function store(ReservationDto $dto): void;
}