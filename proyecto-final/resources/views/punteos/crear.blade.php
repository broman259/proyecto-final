<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agregar Punteo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                @if (count($errors) > 0)
                <div id="alert-border-2" class="flex flex-col items-start p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50 dark:text-red-400" role="alert">
                    <div class="flex w-full mb-4">
                        Se encontraron algunos errores:
                        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:text-red-400" onclick="document.getElementById('alert-border-2').style.display='none'" aria-label="Close">
                            <span class="sr-only">Dismiss</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                    @foreach ($errors->all() as $error)
                    <div class="flex items-center mb-2">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <div class="ms-3 text-sm font-medium">
                            {{ $error }}
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                <form action="{{ route('punteos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
                        <div class="grid grid-cols-1">
                            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Jornada:</label>

                            <select name="jornada_id" class="form-control select2 py-2 px-3 rounded-lg border-2 border-slate-300 mt-1 focus:outline-none focus:ring-2 focus:ring-slate-600 focus:border-transparent">
                                @foreach ($jornadas as $jornada)
                                <option value="{{ $jornada->id }}">
                                    {{ $jornada->nombre }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-1">
                            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Jugador:</label>

                            <select name="jugador_id" id="jugador" class="form-control select2 py-2 px-3 rounded-lg border-2 border-slate-300 mt-1 focus:outline-none focus:ring-2 focus:ring-slate-600 focus:border-transparent">
                                @foreach ($jugadores as $jugador)
                                <option value="{{ $jugador->id }}" data-image="{{ asset('imagen/' . $jugador->imagen) }}">
                                    {{ $jugador->nombre }} {{ $jugador->apellido }}

                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-1">
                            <label for="tipoAccion" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Tipo de Tiro:</label>
                            <select name="tipo_tiro" id="tipoAccion" class="form-control select2 py-2 px-3 rounded-lg border-2 border-slate-300 mt-1 focus:outline-none focus:ring-2 focus:ring-slate-600 focus:border-transparent">
                                <option value="Tiro Libre">Tiro Libre</option>
                                <option value="2 Puntos">2 Puntos</option>
                                <option value="3 Puntos">3 Puntos</option>
                                <option value="Otro">Otro, especifique</option>
                            </select>
                        </div>
                        <div class="grid grid-cols-1" style="display:none;" id="otro_tipo_container">
                            <label for="otro_tipo" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Especifique Otro Tipo de Tiro:</label>
                            <input name="otro_tipo" id="otro_tipo" class="py-2 px-3 rounded-lg border-2 border-slate-300 mt-1 focus:outline-none focus:ring-2 focus:ring-slate-600 focus:border-transparent" type="text" />
                        </div>
                        <div class="grid grid-cols-1">
                            <label for="punteo_obtenido" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Puntos Obtenidos:</label>
                            <input name="puntos_obtenidos" id="punteo_obtenido" class="py-2 px-3 rounded-lg border-2 border-slate-300 mt-1 focus:outline-none focus:ring-2 focus:ring-slate-600 focus:border-transparent" type="number" required />
                        </div>

                        <div class="grid grid-cols-1"></div>


                        <div class='flex items-center justify-center  md:gap-8 gap-4 pt-5 pb-5'>
                            <a href="{{ route('punteos.index') }}" class='w-auto bg-red-700 hover:bg-red-600 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Cancelar</a>
                            <button type="submit" class='w-auto bg-slate-900 hover:bg-slate-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Guardar</button>
                        </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>

<!-- Script para ver la imagen antes de CREAR UN NUEVO JUGADOR -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
<script>
    $(document).ready(function(e) {
        $('#imagen').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#imagenSeleccionada').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>


<!-- Script para inicializar Select2 y mostrar imágenes -->
<script>
    $(document).ready(function() {
        $('#jugador').select2({
            templateResult: formatEquipo,
            templateSelection: formatEquipoSelection,
            // minimumResultsForSearch: Infinity
        });

        function formatEquipo(option) {
            if (!option.id) {
                return option.text;
            }
            var logoUrl = $(option.element).data('image');
            var $option = $(
                '<div class="select2-results__option">' +
                '<img src="' + logoUrl + '" style="vertical-align: middle;" />' +
                '<span>' + option.text + '</span>' +
                '</div>'
            );
            return $option;
        }

        function formatEquipoSelection(option) {
            if (!option.id) {
                return option.text;
            }
            var logoUrl = $(option.element).data('image');
            var $option = $(
                '<span style="display:flex; flex-direction:row; justify-content:start; align-items:center; width:100%;"><img src="' + logoUrl + '" style="vertical-align: middle; min-width:8%; max-width:9%; height:auto; margin-right:10px" />' + option.text + '</span>'
            );
            return $option;
        }
    });
</script>


<script>
    document.getElementById('tipoAccion').addEventListener('change', function() {
        var selectBox = document.getElementById('tipoAccion');
        var selectedValue = selectBox.options[selectBox.selectedIndex].value;
        var punteoInput = document.getElementById('punteo_obtenido');
        const otroTipoContainer = document.getElementById('otro_tipo_container');


        // Condicional para cambiar el valor del input
        if (selectedValue === '2 Puntos') {
            punteoInput.value = 2;
        } else if (selectedValue === '3 Puntos') {
            punteoInput.value = 3;
        } else {
            punteoInput.value = '';
        }

        if (selectedValue === 'Tiro Libre' || selectedValue === 'Otro') {
            punteoInput.readOnly = false; // Habilita la edición del campo
            punteoInput.value = ''; // Opcional: limpia el campo
        } else {
            punteoInput.readOnly = true; // Deshabilita la edición del campo
        }

        if (selectedValue === 'Otro') {
            otroTipoContainer.style.display = 'grid'; // Muestra el campo
        } else {
            otroTipoContainer.style.display = 'none'; // Oculta el campo
        }
    });
</script>