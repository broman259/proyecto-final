<?php

use App\Exports\EquiposExport;
use App\Exports\JugadoresExport;
use App\Exports\MaximosAnotadoresExport;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\JornadaController;
use App\Http\Controllers\JornadaJugadorController;
use App\Http\Controllers\JugadorController;
use App\Http\Controllers\ReporteController;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource('/equipos', EquipoController::class);
    Route::resource('/jugadores', JugadorController::class);
    Route::resource('/jornadas', JornadaController::class);
    Route::resource('/punteos', JornadaJugadorController::class);
    Route::resource('/reportes', ReporteController::class);

    Route::get('/reportes-jugadores-general', [ReporteController::class, 'jugadoresGeneral'])->name('reportes.jugadoresGeneral');
    Route::get('/reportes-jugadores-equipo', [ReporteController::class, 'jugadoresequipo'])->name('reportes.jugadoresEquipo');

    Route::get('/reportes-equipos', [ReporteController::class, 'equipos'])->name('reportes.equipos');

    Route::get('/reportes-maximos-anotadores', [ReporteController::class, 'maximosAnotadores'])->name('reportes.maximosAnotadores');


    Route::get('/export-equipos', function () {
        return Excel::download(new EquiposExport, 'equipos.xlsx');
    });

    Route::get('/export-jugadores', function () {
        return Excel::download(new JugadoresExport, 'jugadores.xlsx');
    });

    Route::get('/export-maximos-anotadores', function () {
        return Excel::download(new MaximosAnotadoresExport, 'maximos-anotadores.xlsx');
    });
});
