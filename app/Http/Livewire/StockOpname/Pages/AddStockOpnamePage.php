<?php

namespace App\Http\Livewire\StockOpname\Pages;

use App\Events\GoodsTransactionCreated;
use App\Models\Dispatching;
use App\Models\DispathcingGoods;
use App\Models\Goods;
use App\Models\GoodsTransaction;
use App\Models\GoodsTransactionCategory;
use App\Models\GoodsTransactionGoods;
use App\Models\Shipper;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddStockOpnamePage extends Component
{   
    public $type;
    public $categoryId;
    public $stockOpnameAt = '';
    public $goodsItems = [];
    public $description = '';

    public $categoryOptions = [];
    public $goodsOptions = [];
    public $typeOptions = [];

    public function mount() {
        $this->loadGoodsOptions();
        $this->loadCategoryOptions();
        $this->loadTypeOptions();
        $this->addItem();
    }

    public function loadCategoryOptions() {
        $this->categoryOptions = GoodsTransactionCategory::stockOpname()->pluck('name', 'id');
    }

    public function loadGoodsOptions() {
        $this->goodsOptions = Goods::get()->pluck('code_name', 'id');
    }

    public function loadTypeOptions() {
        $this->type = GoodsTransaction::$diffenceType;
        $this->typeOptions = [
            [ 'value' => GoodsTransaction::$diffenceType, 'text' => __('Stock Difference')],
            [ 'value' => GoodsTransaction::$totalType, 'text' => __('Stock Total')]
        ];
    }

    public function addItem() {
        array_push($this->goodsItems, [
            "goodsId" => null,
            "quantity" => null,
        ]);
    }

    public function deleteItem($index) {
        unset($this->goodsItems[$index]);
    }

    public function submit() {
        $transaction = GoodsTransaction::create([
            'type' => $this->type,
            'category_id' => $this->categoryId,
            'transaction_at' => strtotime($this->stockOpnameAt),
            'description' => $this->description,
        ]);

        if ($transaction) {
            foreach($this->goodsItems as $item) {
                GoodsTransactionGoods::create([
                    'transaction_id' => $transaction->id,
                    'goods_id' => $item['goodsId'],
                    'quantity' => $item['quantity'],
                ]);
            }

            event(new GoodsTransactionCreated($transaction));

            return redirect()->to(route('dispatching.index'));
        }
    }

    public function render()
    {
        return view('livewire.stock-opname.pages.add-stock-opname-page');
    }
}
