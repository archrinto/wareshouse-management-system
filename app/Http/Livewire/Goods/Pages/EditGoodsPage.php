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
    public $categoryId;
    public $unitId;
    public $description;
    public $stockLimit;
    public $price;

    public $goodsId;

    public $goods;
    public $categories;
    public $units;

    public function mount($id) {
        $this->goodsId = $id;
        $this->loadGoods();
        // $this->loadCategories();
        $this->loadUnits();
    }

    public function loadGoods() {
        $this->goods = Goods::find($this->goodsId)->first();

        if ($this->goods) {
            $this->unitId = $this->goods->unit_id;
            $this->categoryId = $this->goods->category_id;
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
        $this->categories = GoodsCategory::all(['id', 'name']);
    }

    public function loadUnits() {
        $this->units = Unit::all(['id', 'name', 'symbol']);
    }

    public function submit() {
        $this->goods->update([
            'name' => $this->name,
            'code' => $this->code,
            'category_id' => $this->categoryId,
            'minimum_stock' => $this->stockLimit,
            'price' => $this->price,
            'unit_id' => $this->unitId,
            'description' => $this->description,
        ]);
        return redirect()->to(route('goods.index'));
    }

    public function render()
    {
        return view('livewire.goods.pages.edit-goods-page');
    }
}
