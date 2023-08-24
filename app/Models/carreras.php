<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class carreras extends Model
{
    use HasFactory;

    /**
     * Get all of the materias for the carreras
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function materias(): HasMany//listo
    {
        return $this->hasMany(Materias::class);
    }

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class);
    }

    public function periodo()
    {
        return $this->hasMany(Periodo::class);
    }
    
    /**
     * Get all of the seccion for the carreras
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seccion(): HasMany
    {
        return $this->hasMany(Seccion::class);
    }

}
