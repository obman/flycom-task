<?php

namespace App\Repositories\Reservation;

use App\Models\Task;
use App\Models\Aircraft;
use App\DTO\ReservationDto;
use Illuminate\Support\Carbon;

interface ReservationRepository {
    public function getAvailableDatesForMonth(Aircraft $aircraft, Task $task, Carbon $month): array;
    public function store(ReservationDto $dto): void;
}