<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceImage>
 */
class ServiceImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imageUrl = 'http://picsum.photos/640/480';

        // Create a unique filename
        $filename = 'product_' . Str::random(10) . '.jpg';

        // Download and store the image
        $imageContents = Http::withoutVerifying()->get($imageUrl)->body();
        Storage::disk('public')->put('products/' . $filename, $imageContents);

        return [
            'service_id' => rand(1, 10), // This will be set dynamically
            'order' => rand(1, 6),
            'path' => 'products/' . $filename, // Store the correct image path
        ];
    }
}
