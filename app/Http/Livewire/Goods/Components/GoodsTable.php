<?php

namespace App\Http\Livewire\Goods\Components;

use App\Models\Goods;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class GoodsTable extends DataTableComponent
{
    protected $model = Goods::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setColumnSelectStatus(false);
        $this->setConfigurableAreas([
            'toolbar-left-start' => [
                'livewire.livewire-datatable.add-action-button', 
                [
                    'route' => route('goods.add')
                ],
            ],
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make('Code')
                ->sortable(),
            Column::make('Name')
                ->sortable(),
            Column::make('Stock')
                ->sortable(),
            Column::make('Stock Limit', 'minimum_stock')
                ->sortable(),
            Column::make('Unit', 'unit.symbol')
                ->sortable(),
            Column::make('Actions', 'id')
                ->view('livewire.goods.components.goods-action-menu'),
        ];
    }
}