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
                    <a href="{{ route('producto.list') }}"
                        class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Productos</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <x-iconos.flecha />
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-500">Editar</span>
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
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Nombre</label>
            <input type="text" wire:model.defer="productoArray.nombre" id="nombre" name="nombre"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="{{ $producto->nombre }}" value="{{ $producto->nombre }}" required>
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">URL de la Imagen</label>
            <input type="text" wire:model.defer="productoArray.imagen" id="imagen" name="imagen"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="{{ $producto->imagen }}" value="{{ $producto->imagen }}" required>
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Tamaño</label>
            <input type="text" placeholder="{{ $producto->tamaño }}" id="tamaño" name="tamaño"
                wire:model.defer="productoArray.tamaño" value="{{ $producto->tamaño }}" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Precio del producto</label>
            <input type="number" wire:model.defer="productoArray.precio" id="precio" name="precio"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="{{ $producto->precio }}" value="{{ $producto->precio }}" required>
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Descripcion</label>
            <input type="text" placeholder="{{ $producto->descripcion }}" id="descripcion" name="descripcion"
                wire:model.defer="productoArray.descripcion" value="{{ $producto->descripcion }}" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Categoria</label>
            <input type="text" wire:model.defer="productoArray.categoria" id="categoria" name="categoria"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="{{ $producto->categoria }}" value="{{ $producto->categoria }}" required>
        </div>
    </form>

    @push('scripts')
        <script>
            function validarFormulario() {
                var nombre = document.forms["formulario"]["nombre"];
                var imagen = document.forms["formulario"]["imagen"];
                var tamaño = document.forms["formulario"]["tamaño"];
                var precio = document.forms["formulario"]["precio"];
                var descripcion = document.forms["formulario"]["descripcion"];
                var categoria = document.forms["formulario"]["categoria"];

                if (!validarCampo(nombre, "string", 0)) {
                    return false;
                }
                if (!validarCampo(imagen, "string", 0)) {
                    return false;
                }
                if (!validarCampo(tamaño, "string", 0)) {
                    return false;
                }
                if (!validarCampo(precio, "number", 0)) {
                    return false;
                }
                if (!validarCampo(descripcion, "string", 0)) {
                    return false;
                }
                if (!validarCampo(categoria, "string", 0)) {
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
