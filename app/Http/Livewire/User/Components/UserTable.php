<?php

namespace App\Http\Livewire\User\Components;

use App\Models\User;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UserTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setColumnSelectStatus(false);
        $this->setConfigurableAreas([
            'toolbar-left-start' => [
                'livewire.livewire-datatable.add-action-button',
                [
                    'route' => route('user.add')
                ],
            ],
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make('Name')
                ->sortable(),
            Column::make('Email', 'email'),
            Column::make('Created at', 'created_at')
                ->sortable(),
            Column::make(__('Roles'))
                ->label(
                    fn($row, $column) => join(', ', $row->roles->pluck('name')->toArray())
                ),
            Column::make('Actions', 'id')
                ->view('livewire.shipper.components.shipper-action-menu'),
        ];
    }
}
