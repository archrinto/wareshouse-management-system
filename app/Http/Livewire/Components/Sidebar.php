<?php

namespace App\Http\Livewire\Components;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Sidebar extends Component
{
    public function mount() {
    }
    public function render()
    {
        return view('livewire.components.sidebar');
    }
}
