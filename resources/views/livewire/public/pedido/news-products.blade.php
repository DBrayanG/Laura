<div class="bg-white dark:bg-gray-800 p-4 rounded-md">
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-3xl">
            Recien llegados
        </h2>
        <a href="{{ route('public.producto.list') }}"
            class="text-base font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500">Ver
            todos<span aria-hidden="true"> &rarr;</span></a>
    </div>
    <br>

    <div class="grid grid-cols-1 md:grid-cols-4">
        @foreach ($productos as $producto)
            <div
                class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <a href="{{ route('public.producto.show', $producto->id) }}">
                    <img class="p-8 rounded-t-lg" src="{{ $producto->imagen }}" alt="product image" />
                </a>
                <div class="px-5 pb-5">
                    <a href="{{ route('public.producto.show', $producto->id) }}">
                        <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                            {{ $producto->nombre }}
                        </h5>
                    </a>
                    <div class="flex items-center mt-2.5 mb-5">
                        <div class="flex items-center space-x-1 rtl:space-x-reverse dark:text-white">
                            {{ $producto->descripcion }}
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-3xl font-bold text-gray-900 dark:text-white">{{ $producto->precio }}Bs.</span>
                        <a wire:click="addCart({{ $producto->id }})"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 cursor-pointer">
                            Agregar
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
