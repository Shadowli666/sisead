<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Estudiante extends Model
{
    use HasFactory;

    public function procedencia() //Listo
    {
        return $this->belongsTo(Procedencia::class,'procedencia_id', 'id');
    }
    
    public function carrera() //listo
    {
        return $this->belongsTo(Carreras::class);
    }
    
    public function periodoInscripcion() //listo
    {
        return $this->belongsTo(Periodo::class);
    }

    public function materias() //Listo
    {
        return $this->belongsToMany(Materias::class, 'inscripcion_estudiantes', 'estudiante_id', 'materia_id');
    }

    public function inscripciones() // Listo
    {
    return $this->hasMany(inscripcion_estudiantes::class);
    }
    public function notasAprobadas()
    {
        return $this->hasManyThrough(
            NotaEstudiantes::class,
            inscripcion_estudiantes::class,
            'estudiante_id',
            'id_inscripcion',
            'id',
            'id'
        )->where('nota_definitiva', '>', 10);
    }
    public function notasAprobadasEnPeriodo($periodoId)
    {
    return $this->hasManyThrough(
        NotaEstudiantes::class,
        inscripcion_estudiantes::class,
        'estudiante_id',
        'id_inscripcion',
        'id',
        'id'
    )
    ->join('inscripcion_estudiantes', 'nota_estudiantes.id_inscripcion', '=', 'inscripcion_estudiantes.id')
    ->where('inscripcion_estudiantes.periodo_id', '=', $periodoId)
    ->where('nota_definitiva', '>', 10);
    }
}