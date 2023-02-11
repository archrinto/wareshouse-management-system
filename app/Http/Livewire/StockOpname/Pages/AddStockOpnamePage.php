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
    public $categoryId;
    public $stockOpnameAt = '';
    public $goodsItems = [];
    public $description = '';

    public $categoryOptions = [];
    public $goodsOptions = [];
    public $typeOptions = [];

    protected $rules = [
        'categoryId' => 'required',
        'stockOpnameAt' => 'required',
        'description' => 'max:200',
        'goodsItems.*.goodsId' => 'required',
        'goodsItems.*.quantity' => 'required|numeric|min:1'
    ];

    public function mount() {
        $this->loadGoodsOptions();
        $this->loadCategoryOptions();
        $this->addItem();
    }

    public function loadCategoryOptions() {
        $this->categoryOptions = GoodsTransactionCategory::stockOpname()
            ->pluck('name', 'id')
            ->toArray();
    }

    public function loadGoodsOptions() {
        $this->goodsOptions = Goods::all()
            ->pluck('code_name', 'id')
            ->toArray();
    }

    public function addItem() {
        $this->goodsItems[] = [
            "goodsId" => null,
            "quantity" => null,
        ];
    }

    public function deleteItem($index) {
        unset($this->goodsItems[$index]);
    }

    public function submit() {
        $this->validate();

        $transaction = GoodsTransaction::create([
            'category_id' => $this->categoryId,
            'transaction_at' => strtotime($this->stockOpnameAt),
            'description' => $this->description,
            'created_by' => Auth::id()
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

            return redirect()->to(route('stock-opname.detail', $transaction->id));
        }
    }

    public function render()
    {
        return view('livewire.stock-opname.pages.add-stock-opname-page');
    }
}
