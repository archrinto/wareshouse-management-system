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

    public function mount() {
        $this->roleOptions = Role::pluck('name', 'id');
    }

    public function render()
    {
        return view('livewire.user.pages.user-add-page');
    }
}
