<?php

namespace Database\Seeders;

use App\Enums\AircraftType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AircraftTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            DB::table('aircraft_types')->insert($this->getDefaultTypes());
        });
    }

    private function getDefaultTypes(): array
    {
        $types = [];
        $now = now();
        foreach (AircraftType::cases() as $type) {
            $types[] = [
                'name' => $type->value,
                'created_at' => $now,
                'updated_at' => $now
            ];
        }
        return $types;
    }
}
