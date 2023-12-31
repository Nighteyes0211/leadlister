<?php

namespace App\Http\Livewire\Users\Org;

use App\Enum\Facility\StatusEnum;
use App\Enum\PageModeEnum;
use App\Enum\RoleEnum;
use App\Mail\User\NewAppointment;
use App\Models\Appointment;
use App\Models\Branch;
use App\Models\Contact;
use App\Models\FacilityStatus;
use App\Models\FacilityType;
use App\Models\Facilty;
use App\Models\Noteable;
use App\Models\User;
use App\Traits\HasDynamicInput;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
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
    public $facility_types, $contacts, $users, $statuses;

    public $name;
    public $telephone;
    public $street;
    public $house_number;
    public $zip_code;
    public $location;
    public $is_internal = true;
    public $contact = [];
    public $facility_type;
    public $tele_appointment = false;
    public $info_material = false;
    public $status = [];



    // Branch
    public $branch_name, $branch_street, $branch_housing_number, $branch_zip, $branch_location, $branch_contact = [];
    public $facility_branches = [];

    public function mount()
    {

        $this->facility_types = FacilityType::active()->available()->get();
        $this->contacts = Contact::available()->when(auth()->user()->hasRole(RoleEnum::USER->value), fn ($query) => $query->where('user_id', auth()->id()))->get();
        $this->users = User::active()->available()->get();
        $this->statuses = FacilityStatus::available()->get();

        $this->defineInputs(fn() => [
            'notes' => [
                [
                    'id' => null,
                    'note' => ''
                ]
            ],
        ]);

        if ($this->mode == PageModeEnum::EDIT) {
            $this->name = $this->facility->name;
            $this->telephone = $this->facility->telephone;
            $this->street = $this->facility->street;
            $this->house_number = $this->facility->house_number;
            $this->zip_code = $this->facility->zip_code;
            $this->location = $this->facility->location;
            $this->contact = $this->facility->contacts->pluck('id')->toArray();
            $this->facility_type = $this->facility->facility_type_id;
            $this->tele_appointment = $this->facility->tele_appointment;
            $this->info_material = $this->facility->info_material;
            $this->status = $this->facility->statuses->pluck('id')->toArray();
            $this->is_internal = $this->facility->is_internal;
            $this->inputs['notes'] = $this->facility->notes->map(fn ($note) => [
                'id' => $note->id,
                'note' => $note->text
            ])->toArray() ?: [
                [
                    'id' => null,
                    'note' => ''
                ]
            ];
            $this->facility_branches = $this->facility->branches->map(fn ($branch) => [
                'id' => $branch->id,
                'name' => $branch->name,
                'street' => $branch->street,
                'housing_number' => $branch->housing_number,
                'zip' => $branch->zip,
                'location' => $branch->location,
                'contact' => $branch->contact_id,
            ])->toArray() ?: [];

        } else {
            $this->facility_type = $this->facility_types->first()?->id;
            $this->fillInputs();
        }

        // dd($this->inputs['notes']);

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
            'name' => ['required', 'string', 'max:255', Rule::unique('facilties')->where('is_deleted', 0)],
            'telephone' => 'nullable|string|max:20',
            'street' => 'nullable|string|max:255',
            'house_number' => 'nullable|string|max:20',
            'zip_code' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'facility_type' => 'required',
            'contact' => 'required',
            'tele_appointment' => 'nullable|boolean',
            'info_material' => 'nullable|boolean',
        ];

        $this->validate(
            array_merge($rules, $this->inputRules([
                'notes' => [
                    'note' => ['max:200']
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
            'tele_appointment' => $this->tele_appointment,
            'info_material' => $this->info_material,
            'is_internal' => $this->is_internal,
        ];


        $facility = Facilty::create($data);
        $facility->contacts()->attach($this->contact);

        foreach ($this->facility_branches as $branch) {
            $createdBranch = $facility->branches()->create([
                'name' => $branch['name'],
                'street' => $branch['street'],
                'housing_number' => $branch['housing_number'],
                'zip' => $branch['zip'],
                'location' => $branch['location'],
            ]);

            if ($branch['contact'])
            {
                $createdBranch->contacts()->attach($branch['contact']);
            }
        }
        foreach ($this->inputs['notes'] as $note) {
            if ($note['note'])
            {
                $facility->notes()->create([
                    'text' => $note['note']
                ]);
            }
        }
        $facility->statuses()->attach($this->status);

        return redirect()->route('organization.facility.index'); // Adjust the redirect URL as needed
    }

    public function edit()
    {
        $rules = [
            'name' => ['required', 'string', 'max:255', Rule::unique('facilties')->ignore($this->facility->id)->where('is_deleted', 0)],
            'telephone' => 'nullable|string|max:20',
            'street' => 'nullable|string|max:255',
            'house_number' => 'nullable|string|max:20',
            'zip_code' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'facility_type' => 'required',
            'contact' => 'required',
            'tele_appointment' => 'nullable|boolean',
            'info_material' => 'nullable|boolean',
        ];
        $this->validate(array_merge($rules, $this->inputRules([
            'notes' => [
                'note' => ['nullable', 'max:200']
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
            'tele_appointment' => $this->tele_appointment,
            'info_material' => $this->info_material,
            'is_internal' => $this->is_internal,
        ];


        $this->facility->update($data);
        $this->facility->contacts()->sync($this->contact);
        foreach ($this->facility_branches as $branch) {

            $selectedBranch = $this->facility->branches()->updateOrCreate(
                [
                    'id' => $branch['id']
                ],
                [
                'name' => $branch['name'],
                'street' => $branch['street'],
                'housing_number' => $branch['housing_number'],
                'zip' => $branch['zip'],
                'location' => $branch['location'],
            ]);
            if ($branch['contact'])
            {
                $selectedBranch->contacts()->sync($branch['contact']);
            }

        }
        foreach ($this->inputs['notes'] as $note) {
            if ($note['note'])
            {
                $this->facility->notes()->updateOrCreate(
                    [
                        'id' => $note['id']
                    ],
                    [
                    'text' => $note['note']
                ]);
            }
        }
        $this->facility->statuses()->sync($this->status);

        return redirect()->route('organization.facility.index'); // Adjust the redirect URL as needed
    }

    public function addBranch()
    {

        $this->validate([
            'branch_name' => ['required', 'string', 'max:255', Rule::notIn(Arr::pluck($this->facility_branches, 'name'))],
            'branch_street' => 'required|string|max:255',
            'branch_housing_number' => 'required|string|max:20',
            'branch_zip' => 'required|string|max:20',
            'branch_location' => 'required|string|max:255',
            'branch_contact' => 'nullable',
        ]);

        $this->facility_branches[] = [
            'id' => null,
            'name' => $this->branch_name,
            'street' => $this->branch_street,
            'housing_number' => $this->branch_housing_number,
            'zip' => $this->branch_zip,
            'location' => $this->branch_location,
            'contact' => $this->branch_contact,
        ];

        $this->reset('branch_name', 'branch_street', 'branch_housing_number', 'branch_zip', 'branch_location', 'branch_contact');
        $this->emit('closeModal', 'branch_modal');
    }

}
