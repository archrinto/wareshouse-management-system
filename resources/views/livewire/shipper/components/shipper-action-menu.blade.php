<div class="flex items-center gap-3">
    @can('shipper.update')
        <a
            href="{{ route('shipper.edit', $row->id) }}"
            class="text-slate-800 hover:text-slate-700"
        >
            {{ __('Edit') }}
        </a>
    @endcan

    @can('shipper.delete')
        <a
            href="#"
            wire:click.prevent="actionDelete('{{ $row->id }}')"
            class="text-slate-800 hover:text-slate-700"
        >
            {{ __('Delete') }}
        </a>
    @endcan
</div>
