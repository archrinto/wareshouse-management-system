<?php

namespace App\Http\Livewire\Dispatching\Pages;

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

class AddDispatchingPage extends Component
{
    public $shipperId;
    public $dispatchAt = '';
    public $goodsItems = [];
    public $description = '';

    public $shipperOptions;
    public $goodsOptions;

    public function mount() {
        $this->loadGoodsOptions();
        $this->loadShipperOptions();
        $this->addItem();
    }

    public function loadShipperOptions() {
        $this->shipperOptions = Shipper::pluck('name', 'id');
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
        $categoryId = GoodsTransactionCategory::dispatching()->pluck('id')->first();
        $transaction = GoodsTransaction::create([
            'type' => GoodsTransaction::$diffenceType,
            'category_id' => $categoryId,
            'shipper_id' => $this->shipperId,
            'transaction_at' => strtotime($this->dispatchAt),
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
        return view('livewire.dispatching.pages.add-dispatching-page');
    }
}
