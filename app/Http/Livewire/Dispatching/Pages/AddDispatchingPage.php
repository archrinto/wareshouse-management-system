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
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AddDispatchingPage extends Component
{
    public $shipperId;
    public $dispatchAt = '';
    public $goodsItems = [];
    public $description = '';

    public $shipperOptions;
    public $goodsOptions;
    public array $validationErrors = [];

    protected $rules = [
        'shipperId' => 'required',
        'dispatchAt' => 'required',
        'description' => 'max:200',
        'goodsItems.*.goodsId' => 'required',
        'goodsItems.*.quantity' => 'required|numeric|min:1'
    ];

    public function mount() {
        $this->loadGoodsOptions();
        $this->loadShipperOptions();
        $this->addItem();
    }

    public function loadShipperOptions() {
        $this->shipperOptions = Shipper::pluck('name', 'id')->toArray();
    }

    public function loadGoodsOptions() {
        $this->goodsOptions = Goods::all()
            ->pluck('code_name', 'id')
            ->toArray();
    }

    public function submit() {
        $this->validate();
        $categoryId = GoodsTransactionCategory::dispatching()->pluck('id')->first();
        $transaction = GoodsTransaction::create([
            'category_id' => $categoryId,
            'shipper_id' => $this->shipperId,
            'transaction_at' => strtotime($this->dispatchAt),
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

            return redirect()->to(route('dispatching.detail', $transaction->id));
        }
    }

    public function getValidationAttributes() {
        return [
            'shipperId' => __('shipper'),
            'goodsItems.*.goodsId' => __('goods'),
            'goodsItems.*.quantity' => __('quantity'),
            'description' => __('description')
        ];
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

    public function render()
    {
        $this->validationErrors = $this->getErrorBag()->toArray();
        return view('livewire.dispatching.pages.add-dispatching-page');
    }
}
