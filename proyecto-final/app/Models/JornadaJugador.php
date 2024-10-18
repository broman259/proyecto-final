<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JornadaJugador extends Model
{
    protected $table = 'jornada_jugador';

    public function jornada(){
        return $this->belongsTo(Jornada::class, 'jornada_id');
    }

    public function jugador(){
        return $this->belongsTo(Jugador::class, 'jugador_id');
    }

    protected $fillable = ['jornada_id', 'jugador_id', 'puntos_obtenidos', 'tipo_tiro'];
}
