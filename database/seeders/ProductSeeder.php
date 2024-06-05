<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'category_id' => 1,
                'subcategory_id' => 2,
                'product_name' => 'iPhone 13',
                'image' => 'iphone_13.jpg',
                'status' => 1,
            ],
            [
                'category_id' => 1,
                'subcategory_id' => 3,
                'product_name' => 'MacBook Pro',
                'image' => 'macbook_pro.jpg',
                'status' => 1,
            ],
            [
                'category_id' => 4,
                'subcategory_id' => 5,
                'product_name' => 'Men\'s T-Shirt',
                'image' => 'mens_tshirt.jpg',
                'status' => 1,
            ],
            [
                'category_id' => 4,
                'subcategory_id' => 6,
                'product_name' => 'Women\'s Dress',
                'image' => 'womens_dress.jpg',
                'status' => 1,
            ],
        ];

        Product::insert($products);
    }
}
