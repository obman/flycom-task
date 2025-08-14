<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Equipment extends Model
{
    public function aircraft(): BelongsToMany
    {
        return $this->belongsToMany(Aircraft::class);
    }
}
