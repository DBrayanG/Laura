<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('ico.png') }}">
    <title>Ferreteria Laura</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


    <!-- Scripts -->
    <script>
        const now = new Date();
        const currentHour = now.getHours();
        if (currentHour < 6 || currentHour >= 18) {
            if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.documentElement.classList.add('dark');
            }
        }
    </script>
    <script src="{{ asset('js/validaciones.js') }}"></script>
    <script src="{{ asset('livewire/livewire.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    @livewireScripts
    <style>
        body {
            font-family: 'Comic Neue', cursive;
        }

        div * {
            font-size: 1.5rem;
        }

        table * {
            font-size: 1.5rem;
        }

        nav * {
            font-size: 1.5rem;
        }

        aside * {
            font-size: 1.5rem;
        }

        form * {
            font-size: 1.5rem;
        }

        #formulario * {
            font-size: 1.5rem;
        }
    </style>
</head>

<body class="font-sans antialiased dark:bg-gray-100">

    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start w-1/2">
                    <div class="flex items-center justify-start">
                        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                            aria-controls="logo-sidebar" type="button"
                            class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                            <span class="sr-only">Open sidebar</span>
                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                                </path>
                            </svg>
                        </button>
                        <a href="{{ route('dashboard') }}" class="flex ml-2 md:mr-24">
                            {{-- <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 mr-3" alt="FlowBite Logo" /> --}}
                            <span
                                class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Ferreteria
                                Luara</span>
                        </a>
                    </div>
                    @livewire('search')
                </div>

                @livewire('menu-user')
            </div>
        </div>
    </nav>

    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 22 21">
                            <path
                                d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                            <path
                                d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                        </svg>
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>
                @can('usuarios')
                    <li>
                        <a href="{{ route('usuario.list') }}"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <x-iconos.usuarios />
                            <span class="flex-1 ml-3 whitespace-nowrap">Usuarios</span>
                        </a>
                    </li>
                @endcan
                @can('roles')
                    <li>
                        <a href="{{ route('rol.list') }}"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <x-iconos.roles />
                            <span class="flex-1 ml-3 whitespace-nowrap">Roles</span>
                        </a>
                    </li>
                @endcan
                @can('pedidos')
                    <li>
                        <a href="{{ route('pedido.list') }}"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <x-iconos.pedido />
                            <span class="flex-1 ml-3 whitespace-nowrap">Pedidos</span>
                        </a>
                    </li>
                @endcan
                @can('productos')
                    <li>
                        <a href="{{ route('producto.list') }}"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <x-iconos.pantalla />
                            <span class="flex-1 ml-3 whitespace-nowrap">Productos</span>
                        </a>
                    </li>
                @endcan
                @can('proveedores')
                    <li>
                        <a href="{{ route('proveedor.list') }}"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <x-iconos.usuarios />
                            <span class="flex-1 ml-3 whitespace-nowrap">Proveedores</span>
                        </a>
                    </li>
                @endcan
                @can('compras')
                    <li>
                        <a href="{{ route('compra.list') }}"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <x-iconos.compra />
                            <span class="flex-1 ml-3 whitespace-nowrap">Compras</span>
                        </a>
                    </li>
                @endcan
                @can('ingresos')
                    <li>
                        <a href="{{ route('ingreso.list') }}"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <x-iconos.book />
                            <span class="flex-1 ml-3 whitespace-nowrap">Ingresos</span>
                        </a>
                    </li>
                @endcan
                @can('salidas')
                    <li>
                        <a href="{{ route('salida.list') }}"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <x-iconos.book />
                            <span class="flex-1 ml-3 whitespace-nowrap">Salidas</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
    </aside>

    <div class="p-4 sm:ml-64 ">
        <div class="p-4 mt-14 ">
            {{ $slot }}
        </div>
    </div>
    <div class="flex justify-end p-4 font-semibold text-sm mt-10">
        Visitas: @stack('visitas')
    </div>

    @stack('modals')
    @stack('scripts')

</body>

</html>
