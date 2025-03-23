<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;
    
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'brand_name' => $this->faker->company,
            'description' => $this->faker->sentence,
            'category_id' => rand(1, 10), // Adjust as needed
            'show_price' => rand(0, 1),
            'product_tag_group_id' => rand(1, 5), // Adjust as needed
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'quantity' => rand(1, 50),
            'user_id' => 1, // Default user
            'business_id' => 1,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'), // Random date within the past year
            'updated_at' => now(),
        ];        
    }
}
