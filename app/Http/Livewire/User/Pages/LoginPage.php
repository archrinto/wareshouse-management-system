<?php

namespace App\Http\Livewire\User\Pages;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginPage extends Component
{

    public $email;
    public $password;

    public function login() {
        $this->validate([
            'email'     => 'required|email',
            'password'  => 'required'
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            return redirect()->to(route('dashboard.index'));
        }

        session()->flash('toast', __('Your email or password is wrong'));
        return redirect()->to(route('login'));
    }

    public function render()
    {
        return view('livewire.user.pages.login-page')->layout('layouts.login');
    }
}
