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
use App\Models\Product;
use App\Models\State;
use App\Models\User;
use App\Traits\HasDynamicInput;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Livewire\Component;
use App\Models\Productable;

class Facility extends Component
{

    use HasDynamicInput;

    protected $listeners = ['contactCreated' => 'assignContact'];

    /**
     * Parent
     */
    public $mode, $facility;

    /**
     * Collection
     */
    public $facility_types, $contacts, $users, $statuses, $states, $products;

    public $name;
    public $telephone;
    public $street;
    public $house_number;
    public $state = "";
    public $zip_code;
    public $location;
    public $is_internal = true;
    public $contact = [];
    public $email;
    public $facility_type = "";
    public $tele_appointment = false;
    public $info_material = false;
    public $status = [];



    // Branch
    public $branch_name, $branch_street, $branch_housing_number, $branch_zip, $branch_location, $branch_contact = [];
    public $facility_branches = [];

    // Productable
    public $product, $product_quantity = 1;
    public $facility_products = [];

    public function mount()
    {

        $this->facility_types = FacilityType::available()->get();
        // $this->contacts = Contact::available()->when(auth()->user()->is_internal == false, fn($query) => $query->where('is_internal', false))->get();
        $this->contacts = Contact::available()->get();
        $this->users = User::active()->available()->get();
        $this->statuses = FacilityStatus::available()->get();
        $this->states = State::active()->available()->get();
        $this->products = Product::active()->available()->get();
        $this->product = $this->products->first()?->id;

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
            $this->state = $this->facility->state_id ?: $this->states->first()?->id;
            $this->house_number = $this->facility->house_number;
            $this->zip_code = $this->facility->zip_code;
            $this->location = $this->facility->location;
            $this->contact = $this->facility->contacts->pluck('id')->toArray();
            $this->email = $this->facility->email;
            $this->facility_type = $this->facility->facility_type_id;
            $this->tele_appointment = $this->facility->tele_appointment;
            $this->info_material = $this->facility->info_material;
            $this->status = $this->facility->statuses->pluck('id')->toArray();
            $this->is_internal = $this->facility->is_internal;
            $this->inputs['notes'] = $this->facility->notes->map(fn ($note) => [
                'id' => $note->id,
                'note' => $note->text,
                'created_by' => $note->createdBy?->fullName(),
                'created_at' => parseDate($note->created_at),
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

            // td>{{ $singleProduct['scope'] }}</td>

            //                         <td>{{ $singleProduct['lesson_type'] }}</td>

            //                         <td>{{ $singleProduct['price'] }}</td>

            //                         <td>{{ $singleProduct['quantity'] }}</td>
            $this->facility_products = $this->facility->products()->get()->map(fn ($product) => [
                'id' => $product->id,
                'product' => $product->product->id,
                'name' => $product->product->name,
                'scope' => $product->product->scope,
                'lesson_type' => $product->product->lesson_type,
                'price' => $product->product->price,
                'quantity' => $product->quantity,
            ])->toArray() ?: [];

        } else {
            // $this->facility_type = $this->facility_types->first()?->id;
            // $this->state = $this->states->first()?->id;
            $this->fillInputs();
        }

        // dd($this->inputs['notes']);

    }

    public function assignContact($contact)
    {
        $this->contact[] = $contact['id'];
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
            'telephone' => 'required|string|max:20',
            'street' => 'required|string|max:255',
            'house_number' => 'required|string|max:20',
            'zip_code' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'facility_type' => 'required',
            'tele_appointment' => 'nullable|boolean',
            'info_material' => 'nullable|boolean',
            'email' => ['required', 'email']
        ];

        $this->validate(
            array_merge($rules, $this->inputRules([
                'notes' => [
                    'note' => ['max:3000']
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
            'facility_type_id' => $this->facility_type != '' ? $this->facility_type : null,
            'tele_appointment' => $this->tele_appointment,
            'info_material' => $this->info_material,
            'is_internal' => $this->is_internal,
            'email' => $this->email,
            'state_id' => $this->state != '' ? $this->state : null
        ];


        $facility = Facilty::create($data);

        if ($this->contact)
        {
            $facility->contacts()->attach($this->contact);
        }

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


        # Store products
        foreach ($this->facility_products as $product) {
            $facility->products()->create([
                'product_id' => $product['product'],
                'quantity' => $product['quantity'],
            ]);
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
            'telephone' => 'required|string|max:20',
            'street' => 'required|string|max:255',
            'house_number' => 'required|string|max:20',
            'zip_code' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'facility_type' => 'required',
            'tele_appointment' => 'nullable|boolean',
            'info_material' => 'nullable|boolean',
            'email' => ['required', 'email']
        ];
        $this->validate(array_merge($rules, $this->inputRules([
            'notes' => [
                'note' => ['nullable', 'max:3000']
            ]
        ])));

        $data = [
            'name' => $this->name,
            'telephone' => $this->telephone,
            'street' => $this->street,
            'house_number' => $this->house_number,
            'zip_code' => $this->zip_code,
            'location' => $this->location,
            'facility_type_id' => $this->facility_type != '' ? $this->facility_type : null,
            'tele_appointment' => $this->tele_appointment,
            'info_material' => $this->info_material,
            'is_internal' => $this->is_internal,
            'email' => $this->email,
            'state_id' => $this->state != '' ? $this->state : null
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

        foreach ($this->facility_products as $product) {
            $this->facility->products()->updateOrCreate(
                    [
                        'id' => $product['id']
                    ],
                    [
                    'product_id' => $product['product'],
                    'quantity' => $product['quantity'],
                ]);
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

    public function addProduct()
    {

        $this->validate([
            'product' => ['required'],
            'product_quantity' => 'required|numeric',
        ]);

        $product = Product::find($this->product);

        $this->facility_products[] = [
            'id' => null,
            'product' => $this->product,
            'name' => $product->name,
            'scope' => $product->scope,
            'lesson_type' => $product->lesson_type,
            'price' => $product->price,
            'quantity' => $this->product_quantity,
        ];

        $this->reset('product_quantity');
        $this->emit('toast', [
            'message' => 'Product added successfully',
        ]);
    }

    public function removeProduct(int $key)
    {

        $product = $this->facility_products[$key];
        $id = array_key_exists('id', $product) ? $product['id'] : '';
        $id ? Productable::find($id)->delete() : '';
        unset($this->facility_products[$key]);
    }

}
