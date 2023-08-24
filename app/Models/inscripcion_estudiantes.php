<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class inscripcion_estudiantes extends Model
{
    use HasFactory;

    protected $fillable = ['estudiante_id','periodo_id','materia_id'];
    public function periodo() //Listo
    {
        return $this->belongsTo('App\Models\Periodo', 'periodo_id');
    }

    public function estudiante() //Listo
    {
        return $this->belongsTo('App\Models\Estudiante', 'estudiante_id');
    }

    public function materias() //Listo
    {
        return $this->belongsTo('App\Models\Materias', 'materia_id');
    }

    public function notaEstudiantes()
    {
        return $this->hasOne('App\Models\NotaEstudiantes','id_inscripcion','id');
    }
}
