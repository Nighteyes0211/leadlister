<?php

namespace App\Jobs;

use App\Enum\RoleEnum;
use App\Models\Contact;
use App\Models\FacilityType;
use App\Models\Facilty;
use App\Models\User;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;

class ImportCsv implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public array $records
    ) {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->records as $row)
        {

            $creator = User::first();

            $facility_type = FacilityType::firstOrCreate(
                ['name' => $row[6]]
            );

            if ($row[16])
            {
                $creator = User::firstOrCreate(
                    [
                        'email' => $row[16] . '@gmail.com',
                    ],
                    [
                        'first_name' => $row[16],
                        'last_name' => '.',
                        'password' => Hash::make('password'),
                    ]
                );
                $creator->assignRole(RoleEnum::USER->value);
            }

            if ($row[20])
            {
                if (Contact::where('email', $row[14])->exists())
                {
                    $contact = Contact::where('email', $row[14])->first();
                } else {
                    $contact = Contact::firstOrCreate(
                        [
                            'email' => $row[14] ?: null,
                            'first_name' => $row[20],
                        ],
                        [
                            'last_name' => $row[21],
                            'user_id' => $creator->id
                        ]
                    );
                }
            }


            $facility = Facilty::updateOrCreate(
                [
                    'name' => $row[8],
                ],
                [
                    'facility_type_id' => $facility_type->id,
                    'zip_code' => $row[9] ? explode(' ', $row[9])[0] : '',
                    'location' => $row[9] ? (array_key_exists(1, explode(' ', $row[9])) ? explode(' ', $row[9])[1] : '') : '',
                    'telephone' => $row[13],
                    'street' => $row[12],
                ]
            );


            if (isset($contact) && !($facility->contacts()->where('contacts.id', $contact->id)->exists())) {
                $facility->contacts()->attach($contact->id);
            }

            unset($contact);
        }
    }
}
