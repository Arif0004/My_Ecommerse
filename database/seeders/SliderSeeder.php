<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sliders = ['Title One', 'Title Two', 'Title Three'];
        $contents = ['No dolore ipsum accusam no lorem.', 'No dolore ipsum accusam no lorem.', 'No dolore ipsum accusam no lorem. Three'];
        foreach ($sliders as $key => $slider) {
            Slider::create([
                'title' => $slider,
                'content' => $contents[$key],
                'image' => 'storage/Slider/slider.jpg'
            ]);
        }
    }
}
