<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Joseph Adan',
            'email' => 'admin@psicoinfantes.com',
            'password' => Hash::make('admin1234'), // Cambia esta clave luego
            'role' => 'gerente',
        ]);
    }
}