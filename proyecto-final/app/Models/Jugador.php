<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    protected $table = 'jugadores';
    public function equipo(){
        return $this->belongsTo(Equipo::class, 'equipo_id');
    }

    public function jornadas(){
        return $this->belongsToMany(Jornada::class, 'jornada_jugador');

        // return $this->hasMany(JornadaJugador::class, 'jugador_id');
    }

    protected $fillable = ['nombre', 'apellido', 'fecha_nac', 'imagen', 'equipo_id'];
}
