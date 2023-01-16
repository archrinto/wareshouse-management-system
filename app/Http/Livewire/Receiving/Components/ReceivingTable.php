<?php

namespace App\Http\Livewire\Receiving\Components;

use App\Models\GoodsTransaction;
use App\Models\GoodsTransactionGoods;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ReceivingTable extends DataTableComponent
{
    protected $model = GoodsTransaction::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setColumnSelectStatus(false);
        $this->setConfigurableAreas([
            'toolbar-left-start' => [
                'livewire.livewire-datatable.add-action-button', 
                [
                    'route' => route('receiving.add')
                ],
            ],
        ]);
    }

    public function builder(): Builder
    {
        return GoodsTransaction::with('items')
            ->receiving()
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
            Column::make('Supplier', 'category.name')
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
        return redirect()->to(route('receiving.detail', $id));
    }
}