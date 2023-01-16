<?php

namespace App\Http\Livewire\Supplier\Pages;

use App\Models\Supplier;
use Livewire\Component;

class AddSupplierPage extends Component
{
    public string $name;
    public string $address;
    public string $cp_phone;
    public string $cp_name;
    
    public function submit() {
        Supplier::create([
            'name' => $this->name,
            'address' => $this->address,
            'cp_phone' => $this->cp_phone,
            'cp_name' => $this->cp_name,
        ]);

        return redirect()->to(route('supplier.index'));
    }

    public function render()
    {
        return view('livewire.supplier.pages.add-supplier-page');
    }
}
