<?php

namespace App\Http\Livewire\Users\Org;

use App\Enum\Contact\SalutationEnum;
use App\Enum\Contact\StatusEnum;
use App\Enum\PageModeEnum;
use App\Mail\User\NewAppointment;
use App\Models\Contact as ModelsContact;
use App\Models\Noteable;
use App\Models\Position;
use App\Models\Product;
use App\Models\Productable;
use App\Models\User;
use App\Traits\HasDynamicInput;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Contact extends Component
{

    use HasDynamicInput;

    /**
     * Parent
     */
    public $contact, $mode;

    /**
     * Collection
     */
    public $users, $positions, $products;

    /**
     * Form
     */
    public $first_name, $last_name, $email, $telephone, $mobile, $street, $house_number, $zip_code, $location, $position, $status, $notes, $is_internal = true, $salutation, $assign_to, $recieve_promotional_emails = false;

    // Productable
    public $product, $product_quantity = 1;
    public $contact_products = [];

    public function mount()
    {
        $this->users = User::active()->available()->get();
        $this->positions = Position::active()->available()->get();
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


        if ($this->mode == PageModeEnum::CREATE)
        {
            $this->status = StatusEnum::PENDING->value;
            $this->assign_to = auth()->user()->id;
            $this->position = $this->positions->first()?->id;
            $this->salutation = SalutationEnum::NONE->value;
            $this->fillInputs();
        } else {
            $this->first_name = $this->contact->first_name;
            $this->last_name = $this->contact->last_name;
            $this->email = $this->contact->email;
            $this->telephone = $this->contact->telephone;
            $this->mobile = $this->contact->mobile;
            $this->street = $this->contact->street;
            $this->house_number = $this->contact->house_number;
            $this->zip_code = $this->contact->zip_code;
            $this->location = $this->contact->location;
            $this->position = $this->contact->position_id;
            $this->status = $this->contact->status;
            // $this->notes = $this->contact->notes;
            $this->is_internal = $this->contact->is_internal;
            $this->assign_to = $this->contact->user_id;
            $this->salutation = $this->contact->salutation;
            $this->recieve_promotional_emails = $this->contact->recieve_promotional_emails;

            $this->inputs['notes'] = $this->contact->notes->map(fn ($note) => [
                    'id' => $note->id,
                    'note' => $note->text,
                    'created_by' => $note->createdBy?->fullName(),
                    'created_at' => parseDate($note->created_at)
                ])->toArray() ?: [
                    [
                        'id' => null,
                        'note' => ''
                    ]
                ];

            $this->contact_products = $this->contact->products()->get()->map(fn ($product) => [
                'id' => $product->id,
                'product' => $product->product->id,
                'name' => $product->product->name,
                'scope' => $product->product->scope,
                'lesson_type' => $product->product->lesson_type,
                'price' => $product->product->price,
                'quantity' => $product->quantity,
            ])->toArray() ?: [];
        }
    }


    public function handleBeforeInputRemove($key, $group)
    {
        if ($group == 'notes') {
            $note = $this->inputs['notes'][$key];
            $id = array_key_exists('id', $note) ? $note['id'] : '';
            $id ? Noteable::find($id)->delete() : '';
        }
    }

    public function render()
    {
        return view('livewire.users.org.contact');
    }

    public function store()
    {

        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'telephone' => 'nullable|string|max:20', // Adjust max length as needed
            'mobile' => 'nullable|string|max:20', // Adjust max length as needed
            'street' => 'nullable|string|max:255',
            'house_number' => 'nullable|string|max:20', // Adjust max length as needed
            'zip_code' => 'nullable|string|max:20', // Adjust max length as needed
            'location' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'assign_to' => 'required', // Ensure the assigned user exists in the users table
        ];

        $this->validate(
            array_merge($rules, $this->inputRules([
                'notes' => [
                    'note' => ['max:3000']
                ]
            ]))
        );

        $contact = ModelsContact::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'telephone' => $this->telephone,
            'mobile' => $this->mobile,
            'street' => $this->street,
            'house_number' => $this->house_number,
            'zip_code' => $this->zip_code,
            'location' => $this->location,
            'position_id' => $this->position,
            'status' => $this->status,
            'is_internal' => $this->is_internal,
            'user_id' => $this->assign_to,
            'salutation' => $this->salutation,
            'recieve_promotional_emails' => $this->recieve_promotional_emails,
        ]);

          # Store products
          foreach ($this->contact_products as $product) {
            $contact->products()->create([
                'product_id' => $product['product'],
                'quantity' => $product['quantity'],
            ]);
        }



        foreach ($this->inputs['notes'] as $note) {
            if ($note['note'])
            {
                $contact->notes()->create([
                    'text' => $note['note']
                ]);
            }
        }

        return redirect()->route('organization.contact.index');
    }

    public function edit()
    {

        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'telephone' => 'nullable|string|max:20', // Adjust max length as needed
            'mobile' => 'nullable|string|max:20', // Adjust max length as needed
            'street' => 'nullable|string|max:255',
            'house_number' => 'nullable|string|max:20', // Adjust max length as needed
            'zip_code' => 'nullable|string|max:20', // Adjust max length as needed
            'location' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'assign_to' => 'required', // Ensure the assigned user exists in the users table
        ];

        $this->validate(array_merge($rules, $this->inputRules([
            'notes' => [
                'note' => ['nullable', 'max:3000']
            ]
        ])));

        $this->contact->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'telephone' => $this->telephone,
            'mobile' => $this->mobile,
            'street' => $this->street,
            'house_number' => $this->house_number,
            'zip_code' => $this->zip_code,
            'location' => $this->location,
            'position_id' => $this->position,
            'status' => $this->status,
            'is_internal' => $this->is_internal,
            'user_id' => $this->assign_to,
            'salutation' => $this->salutation,
            'recieve_promotional_emails' => $this->recieve_promotional_emails,
        ]);

        foreach ($this->contact_products as $product) {
            $this->contact->products()->updateOrCreate(
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
                $this->contact->notes()->updateOrCreate(
                    [
                        'id' => $note['id']
                    ],
                    [
                    'text' => $note['note']
                ]);
            }
        }


        return redirect()->route('organization.contact.index');
    }

    public function addProduct()
    {

        $this->validate([
            'product' => ['required'],
            'product_quantity' => 'required|numeric',
        ]);


        $product = Product::find($this->product);

        $this->contact_products[] = [
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

        $product = $this->contact_products[$key];
        $id = array_key_exists('id', $product) ? $product['id'] : '';
        $id ? Productable::find($id)->delete() : '';
        unset($this->contact_products[$key]);
    }
}
