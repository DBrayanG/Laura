<div>
    <div class="flex items-center justify-between mb-3 mt-4">
        <span class="text-4xl font-bold text-black dark:text-black">Pedido</span>
    </div>

    <div class="grid grid-cols-2 gap-3 mt-4">
        <div class="grid grid-cols-1 gap-2">
            <div class="mb-1">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:gray-900">Fecha</label>
                <input type="date" value="{{ $pedido->fecha }}"readonly
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div class="mb-1">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:gray-900">Hora</label>
                <input type="time" value="{{ $pedido->hora }}" readonly
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div class="mb-1">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:gray-900">Costo Total</label>
                <input type="number" value="{{ $pedido->monto_total }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    readonly>
            </div>
            <div class="mb-1">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:gray-900">Estado</label>
                <input type="text" value="{{ $pedido->estado }}"
                    class="bg-gray-50 border uppercase border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    readonly>
            </div>
        </div>
        <div class="">
            <p class="text-blue-900 text-xl font-extrabold">Realizar el pago en el siguiente QR</p>
            <div class="flex flex-col p-4 gap-4 text-lg font-semibold shadow-md border rounded-sm">
                {{-- <img src="{{ route('pago_facil.pagar.qr', $pedido->id) }}" alt="" class="w-96 h-96"> --}} 
                <img id="qr-image" alt="QR Code" class="w-96 h-96">
                <p id="codigo-transaccion" class="text-center text-blue-900 font-bold text-lg"></p>
            </div>
            <div class="text-center">
                <button id="verificarEstado" class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                    Verificar Estado
                </button>
                <p id="mensajeEstado" class="mt-2 text-gray-800"></p>
            </div>
        </div>
    
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                // ID del pedido (puedes pasarlo desde el backend o JavaScript)
                const pedidoId = "{{ $pedido->id }}";
        
                // URL de la API para generar el QR
                console.log(pedidoId);
                const url = `{{ route('pago_facil.pagar.qr', '') }}/${pedidoId}`;
        
                // Realizar la solicitud
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        // Verificar si la respuesta contiene errores
                        if (data.error) {
                            console.error("Error al generar el QR:", data.error);
                            return;
                        }
        
                        // Mostrar la imagen QR
                        const qrImage = document.getElementById("qr-image");
                        qrImage.src = `data:image/png;base64,${data.qr_image}`;
        
                        // Mostrar el código de transacción
                        const codigoTransaccion = document.getElementById("codigo-transaccion");
                        console.log(codigoTransaccion);
                        codigoTransaccion.textContent = `Código de Transacción: ${data.codigo_transaccion}`;
                    })
                    .catch(error => console.error("Error en la solicitud:", error));
            });
        </script>
        <script>
            document.getElementById('verificarEstado').addEventListener('click', function () {
            // Obtener datos
            const codigoTransaccionElemento = document.getElementById("codigo-transaccion");

            // Extraer el texto completo
            const textoCompleto = codigoTransaccionElemento.textContent; 

            // Extraer solo el código numérico
            const codigoTransaccion = textoCompleto.replace("Código de Transacción: ", "").trim();

            console.log(codigoTransaccion); // Esto mostrará "2568933"
            const pedidoId = "{{ $pedido->id }}"; // ID del pedido desde Blade

            // Construir la URL con el parámetro pedido
            const url = `{{ route('pago_facil.estado', ':pedido') }}`.replace(':pedido', pedidoId);

            // Enviar la solicitud al servidor
            fetch(url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    tnTransaccion: codigoTransaccion
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log(data);
                        const estadoTransaccion = data.estadoTransaccion;
                        console.log(estadoTransaccion);
                        if (estadoTransaccion === 2 || estadoTransaccion === 1) {
                            // Mostrar el alertDialog
                            alert("¡Compra exitosa!");
                        } else {
                            alert("La transacción no fue exitosa");
                        }
                    } else {
                        console.error("Error en la respuesta:", data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
        });
        </script>
        
        
    </div>
    <br>
    <div class="flex items-center justify-between mb-3 mt-4">
        <span class="text-4xl font-bold text-black dark:text-black">Detalles</span>
    </div>
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
