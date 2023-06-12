<?php

namespace App\Http\Livewire\User\Components;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UserTable extends DataTableComponent
{
    protected $model = User::class;
    protected $listeners = [
        'deleteConfirmed'
    ];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setColumnSelectStatus(false);
        $this->setDefaultSort('created_at', 'desc');
        if (Auth::user()->hasPermissionTo('user.create')) {
            $this->setConfigurableAreas([
                'toolbar-left-start' => [
                    'livewire.livewire-datatable.add-action-button',
                    [
                        'route' => route('user.add')
                    ],
                ],
            ]);
        }
    }

    public function builder(): Builder
    {
        $builder = User::with('roles');
        if (!Auth::user()->hasRole('Super Admin')) {
            $builder->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'Super Admin');
            });
        }
        return $builder;
    }

    public function columns(): array
    {
        return [
            Column::make(__('Name'), 'name')
                ->searchable()
                ->sortable(),
            Column::make(__('Email'), 'email')
                ->searchable(),
            Column::make(__('Created at'), 'created_at')
                ->format(fn($value) => format_date($value))
                ->sortable(),
            Column::make(__('Roles'))
                ->label(
                    fn($row, $column) => join(', ', $row->roles->pluck('name')->toArray())
                ),
            Column::make(__('Actions'), 'id')
                ->view('livewire.user.components.user-action-menu'),
        ];
    }

    public function actionDelete($id)
    {
        $this->emitTo('components.delete-confirm-modal', 'deleteConfirmation', 'user.components.user-table', $id);
    }

    public function deleteConfirmed($id)
    {
        if ($id) {
            User::where('id', $id)->delete();
        }
    }
}
