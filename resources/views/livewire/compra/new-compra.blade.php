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
                    <a href="{{ route('compra.list') }}"
                        class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Compras</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <x-iconos.flecha />
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-500">Nuevo</span>
                </div>
            </li>
        </ol>
        <div>
            <button onclick="validarFormulario()? Livewire.emit('store') : ''"
                class="inline-flex items-center justify-center h-9 px-4 ml-5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50">
                Guardar
            </button>
        </div>
    </nav>

    <form class="grid grid-cols-2 gap-3" name="formulario">
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Fecha</label>
            <input type="date" wire:model.defer="compraArray.fecha" id="fecha" name="fecha"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Hora</label>
            <input type="time" wire:model.defer="compraArray.hora" id="hora" name="hora"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
        </div>
        {{-- <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selecciona el producto</label>
            <select wire:model.defer="compraArray.producto_id" id="producto_id" name="producto_id" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>Selecciona el producto</option>
                @foreach ($productos as $producto)
                    <option value="{{ $producto->id }}">{{ $producto->nombre }} ({{ $producto->tamaño }})</option>
                @endforeach
            </select>
        </div> --}}
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Selecciona el proveedor</label>
            <select wire:model.defer="compraArray.proveedor_id" id="proveedor_id" name="proveedor_id" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>Selecciona el proveedor</option>
                @foreach ($proveedores as $proveedor)
                    <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                @endforeach
            </select>
        </div>
    </form>

    @push('scripts')
        <script>
            function validarFormulario() {
                var fecha = document.forms["formulario"]["fecha"];
                var hora = document.forms["formulario"]["hora"];
                var proveedor_id = document.forms["formulario"]["proveedor_id"];

                if (!validarCampo(fecha, "date", 0)) {
                    return false;
                }
                if (!validarCampo(hora, "string", 0)) {
                    return false;
                }
                if (!validarCampo(proveedor_id, "string", 0)) {
                    return false;
                }
                return true;
            }
        </script>
    @endpush
    @push('visitas')
        {{ $visitas }}
    @endpush
</div>

