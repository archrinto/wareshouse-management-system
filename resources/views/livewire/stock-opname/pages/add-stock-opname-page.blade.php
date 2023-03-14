<div>
    <div class="mb-6">
        <div class="mb-3 flex items-center gap-4">
            <a href="{{ route('stock-opname.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </a>
            <h3 class="text-2xl font-semibold">{{ __('Add Stock Opname') }}</h3>
        </div>
    </div>

    <div class="grid grid-cols-3 gap-6">
        <div class="bg-white rounded-md shadow col-span-2">
            <form wire:submit.prevent="submit">
                <div class="py-3 px-4">
                    <div class="pb-3 border-b mb-3 text-xs uppercase">
                        {{ __('Stock Opname Info') }}
                    </div>
                    <div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700">
                                {{ __('Category') }}
                            </label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <x-select-search
                                    :data="$categoryOptions"
                                    wire:model.defer="categoryId"
                                    placeholder="-- Select category --"
                                />
                            </div>
                            @error('categoryId')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700">
                                {{ __('Stock Opname Date') }}
                            </label>
                            <div class="mt-1 flex shadow-sm">
                                <x-datepicker wire:model.defer="stockOpnameAt" dateFormat="YYYY-MM-DD"  />
                            </div>
                            @error('stockOpnameAt')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="about" class="block text-sm font-medium text-gray-700">
                                {{ __('Description')  }}
                            </label>
                            <div class="mt-1">
                                <textarea
                                    wire:model.defer="description"
                                    name="description"
                                    rows="2"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder="{{ __('Description')  }}"
                                ></textarea>
                            </div>
                            @error('description')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 pb-3 border-b text-xs uppercase">
                        {{ __('Stock Opname Items') }}
                    </div>
                    <div class="">
                        @include('livewire.components.goods-selection')
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-4 mt-4 flex justify-between border-t rounded-b-md">
                    <a href="{{ route('dispatching.index') }}" class="inline-flex justify-center rounded-md bg-white py-2 px-4 text-sm font-medium border border-gray-300 shadow-sm hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        {{ __('Cancel') }}
                    </a>
                    <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-slate-900 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        {{ __('Save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
