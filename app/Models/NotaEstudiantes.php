<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotaEstudiantes extends Model
{
    use HasFactory;
    protected $fillable = ['id_inscripcion','nota1','nota2','nota3'];
    /**
     * Get the inscripcion_estudiantes that owns the NotaEstudiantes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function inscripcion_estudiantes(): BelongsTo
    {
        return $this->belongsTo(inscripcion_estudiantes::class, 'id_inscripcion', 'id');
    }
}
