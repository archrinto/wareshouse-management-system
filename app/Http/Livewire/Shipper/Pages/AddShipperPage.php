<?php

namespace App\Http\Livewire\Shipper\Pages;

use App\Models\Shipper;
use Livewire\Component;

class AddShipperPage extends Component
{
    public string $name = '';
    public string $cp_phone = '';

    protected $rules = [
        'name' => 'required|max:60',
        'cp_phone' => 'max:15|min:9',
    ];

    public function submit() {
        $this->validate();

        Shipper::create([
            'name' => $this->name,
            'cp_phone' => $this->cp_phone,
        ]);

        return redirect()->to(route('shipper.index'));
    }

    public function render()
    {
        return view('livewire.shipper.pages.add-shipper-page');
    }
}
