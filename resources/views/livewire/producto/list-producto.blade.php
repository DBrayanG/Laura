<div class="mt-5">
    <nav class="flex py-3 mb-5">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="/"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-500 dark:hover:text-gray-600">
                    <x-iconos.home />
                    Home
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <x-iconos.flecha />
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-500">Producto</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="p-4 bg-white flex flex-center justify-between dark:bg-gray-900">
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <x-iconos.search />
                </div>
                <input type="text" id="table-search"
                    class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search for items" wire:model.lazy='search'>
            </div>
            <div class="flex items-center space-x-2">
                <a href="{{ route('producto.new') }}"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <x-iconos.plus />
                    Nuevo
                </a>
                <a href="{{ route('reporte.productos') }}" target="_blank"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <x-iconos.book />
                    Reporte
                </a>
            </div>
        </div>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Imagen
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tamaño
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Precio
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Cantidad
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Descripcion
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Categoria
                    </th>
                    <th scope="col" class="px-6 py-3">

                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">
                            {{ $producto->nombre }}
                        </td>
                        <td class="px-6 py-4">
                            <img class="p-1 rounded-t-lg w-20 h-auto" src="{{ $producto->imagen }}"
                                alt="product image" />
                        </td>
                        <td class="px-6 py-4">
                            {{ $producto->tamaño }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $producto->precio }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $producto->cantidad }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $producto->descripcion }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $producto->categoria }}
                        </td>
                        <td class="px-2 py-4 text-right">
                            <a href="{{ route('producto.show', $producto->id) }}"
                                class="mb-1 text-white bg-green-400 hover:bg-green-500 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center dark:bg-green-600 dark:hover:bg-green-400 dark:focus:ring-green-500">
                                <x-iconos.view />
                            </a>
                            <button type="button" wire:click="edit({{ $producto->id }})"
                                class="mb-1 text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <x-iconos.edit />
                            </button>
                            <button type="button" wire:click="delete({{ $producto->id }})"
                                onclick="confirm('¿Está seguro?') || event.stopImmediatePropagation()"
                                class="text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                <x-iconos.delete />
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <x-shared.pagination :modelo='$productos' />
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