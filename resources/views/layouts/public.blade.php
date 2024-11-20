<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('ico.png') }}">
    <title>Ferreteria Laura</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    <script></script>
    <script src="{{ asset('js/validaciones.js') }}"></script>
    <script src="{{ asset('livewire/livewire.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    {{-- scrip livewire --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        const now = new Date();
        const currentHour = now.getHours();
        if (currentHour < 6 || currentHour >= 18) {
            if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.documentElement.classList.add('dark');
            }
        }
    </script>
    @livewireStyles
    @livewireScripts
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f5f5f5;
        }

        aside {
            background-color: #333;
            color: #fff;
        }

        body,
        div,
        table,
        nav,
        aside,
        form,
        #formulario {
            font-size: 1.0rem;
        }
    </style>
</head>

<body class="font-montserrat antialiased flex flex-col h-max">
    <div class="flex-grow">
        <nav
            class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <a href="{{ route('inicio') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <img src="{{ asset('logo.png') }}" class="h-14" alt="Flowbite Logo" />
                </a>
                <div class="flex md:order-2">
                    @auth
                        <livewire:public.pedido.cart />
                        @livewire('menu-user')
                    @else
                        <a href="{{ route('login') }}"
                            class="hidden md:block ml-4  py-2 px-3 text-black bg-black rounded md:bg-transparent  md:p-0  hover:underline dark:text-white"
                            aria-current="page">Ingresar</a>
                        <a href="{{ route('inicio.register') }}"
                            class="hidden md:block ml-4  py-2 px-3 text-black bg-black rounded md:bg-transparent  md:p-0  hover:underline dark:text-white"
                            aria-current="page">Registrarse</a>
                    @endauth

                    <button data-collapse-toggle="navbar-search" type="button"
                        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                        aria-controls="navbar-search" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 17 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 1h15M1 7h15M1 13h15" />
                        </svg>
                    </button>
                </div>
                <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-search">
                    <ul
                        class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                        @auth
                        @else
                            <li>
                                <a href="{{ route('login') }}"
                                    class="block md:hidden py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
                                    aria-current="page">Ingresar</a>
                            </li>
                            <li>

                                <a href="{{ route('inicio.register') }}"
                                    class="block md:hidden py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
                                    aria-current="page">Registrarse</a>
                            </li>
                        @endauth

                        <li>
                            <a href="{{ route('inicio') }}"
                                class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
                                aria-current="page">Inicio</a>
                        </li>
                        <li>
                            <a href="{{ route('public.producto.list') }}"
                                class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Productos</a>
                        </li>
                        <li>
                            <a href="{{ route('public.contacto') }}"
                                class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Contacto</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <br>
        <br>
        <br>
        @if ($fondo)
            <div class="relative w-full">
                <div class="absolute inset-0">
                    <img class="w-full h-full object-cover" src="{{ asset('inicio.jpg') }}"
                        alt="People working on laptops">
                    <div class="absolute inset-0 bg-gray-500 mix-blend-multiply" aria-hidden="true"></div>
                </div>
                <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
                    <h1 class="text-4xl font-extrabold tracking-tight text-white md:text-5xl lg:text-6xl">Productos
                        <span class="block xl:inline">de la mejor calidad</span>
                    </h1>
                    <p class="mt-6 text-xl text-gray-300 dark:text-white">
                        Tenemos los mejores productos para ti, de la mejor calidad y al mejor precio.
                    </p>
                </div>
            </div>
        @endif
        <div class="max-w-screen-xl mx-auto mt-2">
            <div class="p-4">
                {{ $slot }}
            </div>
        </div>
    </div>

    <div>
        <div class="max-w-screen-xl mx-auto">
            <div class="p-4">
                Visitas: @stack('visitas')
            </div>
        </div>
        <footer class="w-full bg-white rounded-lg shadow  dark:bg-gray-800">
            <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
                <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2024 <a
                        href="{{ route('inicio') }}" class="hover:underline">Laura</a>. All Rights Reserved.
                </span>
                <ul
                    class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-400 sm:mt-0">
                    <li>
                        <a href="#" class="hover:underline me-4 md:me-6">Acerca</a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline me-4 md:me-6">Politicas de privacidad</a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline me-4 md:me-6">Licencia</a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline">Contacto</a>
                    </li>
                </ul>
            </div>
        </footer>
    </div>

    @stack('modals')
    @stack('scripts')
</body>

</html>
