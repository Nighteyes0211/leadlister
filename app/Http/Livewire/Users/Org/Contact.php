<?php

namespace App\Http\Livewire\Users\Org;

use App\Enum\Contact\StatusEnum;
use App\Enum\PageModeEnum;
use App\Mail\User\NewAppointment;
use App\Models\Contact as ModelsContact;
use App\Models\Position;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Contact extends Component
{
    /**
     * Parent
     */
    public $contact, $mode;

    /**
     * Collection
     */
    public $users, $positions;

    /**
     * Form
     */
    public $first_name, $last_name, $email, $telephone, $mobile, $street, $house_number, $zip_code, $location, $position, $status, $notes, $is_internal = true, $assign_to;

    public function mount()
    {
        $this->users = User::active()->available()->get();
        $this->positions = Position::active()->available()->get();
        if ($this->mode == PageModeEnum::CREATE)
        {
            $this->status = StatusEnum::PENDING->value;
            $this->assign_to = auth()->user()->id;
            $this->position = $this->positions->first()?->id;
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
            $this->notes = $this->contact->notes;
            $this->is_internal = $this->contact->is_internal;
            $this->assign_to = $this->contact->user_id;
        }
    }

    public function render()
    {
        return view('livewire.users.org.contact');
    }

    public function store()
    {
        $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:contacts,email',
            'telephone' => 'nullable|string|max:20', // Adjust max length as needed
            'mobile' => 'nullable|string|max:20', // Adjust max length as needed
            'street' => 'nullable|string|max:255',
            'house_number' => 'nullable|string|max:20', // Adjust max length as needed
            'zip_code' => 'nullable|string|max:20', // Adjust max length as needed
            'location' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'assign_to' => 'required', // Ensure the assigned user exists in the users table
        ]);

        ModelsContact::create([
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
            'notes' => $this->notes,
            'is_internal' => $this->is_internal,
            'user_id' => $this->assign_to,
        ]);

        return redirect()->route('organization.contact.index');
    }

    public function edit()
    {
        $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:contacts,email,' . $this->contact->id,
            'telephone' => 'nullable|string|max:20', // Adjust max length as needed
            'mobile' => 'nullable|string|max:20', // Adjust max length as needed
            'street' => 'nullable|string|max:255',
            'house_number' => 'nullable|string|max:20', // Adjust max length as needed
            'zip_code' => 'nullable|string|max:20', // Adjust max length as needed
            'location' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'assign_to' => 'required', // Ensure the assigned user exists in the users table
        ]);

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
            'notes' => $this->notes,
            'is_internal' => $this->is_internal,
            'user_id' => $this->assign_to,
        ]);


        return redirect()->route('organization.contact.index');
    }

}
