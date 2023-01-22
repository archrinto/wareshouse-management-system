<?php

namespace App\Http\Livewire\Dashboard\Pages;

use App\Models\Goods;
use Livewire\Component;

class IndexPage extends Component
{
    public $countOutOfStock;
    public $countAvailableStock;
    public $countLowStock;
    public function mount() {
        $this->countAvailableStock = Goods::availableStock()->count();
        $this->countOutOfStock = Goods::outOfStock()->count();
        $this->countLowStock = Goods::lowStock()->count();
    }

    public function render()
    {
        return view('livewire.dashboard.pages.index-page');
    }
}
