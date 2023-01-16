<div>
    <div class="mb-6">
        <div class="mb-3 flex items-center gap-4">
            <a href="{{ route('goods.category.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </a>
            <h3 class="text-2xl font-semibold">Add Transaction Category</h3>
        </div>
    </div>
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="mt-5 md:col-span-2 md:mt-0">
            <form wire:submit.prevent="submit" method="POST">
                <div class="shadow sm:overflow-hidden sm:rounded-md">
                    <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                        <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-3 sm:col-span-2">
                                <label for="company-website" class="block text-sm font-medium text-gray-700">
                                    Name
                                </label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input
                                        wire:model.defer="name"
                                        type="text"
                                        class="block w-full flex-1 rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        placeholder="name"
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-3 sm:col-span-2">
                                <label for="company-website" class="block text-sm font-medium text-gray-700 mb-2">
                                    Operation
                                </label>
                                <div class="flex rounded-md shadow-sm gap-4">
                                    @foreach($operationOptions as $opt)
                                        <div class="flex items-center">
                                            <input 
                                                {{ $operation == $opt['value'] ? 'checked' : '' }}
                                                id="operation-{{ $opt['value'] }}"
                                                type="radio"
                                                value="{{ $opt['value'] }}"
                                                name="default-radio"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                            >
                                            <label
                                                for="operation-{{ $opt['value'] }}"
                                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                            >{{ $opt['text'] }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="about" class="block text-sm font-medium text-gray-700">
                                Description
                            </label>
                            <div class="mt-1">
                                <textarea
                                    wire:model.defer="description"
                                    name="description"
                                    rows="3"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder="Description"
                                ></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-4 flex justify-between sm:px-6 border-t">
                        <a href="{{ route('goods.category.index') }}" class="inline-flex justify-center rounded-md bg-white py-2 px-4 text-sm font-medium border border-gray-300 shadow-sm hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Cancel
                        </a>
                        <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-slate-900 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="md:col-span-1">
        </div>
    </div>
</div>