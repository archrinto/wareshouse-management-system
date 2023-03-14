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
use Illuminate\Validation\Validator;
use Livewire\Component;

class AddDispatchingPage extends Component
{
    public $shipperId;
    public $dispatchAt = '';
    public $goodsItems = [];
    public $goodsInfo = [];
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
        $goods = Goods::with('unit')->get();
        foreach ($goods as $item) {
            $this->goodsOptions[$item->id] = $item->codeName;
            $this->goodsInfo[$item->id] = [
                'stock' => $item->stock,
                'unit' => $item->unit->symbol
            ];
        }
    }

    public function submit() {
        $this->validate();
        $this->withValidator(function (Validator $validator) {
            $validator->after(function ($validator) {
                $this->validateStock($validator);
            });
        })->validate(['goodsItems.*.goodsId' => 'required']);

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


    public function validateStock($validator) {
        $goodsIds = array_column($this->goodsItems, 'goodsId');
        $goodsStocks = Goods::whereIn('id', $goodsIds)->pluck('stock', 'id')->toArray();

        foreach ($this->goodsItems as $key => $item) {
            if ($item['quantity'] > $goodsStocks[$item['goodsId']]) {
                $validator->errors()->add("goodsItems.$key.quantity", 'The quantity field can not more than stock.');
            }
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
