<div class="my-4">
    <nav class="flex px-5 py-3 mb-5 text-gray-700 justify-between border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    <x-iconos.home />
                    Inicio
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <x-iconos.flecha />
                    <a href="{{ route('pedido.list') }}"
                        class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Pedidos</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <x-iconos.flecha />
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Ver</span>
                </div>
            </li>
        </ol>
    </nav>
    <br>
    <div class="grid grid-cols-5 gap-3">
        <div class="mb-1">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Fecha</label>
            <input type="date" value="{{ $pedido->fecha }}"readonly
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
        <div class="mb-1">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Hora</label>
            <input type="time" value="{{ $pedido->hora }}" readonly
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
        <div class="mb-1">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Costo Total</label>
            <input type="number" value="{{ $pedido->monto_total }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                readonly>
        </div>
        <div class="mb-1">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Estado</label>
            <input type="text" value="{{ $pedido->estado }}"
                class="bg-gray-50 border uppercase border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                readonly>
        </div>
    </div>
    <br>
    <div>
        <div class="col-span-2 h-32">
            <p>
                <span class="text-lg font-bold text-gray-900 dark:text-white">Lista de Productos</span>
            </p>
            <br>
            <div class="mb-6">
                <table class="w-full text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-2 py-2">Cliente</th>
                            <th class="px-2 py-2">Foto</th>
                            <th class="px-2 py-2">Nombre</th>
                            <th class="px-2 py-2">Cantidad</th>
                            <th class="px-2 py-2">Precio</th>
                            <th class="px-2 py-2">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detalles as $detalle)
                            <tr class="justify-center items-center text-center">
                                <td class="px-2 py-2"> {{ $detalle->cliente }} </td>
                                <td class="px-2 py-2">
                                    <img src="{{ $detalle->imagen }}" alt="{{ $detalle->producto }}"
                                        class="w-20 h-auto rounded-full">
                                </td>
                                <td class="px-2 py-2"> {{ $detalle->producto }} </td>
                                <td class="px-2 py-2"> {{ $detalle->cantidad }} </td>
                                <td class="px-2 py-2"> {{ $detalle->precio }} </td>
                                <td class="px-2 py-2"> {{ $detalle->precio * $detalle->cantidad }} </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<br>
@push('visitas')
    {{ $visitas }}
@endpush

