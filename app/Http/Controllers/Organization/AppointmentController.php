<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function edit(Appointment $appointment)
    {
        return view('users.organization.appointment', compact('appointment'));
    }
}
