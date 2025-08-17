<?php

namespace App\DTO;

use App\Models\User;
use App\Enums\ReservationType;
use Illuminate\Support\Carbon;

class ReservationDto
{
    public function __construct(
        public int $aircraftId,
        public int $taskId,
        public array $dates,
        public ReservationType $mode,
        public User $user
    )
    {}

    public function expandedDates(): array
    {
        if ($this->mode === ReservationType::RANGE) {
            if (count($this->dates) !== 2) {
                throw new \InvalidArgumentException('Range mode requires exactly 2 dates.');
            }

            $start = Carbon::parse($this->dates[0]);
            $end = Carbon::parse($this->dates[1]);
            $days = [];

            while ($start->lte($end)) {
                $days[] = $start->toDateString();
                $start->addDay();
            }

            return $days;
        }

        return array_map(fn($d) => Carbon::parse($d)->toDateString(), $this->dates);
    }
}