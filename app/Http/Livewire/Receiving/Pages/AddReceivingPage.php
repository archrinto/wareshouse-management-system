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
    public $validationErrors;

    protected $rules = [
        'supplierId' => 'required',
        'receiveAt' => 'required',
        'description' => 'max:200',
        'goodsItems.*.goodsId' => 'required',
        'goodsItems.*.quantity' => 'required|numeric|min:1'
    ];

    public function mount() {
        $this->loadGoodsOptions();
        $this->loadSuppliersOptions();
        $this->addItem();
    }

    public function loadSuppliersOptions() {
        $this->supplierOptions = Supplier::pluck('name', 'id')->toArray();
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
        $categoryId = GoodsTransactionCategory::receiving()->pluck('id')->first();
        $transaction = GoodsTransaction::create([
            'category_id' => $categoryId,
            'supplier_id' => $this->supplierId,
            'transaction_at' => strtotime($this->receiveAt),
            'description' => $this->description
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

            $this->dispatchBrowserEvent('toast',[
                'type' => 'success',
                'message' => __('Receiving added')
            ]);

            return redirect()->to(route('receiving.detail', $transaction->id));
        }
    }

    protected function getValidationAttributes()
    {
        return [
            'supplierId' => __('supplier'),
            'receiveAt' => __('receive At'),
            'description' => __('description'),
            'goodsItems.*.goodsId' => __('goods'),
            'goodsItems.*.quantity' => __('quantity'),
        ];
    }

    public function render()
    {
        return view('livewire.receiving.pages.add-receiving-page');
    }
}
