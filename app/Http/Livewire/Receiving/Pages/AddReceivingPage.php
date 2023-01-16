<?php

namespace App\Http\Livewire\Receiving\Pages;

use App\Events\GoodsTransactionCreated;
use App\Models\Goods;
use App\Models\GoodsTransaction;
use App\Models\GoodsTransactionCategory;
use App\Models\GoodsTransactionGoods;
use App\Models\Receiving;
use App\Models\ReceivingGoods;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddReceivingPage extends Component
{
    public $supplierId;
    public $receiveAt = '';
    public $goodsItems = [];
    public $description = '';

    public $supplierOptions;
    public $goodsOptions;

    public function mount() {
        $this->loadGoodsOptions();
        $this->loadSuppliersOptions();
        $this->addItem();
    }

    public function loadSuppliersOptions() {
        $this->supplierOptions = Supplier::pluck('name', 'id');
    }

    public function loadGoodsOptions() {
        $this->goodsOptions = Goods::get()->pluck('code_name', 'id');
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
        $categoryId = GoodsTransactionCategory::receiving()->pluck('id')->first();
        $transaction = GoodsTransaction::create([
            'type' => GoodsTransaction::$diffenceType,
            'category_id' => $categoryId,
            'supplier_id' => $this->supplierId,
            'transaction_at' => strtotime($this->receiveAt),
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

            return redirect()->to(route('receiving.index'));
        }
    }

    public function render()
    {
        return view('livewire.receiving.pages.add-receiving-page');
    }
}
