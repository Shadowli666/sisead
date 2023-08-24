<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\hasManyThrough;

class periodo extends Model
{
    use HasFactory;
    /**
     * Get all of the inscripcionEstudiantes for the periodo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inscripcionEstudiantes(): HasMany // Listo
    {
        return $this->hasMany(inscripcion_estudiantes::class, 'periodo_id', 'id');
    }

    public function estudiantes() // Listo
    {
        return $this->hasManyThrough(Estudiante::class, inscripcion_estudiantes::class, 'periodo_id','id','id','estudiante_id');
    }

    public function materias()
    {
        return $this->hasManyThrough(Materias::class, inscripcion_estudiantes::class, 'periodo_id','id','id','materia_id');
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
