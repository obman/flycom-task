<?php

namespace App\Repositories\Task;

use App\Models\Task;
use App\Models\Aircraft;
use Illuminate\Support\Collection;

interface TaskRepository {
    public function getTasksByAircraftEquipment(Aircraft $aircraft): Collection|Task;
}