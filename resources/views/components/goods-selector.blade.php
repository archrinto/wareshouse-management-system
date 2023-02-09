<div class="">
    <div class="grid grid-cols-2 mb-3 gap-4">
        <div class="text-sm font-medium text-gray-700">
            <span>{{ __('Goods') }}</span>
        </div>
        <div class="text-sm font-medium text-gray-700">
            <span>{{ __('Quantity') }}</span>
        </div>
    </div>
    <div
        x-data="{
            data: @js($goodsOptions),
            options: [],
            errors: @entangle('validationErrors').defer,
            search: '',
            rows: [],
            init() {
                console.log('-- initialized')
                this.options = [...this.data]
                this.$watch('search', ((value) => {
                    this.options = this.data.filter(item => {
                        return (
                            item?.name?.toLowerCase().includes(value.toLocaleString()) ||
                            item?.code?.toLowerCase().includes(value.toLocaleString())
                        )
                    })
                }));
                this.$watch('rows', (() => {
                    const values = this.rows.map(item => {
                        return {
                            goodsId: item?.value?.id ?? null,
                            quantity: item?.quantity ?? null,
                        }
                    });
                    @this.set('goodsItems', values, true);
                }));
                if (this.rows?.length <= 0) {
                    this.addRow();
                }
            },
            notSelected() {
                const options = [...this.data];
                const selected = this.rows?.map(item => item?.value?.id) ?? [];
                return options.filter(item => !selected.includes(item?.id));
            },
            toggleSelect(index) {
                this.rows[index].isSelect = !this.rows[index].isSelect;
                // if (this.rows[index].isSelect) {
                //    this.options = this.notSelected();
                //    if (this.rows[index]?.value) {
                //        this.options.push(this.rows[index]?.value);
                //    }
                // }
            },
            closeSelect(index) {
                if (this.rows[index]) {
                    this.rows[index].isSelect = false;
                }
            },
            openSelect(index) {
               this.rows[index].isSelect = true;
            },
            addRow(value = {}, quantity = null) {
                this.rows.push({ isSelect: false, value: value, quantity: quantity });
            },
            deleteRow(index) {
                this.rows.splice(index, 1);
            }
        }"
        x-init="init()"
    >
        <template x-for="(row, rowIndex) in rows" :key="'row-' + rowIndex">
            <div class="grid grid-cols-2 gap-4">
                <div class="mb-3">
                    <div class="rounded-md shadow-sm text-sm">
                        <div
                            class="relative py-2 px-3 rounded-md border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            @click="toggleSelect(rowIndex)"
                            @click.away="closeSelect(rowIndex)"
                        >
                            <p x-show="!row?.value?.name" class="text-slate-500">Select</p>
                            <p x-show="row?.value?.name" x-text="row?.value?.name" class="text-slate-500"></p>
                            <div
                                x-show="row.isSelect"
                                class="absolute top-10 bg-white left-0 right-0 z-10 p-3 shadow border rounded-md"
                            >
                                <input
                                    type="search"
                                    x-model="search"
                                    x-ref="search"
                                    x-on:click.prevent.stop="openSelect(rowIndex)"
                                    class="py-2 px-3 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder=""
                                />
                                <div class="mt-2 h-40 overflow-y-scroll">
                                    <template x-for="opt in options" :key="'opt-' + opt.id">
                                        <div>
                                            <template x-if="opt?.id">
                                                <div
                                                    class="cursor-pointer py-2 px-2 hover:bg-slate-200 rounded-md"
                                                    x-text="opt.code + ' ' + opt.name"
                                                    @click="row.value = opt"
                                                ></div>
                                            </template>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span
                        class="text-sm text-red-500"
                        x-text="errors['goodsItems.' + rowIndex + '.goodsId']"
                    ></span>
                </div>
                <div class="mb-3">
                    <div class="flex items-center">
                        <div class="flex rounded-md shadow-sm flex-grow">
                            <input
                                x-model="row.quantity"
                                type="number"
                                class="block w-full flex-1 rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                placeholder="{{ __('Quantity') }}"
                            >
                        </div>
                        <div class="ml-4 w-32">
                            <button
                                @click="deleteRow(rowIndex)"
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
                    <span
                        class="text-sm text-red-500"
                        x-text="errors['goodsItems.' + rowIndex + '.quantity']"
                    ></span>
                </div>
            </div>
        </template>
        <div class="">
            <button
                @click.prevent="addRow()"
                type="button"
                class="flex items-center bg-slate-900 text-slate-300 hover:bg-slate-800 text-white focus:outline-none font-sm rounded-md text-sm px-3 py-2 text-center items-center"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span class="ml-2">{{  __('Add Item') }}</span>
            </button>
        </div>
    </div>
</div>
