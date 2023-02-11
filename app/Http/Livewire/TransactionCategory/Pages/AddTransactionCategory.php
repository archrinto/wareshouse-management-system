<?php

namespace App\Http\Livewire\TransactionCategory\Pages;

use App\Models\GoodsTransactionCategory;
use Livewire\Component;

class AddTransactionCategory extends Component
{
    public $name;
    public $description;
    public $operation;

    public $categoryId;
    public $transactionCategory;
    public $operationOptions = [];

    public function mount($id = null) {
        $this->loadOpertaionOptions();

        if ($id) {
            $this->categoryId = $id;
            $this->loadTransactionCategory();
        }
    }

    protected function rules() {
        if ($this->transactionCategory) {
            return [
                'name' => 'required|max:60|unique:wms_goods_transaction_category,name,' . $this->categoryId,
                'description' => 'max:200',
                'operation' => 'required'
            ];
        } else {
            return [
                'name' => 'required|max:60|unique:wms_goods_transaction_category,name',
                'description' => 'max:200',
                'operation' => 'required'
            ];
        }
    }

    public function loadTransactionCategory() {
        $this->transactionCategory = GoodsTransactionCategory::where('id', $this->categoryId)->first();
        if ($this->transactionCategory) {
            $this->name = $this->transactionCategory->name;
            $this->description = $this->transactionCategory->description;
            $this->operation = $this->transactionCategory->operation;
        }
    }

    public function loadOpertaionOptions() {
        $this->operation = GoodsTransactionCategory::$additionOperation;
        $this->operationOptions = [
            ['value' => GoodsTransactionCategory::$additionOperation, 'text' => __('Addition')],
            ['value' => GoodsTransactionCategory::$subtractionOperation, 'text' => __('Subtraction')],
            ['value' => GoodsTransactionCategory::$changeOperation, 'text' => __('Change')],
        ];
    }

    public function submit() {
        $this->validate();

        if ($this->transactionCategory) {
           $this->transactionCategory->update([
               'name' => $this->name,
               'description' => $this->description,
               'operation' => $this->operation,
           ]);
        } else {
            GoodsTransactionCategory::create([
                'name' => $this->name,
                'description' => $this->description,
                'operation' => $this->operation,
            ]);
        }

        return redirect()->to(route('transaction-category.index'));
    }

    public function render()
    {
        return view('livewire.transaction-category.pages.add-transaction-category');
    }
}
