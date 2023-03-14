<div class="flex items-center gap-3">
    <a
        href="#"
        wire:click.prevent="actionEdit('{{ $row->id }}')"
        class="text-slate-800 hover:text-slate-700"
    >
        {{ __('Edit') }}
    </a>
    <a
        href="#"
        wire:click.prevent="actionDelete('{{ $row->id }}')"
        class="text-slate-800 hover:text-slate-700"
    >
        {{ __('Delete') }}
    </a>
</div>
