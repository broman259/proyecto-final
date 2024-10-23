<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipos = Equipo::paginate(10);
        return view('equipos.index', compact('equipos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('equipos.crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $campos = [
            'nombre' => 'required|string|unique:equipos|max:50',
            'imagen' => 'required|image|mimes:jpeg,png,jpg|max:1024'
        ];

        $mensaje=[
            'required' => 'El :attribute es requerido',
            'imagen.required' => 'la imagen es requerida'
        ];

        $request->validate($campos, $mensaje);

        $equipo = $request->all();

        if($imagen = $request->file('imagen')){
            $rutaGuardarImg = 'imagen/';
            $imagenEquipo = date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move(public_path($rutaGuardarImg), $imagenEquipo);
            $equipo['imagen'] = $imagenEquipo;
        }
            
        Equipo::create($equipo);
        return redirect()->route('equipos.index');
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
    public function edit(Equipo $equipo)
    {
        return view('equipos.editar', compact('equipo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipo $equipo)
    {
        $campos = [
            'nombre' => 'required|string|max:50|unique:equipos,nombre,' . $equipo->id,
        ];

        $mensaje=[
            'required' => 'El :attribute es requerido',
        ];

        $request->validate($campos, $mensaje);

        $equ = $request->all();

        if($imagen = $request->file('imagen')){
            $rutaGuardarImg = 'imagen/';
            $imagenEquipo = date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move(public_path($rutaGuardarImg), $imagenEquipo);
            $equ['imagen'] = $imagenEquipo;
        } else {
            unset($equ['imagen']);
        }
        $equipo->update($equ);
        return redirect()->route('equipos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipo $equipo)
    {
        if($equipo->imagen){
            $rutaImagen = public_path('imagen/') . $equipo->imagen;
            if(file_exists($rutaImagen)){
                unlink($rutaImagen);
            }
        }
        $equipo->delete();
        return redirect()->route('equipos.index');
    }
}
