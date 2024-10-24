<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reporte General de Máximos Anotadores') }}
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
                                    <h3 class="text-lg font-semibold text-slate-800">Reporte General de Máximos Anotadores</h3>
                                    <p class="text-slate-500">Todas las Jornadas</p>
                                </div>
                                <div class="flex flex-row gap-2 shrink-0">
                                <button id="exportButton"
                                        class="rounded border border-slate-500 py-2.5 px-3 text-center text-sm font-semibold text-slate-600 transition-all focus:ring focus:ring-slate-900 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                        type="button">
                                        Exportar Maximos Anotadores
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="p-0 overflow-scroll">
                            <div id="resultados" class="my-6">
                                <table class="w-full mt-4 text-left table-auto min-w-max">
                                    <thead>
                                        <tr class="bg-slate-800 text-white">
                                            <th class="p-4 border-y border-slate-200">
                                                <p class="font-sans text-md font-semibold leading-none">Jugador</p>
                                            </th>
                                            <th class="p-4 border-y border-slate-200">
                                                <p class="font-sans text-md font-semibold leading-none">Total Puntos</p>
                                            </th>
                                            <th class="p-4 border-y border-slate-200">
                                                <p class="font-sans text-md font-semibold leading-none">Creado el</p>
                                            </th>
                                            <th class="p-4 border-y border-slate-200">
                                                <p class="font-sans text-md font-semibold leading-none">Última Actualización</p>
                                            </th>
                                        </tr>
                                    </thead>
                                    @foreach ($jugadores as $jugador)
                                    <tbody id="dataTable">
                                        <tr class="border-b border-slate-300">
                                            <td class="p-4 border-b border-slate-300 bg-gray-100 flex">
                                                <div class="jugador cursor-pointer" onclick="toggleAccordion({{ $jugador->id }})">
                                                    <h3 class="text-white py-2 px-4">
                                                        <span id="arrow-jugador-{{ $jugador->id }}"">&#9654;</span>
                                                    </h3>
                                                </div>
                                                <div class=" flex items-center gap-3">
                                                            <img src="/imagen/{{$jugador->imagen}}"
                                                                class="relative inline-block h-9 w-9 !rounded-full object-cover object-center" />
                                                            <div class="flex flex-col">
                                                                <p class="text-md font-bold text-slate-700">{{$jugador->nombre}}</p>
                                                                <p class="text-md font-bold text-slate-700">{{$jugador->apellido}}</p>
                                                            </div>
                                                </div>
                                            </td>
                                            <td class="bg-gray-100 border-b border-slate-300">{{$jugador->total_puntos}}</td>
                                            <td class="p-4 border-b border-slate-300 bg-gray-100">
                                                <div class="w-max">
                                                    <div
                                                        class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-green-900 uppercase rounded-md select-none whitespace-nowrap bg-green-500/20">
                                                        <span class="">
                                                            {{ \Carbon\Carbon::parse($jugador->created_at)->setTimezone('America/Guatemala')->format('d/m/Y H:i:s') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-4 border-b border-slate-200 bg-gray-100">
                                                <div class="w-max">
                                                    <div
                                                        class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-orange-900 uppercase rounded-md select-none whitespace-nowrap bg-orange-500/20">
                                                        <span class="">
                                                            {{ \Carbon\Carbon::parse($jugador->updated_at)->setTimezone('America/Guatemala')->format('d/m/Y H:i:s') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>




                                        <tr>
                                            <td id="accordion-{{ $jugador->id }}" class="hidden">
                                                @foreach ($jugador->jornadas as $jornada)
                                                <!-- Jornada como subacordeón -->
                                                <div class="border-b border-slate-300 shadow-md my-4 mx-2">
                                                    <button class="px-4 py-2 text-left  font-medium focus:outline-none" onclick="toggleAccordion('jornada-{{ $jugador->id }}-{{ $jornada->id }}')">
                                                        Jornada: {{ $jornada->nombre }}
                                                    </button>

                                                    <!-- Tabla dentro del acordeón -->
                                                    <div id="accordion-jornada-{{ $jugador->id }}-{{ $jornada->id }}" class="hidden px-4 py-2">
                                                        <table class="min-w-full table-auto  border border-gray-700 rounded-lg shadow-md">
                                                            <thead>
                                                                <tr class="bg-gray-300">
                                                                    <th class="px-4 py-2">Tipo de Tiro</th>
                                                                    <th class="px-4 py-2">Puntos Obtenidos</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="border border-gray-600 px-4 py-2">{{ $jornada->pivot->tipo_tiro ?? 'No especificado' }}</td>
                                                                    <td class="border border-gray-600 px-4 py-2">{{ $jornada->pivot->puntos_obtenidos ?? 0 }}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </td>
                                        </tr>

                                    </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                        <div class="flex justify-center py-3">
                            {!! $jugadores->links() !!}
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>


<script>
    function toggleAccordion(id) {
        var element = document.getElementById('accordion-' + id);
        if (element.classList.contains('hidden')) {
            element.classList.remove('hidden');
        } else {
            element.classList.add('hidden');
        }
    }
</script>

<script>
    document.getElementById('exportButton').addEventListener('click', function() {
        window.location.href = "{{ url('/export-maximos-anotadores') }}";
    });
</script>