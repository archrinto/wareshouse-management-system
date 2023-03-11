<?php

namespace App\Http\Livewire\StockOpname\Components;

use App\Models\Dispatching;
use App\Models\Goods;
use App\Models\GoodsTransaction;
use App\Models\GoodsTransactionGoods;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class StockOpnameTable extends DataTableComponent
{
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setColumnSelectStatus(false);
        $this->setSearchDebounce(500);
        $this->setDefaultSort('transaction_at', 'desc');
        if (Auth::user()->hasPermissionTo('goods-transaction.create')) {
            $this->setConfigurableAreas([
                'toolbar-left-start' => [
                    'livewire.livewire-datatable.add-action-button',
                    [
                        'route' => route('stock-opname.add')
                    ],
                ],
            ]);
        }
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
            Column::make(__('Stock Opname At'), 'transaction_at')
                ->searchable()
                ->sortable()
                ->format(
                    fn($value, $row, Column $column) => format_date($value)
                ),
            Column::make(__('Category'), 'category.name')
                ->searchable()
                ->sortable(),
            Column::make(__('Items'))
                ->label(function ($row) {
                    return $row->items_count;
                }),
            Column::make(__('Created By'), 'creator.name')
                ->searchable()
                ->format(fn($value, $row) => $value ?? 'n/a'),
            Column::make(__('Created At'), 'created_at')
                ->format(fn($value) => format_date($value))
                ->sortable(),
            Column::make(__('Actions'), 'id')
                ->view('livewire.stock-opname.components.stock-opname-action-menu')
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
        return redirect()->to(route('stock-opname.detail', $id));
    }
}
