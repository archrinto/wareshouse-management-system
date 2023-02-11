<div class="flex items-center gap-3">
    <a
        href="#"
        wire:click.prevent="actionView('{{ $row->id }}')"
        class="text-slate-800 hover:text-slate-700"
    >
        {{ __('Detail') }}
    </a>
    @can('goods_transaction.update')
        <a
            href="#"
            wire:click.prevent="actionEdit('{{ $row->id }}')"
            class="text-slate-800 hover:text-slate-700"
        >
            {{ __('Edit') }}
        </a>
    @endcan

    @can('goods_transaction.delete')
        <a
            href="#"
            wire:click.prevent="actionDelete('{{ $row->id }}')"
            class="text-slate-800 hover:text-slate-700"
        >
            {{ __('Delete') }}
        </a>
    @endcan
</div>
