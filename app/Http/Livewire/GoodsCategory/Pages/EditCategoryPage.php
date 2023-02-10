<?php

namespace App\Http\Livewire\GoodsCategory\Pages;

use App\Models\GoodsCategory;
use Livewire\Component;

class EditCategoryPage extends Component
{
    public $categoryId;
    public $category;
    public $name;
    public $description;

    protected $rules = [
        'name' => 'required|max:60',
        'description' => 'max:200',
    ];

    public function mount($id) {
        $this->categoryId = $id;
        $this->loadCategory();
    }

    public function loadCategory() {
        $this->category = GoodsCategory::where('id', $this->categoryId);
        if (!$this->category) {
            return redirect()->to('goods-category.index');
        }

        $this->name = $this->category->name;
        $this->description = $this->category->description;
    }

    public function submit() {
        $this->validate();

        $this->category->update([
            'name' => $this->name,
            'description' => $this->description,
        ]);
        return redirect()->to(route('goods-category.index'));
    }

    public function render()
    {
        return view('livewire.goods-category.pages.edit-category-page');
    }
}
