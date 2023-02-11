<div class="flex items-center gap-3">
    @can('goods-transaction-category.update')
        <a
            href="{{ route('transaction-category.edit', $row->id) }}"
            class="text-slate-800 hover:text-slate-700"
        >
            {{ __('Edit') }}
        </a>
    @endcan

    @can('goods-transaction-category.delete')
        <a
            href="#"
            wire:click.prevent="actionDelete('{{ $row->id }}')"
            class="text-slate-800 hover:text-slate-700"
        >
            {{ __('Delete') }}
        </a>
    @endcan
</div>
