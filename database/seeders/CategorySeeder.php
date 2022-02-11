<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Jeans', 'Shirts', 'Pants', 'Blazers', 'Shoes', 'Jackets'];
        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'slug' => $category,
                'image' => 'storage/category/default.jpg'
            ]);
        }
    }
}
