<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = ['Red', 'Green', 'Purple', 'Orange', 'Pink'];
        foreach ($colors as $color) {
            Color::create([
                'name' => $color,
                'slug' => $color
            ]);
        }
    }
}
