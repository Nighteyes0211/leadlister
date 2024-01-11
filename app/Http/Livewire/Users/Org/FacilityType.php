<?php

namespace App\Http\Livewire\Users\Org;

use App\Enum\PageModeEnum;
use App\Models\FacilityType as ModelsFacilityType;
use Illuminate\Validation\Rule;
use Livewire\Component;

class FacilityType extends Component
{
    /**
     * Parent
     */
    public $facilityType, $mode;


    /**
     * Form Fields
     */
    public $name;

    public function mount()
    {
        if ($this->mode == PageModeEnum::EDIT)
        {
            $this->name = $this->facilityType->name;
        }
    }

    public function render()
    {
        return view('livewire.users.org.facility-type');
    }

    public function store()
    {
        $this->validate([
            'name' => ['required', Rule::unique('facility_types')->where('is_deleted', 0)]
        ]);

        ModelsFacilityType::create([
            'name' => $this->name
        ]);

        return redirect()->route('organization.facility-type.index');
    }

    public function edit()
    {
        $this->validate([
            'name' => ['required', Rule::unique('facility_types')->where('is_deleted', 0)->ignore($this->facilityType->id)]
        ]);

        $this->facilityType->update([
            'name' => $this->name
        ]);

        return redirect()->route('organization.facility-type.index');
    }
}
