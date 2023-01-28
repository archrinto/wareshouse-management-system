<?php

namespace App\Http\Livewire\GoodsCategory\Pages;

use App\Models\GoodsCategory;
use Livewire\Component;

class AddCategoryPage extends Component
{
    public $name;
    public $description;

    public function render()
    {
        return view('livewire.goods-category.pages.add-category-page');
    }

    public function submit() {
        GoodsCategory::create([
            'name' => $this->name,
            'description' => $this->description
        ]);

        return redirect()->to(route('goods.category.index'));
    }
}
