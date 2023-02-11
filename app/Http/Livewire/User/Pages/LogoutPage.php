<?php

namespace App\Http\Livewire\User\Pages;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LogoutPage extends Component
{
    public function mount() {
        Auth::logout();
        return redirect()->to(route('login'));
    }
    public function render()
    {
        return view('livewire.user.pages.logout-page');
    }
}
