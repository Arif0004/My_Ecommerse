<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Mens Jeans', 'Mens Shirts', 'Mens Pants', 'Mens Blazers', 'Mens Shoes', 'Mens Jackets', 'Women Jeans', 'Women Shirts', 'Women Pants', 'Women Blazers', 'Women Shoes', 'Women Jackets'];
        foreach ($categories as $category) {
            SubCategory::create([
                'category_id' => rand(1, 6),
                'name' => $category,
                'slug' => $category
            ]);
        }
    }
}
