<?php

namespace App\Http\Livewire\Shipper\Pages;

use App\Models\Shipper;
use Livewire\Component;

class EditShipperPage extends Component
{
    public string $name;
    public string $cp_phone;

    public $shipper;
    public $shipperId;

    protected $rules = [
        'name' => 'required|max:60',
        'cp_phone' => 'max:15|min:9',
    ];

    public function mount($id) {
        $this->shipperId = $id;
        $this->loadShipper();
    }

    public function loadShipper() {
        $this->shipper = Shipper::where('id', $this->shipperId)->first();
        if ($this->shipper) {
            $this->name = $this->shipper->name;
            $this->cp_phone = $this->shipper->cp_phone;

            return;
        }
        return redirect()->to(route('shipper.index'));
    }

    public function submit() {
        $this->validate();

        $this->shipper->update([
            'name' => $this->name,
            'cp_phone' => $this->cp_phone,
        ]);

        return redirect()->to(route('shipper.index'));
    }

    public function render()
    {
        return view('livewire.shipper.pages.edit-shipper-page');
    }
}
