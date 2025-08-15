<?php

namespace Database\Seeders;

use App\Enums\RoleType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function() {
            DB::table('roles')->insert($this->getTypes());
        });
    }

    private function getTypes(): array
    {
        $types = [];
        $now = now();
        foreach (RoleType::cases() as $type) {
            $types[] = [
                'name' => $type->value,
                'created_at' => $now,
                'updated_at' => $now
            ];
        }
        return $types;
    }
}
