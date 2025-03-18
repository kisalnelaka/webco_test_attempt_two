<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use App\Models\ProductType;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electronics',
                'description' => 'Devices and gadgets',
                'external_url' => null,
                'types' => ['Gadget', 'Smart Device'],
            ],
            [
                'name' => 'Clothing',
                'description' => 'Apparel and accessories',
                'external_url' => 'https://example.com/clothing',
                'types' => ['Wearable', 'Accessory'],
            ],
            [
                'name' => 'Furniture',
                'description' => 'Home and office furniture',
                'external_url' => null,
                'types' => ['Decor', 'Eco-Friendly'],
            ],
        ];

        foreach ($categories as $categoryData) {
            $category = ProductCategory::create([
                'name' => $categoryData['name'],
                'description' => $categoryData['description'],
                'external_url' => $categoryData['external_url'],
            ]);

            $typeNames = $categoryData['types'];
            $typeIds = ProductType::whereIn('name', $typeNames)->pluck('id');
            $category->productTypes()->attach($typeIds, [
                'type_assignments_type' => 'category_type',
                'my_bonus_field' => 'bonus_' . $category->id,
            ]);
        }
    }
}