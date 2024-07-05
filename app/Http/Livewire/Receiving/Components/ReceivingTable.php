<?php

namespace App\Http\Livewire\Receiving\Components;

use App\Models\GoodsTransaction;
use App\Models\GoodsTransactionGoods;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ReceivingTable extends DataTableComponent
{
    protected $model = GoodsTransaction::class;
    protected $actions = ['view', 'update', 'delete'];
    protected $listeners = [
        'deleteConfirmed'
    ];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setColumnSelectStatus(false);
        $this->setDefaultSort('transaction_at', 'desc');
        if (Auth::user()->hasPermissionTo('goods-transaction.create')) {
            $this->setConfigurableAreas([
                'toolbar-left-start' => [
                    'livewire.livewire-datatable.add-action-button',
                    [
                        'route' => route('receiving.add')
                    ],
                ],
            ]);
        }
    }

    public function builder(): Builder
    {
        return GoodsTransaction::with(['creator', 'supplier'])
            ->receiving()
            ->withCount('items');
    }

    public function columns(): array
    {
        return [
            Column::make(__('Receive At'), 'transaction_at')
                ->searchable()
                ->sortable()
                ->format(
                    fn($value, $row, Column $column) => format_date($value)
                ),
            Column::make(__('Supplier'), 'supplier.name')
                ->sortable()
                ->searchable(),
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
                ->view('livewire.receiving.components.receiving-action-menu')
        ];
    }

    public function actionEdit($id) {
        // redirect()->to('receiving.good')
    }

    public function actionView($id) {
        return redirect()->to(route('receiving.detail', $id));
    }

    public function actionDelete($id) {
        $this->emitTo('components.delete-confirm-modal', 'deleteConfirmation', 'receiving.components.receiving-table', $id);
    }

    public function deleteConfirmed($id) {
        if ($id) {
            GoodsTransaction::where('id', $id)->delete();
            GoodsTransactionGoods::where('transaction_id', $id)->delete();
        }
    }
}
