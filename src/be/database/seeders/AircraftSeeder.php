<?php

namespace Database\Seeders;

use App\Models\Aircraft;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AircraftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Aircraft::create([
            'type_id' => 1,
            'size_id' => 1,
            'name' => 'Aircraft Test 1'
        ]);
    }
}
