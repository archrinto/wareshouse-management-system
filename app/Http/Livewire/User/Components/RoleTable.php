<?php

namespace App\Http\Livewire\User\Components;

use App\Models\User;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Spatie\Permission\Models\Role;

class RoleTable extends DataTableComponent
{
    protected $model = Role::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setColumnSelectStatus(false);
        $this->setConfigurableAreas([
            'toolbar-left-start' => [
                'livewire.livewire-datatable.add-action-button',
                [
                    'route' => route('role.add')
                ],
            ],
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make(__('Name'), 'name')
                ->searchable()
                ->sortable(),
            Column::make(__('Created at'), 'created_at')
                ->format(fn($value) => format_date($value))
                ->sortable(),
            Column::make(__('Actions'), 'id')
                ->view('livewire.user.components.role-action-menu'),
        ];
    }

    public function actionEdit($id) {
        return redirect()->to(route('role.edit', $id));
    }

    public function actionDelete($id) {
        $role = Role::where('id', $id)->first();
        if ($role) {
            $role->permissions()->detach();
            $role->delete();
        }
        return redirect()->to(route('role.index'));
    }
}
