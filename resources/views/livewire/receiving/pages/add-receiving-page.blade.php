<div>
    <div class="mb-6">
        <div class="mb-3 flex items-center gap-4">
            <a href="{{ route('receiving.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </a>
            <h3 class="text-2xl font-semibold">{{ __('Add Receiving') }}</h3>
        </div>
    </div>

    <div class="grid grid-cols-3 gap-6">
        <div class="bg-white rounded-md shadow col-span-2">
            <form wire:submit.prevent="submit">
                <div class="py-3 px-4">
                    <div class="pb-3 border-b mb-3 text-xs uppercase">
                        {{ __('Receiving Info') }}
                    </div>
                    <div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700">
                                {{ __('Supplier') }}
                            </label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <x-select-search
                                    :data="$supplierOptions"
                                    wire:model.defer="supplierId"
                                    placeholder="-- Select Supplier --"
                                />
                            </div>
                            @error("supplierId")
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700">
                                {{ __('Receive At') }}
                            </label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <x-date-picker wire:model.defer="receiveAt" dateFormat="YYYY-MM-DD"  />
                            </div>
                            @error("receiveAt")
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 pb-3 border-b text-xs uppercase">
                        {{ __('Receiving Items') }}
                    </div>
                    <div class="">
                        <div class="grid grid-cols-2 mb-3 gap-4">
                            <div class="text-sm font-medium text-gray-700">
                                <span>{{ __('Goods') }}</span>
                            </div>
                            <div class="text-sm font-medium text-gray-700">
                                <span>{{ __('Quantity') }}</span>
                            </div>
                        </div>
                        <div>
                            @foreach($goodsItems as $index => $item)
                                <div class="grid grid-cols-2 gap-4" wire:key="item-{{ $index }}">
                                    <div class="mb-3">
                                        <div class="flex rounded-md shadow-sm">
                                            <x-select-search
                                                :data="$goodsOptions"
                                                wire:model.defer="goodsItems.{{ $index }}.goodsId"
                                                placeholder="-- {{ __('Select Goods') }} --"
                                            />
                                        </div>
                                        @error("goodsItems.$index.goodsId")
                                            <span class="text-sm text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <div class="flex items-center">
                                            <div class="flex rounded-md shadow-sm flex-grow">
                                                <input
                                                    wire:model.defer="goodsItems.{{ $index }}.quantity"
                                                    type="number"
                                                    class="block w-full flex-1 rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                    placeholder="{{ __('Quantity') }}"
                                                >
                                            </div>
                                            <div class="ml-4 w-32">
                                                <button
                                                    wire:click.prevent="deleteItem({{ $index }})"
                                                    wire:loading.attr="disabled"
                                                    type="button"
                                                    class="bg-slate-900 text-slate-300 hover:bg-red-600 hover:text-red-100 text-white focus:outline-none font-sm rounded-md text-sm p-2 text-center items-center"
                                                >
                                                    <svg wire:loading wire:target="deleteItem({{ $index }})" aria-hidden="true" role="status" class="w-5 h-5 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                                                    </svg>
                                                    <svg wire:loading.remove wire:target="deleteItem({{ $index }})" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                    </svg>
                                                    <span class="sr-only">Delete</span>
                                                </button>
                                            </div>
                                        </div>
                                        @error("goodsItems.$index.quantity")
                                            <span class="text-sm text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach
                            <div class="">
                                <button
                                    wire:click.prevent="addItem()"
                                    wire:loading.attr="disabled"
                                    type="button"
                                    class="flex items-center bg-slate-900 text-slate-300 hover:bg-slate-800 text-white focus:outline-none font-sm rounded-md text-sm px-3 py-2 text-center items-center"
                                >
                                    <svg wire:loading wire:target="addItem" aria-hidden="true" role="status" class="w-4 h-4 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                                    </svg>
                                    <svg wire:loading.remove wire:target="addItem" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    <span class="ml-2">{{  __('Add Item') }}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-4 mt-4 flex justify-between border-t rounded-b-md">
                    <a href="{{ route('receiving.index') }}" class="inline-flex justify-center rounded-md bg-white py-2 px-4 text-sm font-medium border border-gray-300 shadow-sm hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        {{ __('Cancel') }}
                    </a>
                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        class="inline-flex items-center gap-3 justify-center rounded-md border border-transparent bg-slate-900 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        <svg wire:loading wire:target="submit" aria-hidden="true" role="status" class="w-4 h-4 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                        </svg>
                        {{ __('Save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
