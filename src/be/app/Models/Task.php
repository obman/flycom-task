<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    public function equipment(): BelongsToMany
    {
        return $this->belongsToMany(Equipment::class, 'equipment_task');
    }

    public function getCompatibleAircraftsByTaskEquipment(): Collection|Aircraft
    {
        return $this->equipment
            ->flatMap(fn ($equipment) => $equipment->aircrafts)
            ->unique('id')
            ->values();
    }
}
