<?php

namespace App\Http\Livewire\Supplier\Pages;

use App\Models\Supplier;
use Livewire\Component;

class EditSupplierPage extends Component
{
    public string $name;
    public string $address;
    public string $cp_phone;
    public string $cp_name;

    public $supplier;
    public $supplierId;

    public function mount($id) {
        $this->supplierId = $id;
        $this->loadSupplier();
    }

    public function loadSupplier() {
        $this->supplier = Supplier::find($this->supplierId)->first();
        if ($this->supplier) {
            $this->name = $this->supplier->name;
            $this->address = $this->supplier->address;
            $this->cp_name = $this->supplier->cp_name;
            $this->cp_phone = $this->supplier->cp_phone;

            return;
        }
        return redirect()->to(route('shipper.index'));
    } 
    
    public function submit() {
        $this->supplier->update([
            'name' => $this->name,
            'address' => $this->address,
            'cp_phone' => $this->cp_phone,
            'cp_name' => $this->cp_name,
        ]);

        return redirect()->to(route('supplier.index'));
    }

    public function render()
    {
        return view('livewire.supplier.pages.edit-supplier-page');
    }
}
