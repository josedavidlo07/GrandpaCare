<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DoctorPatientSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'doctor1@gmail.com'],
            ['name' => 'Dr. Juan', 'password' => Hash::make('password'), 'role' => 'doctor']
        );

        User::firstOrCreate(
            ['email' => 'paciente1@gmail.com'],
            ['name' => 'Jhon Jairo', 'password' => Hash::make('password'), 'role' => 'paciente']
        );
    }
}
