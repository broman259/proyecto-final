<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Jugador;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipos = Equipo::paginate(10);
        return view('reportes.index', compact('equipos'));
    }

    public function jugadoresGeneral()
    {
        $equipos = Equipo::with(['jugadores' => function ($query) {
            $query->orderBy('apellido', 'asc'); // Ordenar jugadores por apellido
        }])
            ->orderBy('created_at', 'desc') // Ordenar equipos por el último agregado
            ->paginate(5);

        return view('reportes.jugadoresGeneral', compact(var_name: 'equipos'));
    }

    public function jugadoresEquipo(Request $request)
    {
        // Obtener el término de búsqueda del request
        $search = $request->input('search');
        $equipoId = $request->input('equipo_id'); // Obtener el ID del equipo seleccionado

        // Filtrar equipos y jugadores según el término de búsqueda
        $equipos = Equipo::with(['jugadores' => function ($query) use ($search) {
            if ($search) {
                // Buscar jugadores por apellido o nombre
                $query->where(function ($query) use ($search) {
                    $query->where('apellido', 'like', '%' . $search . '%')
                        ->orWhere('nombre', 'like', '%' . $search . '%');
                });
            }
            $query->orderBy('apellido', 'asc'); // Ordenar jugadores por apellido
        }])
            ->when($equipoId, function ($query) use ($equipoId) {
                return $query->where('id', $equipoId); // Filtrar por ID de equipo
            })
            ->orderBy('created_at', 'desc') // Ordenar equipos por el último agregado
            ->paginate(5); // Paginar resultados

        return view('reportes.jugadoresEquipo', compact('equipos', 'search', 'equipoId'));
    }

    public function equipos()
    {
        $equiposs = Equipo::orderBy('created_at', 'desc')->paginate(5);
        return view('reportes.equipos', compact(var_name: 'equiposs'));
    }

    public function maximosAnotadores()
    {
        return view('reportes.maximosAnotadores');
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
