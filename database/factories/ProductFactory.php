<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->words(5, true);
        $slug = Str::slug($title);
        return [
            'slug' => $slug,
            'title' => $title,
            'description' => $this->faker->paragraphs(4, true),
            'price' => $this->faker->randomFloat(6,0,999999),
            'category_id' => Category::whereIsLeaf()->inRandomOrder()->first()->id
        ];
    }
}
