<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = ['XL', 'XXL', 'L', 'M', 'SM'];
        foreach ($sizes as $size) {
            Size::create([
                'name' => $size,
                'slug' => $size
            ]);
        }
    }
}
