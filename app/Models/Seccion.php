<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
    use HasFactory;
    /**
     * Get the periodo that owns the Seccion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function periodo(): BelongsTo
    {
        return $this->belongsTo('App\Models\Periodo', 'periodo_id');
    }
    public function carrera(): BelongsTo
    {
        return $this->belongsTo('App\Models\Carreras', 'carrera_id');
    }
}
