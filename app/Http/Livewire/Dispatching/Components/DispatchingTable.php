<?php

namespace App\Http\Livewire\Dispatching\Components;

use App\Models\Dispatching;
use App\Models\Goods;
use App\Models\GoodsTransaction;
use App\Models\GoodsTransactionGoods;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class DispatchingTable extends DataTableComponent
{
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setColumnSelectStatus(false);
        $this->setDefaultSort('transaction_at', 'desc');
        if (Auth::user()->hasPermissionTo('goods_transaction.create')) {
            $this->setConfigurableAreas([
                'toolbar-left-start' => [
                    'livewire.livewire-datatable.add-action-button',
                    [
                        'route' => route('dispatching.add')
                    ],
                ],
            ]);
        }
    }

    public function builder(): Builder
    {
        return GoodsTransaction::with(['items', 'creator'])
            ->dispatching()
            ->withCount('items');
    }

    public function columns(): array
    {
        return [
            Column::make('Receive At', 'transaction_at')
                ->sortable()
                ->format(
                    fn($value, $row, Column $column) => date('l d F Y', $value)
                ),
            Column::make('Shipper', 'shipper.name')
                ->sortable(),
            Column::make('Items')
                ->label(function ($row) {
                    return $row->items_count;
                }),
            Column::make('Created By', 'created_by')
                ->format(fn($value, $row) => $row->creator->name ?? 'n/a'),
            Column::make('Created At', 'created_at')
                ->sortable(),
            Column::make(__('Actions'), 'id')
                ->view('livewire.dispatching.components.dispatching-action-menu')
        ];
    }

    public function actionDelete($id) {
        GoodsTransaction::where('id', $id)->delete();
        GoodsTransactionGoods::where('transaction_id', $id)->delete();
    }

    public function actionEdit($id) {
        // redirect()->to('receiving.good')
    }

    public function actionView($id) {
        return redirect()->to(route('dispatching.detail', $id));
    }
}
