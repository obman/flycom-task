<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Aircraft extends Model
{
    protected $table = 'aircrafts';
    protected $fillable = [
        'type_id', 'size_id', 'name'
    ];

    public function equipment(): BelongsToMany
    {
        return $this->belongsToMany(Equipment::class)->withPivot('quantity');
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
