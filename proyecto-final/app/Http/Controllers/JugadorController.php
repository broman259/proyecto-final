<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Jugador;
use Illuminate\Http\Request;

class JugadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jugadores = Jugador::with('equipo')->paginate(10);
        return view('jugadores.index', compact('jugadores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $equipos = Equipo::all();
        return view('jugadores.crear', compact('equipos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'fecha_nac' => 'required',
            'imagen' => 'required|image|mimes:jpeg,png,svg,jpg|max:1024',
            'equipo_id' => 'required|exists:equipos,id'
        ]);

        $jugador = $request->all();

        if($imagen = $request->file('imagen')){
            $rutaGuardarImg = 'imagen/';
            $imagenJugador = date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move(public_path($rutaGuardarImg), $imagenJugador);
            $jugador['imagen'] = $imagenJugador;
        }

        Jugador::create($jugador);
        return redirect()->route('jugadores.index');
    
        // $jugador = new Jugador();
        // $jugador->nombre = $request->input('nombre');
        // $jugador->equipo_id = $request->input('equipo_id'); // Asignar el equipo al jugador
        // $jugador->save();
        // return redirect()->route('jugadores.index')->with('success', 'Jugador registrado con éxito');

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
    public function edit(Jugador $jugador)
    {
        $equipos = Equipo::all();
        return view('jugadores.editar', compact('jugador','equipos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jugador $jugador)
    {
        $jugador->delete();
        return redirect()->route('jugadores.index');
    }
}
