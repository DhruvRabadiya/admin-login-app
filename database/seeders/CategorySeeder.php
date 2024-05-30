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
                'parent_id' => 0,
                'category_name' => 'Electronics',
                'category_image' => 'electronics.jpg',
                'category_discount' => 10.5,
                'description' => 'This category includes electronics items.',
                'url' => 'electronics',
                'meta_title' => 'Electronics - Best Deals',
                'meta_description' => 'Explore the best deals on electronics items.',
                'meta_keyword' => 'electronics, deals',
                'status' => 1,
            ],
            [
                'parent_id' => 1,
                'category_name' => 'Mobile Phones',
                'category_image' => 'mobiles.jpg',
                'category_discount' => 8.5,
                'description' => 'Browse through our latest collection of mobile phones.',
                'url' => 'mobile-phones',
                'meta_title' => 'Mobile Phones - Buy Online',
                'meta_description' => 'Buy the latest mobile phones online at discounted prices.',
                'meta_keyword' => 'mobile phones, smartphones',
                'status' => 1,
            ],
            [
                'parent_id' => 1,
                'category_name' => 'Laptops',
                'category_image' => 'laptops.jpg',
                'category_discount' => 12.5,
                'description' => 'Find the perfect laptop for your needs.',
                'url' => 'laptops',
                'meta_title' => 'Laptops - Top Brands',
                'meta_description' => 'Discover top brands and latest models of laptops.',
                'meta_keyword' => 'laptops, notebooks',
                'status' => 1,
            ],
            [
                'parent_id' => 0,
                'category_name' => 'Clothing',
                'category_image' => 'clothing.jpg',
                'category_discount' => 15,
                'description' => 'Explore a wide range of clothing options.',
                'url' => 'clothing',
                'meta_title' => 'Clothing - Fashion Trends',
                'meta_description' => 'Stay trendy with our latest collection of clothing.',
                'meta_keyword' => 'clothing, fashion',
                'status' => 1,
            ],
            [
                'parent_id' => 4,
                'category_name' => 'Men\'s Clothing',
                'category_image' => 'mens_clothing.jpg',
                'category_discount' => 18,
                'description' => 'Shop for the latest trends in men\'s clothing.',
                'url' => 'mens-clothing',
                'meta_title' => 'Men\'s Clothing - Stylish Fashion',
                'meta_description' => 'Find stylish fashion for men at great prices.',
                'meta_keyword' => 'men\'s clothing, fashion',
                'status' => 1,
            ],
            [
                'parent_id' => 4,
                'category_name' => 'Women\'s Clothing',
                'category_image' => 'womens_clothing.jpg',
                'category_discount' => 20,
                'description' => 'Discover a wide range of women\'s clothing options.',
                'url' => 'womens-clothing',
                'meta_title' => 'Women\'s Clothing - Latest Trends',
                'meta_description' => 'Stay in style with our latest collection of women\'s clothing.',
                'meta_keyword' => 'women\'s clothing, fashion',
                'status' => 1,
            ],
        ];

        Category::insert($categories);
    }
}
