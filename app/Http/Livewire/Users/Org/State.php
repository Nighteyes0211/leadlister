<?php

namespace App\Http\Livewire\Users\Org;

use App\Enum\PageModeEnum;
use App\Models\State as ModelsState;
use Illuminate\Validation\Rule;
use Livewire\Component;

class State extends Component
{
    /**
     * Parent
     */
    public $mode, $state;

    /**
     * Form Fields
     */
    public $name;

    public function mount()
    {
        if ($this->mode == PageModeEnum::EDIT)
        {
            $this->name = $this->state->name;
        }
    }

    public function render()
    {
        return view('livewire.users.org.state');
    }

    public function store()
    {
        $this->validate([
            'name' => ['required', Rule::unique('states')->where('is_deleted', 0)]
        ]);

        ModelsState::create([
            'name' => $this->name,
        ]);

        return redirect()->route('organization.state.index');
    }

    public function edit()
    {
        $this->validate([
            'name' => ['required', Rule::unique('states')->where('is_deleted', 0)->ignore($this->state->id)]
        ]);

        $this->state->update([
            'name' => $this->name,
        ]);

        return redirect()->route('organization.state.index');

    }
}
