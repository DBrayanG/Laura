<div>
    <a {{-- id="dropdownNotificationButton" data-dropdown-toggle="dropdownNotification"  type="button" --}} href="{{ route('public.confirm_pedido') }}"
        class="relative inline-flex items-center text-base font-medium text-center text-gray-500 hover:text-gray-900 focus:outline-none dark:hover:text-white dark:text-gray-400">
        <x-iconos.cart />
        <span
            class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
            {{ $cantProducts }}
        </span>
    </a>
</div>
