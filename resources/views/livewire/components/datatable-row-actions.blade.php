<div class="flex items-center gap-3">
    <a 
        href="#"
        wire:click.prevent="actionView('{{ $row->id }}')"
        class="text-slate-800 hover:text-slate-700"
    >
        Detail
    </a>
    <a 
        href="#"
        wire:click.prevent="actionEdit('{{ $row->id }}')"
        class="text-slate-800 hover:text-slate-700"
    >
        Edit
    </a>
    <a 
        href="#"
        wire:click.prevent="actionDelete('{{ $row->id }}')"
        class="text-slate-800 hover:text-slate-700"
    >
        Delete
    </a>
</div>