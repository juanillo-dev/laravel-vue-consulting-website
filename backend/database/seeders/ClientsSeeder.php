<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientsSeeder extends Seeder
{
    public function run(): void
    {
        $clientsData = [
            [
                'email' => 'contacto@novatech.com',
                'name' => 'NovaTech Solutions',
                'phone' => '911234567',
                'address' => 'Calle Innovación 10, Madrid'
            ],
            [
                'email' => 'info@greenwave.com',
                'name' => 'GreenWave Ltd.',
                'phone' => '922345678',
                'address' => 'Avenida Verde 45, Barcelona'
            ],
            [
                'email' => 'ventas@innovalogistics.com',
                'name' => 'Innova Logistics',
                'phone' => '933456789',
                'address' => 'Calle de la Industria 12, Valencia'
            ],
            [
                'email' => 'contacto@techpioneers.com',
                'name' => 'TechPioneers S.A.',
                'phone' => '944567890',
                'address' => 'Calle del Futuro 8, Sevilla'
            ],
            [
                'email' => 'info@brightsolutions.com',
                'name' => 'Bright Solutions',
                'phone' => '955678901',
                'address' => 'Avenida Innovación 20, Bilbao'
            ]
        ];

        foreach ($clientsData as $client) {
            Client::updateOrInsert(
                ['email' => $client['email']], // evita duplicados
                [
                    'name' => $client['name'],
                    'phone' => $client['phone'],
                    'address' => $client['address']
                ]
            );
        }
    }
}
