<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    public function jugadores(){
        return $this->hasMany(Jugador::class, 'equipo_id');
    }

    protected $fillable = ['nombre', 'imagen'];
}
