<?php

namespace App\Http\Livewire\Supplier\Components;

use App\Models\Goods;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class SupplierTable extends DataTableComponent
{
    protected $model = Supplier::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setColumnSelectStatus(false);
        $this->setConfigurableAreas([
            'toolbar-left-start' => [
                'livewire.livewire-datatable.add-action-button', 
                [
                    'route' => route('supplier.add')
                ],
            ],
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make('Name')
                ->sortable()
                ->searchable(),
            Column::make('Contact Person', 'cp_name')
                ->sortable(),
            Column::make('Contact Phone', 'cp_phone')
                ->sortable(),
            Column::make('Created at', 'created_at')
                ->sortable(),
            Column::make('Actions', 'id')
                ->view('livewire.supplier.components.supplier-action-menu'),
        ];
    }
}