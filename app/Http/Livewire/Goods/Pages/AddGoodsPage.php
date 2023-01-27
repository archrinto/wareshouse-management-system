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
    public $categoryId;
    public $stockLimit;
    public $unitId;
    public $description;
    public $price;

    public $categories;
    public $units;

    public function mount() {
        $this->loadUnits();
    }

    public function loadUnits() {
        $this->units = Unit::all(['id', 'name', 'symbol']);
    }

    public function submit() {
        Goods::create([
            'name' => $this->name,
            'code' => $this->code,
            'minimum_stock' => $this->stockLimit,
            'price' => $this->price,
            'unit_id' => $this->unitId,
            'description' => $this->description,
        ]);
        return redirect()->to(route('goods.index'));
    }

    public function render()
    {
        return view('livewire.goods.pages.add-goods-page');
    }
}
