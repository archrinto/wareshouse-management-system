<?php

namespace App\Http\Livewire\User\Pages;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class RoleAddPage extends Component
{
    public string $name = '';
    public array $permissions = ['goods.create'];
    public array $permissionOptions = [];

    public function mount() {
        $this->loadPermissionOptions();
    }

    public function loadPermissionOptions() {
        $this->permissionOptions = Permission::select('name', 'id')
            ->orderByDesc('name')
            ->get()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.user.pages.role-add-page');
    }
}
