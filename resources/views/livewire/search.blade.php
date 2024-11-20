<div class="w-96">
    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
    <div class="relative">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
        </div>
        <input type="search" id="dropdownNotificationButton" data-dropdown-toggle="dropdownNotification"
            wire:model="search"
            class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Search..." required>
        <button onclick="document.getElementById('dropdownNotificationButton').click()"
            class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
    </div>

    <div id="dropdownNotification"
        class="z-20 hidden w-full max-w-sm bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-800 dark:divide-gray-700"
        aria-labelledby="dropdownNotificationButton">
        <div
            class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
            Resultado de la Busqueda
        </div>
        <div class="divide-y divide-gray-100 dark:divide-gray-700 h-72 overflow-y-auto">
            @foreach ($resultados as $resultado)
                <a @if ($resultado->tabla != 'usuario') href="{{ route($resultado->tabla . '.show', $resultado->id) }}" @endif
                    class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <div class="w-full pl-3">
                        <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400">
                            {{ $resultado->nombre }} {{ $resultado->apellido ?? '' }}
                        </div>
                        <div class="text-xs text-blue-600 dark:text-blue-500">{{ $resultado->tabla ?? '' }}</div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

</div>
