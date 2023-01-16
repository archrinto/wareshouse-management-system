<?php

namespace App\Http\Livewire\TransactionCategory\Pages;

use App\Models\GoodsTransactionCategory;
use Livewire\Component;

class AddTransactionCategory extends Component
{
    public $name;
    public $description;
    public $operation;

    public $operationOptions = [];

    public function mount() {
        $this->loadOpertaionOptions();
    }

    public function loadOpertaionOptions() {
        $this->operation = GoodsTransactionCategory::$additionOperation;
        $this->operationOptions = [
            ['value' => GoodsTransactionCategory::$additionOperation, 'text' => __('Addition')],
            ['value' => GoodsTransactionCategory::$subtractionOperation, 'text' => __('Subtraction')]
        ];
    }

    public function submit() {
        GoodsTransactionCategory::create([
            'name' => $this->name,
            'description' => $this->description,
            'operation' => $this->operation,
        ]);

        return redirect()->to(route('transaction-category.index'));
    }

    public function render()
    {
        return view('livewire.transaction-category.pages.add-transaction-category');
    }
}
