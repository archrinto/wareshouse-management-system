<div class="flex items-center gap-3">
    <a
        href="{{ route('stock-opname.detail', $row->id ) }}"
        class="text-slate-800 hover:text-slate-700"
    >
        {{ __('Detail') }}
    </a>

    @can('goods-transaction.delete')
        <a
            href="#"
            wire:click.prevent="actionDelete('{{ $row->id }}')"
            class="text-slate-800 hover:text-slate-700"
        >
            {{ __('Delete') }}
        </a>
    @endcan
</div>
