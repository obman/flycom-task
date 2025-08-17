<?php

namespace App\Repositories\Task;

use App\Models\Task;
use App\Models\Aircraft;
use Illuminate\Support\Collection;

class EloquentTaskRepository implements TaskRepository
{
    public function getTasksByAircraftEquipment(Aircraft $aircraft): Collection|Task
    {
        return $aircraft->equipment
            ->flatMap(function ($equipment) {
                return $equipment->tasks;
            })
            ->unique('id')
            ->values();
    }
}