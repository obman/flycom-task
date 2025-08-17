<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Equipment extends Model
{
    public function aircrafts(): BelongsToMany
    {
        return $this->belongsToMany(Aircraft::class, 'equipment_aircraft');
    }

    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'equipment_task');
    }
}
