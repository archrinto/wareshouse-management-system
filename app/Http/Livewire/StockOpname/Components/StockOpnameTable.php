<?php

namespace App\Http\Livewire\StockOpname\Components;

use App\Models\Dispatching;
use App\Models\Goods;
use App\Models\GoodsTransaction;
use App\Models\GoodsTransactionGoods;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class StockOpnameTable extends DataTableComponent
{
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setColumnSelectStatus(false);
        $this->setConfigurableAreas([
            'toolbar-left-start' => [
                'livewire.livewire-datatable.add-action-button', 
                [
                    'route' => route('stock-opname.add')
                ],
            ],
        ]);
    }

    public function builder(): Builder
    {
        return GoodsTransaction::with(['items'])
            ->stockOpname()
            ->withCount('items');
    }

    public function columns(): array
    {
        return [
            Column::make('Stock Opname At', 'transaction_at')
                ->sortable()
                ->format(
                    fn($value, $row, Column $column) => date('l d F Y', $value)
                ),
            Column::make('Category', 'category.name')
                ->sortable(),
            Column::make('Items')
                ->label(function ($row) {
                    return $row->items_count;
                }),
            Column::make('Created By', 'created_by')
                ->sortable(),
            Column::make('Created At', 'created_at')
                ->sortable(),
            Column::make(__('Actions'), 'id')
                ->view('livewire.components.datatable-row-actions')
        ];
    }

    public function actionDelete($id) {
        GoodsTransaction::where('id', $id)->delete();
        GoodsTransactionGoods::where('transaction_id', $id)->delete();

        $this->emit('refreshDatatable');
    }

    public function actionEdit($id) {
        // redirect()->to('receiving.good')
    }

    public function actionView($id) {
        return redirect()->to(route('dispatching.detail', $id));
    }
}