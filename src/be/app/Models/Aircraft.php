<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Aircraft extends Model
{
    use SoftDeletes;
    
    protected $table = 'aircrafts';
    protected $fillable = [
        'type_id', 'size_id', 'name'
    ];

    public function equipment(): BelongsToMany
    {
        return $this->belongsToMany(Equipment::class, 'equipment_aircraft')->withPivot('quantity');
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function getCompatibleTasksByAircraftEquipment(): Collection|Task
    {
        return $this->equipment
            ->flatMap(function ($equipment) {
                return $equipment->tasks;
            })
            ->unique('id')
            ->values();
    }

}
