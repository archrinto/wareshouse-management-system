<?php

namespace App\Http\Livewire\Goods\Pages;

use App\Models\Goods;
use App\Models\GoodsCategory;
use App\Models\Unit;
use Livewire\Component;

class EditGoodsPage extends Component
{
    public $name;
    public $code;
    public $categoryIds;
    public $unitId;
    public $description;
    public $stockLimit;
    public $price;

    public $goodsId;

    public $goods;
    public $categoryOptions;
    public $units;

    protected $rules = [
        'name' => 'required|max:80',
        'code' => 'required|max:25',
        'description' => 'max:200',
        'stockLimit' => 'numeric|min:0',
        'unitId' => 'required',
        'price' => 'numeric|min:0'
    ];

    public function mount($id) {
        $this->goodsId = $id;
        $this->loadGoods();
        $this->loadCategories();
        $this->loadUnits();
    }

    public function loadGoods() {
        $this->goods = Goods::where('id', $this->goodsId)->first();

        if ($this->goods) {
            $this->unitId = $this->goods->unit_id;
            $this->categoryIds = $this->goods->categories->pluck('id');
            $this->description = $this->goods->description;
            $this->name = $this->goods->name;
            $this->price = $this->goods->price;
            $this->stockLimit = $this->goods->minimum_stock;
            $this->code = $this->goods->code;

            return;
        }
        return redirect()->to('goods.index');
    }

    public function loadCategories() {
        $this->categoryOptions = GoodsCategory::all()->pluck('name', 'id')->toArray();
    }

    public function loadUnits() {
        $this->units = Unit::all(['id', 'name', 'symbol']);
    }

    public function submit() {
        $this->validate();

        $this->goods->update([
            'name' => $this->name,
            'code' => $this->code,
            'minimum_stock' => $this->stockLimit,
            'price' => $this->price,
            'unit_id' => $this->unitId,
            'description' => $this->description,
        ]);
        if ($this->goods) {
            $this->goods->categories()->sync($this->categoryIds);
        }

        return redirect()->to(route('goods.index'));
    }

    public function render()
    {
        return view('livewire.goods.pages.edit-goods-page');
    }
}
