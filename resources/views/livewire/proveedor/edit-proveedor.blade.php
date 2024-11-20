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
                    <a href="{{ route('proveedor.list') }}"
                        class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Proveedor</a>
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
            <input type="text" wire:model.defer="proveedorArray.nombre" id="nombre" name="nombre" value="{{ $proveedor->nombre }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="{{ $proveedor->nombre }}" required>
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Correo</label>
            <input type="text" wire:model.defer="proveedorArray.correo" placeholder="{{ $proveedor->correo }}" id="email" name="email" required
                value="{{ $proveedor->correo }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Telefono</label>
            <input type="number" wire:model.defer="proveedorArray.telefono" id="telefono" name="telefono" value="{{ $proveedor->telefono }}" 
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="{{ $proveedor->telefono }}" required>
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Direccion</label>
            <input type="text"  wire:model.defer="proveedorArray.direccion" placeholder="{{ $proveedor->direccion }}" id="direccion"
                name="direccion" required value="{{ $proveedor->direccion }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">NIT</label>
            <input type="text" wire:model.defer="proveedorArray.nit" placeholder="{{ $proveedor->nit }}" id="nit"
                name="nit" required value="{{ $proveedor->nit }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
    </form>

    @push('scripts')
    <script>
        function validarFormulario() {
            var nombre = document.forms["formulario"]["nombre"];
            var email = document.forms["formulario"]["email"];
            var telefono = document.forms["formulario"]["telefono"];
            var direccion = document.forms["formulario"]["direccion"];
            var nit = document.forms["formulario"]["nit"];

            if (!validarCampo(nombre, "string", 0)) {
                return false;
            }
            if (!validarCampo(email, "string", 0)) {
                return false;
            }
            if (!validarCampo(telefono, "number", 0)) {
                return false;
            }
            if (!validarCampo(direccion, "string", 0)) {
                return false;
            }
            if (!validarCampo(nit, "number", 0)) {
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
