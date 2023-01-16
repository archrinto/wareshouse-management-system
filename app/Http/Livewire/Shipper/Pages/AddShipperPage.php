<?php

namespace App\Http\Livewire\Shipper\Pages;

use App\Models\Shipper;
use Livewire\Component;

class AddShipperPage extends Component
{
    public string $name;
    public string $cp_phone;
    
    public function submit() {
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
