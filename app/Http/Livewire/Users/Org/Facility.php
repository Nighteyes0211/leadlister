<?php

namespace App\Http\Livewire\Users\Org;

use App\Enum\PageModeEnum;
use App\Models\Appointment;
use App\Models\Branch;
use App\Models\Contact;
use App\Models\FacilityType;
use App\Models\Facilty;
use App\Models\Noteable;
use App\Traits\HasDynamicInput;
use Livewire\Component;

class Facility extends Component
{

    use HasDynamicInput;

    /**
     * Parent
     */
    public $mode, $facility;

    /**
     * Collection
     */
    public $facility_types, $contacts, $branches;

    public $name;
    public $telephone;
    public $street;
    public $house_number;
    public $zip_code;
    public $location;
    public $contact;
    public $facility_type;
    public $tele_appointment = false;
    public $info_material = false;

    public $appointment_name, $appointment_contact, $appointment_start_date, $appointment_end_date, $branch;

    public function mount()
    {

        $this->facility_types = FacilityType::active()->available()->get();
        $this->contacts = Contact::available()->get();
        $this->branches = Branch::available()->get();

        $this->defineInputs(fn() => [
            'notes' => [
                [
                    'id' => null,
                    'note' => ''
                ]
            ]
        ]);

        if ($this->mode == PageModeEnum::EDIT) {
            $this->name = $this->facility->name;
            $this->telephone = $this->facility->telephone;
            $this->street = $this->facility->street;
            $this->house_number = $this->facility->house_number;
            $this->zip_code = $this->facility->zip_code;
            $this->location = $this->facility->location;
            $this->contact = $this->facility->contact_id;
            $this->facility_type = $this->facility->facility_type_id;
            $this->tele_appointment = $this->facility->tele_appointment;
            $this->info_material = $this->facility->info_material;
            $this->branch = $this->branches->first()?->id;
            $this->inputs['notes'] = $this->facility->notes->map(fn ($note) => [
                'id' => $note->id,
                'note' => $note->text
            ])->toArray() ?: [
                [
                    'id' => null,
                    'note' => ''
                ]
            ];
        } else {
            $this->contact = $this->contacts->first()?->id;
            $this->facility_type = $this->facility_types->first()?->id;
            $this->fillInputs();
        }

        // dd($this->inputs['notes']);

    }

    public function updatedTeleAppointment()
    {
        if ($this->tele_appointment && $this->mode == PageModeEnum::CREATE) {
            $this->emit('openModal', 'appointment_modal');
        }
    }

    public function render()
    {
        return view('livewire.users.org.facility');
    }

    public function validationAttributes()
    {
        return [
            'inputs.notes.*.note' => 'note'
        ];
    }


    public function handleBeforeInputRemove($key, $group)
    {
        if ($group == 'notes') {
            $note = $this->inputs['notes'][$key];
            $id = array_key_exists('id', $note) ? $note['id'] : '';
            $id ? Noteable::find($id)->delete() : '';
        }
    }


    public function store()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'street' => 'nullable|string|max:255',
            'house_number' => 'nullable|string|max:20',
            'zip_code' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'facility_type' => 'required',
            'contact' => 'required',
            'tele_appointment' => 'nullable|boolean',
            'info_material' => 'nullable|boolean',
            'branch' => 'required',
        ];

        $this->validate(
            array_merge($rules, $this->inputRules([
                'notes' => [
                    'note' => ['required']
                ]
            ]))
        );

        $data = [
            'name' => $this->name,
            'telephone' => $this->telephone,
            'street' => $this->street,
            'house_number' => $this->house_number,
            'zip_code' => $this->zip_code,
            'location' => $this->location,
            'facility_type_id' => $this->facility_type,
            'contact_id' => $this->contact,
            'tele_appointment' => $this->tele_appointment,
            'info_material' => $this->info_material,
            'branch_id' => $this->branch,
        ];


        $facility = Facilty::create($data);
        foreach ($this->inputs['notes'] as $note) {
            $facility->notes()->create([
                'text' => $note['note']
            ]);
        }

        return redirect()->route('organization.facility.index'); // Adjust the redirect URL as needed
    }

    public function edit()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'street' => 'nullable|string|max:255',
            'house_number' => 'nullable|string|max:20',
            'zip_code' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'facility_type' => 'required',
            'contact' => 'required',
            'tele_appointment' => 'nullable|boolean',
            'info_material' => 'nullable|boolean',
            'branch' => 'required',
        ];
        $this->validate(array_merge($rules, $this->inputRules([
            'notes' => [
                'note' => ['required']
            ]
        ])));

        $data = [
            'name' => $this->name,
            'telephone' => $this->telephone,
            'street' => $this->street,
            'house_number' => $this->house_number,
            'zip_code' => $this->zip_code,
            'location' => $this->location,
            'facility_type_id' => $this->facility_type,
            'contact_id' => $this->contact,
            'tele_appointment' => $this->tele_appointment,
            'info_material' => $this->info_material,
            'branch_id' => $this->branch,
        ];


        $this->facility->update($data);
        // dd($this->inputs['notes']);
        foreach ($this->inputs['notes'] as $note) {
            $this->facility->notes()->updateOrCreate(
                [
                    'id' => $note['id']
                ],
                [
                'text' => $note['note']
            ]);
        }

        return redirect()->route('organization.facility.index'); // Adjust the redirect URL as needed
    }

    public function createAppointment()
    {
        $this->validate([
            'appointment_name' => 'required|string|max:255',
            'appointment_contact' => 'required',
            'appointment_start_date' => 'required|date',
            'appointment_end_date' => 'required|date',
        ]);

        Appointment::create([
            'name' => $this->appointment_name,
            'contact' => $this->appointment_contact,
            'start_date' => $this->appointment_start_date,
            'end_date' => $this->appointment_end_date,
            'user_id' => auth()->id(),
        ]);

        $this->emit('closeModal', 'appointment_modal');
    }
}
