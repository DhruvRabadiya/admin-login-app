<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'parent_id' => null,
                'category_name' => 'Electronics',
                
                'description' => 'This category includes electronics items.',
                'url' => 'electronics',
                
                'status' => 1,
            ],
            [
                'parent_id' => 1,
                'category_name' => 'Mobile Phones',
               
                'description' => 'Browse through our latest collection of mobile phones.',
                'url' => 'mobile-phones',
                
                'status' => 1,
            ],
            [
                'parent_id' => 1,
                'category_name' => 'Laptops',
                'description' => 'Find the perfect laptop for your needs.',
                'url' => 'laptops',
                'status' => 1,
            ],
            [
                'parent_id' => null,
                'category_name' => 'Clothing',

                'description' => 'Explore a wide range of clothing options.',
                'url' => 'clothing',

                'status' => 1,
            ],
            [
                'parent_id' => 4,
                'category_name' => 'Men\'s Clothing',

                'description' => 'Shop for the latest trends in men\'s clothing.',
                'url' => 'mens-clothing',

                'status' => 1,
            ],
            [
                'parent_id' => 4,
                'category_name' => 'Women\'s Clothing',

                'description' => 'Discover a wide range of women\'s clothing options.',
                'url' => 'womens-clothing',

                'status' => 1,
            ],
        ];

        Category::insert($categories);
    }
}
