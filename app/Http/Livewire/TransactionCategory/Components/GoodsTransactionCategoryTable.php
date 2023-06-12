<?php

namespace App\Http\Livewire\TransactionCategory\Components;

use App\Models\GoodsTransactionCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class GoodsTransactionCategoryTable extends DataTableComponent
{
    // protected $model = GoodsCategory::class;
    protected $listeners = [
        'deleteConfirmed'
    ];

    public function builder(): Builder
    {
        return GoodsTransactionCategory::stockOpname();
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setColumnSelectStatus(false);
        $this->setDefaultSort('created_at', 'desc');
        if (Auth::user()->hasPermissionTo('goods-transaction-category.create')) {
            $this->setConfigurableAreas([
                'toolbar-left-start' => [
                    'livewire.livewire-datatable.add-action-button',
                    [
                        'route' => route('transaction-category.add')
                    ],
                ],
            ]);
        }
    }

    public function columns(): array
    {
        return [
            Column::make(__('Name'), 'name')
                ->searchable()
                ->sortable(),
            Column::make(__('Operation'), 'operation'),
            Column::make(__('Description'), 'description'),
            Column::make(__('Actions'), 'id')
                ->view('livewire.transaction-category.components.transaction-category-action-menu'),
        ];
    }

    public function actionDelete($id) {
        $this->emitTo('components.delete-confirm-modal', 'deleteConfirmation', 'transaction-category.components.goods-transaction-category-table', $id);
    }

    public function deleteConfirmed($id) {
        if ($id) {
            GoodsTransactionCategory::where('id', $id)->delete();
        }
    }
}
