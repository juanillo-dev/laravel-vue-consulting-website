<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'ERP Empresarial',
                'description' => 'Sistema integral de gestión empresarial',
                'price' => 2500.00
            ],
            [
                'name' => 'Módulo CRM',
                'description' => 'Gestión de clientes y ventas',
                'price' => 1200.00
            ],
            [
                'name' => 'Consultoría IT',
                'description' => 'Asesoramiento y soporte técnico profesional',
                'price' => 80.00
            ]
        ];

        foreach ($products as $product) {
            Product::updateOrInsert(
                ['name' => $product['name']],
                $product
            );
        }
    }
}
