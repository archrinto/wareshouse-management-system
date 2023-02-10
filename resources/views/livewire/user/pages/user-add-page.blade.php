<div>
    <div class="mb-6">
        <div class="mb-3 flex items-center gap-4">
            <a href="{{ route('user.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </a>
            <h3 class="text-2xl font-semibold">{{ __('Add User') }}</h3>
        </div>
    </div>
</div>
<div class="md:grid md:grid-cols-3 md:gap-6">
    <div class="mt-5 md:col-span-2 md:mt-0">
        <form wire:submit.prevent="submit" method="POST">
            <div class="shadow sm:overflow-hidden sm:rounded-md">
                <div class="space-y-4 bg-white px-4 py-5 sm:p-6">
                    <div class="mb-2">
                        <label for="company-website" class="block text-sm font-medium text-gray-700">
                           {{ __('Name') }}
                        </label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <input
                               wire:model.defer="name"
                               type="text"
                               class="block w-full flex-1 rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                               placeholder="{{ __('Name') }}"
                            >
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="company-website" class="block text-sm font-medium text-gray-700">
                            {{ __('Email') }}
                        </label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <input
                                wire:model.defer="email"
                                type="text"
                                class="block w-full flex-1 rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                placeholder="{{ __('Email') }}"
                            >
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="company-website" class="block text-sm font-medium text-gray-700">
                            {{ __('Role') }}
                        </label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <x-select-search
                                :data="$roleOptions"
                                wire:model.defer="roleOption"
                                placeholder="-- {{ __('Select Role') }} --"
                            />
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="company-website" class="block text-sm font-medium text-gray-700">
                            {{ __('Password') }}
                        </label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <input
                                wire:model.defer="password"
                                type="password"
                                class="block w-full flex-1 rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                placeholder="{{ __('Password') }}"
                            >
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="company-website" class="block text-sm font-medium text-gray-700">
                            {{ __('Confirm Password') }}
                        </label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <input
                                wire:model.defer="confirmPassword"
                                type="password"
                                class="block w-full flex-1 rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                placeholder="{{ __('Confirm Password') }}"
                            >
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-4 flex justify-between sm:px-6 border-t">
                    <a href="{{ route('user.index') }}" class="inline-flex justify-center rounded-md bg-white py-2 px-4 text-sm font-medium border border-gray-300 shadow-sm hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        {{ __('Cancel') }}
                    </a>
                    <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-slate-900 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        {{ __('Save') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
