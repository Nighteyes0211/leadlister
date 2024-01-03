<?php

namespace Database\Seeders;

use App\Enum\Facility\StatusEnum;
use App\Models\FacilityStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilityStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (StatusEnum::cases() as $status) {
            FacilityStatus::updateOrCreate(
                [
                    'name' => $status->value,
                ],
                [
                    'name' => $status->german(),
                    'color' => $status->color(),
                ]
            );
        }
    }
}
