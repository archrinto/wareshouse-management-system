<?php

namespace App\Http\Livewire\GoodsCategory\Pages;

use App\Models\GoodsCategory;
use Livewire\Component;

class AddCategoryPage extends Component
{
    public $name;
    public $description;

    protected $rules = [
        'name' => 'required|max:60',
        'description' => 'max:200',
    ];

    public function render()
    {
        return view('livewire.goods-category.pages.add-category-page');
    }

    public function submit() {
        $this->validate();

        GoodsCategory::create([
            'name' => $this->name,
            'description' => $this->description
        ]);

        return redirect()->to(route('goods-category.index'));
    }
}
