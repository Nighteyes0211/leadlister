<?php

namespace App\Http\Controllers\Organization;

use App\Enum\RoleEnum;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Section;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $currentAppointment = Appointment::where('user_id', auth()->id())->whereBetween('start_date', [now()->subDay(), now()->addDay()])->count();
        $tomorrowAppointment = Appointment::where('user_id', auth()->id())->whereBetween('start_date', [now()->addDay(), now()->addDays(2)])->count();

        return view('users.organization.dashboard', compact('currentAppointment', 'tomorrowAppointment'));
    }

    public function calendar()
    {
        $startDate = now()->startOfDay();
        $endDate = now()->endOfDay();

        $other_users = User::where('is_absent', true)
                            ->where(fn ($query) => $query->where('absent_from', '<=', $startDate)->orWhere('absent_to', '>=', $endDate))
                            ->where('substitution_handler', auth()->id())
                            ->get()
                            ->pluck('id')
                            ->toArray();
        $appointments = Appointment::where(fn ($query) => $query->where('user_id', auth()->id())->orWhereIn('user_id', $other_users))->get();

        // id: '1',
        // start: curYear + '-' + curMonth + '-02T09:00:00',
        // end: curYear + '-' + curMonth + '-02T13:00:00',
        // title: 'Spruko Meetup',
        // backgroundColor: 'rgba(71, 84, 242, 0.2)',
        // borderColor: 'rgba(71, 84, 242, 0.2)',
        // description: 'All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary'
        $appointments = $appointments->map(function ($appointment) {
            return [
                'id' => $appointment->id,
                'title' => $appointment->name,
                'start' => $appointment->start_date,
                'end' => $appointment->end_date,
                'contact' => $appointment->contact,
                'appointment_start_time' => parseDate($appointment->start_date, 'M j, Y h:i A'),
                'appointment_end_time' => parseDate($appointment->end_date, 'M j, Y h:i A'),
                'user' => $appointment->user->fullName()
            ];
        });

        return view('users.organization.calendar', compact('appointments'));
    }

}
