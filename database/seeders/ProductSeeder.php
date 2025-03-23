<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Product::factory(100)->create()->each(function ($product) {
            // Ensure exactly 6 images per product
            foreach (range(1, 6) as $order) {
                ProductImage::factory()->create([
                    'product_id' => $product->id,
                    'order' => $order,
                ]);
            }
        });
    }
}
