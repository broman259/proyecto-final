<?php

namespace App\Http\Controllers;

use App\Models\Jornada;
use App\Models\JornadaJugador;
use App\Models\Jugador;
use Illuminate\Http\Request;

class JornadaJugadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $punteos = JornadaJugador::with(['jugador', 'jornada'])->paginate(10);
        return view('punteos.index', compact('punteos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jornadas = Jornada::all();
        $jugadores = Jugador::all();
        return view('punteos.crear', compact('jornadas', 'jugadores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jornada_id' => 'required|exists:jornadas,id',
            'jugador_id' => 'required|exists:jugadores,id',
            'puntos_obtenidos' => 'required',
            'tipo_tiro' => 'required'
        ],[
            'puntos_obtenidos.required' => 'El punteo no debe quedar vacio.'
        ]);

        $tipoAccion = $request->input('tipo_tiro');
        $otro_tipo = $request->input('otro_tipo');

        $punteo = $request->all();

        if ($tipoAccion === 'Otro') {
            
            $tipoAccion = $otro_tipo;
            $punteo['tipo_tiro'] = $request->input('tipo_tiro') . ': ' . $tipoAccion;
        }    

        JornadaJugador::create($punteo);
        return redirect()->route('punteos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JornadaJugador $punteo)
    {
        $jornadas = Jornada::all();
        $jugadores = Jugador::all();
        $datoLimpio = str_ireplace('Otro: ', '', $punteo->tipo_tiro);
        return view('punteos.editar', compact('punteo','datoLimpio', 'jornadas', 'jugadores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JornadaJugador $punteo)
    {
        $request->validate([
            'puntos_obtenidos' => 'required',
            'tipo_tiro' => 'required'
        ],[
            'puntos_obtenidos.required' => 'El punteo no debe quedar vacio.'
        ]);

        $tipoAccion = $request->input('tipo_tiro');
        $otro_tipo = $request->input('otro_tipo');

        $punt = $request->all();

        if ($tipoAccion === 'Otro') {
            
            $tipoAccion = $otro_tipo;
            $punt['tipo_tiro'] = $request->input('tipo_tiro') . ': ' . $tipoAccion;
        }

        $punteo->update($punt);
        return redirect()->route('punteos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JornadaJugador $punteo)
    {
        $punteo->delete();
        return redirect()->route('punteos.index');
    }
}
