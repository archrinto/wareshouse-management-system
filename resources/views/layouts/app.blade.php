<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warehouse Management System</title>
    @livewireStyles
    @livewireScripts
    @vite('resources/js/app.js')
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body
    x-data="sidebar()"
    class="text-slate-500 antialiased bg-gray-100 h-full"
    @resize.window="handleResize()"
>
    <div class="w-full flex font-sans">
        <div
            x-show="isOpen()"
            class="fixed z-10 top-0 left-0 overflow-y-auto h-screen"
        >
            <livewire:components.sidebar />
        </div>
        <div
            class="flex-grow relative"
            :class="{'ml-64': isOpen() && isAboveBreakpoint }"
        >
            <div
                class="bg-white border-b flex justify-between h-16 items-center pl-4 sticky top-0 w-full left-0 right-0"
            >
                <button @click.prevent="handleToggle()" class="rounded-md p-2 hover:text-slate-900">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                       <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
                <div class="mr-3 flex items-center gap-3">
                    <x-user-avatar />
                </div>
            </div>
            <div class="p-6">
                {{ $slot }}
            <div>
        </div>
    </div>

    <livewire:components.toast-message />

    @stack('scripts')

    <script>
        function sidebar() {
            const breakpoint = 1280
            return {
                open: {
                    above: true,
                    below: false,
                },
                isAboveBreakpoint: window.innerWidth > breakpoint,

                handleToggle() {
                    if (this.isOpen()) {
                        this.handleClose()
                    } else {
                        this.handleOpen()
                    }
                },

                handleResize() {
                    this.isAboveBreakpoint = window.innerWidth > breakpoint
                },

                isOpen() {
                    if (this.isAboveBreakpoint) {
                        return this.open.above
                    }
                    return this.open.below
                },
                handleOpen() {
                    if (this.isAboveBreakpoint) {
                        this.open.above = true
                    }
                    this.open.below = true
                },
                handleClose() {
                    if (this.isAboveBreakpoint) {
                        this.open.above = false
                    }
                    this.open.below = false
                },
                handleAway() {
                    if (!this.isAboveBreakpoint) {
                        this.open.below = false
                    }
                },
            }
        }
    </script>
    <script>
        function AlpineSelect(config) {
            console.log(config.selected, config.selected.length);
            return {
                data: config.data ?? [],
                open: false,
                search: '',
                options: {},
                emptyOptionsMessage: 'No results match your search.',
                placeholder: config.placeholder,
                selected: config.selected,
                multiple: config.multiple,
                currentIndex: 0,
                isLoading: false,
                disabled: config.disabled ?? false,
                limit: config.limit ?? 40,
                init: function() {
                    if(!this.selected) {
                        console.log('--------- invalid selected')
                    }
                    if(this.selected == null ){
                        if(this.multiple)
                            this.selected = []
                        else
                            this.selected = ''
                    }
                    if(!this.data) this.data = {}
                    this.resetOptions()
                    this.$watch('search', ((values) => {
                        if (!this.open || !values) {
                            this.resetOptions()
                            return
                        }
                        this.options = Object.keys(this.data)
                            .filter((key) => this.data[key].toLowerCase().includes(values.toLowerCase()))
                            .slice(0, this.limit)
                            .reduce((options, key) => {
                                options[key] = this.data[key]
                                return options
                            }, {})
                        this.currentIndex=0
                    }))
                },
                resetOptions: function() {
                    this.options = Object.keys(this.data)
                        .slice(0,this.limit)
                        .reduce((options, key) => {
                            options[key] = this.data[key]
                            return options
                        }, {})
                },
                closeSelect: function() {
                    this.open = false
                    this.search = ''
                },
                toggleSelect: function() {
                    if(!this.disabled) {
                        if (this.open) return this.closeSelect()
                        this.open = true
                    }
                },
                deselectOption: function(index) {
                    if(this.multiple) {
                        this.selected.splice(index, 1)
                    }
                    else {
                        this.selected = ''
                    }
                },
                selectOption: function(value) {
                    if(!this.disabled) {
                        // If multiple push to the array, if not, keep that value and close menu
                        if(this.multiple){
                            // If it's not already in there
                            if (!this.selected.includes(value)) {
                                this.selected.push(value)
                            }
                        }
                        else {
                            this.selected=value
                            this.closeSelect()
                        }
                    }
                },
                increaseIndex: function() {
                    if(this.currentIndex == Object.keys(this.options).length)
                        this.currentIndex = 0
                    else
                        this.currentIndex++
                },
                decreaseIndex: function() {
                    if(this.currentIndex == 0)
                        this.currentIndex = Object.keys(this.options).length-1
                    else
                        this.currentIndex--;
                },
            }
        }
    </script>
</body>
</html>
