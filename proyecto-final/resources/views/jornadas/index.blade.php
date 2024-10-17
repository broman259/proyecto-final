<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jornadas') }}
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
                                    <h3 class="text-lg font-semibold text-slate-800">Lista de Jornadas</h3>
                                    <p class="text-slate-500">Agrega una nueva jornada navideña</p>
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
                                        href="{{ route('jornadas.create') }}">
                                        Agregar Nueva Jornada
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
                                    @foreach ($jornadas as $jornada)
                                    <tr>
                                        <td class="p-4 border-b border-slate-200" style="display: none;">{{$jornada->id}}</td>
                                        <td class="p-4 border-b border-slate-200">{{ $loop->iteration }}</td>

                                        <td class="p-4 border-b border-slate-200">
                                            <div class="flex items-center gap-3">
                                                <div class="flex flex-col">
                                                    <p class="text-sm font-semibold text-slate-700">
                                                        {{$jornada->nombre}}
                                                    </p>
                                                    <!-- <p
                                                        class="text-sm text-slate-500">
                                                        descripcion
                                                    </p> -->
                                                </div>
                                            </div>
                                        </td>

                                        <td class="p-4 border-b border-slate-200">
                                            <div class="w-max">
                                                <div
                                                    class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-green-900 uppercase rounded-md select-none whitespace-nowrap bg-green-500/20">
                                                    <span class="">{{$jornada->created_at}}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-4 border-b border-slate-200">
                                            <div class="w-max">
                                                <div
                                                    class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-orange-900 uppercase rounded-md select-none whitespace-nowrap bg-orange-500/20">
                                                    <span class="">{{$jornada->updated_at}}</span>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="p-4 border-b border-slate-200">
                                            <div class="flex" role="group">
                                                <a href="{{ route('jornadas.edit', $jornada->id) }}"
                                                    class="relative px-4 py-3 select-none mx-1 rounded-lg text-center align-middle font-sans text-sm font-medium uppercase bg-slate-700 text-white transition-all hover:bg-slate-700/80 active:bg-slate-700/80"
                                                    type="button">Editar</a>

                                                <form action="{{ route('jornadas.destroy', $jornada->id) }}" method="POST" class="formEliminar">
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
                            {!! $jornadas->links() !!}
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