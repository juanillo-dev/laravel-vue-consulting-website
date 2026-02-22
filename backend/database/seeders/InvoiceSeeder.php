<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Invoice;

class InvoiceSeeder extends Seeder
{
    public function run(): void
    {
        $invoicesData = [
            [
                'id' => 1,
                'client_id' => 1,
                'user_id' => 1, // Juan crea la factura
                'total' => 3700.00,
                'products' => [1, 2] // ERP + CRM
            ],
            [
                'id' => 2,
                'client_id' => 2,
                'user_id' => 2, // Salvi crea la factura
                'total' => 800.00,
                'products' => [3] // Consultoría IT
            ],
            [
                'id' => 3,
                'client_id' => 3,
                'user_id' => 1,
                'total' => 1400.00,
                'products' => [2, 3] // CRM + Consultoría IT
            ]
        ];

        foreach ($invoicesData as $data) {
            $invoice = Invoice::updateOrCreate(
                ['id' => $data['id']], // Evita duplicados por ID
                [
                    'client_id' => $data['client_id'],
                    'user_id' => $data['user_id'],
                    'total' => $data['total']
                ]
            );

            // Asociar productos a la factura sin romper relaciones existentes
            $invoice->products()->syncWithoutDetaching($data['products']);
        }
    }
}
