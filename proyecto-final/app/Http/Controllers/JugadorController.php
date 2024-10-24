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
        $campos = [
            'nombre' => 'required|string|max:50',
            'apellido' => 'required|string|max:50',
            'fecha_nac' => 'required|date',
            'imagen' => 'required|image|mimes:jpeg,png,jpg|max:1024',
            'equipo_id' => 'required|exists:equipos,id'
        ];

        $mensaje=[
            'required' => 'El :attribute es requerido',
            'imagen.required' => 'la imagen es requerida',
            'fecha_nac.required' => 'la fecha es requerida',
        ];

        $request->validate($campos, $mensaje);

        $jugador = $request->all();

        if($imagen = $request->file('imagen')){
            $rutaGuardarImg = 'imagen/';
            $imagenJugador = date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move(public_path($rutaGuardarImg), $imagenJugador);
            $jugador['imagen'] = $imagenJugador;
        }

        Jugador::create($jugador);
        return redirect()->route('jugadores.index');
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
    public function edit(Jugador $jugadore)
    {
        // dd($jugadore);
        $equipos = Equipo::all();
        return view('jugadores.editar', compact('jugadore','equipos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jugador $jugadore)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'fecha_nac' => 'required'
        ]);

        $campos = [
            'nombre' => 'required|string|max:50',
            'apellido' => 'required|string|max:50',
            'fecha_nac' => 'required|date',
        ];

        $mensaje=[
            'required' => 'El :attribute es requerido',
        ];

        $request->validate($campos, $mensaje);

        $jug = $request->all();

        if($imagen = $request->file('imagen')){
            $rutaGuardarImg = 'imagen/';
            $imagenJugador = date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move(public_path($rutaGuardarImg), $imagenJugador);
            $jug['imagen'] = $imagenJugador;
        } else {
            unset($jug['imagen']);
        }
        $jugadore->update($jug);
        return redirect()->route('jugadores.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jugador $jugadore)
    {
        // dd($jugador);
        // $jugador = Jugador::findOrFail($id);
        if($jugadore->imagen){
            $rutaImagen = public_path('imagen/') . $jugadore->imagen;
            if(file_exists($rutaImagen)){
                unlink($rutaImagen);
            }
        }
        $jugadore->delete();
        return redirect()->route('jugadores.index');
    }
}
