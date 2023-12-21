<?php

namespace App\Http\Livewire\Users\Org\Modal\Create;

use App\Mail\User\NewAppointment;
use App\Models\Appointment as ModelsAppointment;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Appointment extends Component
{
    /**
     * COllection
     */
    public $users;

    // Form fields
    public $appointment_name, $appointment_contact, $appointment_start_date, $appointment_end_date, $appointment_user;

    public function mount()
    {
        $this->users = User::active()->available()->get();
        $this->appointment_user = auth()->user()->id;
    }

    public function render()
    {
        return view('livewire.users.org.modal.create.appointment');
    }


    public function store()
    {
        $this->validate([
            'appointment_name' => 'required|string|max:255',
            'appointment_contact' => 'required',
            'appointment_start_date' => 'required|date',
            'appointment_end_date' => 'required|date',
        ]);

        $appointment = ModelsAppointment::create([
            'name' => $this->appointment_name,
            'contact' => $this->appointment_contact,
            'start_date' => $this->appointment_start_date,
            'end_date' => $this->appointment_end_date,
            'user_id' => $this->appointment_user,
        ]);


        if ($this->appointment_user != auth()->user()->id)
        {
            Mail::to(User::find($this->appointment_user))->send(new NewAppointment($appointment));
        }

        return redirect(request()->header('Referer'));
    }
}
