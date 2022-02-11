<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->title,
            'slug' =>  $this->faker->title,
            'category_id' => rand(1, 5),
            'sub_cat_id' => rand(1, 5),
            'color_id' => rand(1, 5),
            'size_id' => rand(1, 5),
            'quantity' => rand(30, 50),
            'short_des' => $this->faker->text,
            'long_des' => $this->faker->text,
        ];
    }
}
