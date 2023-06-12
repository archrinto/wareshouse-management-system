<?php

namespace App\Http\Livewire\GoodsCategory\Components;

use App\Models\Goods;
use App\Models\GoodsCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class GoodsCategoryTable extends DataTableComponent
{
    // protected $model = GoodsCategory::class;
    protected $listeners = [
        'deleteConfirmed'
    ];

    public function builder(): Builder
    {
        return GoodsCategory::select('*');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setColumnSelectStatus(false);
        if (Auth::user()->hasPermissionTo('goods-category.create')) {
            $this->setConfigurableAreas([
                'toolbar-left-start' => [
                    'livewire.livewire-datatable.add-action-button',
                    [
                        'route' => route('goods-category.add')
                    ],
                ],
            ]);
        }
    }

    public function columns(): array
    {
        return [
            Column::make(__('Name'), 'name')
                ->sortable(),
            Column::make(__('Actions'), 'id')
                ->view('livewire.goods-category.components.category-action-menu'),
        ];
    }

    public function actionDelete($id)
    {
        $this->emitTo('components.delete-confirm-modal', 'deleteConfirmation', 'goods-category.components.goods-category-table', $id);
    }

    public function deleteConfirmed($id)
    {
        if ($id) {
            GoodsCategory::where('id', $id)->delete();
        }
    }
}
