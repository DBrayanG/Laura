<div>
    @if ($error)
        <div id="alert-border-2"
            class="mx-14 flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-100 dark:text-red-400 dark:bg-gray-800 dark:border-red-800"
            role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <div class="ms-3 text-sm font-medium">
                Error!! No se pudo realizar el pedido.
            </div>
        </div>
    @endif
    <div class="flex flex-col md:flex-row w-full h-full px-14 py-7">
        {{-- m --}}
        <div class="w-full flex flex-col h-fit gap-4 p-4 ">
            <p class="text-blue-900 text-xl font-extrabold">Mi Carrito</p>
            @foreach ($detalles as $detalle)
                <div class="flex flex-col p-4 text-lg font-semibold shadow-md border rounded-sm">
                    <div class="flex flex-col md:flex-row gap-3 justify-between">
                        <!-- Product Information -->
                        <div class="flex flex-row gap-6 items-center">
                            <div class="w-28 h-28">
                                <img class="w-full h-full" src="{{ $detalle->imagen }}">
                            </div>
                            <div class="flex flex-col gap-1">
                                <p class="text-lg text-gray-800 font-semibold">{{ $detalle->producto }}</p>
                                <p class="text-xs text-gray-600 font-semibold">Des:
                                    <span class="font-normal">{{ $detalle->descripcion }}</span>
                                </p>

                            </div>
                        </div>
                        <div class="self-center text-center">
                            <p class="text-gray-800 font-normal text-xl">{{ $detalle->precio * $detalle->cantidad }} Bs.
                            </p>
                        </div>
                        <!-- Remove Product Icon -->
                        <div class="self-center">
                            <button class="" wire:click="removeCart({{ $detalle->id }})">
                                <svg class="" height="24px" width="24px" id="Layer_1"
                                    style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512"
                                    xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g>
                                        <path
                                            d="M400,113.3h-80v-20c0-16.2-13.1-29.3-29.3-29.3h-69.5C205.1,64,192,77.1,192,93.3v20h-80V128h21.1l23.6,290.7   c0,16.2,13.1,29.3,29.3,29.3h141c16.2,0,29.3-13.1,29.3-29.3L379.6,128H400V113.3z M206.6,93.3c0-8.1,6.6-14.7,14.6-14.7h69.5   c8.1,0,14.6,6.6,14.6,14.7v20h-98.7V93.3z M341.6,417.9l0,0.4v0.4c0,8.1-6.6,14.7-14.6,14.7H186c-8.1,0-14.6-6.6-14.6-14.7v-0.4   l0-0.4L147.7,128h217.2L341.6,417.9z" />
                                        <g>
                                            <rect height="241" width="14" x="249" y="160" />
                                            <polygon points="320,160 305.4,160 294.7,401 309.3,401" />
                                            <polygon points="206.5,160 192,160 202.7,401 217.3,401" />
                                        </g>
                                    </g>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <!-- Product Quantity -->
                    <div class="flex flex-row self-center gap-1">
                        <button class="w-5 h-5 self-center rounded-full border border-gray-300"
                            wire:click="updateCart({{ $detalle->id }},{{ -1 }})">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#d1d5db"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14" />
                            </svg>
                        </button>
                        <input type="text" readonly="readonly" name="quantity" id="quantity"
                            wire:model="cantidades.{{ $detalle->id }}"
                            class="w-14 h-8 text-center text-gray-900 text-sm outline-none border border-gray-300 rounded-sm">
                        <button class="w-5 h-5 self-center rounded-full border border-gray-300"
                            wire:click="updateCart({{ $detalle->id }},{{ 1 }})">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="" stroke="#9ca3af"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 5v14M5 12h14" />
                            </svg>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Purchase Resume -->
        <div class="flex flex-col w-full md:w-2/3 h-fit gap-4 p-4">
            <p class="text-blue-900 text-xl font-extrabold">Resumen</p>
            <div class="flex flex-col p-4 gap-4 text-lg font-semibold shadow-md border rounded-sm">
                <div class="flex flex-row justify-between">
                    <p class="text-gray-600">Subtotal ({{ $cantProducts }} Items)</p>
                    <p class="text-end font-bold">{{ $total }} Bs.</p>
                </div>
                <hr class="bg-gray-200 h-0.5">
                <div class="flex flex-row justify-between">
                    <p class="text-gray-600">Total</p>
                    <div>
                        <p class="text-end font-bold">{{ $total }} Bs.</p>
                    </div>
                </div>
                <div class="flex gap-2">
                    @if (!$mostrarQR)
                        <button wire:click="confirmPedido"
                            class="transition-colors text-sm bg-blue-600 hover:bg-blue-700 p-2 rounded-sm w-full text-white text-hover shadow-md">
                            Finalizar
                        </button>
                    @endif
                    <a href="{{ route('inicio') }}"
                        class="transition-colors text-sm bg-white border border-gray-600 p-2 rounded-sm w-full text-gray-700 text-hover shadow-md">
                        Agregar mas productos
                    </a>
                </div>
            </div>
            @if ($mostrarQR)
                <div>
                    <p class="text-blue-900 text-xl font-extrabold">Complete el pago para finalizar el pedido</p>
                    <div class="flex flex-col p-4 gap-4 text-lg font-semibold shadow-md border rounded-sm">
                        <img src="{{ route('pago_facil.pagar.qr', $pedido->id) }}" alt="" class="w-96 h-96">
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@push('visitas')
    {{ $visitas }}
@endpush
