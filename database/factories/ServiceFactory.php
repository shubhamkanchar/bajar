<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'work_brief' => $this->faker->company,
            'description' => $this->faker->sentence,
            'category_id' => rand(1, 10), // Adjust as needed
            'service_tag_group_id' => rand(1, 5), // Adjust as needed
            'user_id' => 1, // Default user
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'), // Random date within the past year
            'updated_at' => now(),
        ];
    }
}
