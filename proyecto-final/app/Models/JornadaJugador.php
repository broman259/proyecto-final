<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JornadaJugador extends Model
{
    
    protected $fillable = ['jornada_id', 'jugador_id', 'puntos', 'tipo_tiro'];
}
