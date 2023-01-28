<?php

namespace App\Http\Livewire\Goods\Pages;

use App\Models\Goods;
use Livewire\Component;

class DetailGoodsPage extends Component
{
    public $goodsId;
    public $goods;

    public function mount($id) {
        $this->goodsId = $id;
        $this->loadGoods();
    }

    public function loadGoods() {
        $this->goods = Goods::where('id', $this->goodsId)->first();
    }

    public function render()
    {
        return view('livewire.goods.pages.detail-goods-page');
    }
}
