<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class procedencia extends Model
{
    use HasFactory;
    /**
     * Get all of the estudiante for the procedencia
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    // public function estudiante(): HasMany
    // {
    //     return $this->hasMany(Estudiante::class);
    // }

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class);
    }
}
