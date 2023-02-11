<?php

namespace App\Http\Livewire\Supplier\Components;

use App\Models\Goods;
use App\Models\GoodsCategory;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
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
        if (Auth::user()->hasPermissionTo('supplier.create')) {
            $this->setConfigurableAreas([
                'toolbar-left-start' => [
                    'livewire.livewire-datatable.add-action-button',
                    [
                        'route' => route('supplier.add')
                    ],
                ],
            ]);
        }
    }

    public function columns(): array
    {
        return [
            Column::make(__('Name'), 'name')
                ->searchable(),
            Column::make(__('Contact Person'), 'cp_name')
                ->sortable(),
            Column::make(__('Contact Phone'), 'cp_phone')
                ->sortable(),
            Column::make(__('Created at'), 'created_at')
                ->format(fn($value) => format_date($value))
                ->sortable(),
            Column::make(__('Actions'), 'id')
                ->view('livewire.supplier.components.supplier-action-menu'),
        ];
    }

    public function actionDelete($id) {
        Supplier::where('id', $id)->delete();
    }
}
