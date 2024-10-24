<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="py-5 flex items-center justify-center">
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                        <!-- Header -->
                        <header class="bg-indigo-600 p-4 text-white text-center">
                            <h1 class="text-3xl font-bold">Bienvenido al Dashboard</h1>
                            <p class="text-sm">Torneo Navideño de BasketBall LA CANASTA</p>
                        </header>

                        <div class="p-6">
                            <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2 gap-4">
                                <div class="bg-gray-200 p-4 rounded-lg text-center shadow-sm">
                                    <h2 class="text-xl font-semibold">BRYAN JOSUE ROMAN GARCIA</h2>
                                    <p class="text-gray-600">5190-21-1202</p>
                                </div>
                                <div class="bg-gray-200 p-4 rounded-lg text-center shadow-sm">
                                    <h2 class="text-xl font-semibold">ABNER OTTONIEL LOPEZ TOBAR</h2>
                                    <p class="text-gray-600">5190-17-1390</p>
                                </div>
                            </div>
                        </div>

                        <footer class="bg-gray-800 p-4 text-white text-center">
                            <p>Proyecto Final Desarrollo Web</p>
                        </footer>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>