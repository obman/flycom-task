<?php

namespace Database\Seeders;

use App\Models\Aircraft;
use App\Models\Equipment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AircraftEquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function() {
            DB::table('equipment_aircraft')->insert($this->getAircraftEquipment());
        });
    }

    private function getAircraftEquipment(): array
    {
        $sets = [];
        $now = now();
        $aircrafts = Aircraft::all();
        $equipment = Equipment::all();
        foreach ($aircrafts as $aircraft) {
            foreach ($equipment as $unit) {
                $sets[] = [
                    'aircraft_id' => $aircraft->id,
                    'equipment_id' => $unit->id,
                    'created_at' => $now,
                    'updated_at' => $now
                ];
            }
        }
        return $sets;
    }
}
