<?php

namespace App\Http\Livewire\Users\Org;

use App\Enum\PageModeEnum;
use App\Models\FacilityStatus as ModelsFacilityStatus;
use Illuminate\Validation\Rule;
use Livewire\Component;

class FacilityStatus extends Component
{

    /**
     * Parent
     */
    public $mode, $facilityStatus;

    /**
     * Form Fields
     */
    public $name;

    public function mount()
    {
        if ($this->mode == PageModeEnum::EDIT)
        {
            $this->name = $this->facilityStatus->name;
        }
    }


    public function render()
    {
        return view('livewire.users.org.facility-status');
    }


    public function store()
    {
        $this->validate([
            'name' => ['required', Rule::unique('facility_statuses')->where('is_deleted', 0)]
        ]);

        ModelsFacilityStatus::create([
            'name' => $this->name,
            'color' => 'bg-primary'
        ]);

        return redirect()->route('organization.facility-status.index');
    }

    public function edit()
    {
        $this->validate([
            'name' => ['required', Rule::unique('facility_statuses')->where('is_deleted', 0)->ignore($this->facilityStatus->id)]
        ]);

        $this->facilityStatus->update([
            'name' => $this->name,
        ]);

        return redirect()->route('organization.facility-status.index');

    }
}
