<?php

namespace App\Http\Livewire\Users\Org\Modal\Create;

use App\Enum\Contact\SalutationEnum;
use App\Enum\Contact\StatusEnum;
use App\Models\Contact as ModelsContact;
use App\Models\Position;
use App\Models\User;
use App\Traits\HasDynamicInput;
use Livewire\Component;

class Contact extends Component
{

    use HasDynamicInput;

    /**
     * Collection
     */
    public $users, $positions;

    /**
     * Form
     */
    public $first_name, $last_name, $email, $telephone, $mobile, $street, $house_number, $zip_code, $location, $position, $status, $notes, $is_internal = true, $salutation, $assign_to, $recieve_promotional_emails = false;


    public function mount()
    {
        $this->users = User::active()->available()->get();
        $this->positions = Position::active()->available()->get();

        $this->defineInputs(fn() => [
            'notes' => [
                [
                    'id' => null,
                    'note' => ''
                ]
            ],
        ]);


        $this->status = StatusEnum::PENDING->value;
        $this->assign_to = auth()->user()->id;
        $this->position = $this->positions->first()?->id;
        $this->salutation = SalutationEnum::NONE->value;
        $this->fillInputs();
    }

    public function render()
    {
        return view('livewire.users.org.modal.create.contact');
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
                    'note' => ['max:400']
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

        foreach ($this->inputs['notes'] as $note) {
            if ($note['note'])
            {
                $contact->notes()->create([
                    'text' => $note['note']
                ]);
            }
        }

        $this->emit('closeModal', 'create_contact_modal');
        $this->emit('contactCreated', $contact);
    }

}
