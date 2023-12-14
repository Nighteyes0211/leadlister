<?php

namespace App\Http\Livewire\Users\Org\Modal\Delete;

use Livewire\Component;

class Confirm extends Component
{

    public $modalId = 'delete-modal';

    /**
     * Parent
     */
    public $data;

    protected $listeners = ['confirmDelete' => 'setData'];

    public function setData($data)
    {
        $this->data = $data;
    }

    public function render()
    {
        return view('livewire.users.org.modal.delete.confirm');
    }

    public function confirmed()
    {
        $this->emit('recordDeletionConfirmed', $this->data);
        $this->emit('closeModal', $this->modalId);
    }
}
