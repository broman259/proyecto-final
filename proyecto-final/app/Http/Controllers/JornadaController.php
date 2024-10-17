<?php

namespace App\Http\Controllers;

use App\Models\Jornada;
use Illuminate\Http\Request;


class JornadaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jornadas = Jornada::paginate(10);
        return view('jornadas.index', compact('jornadas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(view: 'jornadas.crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required', 
        ]);

        // dd($request->all());

        $jornada = $request->all();

        Jornada::create($jornada);
        return redirect()->route('jornadas.index');
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
    public function edit(Jornada $jornada)
    {
        return view('jornadas.editar', compact('jornada'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jornada $jornada)
    {
        $request->validate([
            'nombre' => 'required'
        ]);

        $jor = $request->all();
        $jornada->update($jor);
        return redirect()->route('jornadas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jornada $jornada)
    {
        $jornada->delete();
        return redirect()->route('jornadas.index');
    }
}
