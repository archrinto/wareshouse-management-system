<div>
    <div class="mb-6">
        <div class="mb-3 flex items-center gap-4">
            <a href="{{ route('receiving.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </a>
            <h3 class="text-2xl font-semibold">Add Receiving</h3>
        </div>
    </div>

    <div class="grid grid-cols-3 gap-6">
        <div class="bg-white rounded-md shadow col-span-2">
            <form wire:submit.prevent="submit">
                <div class="py-3 px-4">
                    <div class="pb-3 border-b mb-3 text-xs uppercase">
                        Receiving Info
                    </div>
                    <div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700">
                                Supplier
                            </label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <x-select-search
                                    :data="$supplierOptions"
                                    wire:model.defer="supplierId"
                                    placeholder="-- Select Supplier --"
                                />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700">
                                Receive Date
                            </label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <x-date-picker wire:model.defer="receiveAt" dateFormat="YYYY-MM-DD"  />
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 pb-3 border-b text-xs uppercase">
                        Receiving Items
                    </div>
                    <div class="">
                        <div class="grid grid-cols-2 mb-3 gap-4">
                            <div class="text-sm font-medium text-gray-700">
                                <span>Goods</span>
                            </div>
                            <div class="text-sm font-medium text-gray-700">
                                <span>Quantity</span>
                            </div>
                        </div>
                        <div>
                            @foreach($goodsItems as $index => $item)
                                <div class="grid grid-cols-2 gap-4" wire:key="$index">
                                    <div class="mb-3">
                                        <div class="flex rounded-md shadow-sm">
                                            <x-select-search
                                                :data="$goodsOptions"
                                                wire:model.defer="goodsItems.{{ $index }}.goodsId"
                                                placeholder="-- Select Goods --"
                                            />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="flex items-center">
                                            <div class="flex rounded-md shadow-sm flex-grow">
                                                <input
                                                    wire:model.defer="goodsItems.{{ $index }}.quantity"
                                                    type="number"
                                                    name="company-website"
                                                    class="block w-full flex-1 rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                    placeholder="Quantity"
                                                >
                                            </div>
                                            <div class="ml-4 w-32">
                                                <button
                                                    wire:click.prevent="deleteItem({{ $index }})"
                                                    type="button"
                                                    class="bg-slate-900 text-slate-300 hover:bg-red-600 hover:text-red-100 text-white focus:outline-none font-sm rounded-md text-sm p-2 text-center items-center"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                    </svg>
                                                    <span class="sr-only">Delete</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="">
                                <button
                                    wire:click.prevent="addItem()"
                                    type="button"
                                    class="flex items-center bg-slate-900 text-slate-300 hover:bg-red-600 hover:text-red-100 text-white focus:outline-none font-sm rounded-md text-sm px-3 py-2 text-center items-center"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    <span class="ml-2">Add Item</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-4 mt-4 flex justify-between border-t rounded-b-md">
                    <a href="{{ route('receiving.index') }}" class="inline-flex justify-center rounded-md bg-white py-2 px-4 text-sm font-medium border border-gray-300 shadow-sm hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-slate-900 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
