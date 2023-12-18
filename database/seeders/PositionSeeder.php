<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Pflegedienstleitung'
            ],
            [
                'name' => 'Pflegedienstleitung'
            ],
            [
                'name' => 'Einrichtungsleitung'
            ],
            [
                'name' => 'Geschäftsführer'
            ],
        ];


        foreach ($data as $item) {
            Position::firstOrCreate($item);
        }
    }
}
