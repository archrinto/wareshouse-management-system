<?php

namespace App\Http\Livewire\TransactionCategory\Components;

use App\Models\GoodsTransactionCategory;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class GoodsTransactionCategoryTable extends DataTableComponent
{
    // protected $model = GoodsCategory::class;

    public function builder(): Builder
    {
        return GoodsTransactionCategory::stockOpname();
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setColumnSelectStatus(false);
        $this->setConfigurableAreas([
            'toolbar-left-start' => [
                'livewire.livewire-datatable.add-action-button', 
                [
                    'route' => route('transaction-category.add')
                ],
            ],
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make('Name')
                ->sortable(),
            Column::make('Description'),
            Column::make('Actions', 'id')
                ->view('livewire.components.datatable-row-actions'),
        ];
    }
}