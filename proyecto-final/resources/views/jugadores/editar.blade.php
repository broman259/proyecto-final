<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Jugador') }}
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

                <form action="{{ route('jugadores.update', $jugadore->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
                        <div class="grid grid-cols-1">
                            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Nombres del Jugador:</label>
                            <input name="nombre" value="{{ $jugadore->nombre }}" class="py-2 px-3 rounded-lg border-2 border-slate-300 mt-1 focus:outline-none focus:ring-2 focus:ring-slate-600 focus:border-transparent" type="text" required />
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Apellidos del Jugador:</label>
                            <input name="apellido" value="{{ $jugadore->apellido }}" class="py-2 px-3 rounded-lg border-2 border-slate-300 mt-1 focus:outline-none focus:ring-2 focus:ring-slate-600 focus:border-transparent" type="text" required />
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Fecha de Nacimiento:</label>
                            <input name="fecha_nac" value="{{ $jugadore->fecha_nac }}" class="py-2 px-3 rounded-lg border-2 border-slate-300 mt-1 focus:outline-none focus:ring-2 focus:ring-slate-600 focus:border-transparent max-h-11" type="date" required />
                        </div>



                        <!-- Select para equipos con imágenes -->
                        <div class="grid grid-cols-1">
                            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Cambiar de Equipo:</label>

                            <select name="equipo_id" id="equipo" class="form-control select2 py-2 px-3 rounded-lg border-2 border-slate-300 mt-1 focus:outline-none focus:ring-2 focus:ring-slate-600 focus:border-transparent min-h-11">
                                @foreach ($equipos as $equipo)
                                <option value="{{ $equipo->id }}" data-image="{{ asset('imagen/' . $equipo->imagen) }}" {{ $jugadore->equipo_id == $equipo->id ? 'selected' : '' }}>
                                    {{ $equipo->nombre }}
                                </option>
                                @endforeach
                            </select>
                        </div>



                        <div class="grid grid-cols-2">
                            <div role="group">
                                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Equipo Actual:</label>

                                <div class="flex items-center gap-3">
                                    <img src="/imagen/{{$jugadore->equipo->imagen}}"
                                        class="relative inline-block w-20 h-20 !rounded-full object-cover object-center" />
                                    <div class="flex flex-col">
                                        <p class="text-sm font-semibold text-slate-700">
                                            {{$jugadore->equipo->nombre}}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div role="group">
                                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Imagen de Perfil Actual:</label>

                                <div class="flex items-center gap-3">
                                    <img src="/imagen/{{$jugadore->imagen}}"
                                        class="relative inline-block h-20 w-20 !rounded-full object-cover object-center" />
                                </div>
                            </div>
                        </div>


                        <!-- Para ver la imagen seleccionada -->
                        <div class="grid grid-cols-3">
                            <div role="group">
                                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Nueva Imagen de Perfil:</label>
                                <img id="imagenSeleccionada" class="relative inline-block h-20 w-20 !rounded-full object-cover object-center"" style=" max-height: 200px;">
                            </div>
                        </div>
                    </div>


                    <div class="grid grid-cols-1 mt-5 mx-7">
                        <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold mb-1">Subir Imagen</label>
                        <div class='flex items-center justify-center w-full'>
                            <label class='flex flex-col border-4 border-dashed w-full h-32 hover:bg-gray-100 hover:border-slate-300 group'>
                                <div class='flex flex-col items-center justify-center pt-7'>
                                    <svg class="w-10 h-10 text-slate-400 group-hover:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <p class='text-sm text-gray-400 group-hover:text-slate-600 pt-1 tracking-wider'>Seleccione la imagen</p>
                                </div>
                                <input name="imagen" id="imagen" type='file' class="hidden" />
                            </label>
                        </div>
                    </div>

                    <div class='flex items-center justify-center  md:gap-8 gap-4 pt-5 pb-5'>
                        <a href="{{ route('jugadores.index') }}" class='w-auto bg-red-700 hover:bg-red-600 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Cancelar</a>
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

<!-- <script>
    function mostrarLogoEquipo() {
        var select = document.getElementById('equipo');
        var logoContainer = document.getElementById('logo-container');
        var logoImg = document.getElementById('logo-equipo');

        // Obtener la opción seleccionada
        var selectedOption = select.options[select.selectedIndex];

        // Obtener el atributo data-image de la opción seleccionada
        var imageUrl = selectedOption.getAttribute('data-image');

        if (imageUrl) {
            // Mostrar la imagen con el logotipo del equipo
            logoImg.src = imageUrl;
            logoImg.style.display = 'block';
        } else {
            // Si no hay imagen, ocultar el logo
            logoImg.style.display = 'none';
        }
    }
</script> -->


<!-- Script para inicializar Select2 y mostrar imágenes -->
<script>
    $(document).ready(function() {
        $('#equipo').select2({
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