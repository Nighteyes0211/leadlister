<?php

namespace App\Http\Controllers\Organization;

use App\Enum\PageModeEnum;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{

    public function index()
    {
        $mode = PageModeEnum::INDEX;
        return view('users.organization.appointment', compact('mode'));
    }

    public function edit(Appointment $appointment)
    {
        $mode = PageModeEnum::EDIT;
        return view('users.organization.appointment', compact('appointment', 'mode'));
    }
}
