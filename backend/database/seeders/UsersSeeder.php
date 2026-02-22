<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        // Empleados reales de LynxOS Consulting (sin duplicados)
        User::updateOrInsert(
            ['email' => 'juan@lynxos.com'],
            ['name' => 'Juan Leiva', 'password' => bcrypt('Admin123'), 'role' => 'admin']
        );

        User::updateOrInsert(
            ['email' => 'salvi@lynxos.com'],
            ['name' => 'Salvi Aguilar', 'password' => bcrypt('Empleado123'), 'role' => 'empleado']
        );
    }
}
