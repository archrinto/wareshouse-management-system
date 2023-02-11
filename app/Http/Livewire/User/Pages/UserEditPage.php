<?php

namespace App\Http\Livewire\User\Pages;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UserEditPage extends Component
{
    public $userId = null;
    public $name;
    public $password;
    public $confirmPassword;
    public $email;
    public $role;
    public User|null $user = null;

    public $roleOptions = [];

    public function mount($id) {
        $this->userId = $id;
        $this->loadUser();
        $this->loadRoleOptions();
    }

    public function loadRoleOptions() {
        $this->roleOptions = Role::pluck('name', 'name')->toArray();
    }

    public function loadUser() {
        $this->user = User::where('id', $this->userId)->first();
        if ($this->user) {
            $this->name = $this->user->name;
            $this->email = $this->user->email;
            $this->role = $this->user->roles()->first()->name ?? null;
        }
    }

    protected function rules() {
        return [
            'name' => 'required|max:60',
            'role' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->userId
        ];
    }

    public function submit() {
        $this->validate();
        $data = [
            'name' => $this->name,
            'email' => $this->email,
        ];
        if ($this->password) {
            $this->validate([
                'password' => 'required',
                'confirmPassword' => 'required|same:password',
            ]);

            $data['password'] = $this->password;
        }

        $this->user->update($data);
        $this->user->syncRoles([$this->role]);

        return redirect()->to(route('user.index'));
    }

    public function render()
    {
        return view('livewire.user.pages.user-edit-page');
    }
}
