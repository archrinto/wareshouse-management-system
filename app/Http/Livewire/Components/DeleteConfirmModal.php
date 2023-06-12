<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class DeleteConfirmModal extends Component
{
    public $componentName = null;
    public $itemId = null;

    protected $listeners = ['deleteConfirmation' => 'deleteConfirmation'];    

    public function deleteConfirmation($componentName, $itemId) {
        $this->componentName = $componentName;
        $this->itemId = $itemId;

        $this->emitSelf('showDeleteConfirmModal');
    }

    public function deleteConfirm() {
        $this->emitTo($this->componentName, 'deleteConfirmed', $this->itemId);
        $this->emitSelf('hideDeleteConfirmModal');
    }

    public function deleteCancel() {
        $this->emitSelf('hideDeleteConfirmModal');
    }

    public function render()
    {
        return view('livewire.components.delete-confirm-modal');
    }
}
