<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Punteos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">


                <div class="mx-auto">

                    <div class="relative flex flex-col w-full h-full text-slate-700 bg-white shadow-md rounded-xl bg-clip-border">
                        <div class="relative mx-4 mt-4 overflow-hidden text-slate-700 bg-white rounded-none bg-clip-border">
                            <div class="flex items-center justify-between ">
                                <div>
                                    <h3 class="text-lg font-semibold text-slate-800">Lista de Punteos x Jornada</h3>
                                    <p class="text-slate-500">Agrega el punteo al jugador por cada jornada</p>
                                </div>
                                <div class="flex flex-col gap-2 shrink-0 sm:flex-row">
                                    <!-- <button
                                        class="rounded border border-slate-300 py-2.5 px-3 text-center text-sm font-semibold text-slate-600 transition-all hover:opacity-75 focus:ring focus:ring-slate-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                        type="button">
                                        POR SI ACASO
                                    </button> -->
                                    <a
                                        class="flex select-none items-center gap-2 rounded bg-slate-800 py-2.5 px-4 text-sm font-semibold text-white shadow-md shadow-slate-900/10 transition-all hover:shadow-lg hover:shadow-slate-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                        type="button"
                                        href="{{ route('punteos.create') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
                                            stroke-width="2" class="w-4 h-4">
                                            <path
                                                d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                                            </path>
                                        </svg>
                                        Agregar Punteo
                                    </a>
                                </div>
                            </div>

                        </div>
                        <div class="p-0 overflow-scroll">
                            <table class="w-full mt-4 text-left table-auto min-w-max">
                                <thead>
                                    <tr class="bg-slate-800 text-white">
                                        <th class="p-4 border-y border-slate-200">
                                            <p class="flex items-center justify-between gap-2 font-sans text-md font-semibold leading-none">
                                                No. </p>
                                        </th>
                                        <th class="p-4 border-y border-slate-200">
                                            <p class="flex items-center justify-between gap-2 font-sans text-md font-semibold leading-none">
                                                Jornada </p>
                                        </th>
                                        <th class="p-4 border-y border-slate-200">
                                            <p class="flex items-center justify-between gap-2 font-sans text-md font-semibold leading-none">
                                                Jugador </p>
                                        </th>
                                        <th class="p-4 border-y border-slate-200">
                                            <p class="flex items-center justify-between gap-2 font-sans text-md font-semibold leading-none">
                                                Tipo de Tiro </p>
                                        </th>
                                        <th class="p-4 border-y border-slate-200">
                                            <p class="flex items-center justify-between gap-2 font-sans text-md font-semibold leading-none">
                                                Puntos Obtenidos</p>
                                        </th>
                                        <th class="p-4 border-y border-slate-200">
                                            <p class="flex items-center justify-between gap-2 font-sans text-md font-semibold leading-none">
                                                Creado el </p>
                                        </th>
                                        <th class="p-4 border-y border-slate-200">
                                            <p class="flex items-center justify-between gap-2 font-sans text-md font-semibold leading-none">
                                                Última Actualización </p>
                                        </th>
                                        <th class="p-4 border-y border-slate-200">
                                            <p class="flex items-center justify-between gap-2 font-sans text-md font-semibold leading-none">
                                                Acciones </p>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($punteos as $punteo)
                                    <tr>
                                        <td class="p-4 border-b border-slate-200" style="display: none;">{{$punteo->id}}</td>
                                        <td class="p-4 border-b border-slate-200">{{ $loop->iteration }}</td>

                                        <td class="p-4 border-b border-slate-200">
                                            <div class="flex items-center gap-3">
                                                <div class="flex flex-col">
                                                    <p class="text-sm font-semibold text-slate-700">
                                                        {{$punteo->jornada->nombre}}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="p-4 border-b border-slate-200">
                                            <div class="flex items-center gap-3">
                                                <img src="/imagen/{{$punteo->jugador->imagen}}"
                                                    class="relative inline-block h-9 w-9 !rounded-full object-cover object-center" />
                                                <div class="flex flex-col">
                                                    <p class="text-sm font-semibold text-slate-700">
                                                        {{$punteo->jugador->nombre}}
                                                    </p>
                                                    <p
                                                        class="text-sm font-semibold text-slate-700">
                                                        {{$punteo->jugador->apellido}}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="p-4 border-b border-slate-200">
                                            <div class="flex items-center gap-3">
                                                <div class="flex flex-col">
                                                    <p class="text-sm font-semibold text-slate-700">
                                                        {{$punteo->tipo_tiro}}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="p-4 border-b border-slate-200">
                                            <div class="flex items-center gap-3">
                                                <div class="flex flex-col">
                                                    <p class="text-sm font-semibold text-slate-700">
                                                        {{$punteo->puntos_obtenidos}}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="p-4 border-b border-slate-200">
                                            <div class="w-max">
                                                <div
                                                    class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-green-900 uppercase rounded-md select-none whitespace-nowrap bg-green-500/20">
                                                    <span class="">{{ \Carbon\Carbon::parse($punteo->updated_at)->setTimezone('America/Guatemala')->format('d/m/Y H:i:s') }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-4 border-b border-slate-200">
                                            <div class="w-max">
                                                <div
                                                    class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-orange-900 uppercase rounded-md select-none whitespace-nowrap bg-orange-500/20">
                                                    <span class="">{{ \Carbon\Carbon::parse($punteo->updated_at)->setTimezone('America/Guatemala')->format('d/m/Y H:i:s') }}</span>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="p-4 border-b border-slate-200">
                                            <div class="flex" role="group">
                                                <a href="{{ route('punteos.edit', $punteo->id) }}"
                                                    class="relative px-4 py-3 select-none mx-1 rounded-lg text-center align-middle font-sans text-sm font-medium uppercase bg-slate-700 text-white transition-all hover:bg-slate-700/80 active:bg-slate-700/80"
                                                    type="button">Editar</a>

                                                    <form action="{{ route('punteos.destroy', $punteo->id) }}" method="POST" class="formEliminar">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        class="relative px-4 py-3 select-none mx-1 rounded-lg text-center align-middle font-sans text-sm font-medium uppercase bg-red-700 text-white transition-all hover:bg-red-700/80 active:bg-red-700/80 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                                        type="submit">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="flex justify-center py-3">
                            {!! $punteos->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    (function() {
        'use strict'

        var forms = document.querySelectorAll('.formEliminar')
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    event.preventDefault()
                    event.stopPropagation()

                    Swal.fire({
                        title: '¿Confirma la eliminación del registro?',
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#20c997',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Confirmar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                            Swal.fire('¡Eliminado!', 'El registro ha sido eliminado exitosamente.', 'success');
                        }
                    })

                }, false)
            })
    })()
</script>