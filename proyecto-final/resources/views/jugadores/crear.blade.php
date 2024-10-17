<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Jugador') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">



                <form action="{{ route('jugadores.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
                        <div class="grid grid-cols-1">
                            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Nombres del Jugador:</label>
                            <input name="nombre" class="py-2 px-3 rounded-lg border-2 border-slate-300 mt-1 focus:outline-none focus:ring-2 focus:ring-slate-600 focus:border-transparent" type="text" required />
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Apellidos del Jugador:</label>
                            <input name="apellido" class="py-2 px-3 rounded-lg border-2 border-slate-300 mt-1 focus:outline-none focus:ring-2 focus:ring-slate-600 focus:border-transparent" type="text" required />
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Fecha de Nacimiento:</label>
                            <input name="fecha_nac" class="py-2 px-3 rounded-lg border-2 border-slate-300 mt-1 focus:outline-none focus:ring-2 focus:ring-slate-600 focus:border-transparent" type="date" required />
                        </div>

                        <!-- se mostrará la imagen del equipo seleccionado  onchange="mostrarLogoEquipo()"-->
                        <!-- <div id="logo-container" style="margin-top: 20px;">
                            <img id="logo-equipo" src="" alt="Logotipo del equipo" style="max-width: 100px; display: none;">
                        </div> -->


                        <!-- Select para equipos con imágenes -->
                        <div class="grid grid-cols-1">
                            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Asociar a un Equipo:</label>

                            <select name="equipo_id" id="equipo" class="form-control select2 py-2 px-3 rounded-lg border-2 border-slate-300 mt-1 focus:outline-none focus:ring-2 focus:ring-slate-600 focus:border-transparent">
                                <option value="">Selecciona un Equipo</option>
                                @foreach ($equipos as $equipo)
                                <option value="{{ $equipo->id }}" data-image="{{ asset('imagen/' . $equipo->imagen) }}">
                                    {{ $equipo->nombre }}
                                </option>
                                @endforeach
                            </select>
                        </div>






                        <!-- Para ver la imagen seleccionada -->
                        <div class="grid grid-cols-1 mt-5 mx-7">
                            <img id="imagenSeleccionada" style="max-height: 200px;">
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