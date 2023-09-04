<?php

namespace App\Models;
//TODO hacer relaciones a seccion periodo materia profesor en los otros modelos
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class SeccionMateria extends Model
{
    use HasFactory;
    /**
     * Get the periodo that owns the SeccionMateria
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function periodo(): BelongsTo
    {
        return $this->belongsTo(periodo::class, 'App\Models\periodo', 'periodo_id');
    }
    /**
     * Get the seccion that owns the SeccionMateria
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seccion(): BelongsTo
    {
        return $this->belongsTo(Seccion::class, 'App\Models\Periodo', 'seccion_id');
    }
    /**
     * Get all of the materias for the SeccionMateria
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function materias(): HasMany
    {
        return $this->hasMany(Materias::class, 'App\Models\Materias', 'materia_id');
    }
}
