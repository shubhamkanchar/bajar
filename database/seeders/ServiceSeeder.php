<?php

namespace Database\Seeders;

use App\Models\ProductImage;
use App\Models\Service;
use App\Models\ServiceImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::factory(10)->create()->each(function ($product) {
            foreach (range(1, 6) as $order) {
                ServiceImage::factory()->create([
                    'service_id' => $product->id,
                    'order' => $order,
                ]);
            }
        });
    }
}
