<?php

namespace Database\Seeders;

use App\Enums\AircraftSize;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AircraftSizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            DB::table('aircraft_sizes')->insert($this->getDefaultSizes());
        });
    }

    private function getDefaultSizes(): array
    {
        $sizes = [];
        $now = now();
        foreach (AircraftSize::cases() as $size) {
            $sizes[] = [
                'name' => $size->value,
                'created_at' => $now,
                'updated_at' => $now
            ];
        }
        return $sizes;
    }
}
