<?php

namespace Database\Factories;

use App\Models\Category;
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
        return [
            'category_id' => Category::factory(),
            'name' => fake()->name(),
            'description' => fake()->sentence(),
            'status' => fake()->boolean(50),
            'price' => fake()->randomFloat(2, 199, 9999),
            'thumbnail' => fake()->imageUrl(500, 500, null, null, null, null, 'png'),
        ];
    }
}
