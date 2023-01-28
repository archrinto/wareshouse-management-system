<div class="flex items-center gap-3">
    <a
        href="{{ route('goods.detail',  $row->id) }}"
        class="text-slate-800 hover:text-slate-700"
    >
        {{ __('Detail') }}
    </a>
    @can('goods.update')
        <a
            href="{{ route('goods.edit',  $row->id) }}"
            class="text-slate-800 hover:text-slate-700"
        >
            {{ __('Edit') }}
        </a>
    @endcan

    @can('goods.delete')
        <a
            href="#"
            wire:click.prevent="actionDelete('{{ $row->id }}')"
            class="text-slate-800 hover:text-slate-700"
        >
            {{ __('Delete') }}
        </a>
    @endcan
</div>
