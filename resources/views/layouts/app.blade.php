<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warehouse Management System</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
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

</body>
</html>
