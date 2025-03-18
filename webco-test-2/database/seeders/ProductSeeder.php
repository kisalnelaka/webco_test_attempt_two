<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductColor;
use App\Models\ProductType;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Smartphone',
                'product_category_id' => 1, // Electronics
                'product_color_id' => 1,   // Red
                'description' => 'Latest model smartphone',
            ],
            [
                'name' => 'T-Shirt',
                'product_category_id' => 2, // Clothing
                'product_color_id' => 3,   // Green
                'description' => 'Comfortable cotton t-shirt',
            ],
            [
                'name' => 'Laptop',
                'product_category_id' => 1, // Electronics
                'product_color_id' => 5,   // Silver
                'description' => 'High-performance laptop',
            ],
            [
                'name' => 'Sofa',
                'product_category_id' => 3, // Furniture
                'product_color_id' => 4,   // Black
                'description' => 'Comfortable living room sofa',
            ],
        ];

        foreach ($products as $productData) {
            $product = Product::create($productData);

            // Assign types based on category
            $category = ProductCategory::find($productData['product_category_id']);
            $validTypeIds = $category->productTypes->pluck('id');
            $product->productTypes()->attach($validTypeIds, [
                'type_assignments_type' => 'product_type',
                'my_bonus_field' => 'bonus_' . $product->id,
                'type_assignments_id' => $product->id,
            ]);
        }
    }
}