<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AircraftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            DB::table('aircrafts')->insert($this->getAircrafts());
        });
    }

    private function getAircrafts(): array
    {
        $now = now();
        return [
            [
                'type_id' => 1,
                'size_id' => 1,
                'name' => 'Aircraft Test 1',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'type_id' => 2,
                'size_id' => 2,
                'name' => 'Aircraft Test 2',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'type_id' => 2,
                'size_id' => 1,
                'name' => 'Aircraft Test 3',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ];
    }
}
