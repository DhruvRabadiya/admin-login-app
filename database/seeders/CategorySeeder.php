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

                'status' => 1,
            ],
            [
                'parent_id' => 1,
                'category_name' => 'Mobile Phones',

                'status' => 1,
            ],
            [
                'parent_id' => 1,
                'category_name' => 'Laptops',
                'status' => 1,
            ],
            [
                'parent_id' => null,
                'category_name' => 'Clothing',
                'status' => 1,
            ],
            [
                'parent_id' => 4,
                'category_name' => 'Men\'s Clothing',

                'status' => 1,
            ],
            [
                'parent_id' => 4,
                'category_name' => 'Women\'s Clothing',

                'status' => 1,
            ],
        ];

        Category::insert($categories);
    }
}
