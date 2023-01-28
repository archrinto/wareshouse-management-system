<?php

namespace App\Http\Livewire\Goods\Pages;

use App\Models\Goods;
use App\Models\GoodsCategory;
use App\Models\Unit;
use Livewire\Component;

class AddGoodsPage extends Component
{
    public $name;
    public $code;
    public $categoryIds;
    public $stockLimit;
    public $unitId;
    public $description;
    public $price;

    public $categoryOptions;
    public $unitOptions;

    public function mount() {
        $this->loadUnitOptions();
        $this->loadCategoryOptions();
    }

    public function loadUnitOptions() {
        $this->unitOptions = Unit::all(['id', 'name', 'symbol']);
    }

    public function loadCategoryOptions() {
        $this->categoryOptions = GoodsCategory::all()->pluck('name', 'id');
    }

    public function submit() {
        $goods = Goods::create([
            'name' => $this->name,
            'code' => $this->code,
            'minimum_stock' => $this->stockLimit,
            'price' => $this->price,
            'unit_id' => $this->unitId,
            'description' => $this->description,
        ]);
        if ($goods) {
            $goods->categories()->attach($this->categoryIds);
        }
        return redirect()->to(route('goods.index'));
    }

    public function render()
    {
        return view('livewire.goods.pages.add-goods-page');
    }
}
