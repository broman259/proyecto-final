<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    public function categorias(){
        return $this->belongsTo(Equipo::class, 'equipo_id');
    }

    public function jornadas(){
        return $this->belongsToMany(Jornada::class, 'jornada_jugador');
    }
}
