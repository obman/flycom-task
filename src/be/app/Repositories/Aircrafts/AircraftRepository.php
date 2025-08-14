<?php

namespace App\Repositories\Aircrafts;

use Illuminate\Database\Eloquent\Collection;

interface AircraftRepository
{
    public function availableAircraftsByDate(DateTime $from, DateTime $to): Collection;
    public function availableEquipmentByTask(int $aircraftId, int $taskId);
}
