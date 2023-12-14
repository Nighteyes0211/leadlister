<?php

namespace App\Http\Livewire\Users\Org;

use App\Enum\PageModeEnum;
use App\Models\Branch as ModelsBranch;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Branch extends Component
{
    /**
     * Parent
     */
    public $mode, $branch;

    /**
     * Fields
     */
    public $name;
    public $street;
    public $housing_number;
    public $zip;
    public $location;
    public $contact;

    public function mount()
    {
        if ($this->mode == PageModeEnum::EDIT) {
            $this->name = $this->branch->name;
            $this->street = $this->branch->street;
            $this->housing_number = $this->branch->housing_number;
            $this->zip = $this->branch->zip;
            $this->location = $this->branch->location;
            $this->contact = $this->branch->contact;
        }
    }

    public function render()
    {
        return view('livewire.users.org.branch');
    }

    public function store()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('branches')->where('is_deleted', false)],
            'street' => ['required', 'string', 'max:255'],
            'housing_number' => ['required', 'string', 'max:20'],
            'zip' => ['required', 'string', 'max:20'],
            'location' => ['required', 'string', 'max:255'],
            'contact' => ['nullable', 'string', 'max:255'],
        ]);


        ModelsBranch::create([
            'name' => $this->name,
            'street' => $this->street,
            'housing_number' => $this->housing_number,
            'zip' => $this->zip,
            'location' => $this->location,
            'contact' => $this->contact,
        ]);

        return redirect()->route('organization.branch.index'); // Adjust the redirect URL as needed
    }

    public function edit()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('branches')->ignore($this->branch->id)->where('is_deleted', false)],
            'street' => ['required', 'string', 'max:255'],
            'housing_number' => ['required', 'string', 'max:20'],
            'zip' => ['required', 'string', 'max:20'],
            'location' => ['required', 'string', 'max:255'],
            'contact' => ['nullable', 'string', 'max:255'],
        ]);


        $this->branch->update([
            'name' => $this->name,
            'street' => $this->street,
            'housing_number' => $this->housing_number,
            'zip' => $this->zip,
            'location' => $this->location,
            'contact' => $this->contact,
        ]);

        return redirect()->route('organization.branch.index'); // Adjust the redirect URL as needed
    }
}
