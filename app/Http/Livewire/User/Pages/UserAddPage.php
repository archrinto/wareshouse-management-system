<?php

namespace App\Http\Livewire\User\Pages;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UserAddPage extends Component
{
    public $name;
    public $password;
    public $confirmPassword;
    public $email;
    public $role;

    public $roleOptions = [];

    protected $rules = [
        'name' => 'required|max:60',
        'password' => 'required',
        'role' => 'required',
        'confirmPassword' => 'required|same:password',
        'email' => 'required|email|unique:users'
    ];

    public function mount() {
        if (!Auth::user()->hasRole('Super Admin')) {
            $this->roleOptions = Role::where('name', '!=', 'Super Admin')->pluck('name', 'name')->toArray();
        } else {
            $this->roleOptions = Role::pluck('name', 'name')->toArray();
        }
    }

    public function submit() {
        $this->validate();
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'email_verified_at' => now(),
        ]);

        if ($user) {
            $user->assignRole($this->roleOptions[$this->role]);
        }

        return redirect()->to(route('user.index'));
    }

    public function render()
    {
        return view('livewire.user.pages.user-add-page');
    }
}
