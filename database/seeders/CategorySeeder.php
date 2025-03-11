<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'type' => 'product',
                'title' => 'Cement & Steel'
            ],
            [
                'type' => 'product',
                'title' => 'Bricks'
            ],
            [
                'type' => 'product',
                'title' => 'Tiles & Granites'
            ],
            [
                'type' => 'product',
                'title' => 'Plumbing Materials'
            ],
            [
                'type' => 'product',
                'title' => 'Electrical Materials'
            ],
            [
                'type' => 'product',
                'title' => 'Ply & Laminates'
            ],
            [
                'type' => 'product',
                'title' => 'Hardware'
            ],
            [
                'type' => 'product',
                'title' => 'Paints'
            ],
            [
                'type' => 'product',
                'title' => 'Fabrication Material'
            ],
            [
                'type' => 'product',
                'title' => 'Furniture'
            ],
            [
                'type' => 'service',
                'title' => 'Architect'
            ],
            [
                'type' => 'service',
                'title' => 'Civil Engineer'
            ],
            [
                'type' => 'service',
                'title' => 'Fabricator'
            ],
            [
                'type' => 'service',
                'title' => 'Plumber'
            ],
            [
                'type' => 'service',
                'title' => 'Electrician'
            ],
            [
                'type' => 'service',
                'title' => 'Interior Designer'
            ],
            [
                'type' => 'service',
                'title' => 'Carpenter'
            ],
            [
                'type' => 'service',
                'title' => 'Painter'
            ],
            [
                'type' => 'service',
                'title' => 'Brickwork Contractor'
            ],
            [
                'type' => 'service',
                'title' => 'RCC Contractor'
            ],
            [
                'type' => 'service',
                'title' => 'Tiles Contractor'
            ],
            [
                'type' => 'service',
                'title' => 'Earth Movers'
            ]
        ];

        foreach($categories as $category){
            $query = Category::updateOrCreate($category,$category);
        }
    }
}
