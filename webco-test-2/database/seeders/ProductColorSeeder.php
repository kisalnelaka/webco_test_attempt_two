<?php

namespace Database\Seeders;

use App\Models\ProductColor;
use Illuminate\Database\Seeder;

class ProductColorSeeder extends Seeder
{
    public function run(): void
    {
        $colors = [
            [
                'name' => 'Red',
                'description' => 'A vibrant red shade',
                'hex_code' => '#FF0000',
            ],
            [
                'name' => 'Blue',
                'description' => 'A deep blue tone',
                'hex_code' => '#0000FF',
            ],
            [
                'name' => 'Green',
                'description' => 'A fresh green color',
                'hex_code' => '#00FF00',
            ],
            [
                'name' => 'Black',
                'description' => 'A classic black',
                'hex_code' => '#000000',
            ],
            [
                'name' => 'Silver',
                'description' => 'A metallic silver',
                'hex_code' => '#C0C0C0',
            ],
        ];

        foreach ($colors as $color) {
            ProductColor::create($color);
        }
    }
}