<?php

namespace Database\Seeders;

use App\Models\ProductType;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['name' => 'Gadget', 'api_unique_number' => 'GAD123'],
            ['name' => 'Wearable', 'api_unique_number' => 'WEA456'],
            ['name' => 'Smart Device', 'api_unique_number' => 'SMD789'],
            ['name' => 'Accessory', 'api_unique_number' => 'ACC012'],
            ['name' => 'Decor', 'api_unique_number' => null],
            ['name' => 'Eco-Friendly', 'api_unique_number' => 'ECO345'],
        ];

        foreach ($types as $type) {
            ProductType::create($type);
        }
    }
}