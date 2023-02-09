<div>
    <div class="mb-6">
        <div class="mb-3 flex items-center gap-4">
            <a href="{{ route('receiving.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </a>
            <h3 class="text-2xl font-semibold">{{ __('Detail Receiving') }}</h3>
        </div>
    </div>

    <div class="grid grid-cols-3 gap-6">
        <div class="bg-white rounded-md shadow col-span-2">
            <div class="py-3 px-4">
                <div class="pb-3 border-b mb-3 text-xs uppercase">
                    {{ __('Receiving Info') }}
                </div>
                <div class="mb-8">
                    <dl>
                        <div class="mb-4 grid grid-cols-3 gap-4">
                            <dt>
                                {{ __('Supplier') }}
                            </dt>
                            <dd class="text-gray-900 col-span-2 mt-0">
                                {{ $transaction->supplier->name ?? '-' }}
                            </dd>
                        </div>
                        <div class="my-4 grid grid-cols-3 gap-4">
                            <dt>
                                {{ __('Receive at') }}
                            </dt>
                            <dd class="text-gray-900 col-span-2 mt-0">
                                {{ $transaction->transaction_at_formatted ?? '-' }}
                            </dd>
                        </div>
                        <div class="my-4 grid grid-cols-3 gap-4">
                            <dt>
                                {{ __('Description') }}
                            </dt>
                            <dd class="text-gray-900 col-span-2 mt-0">
                                {{ $transaction->description ?? '-' }}
                            </dd>
                        </div>
                    </dl>
                </div>

                <div class="mb-6 pb-3 border-b text-xs uppercase">
                    {{ __('Receiving Items') }}
                </div>

                <div class="mb-8">
                    <div class="grid grid-cols-4 gap-4 mb-4">
                        <div class="text-sm font-medium text-gray-700 col-span-2">
                            <span>{{__('Goods')}}</span>
                        </div>
                        <div class="text-sm font-medium text-gray-700">
                            <span>{{__('Quantity')}}</span>
                        </div>
                        <div class="text-sm font-medium text-gray-700">
                            <span>{{__('Unit')}}</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-4 gap-4">
                        @foreach($transaction->items as $item)
                            <div class="col-span-2">{{ $item->goods->codeName }}</div>
                            <div>{{ $item->quantity }}</div>
                            <div>{{ $item->goods->unit->name ?? '-' }}</div>
                        @endforeach
                    </div>
                </div>

                <div class="mb-3 pb-3 border-b text-xs uppercase">
                    {{ __('Additional Info') }}
                </div>

                <div class="mb-8">
                    <dl>
                        <div class="mb-4 grid grid-cols-3 gap-4">
                            <dt>
                                {{ __('Created by') }}
                            </dt>
                            <dd class="text-gray-900 col-span-2 mt-0">
                                {{ $transaction->creator->name ?? '-' }}
                            </dd>
                        </div>
                        <div class="mb-4 grid grid-cols-3 gap-4">
                            <dt>
                                {{ __('Created at') }}
                            </dt>
                            <dd class="text-gray-900 col-span-2 mt-0">
                                {{ $transaction->created_at ?? '-' }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-4 mt-4 flex justify-between border-t rounded-b-md">
                <a href="{{ route('receiving.index') }}"
                   class="inline-flex justify-center rounded-md bg-white py-2 px-4 text-sm font-medium border border-gray-300 shadow-sm hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    {{ __('Back') }}
                </a>
                <button
                    wire:click="printPDF()"
                    type="button"
                    class="inline-flex justify-center rounded-md border border-transparent bg-slate-900 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    {{ __('Print PDF') }}
                </button>
            </div>
        </div>
    </div>
</div>
