<div>
    <div class="mb-6">
        <div class="mb-3 flex items-center gap-4">
            <a href="{{ route('goods.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </a>
            <h3 class="text-2xl font-semibold">{{ $goods->code }} {{ $goods->name }}</h3>
        </div>
    </div>
    <div class="grid grid-cols-3 gap-6">
        <div>
            <div class="bg-white shadow rounded-md">
                <div class="px-6 py-4 border-b">
                    {{ __('Goods Information') }}
                </div>
                <div class="p-6 text-sm">
                    <div class="grid grid-cols-3 py-3 border-b">
                        <div>
                            {{ __('Code') }}
                        </div>
                        <div class="col-span-2 font-medium">
                            {{ $goods->code }}
                        </div>
                    </div>
                    <div class="grid grid-cols-3 py-3 border-b">
                        <div>
                            {{ __('Name') }}
                        </div>
                        <div class="col-span-2 font-medium">
                            {{ $goods->name }}
                        </div>
                    </div>
                    <div class="grid grid-cols-3 py-3 border-b">
                        <div>
                            {{ __('Category') }}
                        </div>
                        <div class="col-span-2 font-medium">
                            {{ implode(', ', $goods->getCategoryNames()) }}
                        </div>
                    </div>
                    <div class="grid grid-cols-3 py-3 border-b">
                        <div>
                            {{ __('Unit') }}
                        </div>
                        <div class="col-span-2 font-medium">
                            {{ $goods->unit->name ?? '-' }} ({{ $goods->unit->symbol ?? '-' }})
                        </div>
                    </div>
                    <div class="grid grid-cols-3 py-3 border-b">
                        <div>
                            {{ __('Stock') }}
                        </div>
                        <div class="col-span-2 font-medium">
                            {{ number_format($goods->stock) }}
                        </div>
                    </div>
                    <div class="grid grid-cols-3 py-3 border-b">
                        <div>
                            {{ __('Stock Limit') }}
                        </div>
                        <div class="col-span-2 font-medium">
                            {{ number_format($goods->minimum_stock) }}
                        </div>
                    </div>
                    <div class="grid grid-cols-3 py-3 border-b">
                        <div>
                            {{ __('Price') }}
                        </div>
                        <div class="col-span-2 font-medium">
                            {{ number_format($goods->price) }}
                        </div>
                    </div>
                    <div class="grid grid-cols-3 py-3 border-b">
                        <div>
                            {{ __('Value') }}
                        </div>
                        <div class="col-span-2 font-medium">
                            {{ number_format($goods->price * $goods->stock) }}
                        </div>
                    </div>
                    <div class="grid grid-cols-3 py-3">
                        <div>
                            {{ __('Description') }}
                        </div>
                        <div class="col-span-2 font-medium">
                            {{ $goods->description }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-2">
            <div class="bg-white shadow rounded-md ">
                <div class="px-6 py-4 border-b">
                    {{ __('Transaction History') }}
                </div>
                <div class="p-6">
                    <livewire:goods.components.goods-transaction-history-table :goods-id="$goodsId" />
                </div>
            </div>
        </div>
    </div>
</div>
