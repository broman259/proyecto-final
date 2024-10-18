<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jornada extends Model
{
    public function jugadores(){
        return $this->belongsToMany(Jugador::class, 'jornada_jugador');
        // return $this->hasMany(JornadaJugador::class, 'jornada_id');
    }

    protected $fillable = ['nombre'];
}
