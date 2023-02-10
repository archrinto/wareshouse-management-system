<?php

namespace App\Http\Livewire\User\Pages;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class UserAddPage extends Component
{
    public $name;
    public $password;
    public $confirmPassword;
    public $email;

    public $roleOptions = [];

    protected $roles = [
        'name' => 'required|max:60',
        'password' => 'required',
        'confirmPassword' => 'required|same:password',
        'email' => 'required|email'
    ];

    public function mount() {
        $this->roleOptions = Role::pluck('name', 'id')->toArray();
    }

    public function render()
    {
        return view('livewire.user.pages.user-add-page');
    }
}
