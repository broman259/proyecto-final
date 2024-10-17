<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Equipos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <a type="button" href="{{ route('equipos.create') }}" class="bg-indigo-500 px-12 py-2 rounded text-gray-200 font-semibold hover:bg-indigo-800 transition duration-200 each-in-out">Crear un Equipo</a>

                <table class="table-fixed w-full mt-5">
                    <thead>
                        <tr class="bg-gray-800 text-white">
                            <th class="border px-4 py-2">Id</th>
                            <th class="border px-4 py-2">Equipo</th>
                            <th class="border px-14 py-1">Imagen</th>
                            <th class="border px-4 py-2">Creado el</th>
                            <th class="border px-4 py-2">Última Actualización</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($equipos as $equipo)
                        <tr>
                            <td>{{$equipo->id}}</td>
                            <td>{{$equipo->nombre}}</td>
                            <td class="border px-14 py-1">
                                <img src="/imagen/{{$equipo->imagen}}" width="60%">
                            </td>
                            <td>{{$equipo->created_at}}</td>
                            <td>{{$equipo->updated_at}}</td>
                            <td class="border px-4 py-2">
                                <div class="flex justify-center rounded-lg text-lg" role="group">
                                    <a href="{{ route('equipos.edit', $equipo->id) }}" class="rounded bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4">Editar</a>

                                    <form action="{{ route('equipos.destroy', $equipo->id) }}" method="POST" class="formEliminar">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded bg-pink-400 hover:bg-pink-500 text-white font-bold py-2 px-4">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    {!! $equipos->links() !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    (function () {
        'use strict'

        var forms = document.querySelectorAll('.formEliminar')
        Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
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