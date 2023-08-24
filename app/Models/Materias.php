<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Materias extends Model
{
    use HasFactory;
    /**
     * Get the carreras that owns the Materias
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carreras(): BelongsTo //Listo
    {
        return $this->belongsTo('App\Models\carreras', 'carrera_id', 'id');
    }
    /**
     * Relacion que trae la carrera a la que pertenece
     */

    /**
     * Get the profesor that owns the Materias
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profesor(): BelongsTo // Listo
    {
        return $this->belongsTo('App\Models\Profesor', 'profesor_id', 'id');
    }
    /**
     * Relacion que trae al profesor que da la materia
     */
    
    /**
     * Get all of the inscripciones for the Materias
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inscripciones(): HasMany //Listo
    {
        return $this->hasMany(inscripcion_estudiantes::class, 'materia_id', 'id');
    }

    /**
     * 
     * Relacion que obtiene todas las inscripciones de la materia
     */

     public function periodos(): BelongsToMany
{
    return $this->belongsToMany(Periodo::class, 'inscripcion_estudiantes', 'materia_id', 'periodo_id');
}

}