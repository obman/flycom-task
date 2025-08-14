<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;

class EloquentAircraftRepository
{
    public function availableAircraftsByDate(DateTime $from, DateTime $to): Collection
    {
        return Aircraft::whereDoesntHave('reservations', function (Builder $query) use ($from, $to) {
            $query->whereRaw(
                "tsrange(reserved_from, reserved_to) && tsrange(?, ?)",
                [$from, $to]
            );
        })->get();
    }

    public function availableEquipmentByTask(int $aircraftId, int $taskId)
    {
        $aircraft = DB::table('equipment_aircraft as ve')
            ->join('equipment_task as ter', 'ter.equipment_id', '=', 've.equipment_id')
            ->where('ve.vessel_id', $aircraftId)
            ->where('ter.task_id', $taskId)
            ->whereColumn('ve.quantity', '>=', 'ter.quantity_required')
            ->count();
    }
}
