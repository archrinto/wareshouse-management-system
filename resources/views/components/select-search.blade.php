@props([
    'data' => [],
    'placeholder' => 'Select an option',
    'limit' => 40,
])

<div
    x-data="AlpineSelect({
        data: {{ json_encode($data) }},
        selected:  @entangle($attributes->wire('model')),
        placeholder: '{{ $placeholder }}',
        multiple: {{ isset($attributes['multiple']) ? 'true':'false' }},
        disabled: {{ isset($attributes['disabled']) ? 'true':'false' }},
        limit: {{ $limit }},
    })"
    x-init="init()"
    @click.away="closeSelect()"
    @keydown.escape="closeSelect()"
    @keydown.arrow-down.prevent="increaseIndex()"
    @keydown.arrow-up.prevent="decreaseIndex()"
    @keydown.enter="selectOption(Object.keys(options)[currentIndex])"
    class="w-full"
>
    <div
        class="relative content-center w-full p-1 px-2 text-left bg-white border border-gray-300 rounded-md sm:text-sm sm:leading-5"
        x-bind:class="{'border-blue-300 ring ring-blue-200 ring-opacity-50':open, 'bg-gray-200 cursor-default':disabled}"
        @click.prevent="toggleSelect(); $nextTick(() => $refs.search.focus());"
    >
        <div id="placeholder">
            <div class="inline-block m-1" x-show="selected?.length === 0" x-text="placeholder">&nbsp;</div>
        </div>
        @isset($attributes['multiple'])
            <div class="flex flex-wrap space-x-1" x-cloak x-show="selected.length > 0">
                <template x-for="(key, index) in selected" :key="index">
                    <div class="text-gray-800 rounded-full truncate bg-blue-300 px-2 py-0.5 my-0.5 flex flex-row items-center">
                        <div class="px-2 truncate" x-text="data[key]"></div>
                        <div x-show="!disabled" x-bind:class="{'cursor-pointer':!disabled}" class="w-4" @click.prevent.stop="deselectOption(index)"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class = 'h-4 fill-current'><path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.538l-4.592-4.548 4.546-4.587-1.416-1.403-4.545 4.589-4.588-4.543-1.405 1.405 4.593 4.552-4.547 4.592 1.405 1.405 4.555-4.596 4.591 4.55 1.403-1.416z"/></svg></div>
                    </div>
                </template>
            </div>
        @else
            <div class="flex flex-wrap" x-cloak x-show="selected">
                <div class="truncate px-1 py-0.5 my-0.5 flex flex-row items-center">
                    <div class="truncate" x-text="data[selected]"></div>
                </div>
            </div>
        @endif

        <div
            class="mt-0.5 w-full bg-white border-gray-300 rounded-b-md border absolute top-full left-0 z-30"
            x-show="open"
            x-cloak
        >

            <div class="relative z-30 w-full p-2 bg-white">
                <input
                    type="search"
                    x-model="search"
                    x-on:click.prevent.stop="open=true"
                    class="block w-full p-2 border border-gray-300 rounded-md focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 sm:text-sm sm:leading-5"
                    x-ref="search"
                >
            </div>

            <div x-ref="dropdown" class="relative z-30 p-2 overflow-y-auto max-h-60" >
                <div x-cloak x-show="Object.keys(options).length === 0" x-text="emptyOptionsMessage">Gragr</div>
                <template x-for="(key, index) in Object.keys(options)" :key="index" >
                    @isset($attributes['multiple'])
                    <div
                        class="px-2 py-1"
                        x-bind:class="{'bg-gray-300 text-white hover:none':selected.includes(key), 'hover:bg-blue-500 hover:text-white cursor-pointer':!(selected.includes(key)), 'bg-blue-500 text-white':currentIndex==index}"
                        @click.prevent.stop="selectOption(key)"
                        x-text="Object.values(options)[index]">
                    </div>
                    @else
                    <div
                        class="px-2 py-1"
                        x-bind:class="{'bg-gray-300 text-white rounded-md hover:none':selected==key, 'hover:bg-gray-200 rounded-md cursor-pointer':!(selected==key)}"
                        @click.prevent.stop="selectOption(key)"
                        x-text="Object.values(options)[index]">
                    </div>
                    @endisset
                </template>
            </div>
        </div>
    </div>
</div>
