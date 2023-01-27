<div class="flex justify-center">
    <div
        x-data="{
            open: false,
            toggle() {
                if (this.open) {
                    return this.close()
                }

                this.$refs.button.focus()

                this.open = true
            },
            close(focusAfter) {
                if (! this.open) return

                this.open = false

                focusAfter && focusAfter.focus()
            }
        }"
        x-on:keydown.escape.prevent.stop="close($refs.button)"
        x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
        x-id="['dropdown-button']"
        class="relative"
    >
        <!-- Button -->

        <a
            href="#"
            x-ref="button"
            x-on:click.prevent="toggle()"
            :aria-expanded="open"
            :aria-controls="$id('dropdown-button')"
            class="flex items-center gap-2"
        >
            <div class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-200 rounded-full dark:bg-gray-600">
                <span class="font-medium text-gray-600 dark:text-gray-300">JL</span>
            </div>
            <!-- Heroicon: chevron-down -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </a>

        <!-- Panel -->
        <div
            x-ref="panel"
            x-show="open"
            x-transition.origin.top.right
            x-on:click.outside="close($refs.button)"
            :id="$id('dropdown-button')"
            style="display: none;"
            class="absolute right-0 mt-4 w-52 rounded-md bg-white shadow divide-y divide-gray-100 py-1"
        >
            <div class="px-4 py-3 text-sm dark:text-white">
                <div>{{ Auth::user()->name }}</div>
                <div class="font-medium truncate">
                    {{ Auth::user()->email }}
                </div>
            </div>
            <a href="{{ route('logout') }}" class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-3 text-left text-sm hover:bg-gray-100 disabled:text-gray-500">
                <span class="text-red-600">
                    {{ __('Logout') }}
                </span>
            </a>
        </div>
    </div>
</div>
