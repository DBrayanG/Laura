<div class="flex items-center ml-2">
    <div class="flex items-center ml-3">
        <div>
            <button type="button"
                class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                aria-expanded="false" data-dropdown-toggle="dropdown-user">
                <span class="sr-only">Open user menu</span>
                <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                    alt="user photo">
            </button>

        </div>
        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
            id="dropdown-user">
            <div class="px-4 py-3" role="none">
                <p class="text-gray-900 dark:text-white" role="none">
                    {{ Auth::user()->name ?? '' }}
                </p>
                <p class="font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                    {{ Auth::user()->email ?? '' }}
                </p>
            </div>
            <ul class="py-1" role="none">
                @if (Auth::user()->es_administrador || Auth::user()->es_personal)
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="block px-4 py-2  text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                            role="menuitem">Dashboard</a>
                    </li>
                @endif
                <li>
                    <a @if (Auth::user()->es_cliente) href="{{ route('public.perfil') }}" @else href="{{ route('profile.show') }}" @endif
                        class="block px-4 py-2  text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                        role="menuitem">Perfil</a>
                </li>
                <li>
                    <a href="{{ route('public.pedido') }}"
                        class="block px-4 py-2  text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                        role="menuitem">Pedidos</a>
                </li>
                @if (Auth::user()->es_administrador || Auth::user()->es_personal)
                    <li>
                        <button id="doubleDropdownButton" data-dropdown-toggle="doubleDropdown"
                            data-dropdown-placement="right-start" type="button"
                            class="flex items-center justify-between w-full px-4 py-2 text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white">Temas
                            <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                        </button>
                        <div id="doubleDropdown"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <ul class="py-2  text-gray-700 dark:text-gray-200" aria-labelledby="doubleDropdownButton">
                                @foreach ($temas as $tema)
                                    <li>
                                        <button wire:click="cambiarTema('{{ $tema['value'] }}')"
                                            class="px-4 py-2 w-full text-start flex">
                                            @if ($temaActual == $tema['value'])
                                                <svg class="w-4 h-4 mr-2" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            @endif
                                            {{ $tema['label'] }}
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                @endif
                <li>
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <button type="submit"
                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                            role="menuitem">Cerrar Sesion</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
