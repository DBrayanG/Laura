<div>
    <nav class="flex justify-between py-3 mb-5">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-500 dark:hover:text-gray-600">
                    <x-iconos.home />
                    Home
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <x-iconos.flecha />
                    <a href="{{ route('ingreso.list') }}"
                        class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Ingresos</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <x-iconos.flecha />
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-500">Detalle</span>
                </div>
            </li>
        </ol>
        <div>
            <button type="button" wire:click="detalle({{ $ingreso->id }})"
                class="inline-flex items-center justify-center h-9 px-4 ml-5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50">
                Añadir Detalle
            </button>
        </div>
    </nav>
    <div class="grid grid-cols-5 gap-3">
        <div class="mb-1">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Fecha</label>
            <input type="date" value="{{ $ingreso->fecha }}"readonly
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
        <div class="mb-1">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Hora</label>
            <input type="time" value="{{ $ingreso->hora }}" readonly
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
        <div class="mb-1">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Motivo</label>
            <input type="text" value="{{ $ingreso->motivo }}" readonly
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                readonly>
        </div>
    </div>
    <br>
    <div>
        <div class="col-span-2 h-32">
            <p>
                <span class="text-lg font-bold text-gray-900 dark:text-black">Lista de Productos</span>
            </p>
            <br>
            <div class="mb-6">
                <table class="w-full text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-2 py-2">Foto</th>
                            <th class="px-2 py-2">Nombre</th>
                            <th class="px-2 py-2">Cantidad</th>
                            <th scope="col" class="px-2 py-2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detalles as $detalle)
                            <tr class="justify-center items-center text-center">
                                <td class="px-2 py-2 text-center">
                                    <img src="{{ $detalle->imagen }}" alt="{{ $detalle->producto }}"
                                        class="w-20 h-auto rounded-full ">
                                </td>
                                <td class="px-2 py-2"> {{ $detalle->producto }} </td>
                                <td class="px-2 py-2"> {{ $detalle->cantidad }} </td>
                                <td class="px-2 py-2">
                                    <button type="button" wire:click="delete({{ $detalle->id }})"
                                        onclick="confirm('¿Está seguro?') || event.stopImmediatePropagation()"
                                        class="text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                        <x-iconos.delete />
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @if ($notificacion)
        <x-shared.notificacion :message="$message" :type="$type" />
    @endif
    <script>
        Livewire.on('notificacion', function() {
            let interval = 5000;
            setTimeout((function() {
                @this.notificacion = false;
            }), interval);
        });
    </script>
    @push('visitas')
        {{ $visitas }}
    @endpush
</div>
