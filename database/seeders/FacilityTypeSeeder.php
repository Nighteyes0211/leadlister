<?php

namespace Database\Seeders;

use App\Models\FacilityType;
use App\Models\Facilty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $types = [
            [
                'name' => 'Nursing homes',
            ],
            [
                'name' => 'Nursing services',
            ],
            [
                'name' => 'Hospitals',
            ]
        ];

        foreach ($types as $type) {
            FacilityType::firstOrCreate($type, $type);
        }
    }
}
