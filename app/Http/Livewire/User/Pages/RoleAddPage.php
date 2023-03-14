<?php

namespace App\Http\Livewire\User\Pages;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAddPage extends Component
{
    public string|null $name = null;
    public array $permissions = [];
    public array $permissionOptions = [];
    public string|null $roleId = null;
    public Role|null $role = null;

    protected array $rules = [
        'name' => 'required|max:60',
    ];

    public function mount(string $id = null) {
        if ($id) {
            $this->roleId = $id;
            $this->loadRole();
        }
        $this->loadPermissionOptions();
    }

    public function loadRole() {
        $this->role = Role::where('id', $this->roleId)->first();
        if ($this->role) {
            $this->name = $this->role->name;
            $this->permissions = $this->role->permissions->pluck('name')->toArray();
        }
    }

    public function loadPermissionOptions() {
        $this->permissionOptions = Permission::select('name', 'id')
            ->orderByDesc('name')
            ->get()
            ->toArray();
    }

    public function submit() {
        if ($this->role) {
            $this->role->syncPermissions($this->permissions);
        } else {
            $role = Role::create([
                'name' => $this->name,
                'guard_name' => 'web',
            ]);
            if ($role) {
                $role->syncPermissions($this->permissions);
            }
        }
        return redirect()->to(route('role.index'));
    }

    public function render()
    {
        return view('livewire.user.pages.role-add-page');
    }
}
