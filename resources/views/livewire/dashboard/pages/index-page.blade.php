<div>
    <div class="mb-6">
        <div class="mb-3">
            <h3 class="text-2xl font-semibold">Dashboard</h3>
        </div>
    </div>
    <div>
        <div class="mb-4">
            <h3 class="text-xl">Goods Stock</h3>
        </div>
        <div class="grid grid-cols-3 gap-6">
            <div class="shadow bg-white flex p-4 rounded-md items-center border">
                <div class="w-20 mr-4 py-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-full aspect-square">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                </div>
                <div class="flex-grow">
                    <h3 class="font-semibold text-xl">{{ $countAvailableStock }} items</h3>
                    <p>{{ __('Available Stock') }}</p>
                </div>
            </div>

            <div class="shadow border bg-white flex p-4 rounded-md items-center">
                <div class="w-20 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-full aspect-square">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                </div>
                <div class="flex-grow">
                    <h3 class="font-semibold text-xl">{{ $countLowStock }} items</h3>
                    <p>{{ __('Low Stock') }}</p>
                </div>
            </div>

            <div class="shadow border bg-white flex p-4 rounded-md items-center">
                <div class="w-20 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-full aspect-square">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                </div>
                <div class="flex-grow">
                    <h3 class="font-semibold text-xl">{{ $countOutOfStock }} items</h3>
                    <p>{{ __('Out of Stock') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
