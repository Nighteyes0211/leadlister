<?php

namespace App\Http\Livewire\Users\Org;

use App\Models\Contact;
use App\Models\User;
use Livewire\Component;

class Appointment extends Component
{

    /**
     * Parent
     */
    public $appointment;

    /**
     * COllection
     */
    public $users, $contacts;

    // Form fields
    public $appointment_name, $appointment_contact = "", $appointment_start_date, $appointment_end_date, $appointment_user = "", $status;

    public function mount()
    {
        $this->users = User::active()->available()->get();
        $this->contacts = Contact::available()->when(auth()->user()->is_internal == false, fn($query) => $query->where('is_internal', false))->get();

        $this->appointment_name = $this->appointment->name;
        $this->appointment_contact = $this->appointment->contact_id;
        $this->appointment_start_date = $this->appointment->start_date;
        $this->appointment_end_date = $this->appointment->end_date;
        $this->appointment_user = $this->appointment->user_id;
        $this->status = $this->appointment->status;
    }

    public function render()
    {
        return view('livewire.users.org.appointment');
    }

    public function edit()
    {
        $this->validate([
            'appointment_name' => 'required|string|max:255',
            'appointment_contact' => 'required',
            'appointment_user' => 'required',
            'appointment_start_date' => 'required|date',
            'appointment_end_date' => 'required|date',
        ]);

        $this->appointment->update([
            'name' => $this->appointment_name,
            'contact_id' => $this->appointment_contact,
            'user_id' => $this->appointment_user,
            'start_date' => $this->appointment_start_date,
            'end_date' => $this->appointment_end_date,
            'status' => $this->status,
        ]);

        return redirect()->route('organization.calendar');
    }
}
