<?php

namespace App\DTO;

use App\Models\User;
use DateTimeImmutable;

readonly class ReservationDto
{
    public function __construct(
        public int $aircraftId,
        public int $taskId,
        public string $from,
        public string $to,
        public User $user
    )
    {}
}