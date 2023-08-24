<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profesor extends Model
{
    use HasFactory;

    /**
     * Get all of the materias for the Profesor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function materias(): HasMany //LISTO
    {
        return $this->hasMany(Materias::class);
    }
}