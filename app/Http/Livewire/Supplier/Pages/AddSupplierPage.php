<?php

namespace App\Http\Livewire\Supplier\Pages;

use App\Models\Supplier;
use Livewire\Component;

class AddSupplierPage extends Component
{
    public string $name;
    public string|null $address = null;
    public string|null $cp_phone = null;
    public string|null $cp_name = null;

    protected $rules = [
        'name' => 'required|max:60',
        'address' => 'max:200',
        'cp_phone' => 'sometimes|nullable|max:15|min:9',
        'cp_name' => 'max:60'
    ];

    public function submit() {
        $this->validate();

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
