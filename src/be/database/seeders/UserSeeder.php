<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('ZeloTezkoGeslo123'),
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
