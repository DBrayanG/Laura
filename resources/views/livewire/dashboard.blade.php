<div class="grid grid-row">
    <div class="w-full">
        <div class="flex flex-col lg:flex-row w-full lg:space-x-2 space-y-2 lg:space-y-0 mb-2 lg:mb-4">
            <div class="w-full lg:w-1/4 shadow-md">
                <div class="widget w-full p-4 rounded-lg bg-white border-l-4 border-purple-400">
                    <div class="flex items-center">
                        <div class="icon w-14 p-3.5 bg-purple-400 text-white rounded-full mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                            </svg>

                        </div>
                        <div class="flex flex-col justify-center">
                            <div class="text-lg">{{ $productos }}</div>
                            <div class="text-sm text-gray-400">Productos</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/4 shadow-md">
                <div class="widget w-full p-4 rounded-lg bg-white border-l-4 border-yellow-400">
                    <div class="flex items-center">
                        <div class="icon w-14 p-3.5 bg-yellow-400 text-white rounded-full mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                            </svg>

                        </div>
                        <div class="flex flex-col justify-center">
                            <div class="text-lg">{{ $ventas }}</div>
                            <div class="text-sm text-gray-400">Ventas</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/4 shadow-md">
                <div class="widget w-full p-4 rounded-lg bg-white border-l-4 border-blue-400">
                    <div class="flex items-center">
                        <div class="icon w-14 p-3.5 bg-blue-400 text-white rounded-full mr-3 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                            </svg>

                        </div>
                        <div class="flex flex-col justify-center">
                            <div class="text-lg">{{ $compras }}</div>
                            <div class="text-sm text-gray-400">Compras</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/4 shadow-md">
                <div class="widget w-full p-4 rounded-lg bg-white border-l-4 border-red-400">
                    <div class="flex items-center">
                        <div class="icon w-14 p-3.5 bg-red-400 text-white rounded-full mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                            </svg>

                        </div>
                        <div class="flex flex-col justify-center">
                            <div class="text-lg">{{ $clientes }} </div>
                            <div class="text-sm text-gray-400 ">Clientes</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-5 mt-4 gap-2">
        <div class="col-span-3 w-full h-auto col-row">
            <div class="border rounded-md p-2 shadow-md bg-white dark:bg-dark">
                <p class="text-xl text-center font-bold text-gray-700 dark:text-gray-200 mb-2 uppercase">Páginas más
                    visitadas</p>
                <canvas id="paginas"></canvas>
            </div>
        </div>
        <div class="col-span-2 border rounded-md p-2 shadow-md bg-white">
            <p class="text-xl text-center font-bold text-gray-700 dark:text-gray-200 mb-2 uppercase">
                Últimos ingresos
            </p>
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nombre
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Fecha
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Hora
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ingresos as $usuario)
                        <tr class=" bg-white hover:bg-gray-50 text-blak border-b font-semibold">
                            <td class="px-2 py-2">
                                {{ $usuario->nombre }}
                            </td>
                            <td class="px-2 py-2">
                                {{ $usuario->fecha }}
                            </td>
                            <td class="px-2 py-2">
                                {{ $usuario->hora }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script type="text/javascript">
            let paginas = @json($paginas);
            let colores = @json($colores);
            let labels = [];
            let data = [];
            const dataPagina = {
                labels: labels,
                datasets: [{
                    label: "Visitas",
                    data: data,
                    backgroundColor: colores[2],
                    borderColor: colores[2],
                }]
            };

            paginas.forEach((pagina, index) => {
                labels.push(pagina.nombre);
                data.push(pagina.visitas);
            });
            const config = {
                type: 'bar',
                data: dataPagina,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    }
                }
            };

            var myChart = new Chart(
                document.getElementById('paginas'),
                config
            );
        </script>
    @endpush
    @push('visitas')
        {{ $visitas }}
    @endpush
</div>
