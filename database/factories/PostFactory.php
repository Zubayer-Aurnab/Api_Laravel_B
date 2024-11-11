<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $var = fake()->title();
        return [
            'categories_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'title' => $var,
            'slug' => Str::slug($var) . '-' . Str::random(5),
            'photo' => fake()->url(),
            'content' => fake()->paragraph(30)
        ];
    }
}
