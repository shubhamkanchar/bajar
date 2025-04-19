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
            [ 'type' => 'product', 'title' => 'Cement & Steel', 'order' => 1 ],
            [ 'type' => 'product', 'title' => 'RMC', 'order' => 2 ],
            [ 'type' => 'product', 'title' => 'Bricks & Blocks', 'order' => 3 ],
            [ 'type' => 'product', 'title' => 'Sand & Aggregates', 'order' => 4 ],
            [ 'type' => 'product', 'title' => 'Shuttering Material', 'order' => 5 ],
            [ 'type' => 'product', 'title' => 'Tiles & Granites', 'order' => 6 ],
            [ 'type' => 'product', 'title' => 'Paints and Coating', 'order' => 7 ],
            [ 'type' => 'product', 'title' => 'Plywood and Laminates', 'order' => 8 ],
            [ 'type' => 'product', 'title' => 'Furniture', 'order' => 9 ],
            [ 'type' => 'product', 'title' => 'Hardware & Fittings', 'order' => 10 ],
            [ 'type' => 'product', 'title' => 'Electrical Materials', 'order' => 11 ],
            [ 'type' => 'product', 'title' => 'Plumbing & Sanitary ware', 'order' => 12 ],
            [ 'type' => 'product', 'title' => 'Window & Doors', 'order' => 13 ],
            [ 'type' => 'product', 'title' => 'Roofing Materials', 'order' => 14 ],
            [ 'type' => 'product', 'title' => 'False ceiling Material', 'order' => 15 ],
            [ 'type' => 'product', 'title' => 'Paver Blocks & Curb stones', 'order' => 16 ],
            [ 'type' => 'product', 'title' => 'Garden & Landscape Materials', 'order' => 17 ],
            [ 'type' => 'product', 'title' => 'Solar Panel', 'order' => 18 ],
            [ 'type' => 'product', 'title' => 'Glass & Mirror', 'order' => 19 ],
            [ 'type' => 'product', 'title' => 'Admixture and Bonding agents', 'order' => 20 ],
            [ 'type' => 'product', 'title' => 'Waterproofing Chemicals', 'order' => 21 ],
            [ 'type' => 'product', 'title' => 'Security & Automation Equipment', 'order' => 22 ],
            [ 'type' => 'service', 'title' => 'Architects', 'order' => 1 ],
            [ 'type' => 'service', 'title' => 'Engineers', 'order' => 2 ],
            [ 'type' => 'service', 'title' => 'Interior Designers', 'order' => 3 ],
            [ 'type' => 'service', 'title' => 'MEP & Structural Consultants', 'order' => 4 ],
            [ 'type' => 'service', 'title' => 'Project Management Consultants', 'order' => 5 ],
            [ 'type' => 'service', 'title' => 'Landscape Consultant', 'order' => 6 ],
            [ 'type' => 'service', 'title' => 'Fire Safety Consultants', 'order' => 7 ],
            [ 'type' => 'service', 'title' => 'Land Survey & Soil Testing', 'order' => 8 ],
            [ 'type' => 'service', 'title' => 'Brickwork & Plaster Contractor', 'order' => 9 ],
            [ 'type' => 'service', 'title' => 'RCC Contractor', 'order' => 10 ],
            [ 'type' => 'service', 'title' => 'Electrical Contractors', 'order' => 11 ],
            [ 'type' => 'service', 'title' => 'Plumbers', 'order' => 12 ],
            [ 'type' => 'service', 'title' => 'False Ceiling and POP Work', 'order' => 13 ],
            [ 'type' => 'service', 'title' => 'Flooring and Tiling Agencies', 'order' => 14 ],
            [ 'type' => 'service', 'title' => 'Waterproofing Contractors', 'order' => 15 ],
            [ 'type' => 'service', 'title' => 'Painters', 'order' => 16 ],
            [ 'type' => 'service', 'title' => 'Fabricators', 'order' => 17 ],
            [ 'type' => 'service', 'title' => 'HVAC', 'order' => 18 ],
            [ 'type' => 'service', 'title' => 'Lift & Elevators Providers', 'order' => 19 ],
            [ 'type' => 'service', 'title' => 'Home Automation & Security System Experts', 'order' => 20 ],
            [ 'type' => 'service', 'title' => 'Renovation & Retrofitting Contractors', 'order' => 21 ],
            [ 'type' => 'service', 'title' => 'Cleaning & Building Maintainance', 'order' => 22 ],
            [ 'type' => 'service', 'title' => 'Laisoning & Documentation Services', 'order' => 23 ],
            [ 'type' => 'service', 'title' => 'Earth Movers', 'order' => 24 ],
            [ 'type' => 'service', 'title' => 'Transport', 'order' => 25 ]
        ];

        foreach($categories as $category){
            $query = Category::updateOrCreate($category,$category);
        }
    }
}
