<div class="mt-5">
    <nav class="flex py-3 mb-5">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="/inicio"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-500 dark:hover:text-gray-600">
                    <x-iconos.home />
                    Inicio
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <x-iconos.flecha />
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-500">Pedidos</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="p-4 bg-white flex flex-center justify-between dark:bg-gray-900">
            <div class="flex flex-center">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Historial de pedidos</h1>
            </div>
        </div>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Fecha
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Hora
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Monto
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Estado
                    </th>
                    <th scope="col" class="px-6 py-3">

                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pedidos as $pedido)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">
                            {{ $pedido->fecha }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $pedido->hora }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $pedido->monto_total }} Bs.
                        </td>
                        <td class="px-6 py-4">
                            @if ($pedido->estado == 'pendiente')
                                <span
                                    class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-blue-600 bg-blue-200  last:mr-0 mr-1">
                                    {{ $pedido->estado }}
                                </span>
                            @elseif($pedido->estado == 'cancelado')
                                <span
                                    class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-red-600 bg-red-200 uppercase last:mr-0 mr-1">
                                    {{ $pedido->estado }}
                                </span>
                            @else
                                <span
                                    class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-green-600 bg-green-200 uppercase last:mr-0 mr-1">
                                    {{ $pedido->estado }}
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('public.pedido.show', $pedido->id) }}"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <x-iconos.view />
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@push('visitas')
    {{ $visitas }}
@endpush
