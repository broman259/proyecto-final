<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reporte General de Equipos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="mx-auto">
                    <div class="relative flex flex-col w-full h-full text-slate-700 bg-white shadow-md rounded-xl bg-clip-border">
                        <div class="relative mx-4 mt-4 overflow-hidden text-slate-700 bg-white rounded-none bg-clip-border">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-lg font-semibold text-slate-800">Reporte General de Equipos</h3>
                                    <p class="text-slate-500">Todos los equipos</p>
                                </div>
                                <div class="flex flex-col gap-2 shrink-0 sm:flex-row">
                                    <!-- Filtro por nombre de jugador o equipo -->
                                    <input type="text" id="filterInput" placeholder="Buscar equipo..." class="px-4 py-2 mr-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-blue-500">
                                </div>
                            </div>
                        </div>

                        <div class="p-0 overflow-scroll">
                            <div id="resultados" class="my-6">
                                <table class="w-full mt-4 text-left table-auto min-w-max">
                                    <thead>
                                        <tr class="bg-slate-800 text-white">
                                            <th class="p-4 border-y border-slate-200">
                                                <p class="font-sans text-md font-semibold leading-none">Equipo</p>
                                            </th>
                                            <th class="p-4 border-y border-slate-200">
                                                <p class="font-sans text-md font-semibold leading-none">Creado el</p>
                                            </th>
                                            <th class="p-4 border-y border-slate-200">
                                                <p class="font-sans text-md font-semibold leading-none">Última Actualización</p>
                                            </th>
                                        </tr>
                                    </thead>
                                    @foreach ($equiposs as $equipo)
                                    <tbody id="dataTable">
                                        <tr class="border-b border-slate-300">
                                            <td class="p-4 border-b border-slate-300 bg-gray-100">
                                                <div class="flex items-center gap-3">
                                                    <img src="/imagen/{{$equipo->imagen}}"
                                                        class="relative inline-block h-9 w-9 !rounded-full object-cover object-center" />
                                                    <div class="flex flex-col">
                                                        <p class="text-md font-bold text-slate-700">
                                                            {{$equipo->nombre}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-4 border-b border-slate-300 bg-gray-100">
                                                <div class="w-max">
                                                    <div
                                                        class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-green-900 uppercase rounded-md select-none whitespace-nowrap bg-green-500/20">
                                                        <span class="">
                                                            {{ \Carbon\Carbon::parse($equipo->created_at)->setTimezone('America/Guatemala')->format('d/m/Y H:i:s') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-4 border-b border-slate-200 bg-gray-100">
                                                <div class="w-max">
                                                    <div
                                                        class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-orange-900 uppercase rounded-md select-none whitespace-nowrap bg-orange-500/20">
                                                        <span class="">
                                                            {{ \Carbon\Carbon::parse($equipo->updated_at)->setTimezone('America/Guatemala')->format('d/m/Y H:i:s') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                        <div class="flex justify-center py-3">
                            {!! $equiposs->links() !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>


<script>
    document.getElementById('filterInput').addEventListener('keyup', function() {
        let filterValue = this.value.toLowerCase();
        let rows = document.querySelectorAll('#dataTable tr');

        rows.forEach(function(row) {
            let equipoCell = row.querySelectorAll('td')[0];
            let equipoText = equipoCell ? equipoCell.textContent.toLowerCase() : '';

            if (equipoText.includes(filterValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>