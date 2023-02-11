<?php

namespace App\Http\Livewire\Goods\Components;

use App\Models\Goods;
use App\Models\GoodsTransactionGoods;
use App\Services\PrintService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;
use Termwind\Components\Raw;

class GoodsTransactionHistoryTable extends DataTableComponent
{
    public $goodsId;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setColumnSelectStatus(false);
        $this->setDefaultSort('wms_goods_transaction.transaction_at', 'desc');
    }

    public function builder(): Builder
    {
        return GoodsTransactionGoods::query()
            ->where('goods_id', $this->goodsId);
    }

    public function showBulkActionsDropdown(): bool
    {
        return false;
    }

    public function columns(): array
    {
        return [
           Column::make(__('Transaction At'), 'transaction.transaction_at')
               ->format(
                   fn($value, $row, $column) => format_date($value)
               )
               ->sortable(),
           Column::make(__('Transaction Category'), 'transaction.category.name')
                ->sortable(),
           Column::make(__('Quantity'), 'quantity')
                ->sortable(),
        ];
    }
}
