<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->word();

        return [
            'category_id' => Category::factory(),
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->paragraphs(5, true),
            'price' => random_int(100, 9000),
            'status' => fake()->boolean(50),
            'featured' => fake()->boolean(50),
            'slider' => fake()->boolean(50),
            'thumbnail' => fake()->imageUrl(500, 500, null, null, null, null, 'png'),
        ];
    }
}
