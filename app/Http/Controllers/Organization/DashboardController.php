<?php

namespace App\Http\Controllers\Organization;

use App\Enum\RoleEnum;
use App\Http\Controllers\Controller;
use App\Jobs\ImportCsv;
use App\Models\Appointment;
use App\Models\Contact;
use App\Models\FacilityType;
use App\Models\Facilty;
use App\Models\Section;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
                'contact' => $appointment->contact?->fullName() ?: 'N/A',
                'appointment_start_time' => parseDate($appointment->start_date, 'M j, Y h:i A'),
                'appointment_end_time' => parseDate($appointment->end_date, 'M j, Y h:i A'),
                'user' => $appointment->user->fullName()
            ];
        });

        return view('users.organization.calendar', compact('appointments'));
    }

    public function importData()
    {

        $data = [];
        // Check if the file exists
        if (file_exists(storage_path('app/data.csv'))) {
            // Open the CSV file for reading
            $file = fopen(storage_path('app/data.csv'), 'r');


            // Skip header
            $row_index = -1;

            // Read and parse each row
            while (($row = fgetcsv($file)) !== false) {


                $row_index += 1;
                if ($row_index == 0 && true) {
                    continue;
                }


                $data[] = $row;
            }

            // Close the file
            fclose($file);
        }

        $data = array_chunk($data, 50);
        $readyData = [];
        $batches = Bus::batch([])->dispatch();
        foreach ($data as $chunk)
        {
            // $readyData[] = new ImportCsv($chunk);
            $batches->add(new ImportCsv($chunk));
        }



        // $creator = User::first();
        // $facility_type = FacilityType::firstOrCreate(
        //     ['name' => $row[6]]
        // );

        // if ($row[16])
        // {
        //     $creator = User::firstOrCreate(
        //         [
        //             'email' => $row[16] . '@gmail.com',
        //         ],
        //         [
        //             'first_name' => $row[16],
        //             'last_name' => '.',
        //             'password' => Hash::make('password'),
        //         ]
        //     );
        //     $creator->assignRole(RoleEnum::USER->value);
        // }


        // if ($row[20])
        // {
        //     $contact = Contact::firstOrCreate(
        //         [
        //             'email' => $row[14] ?: null
        //         ],
        //         [
        //             'first_name' => $row[20],
        //             'last_name' => $row[21],
        //             'user_id' => $creator->id
        //         ]
        //     );
        // }

        // $facility = Facilty::firstOrCreate(
        //     [
        //         'name' => $row[8],
        //     ],
        //     [
        //         'facility_type_id' => $facility_type->id,
        //         'zip_code' => $row[9] ? explode(' ', $row[9])[0] : '',
        //         'location' => $row[9] ? (array_key_exists(1, explode(' ', $row[9])) ? explode(' ', $row[9])[1] : '') : '',
        //         'telephone' => $row[13],
        //         'street' => $row[12],
        //     ]
        // );

        // if (isset($contact) && $facility->contacts()->whereNot('contacts.id', $contact->id)->exists()) {
        //     $facility->contacts()->attach($contact->id);
        // }

        return redirect()->back()->with('success', 'Data is being imported.');

    }
}
