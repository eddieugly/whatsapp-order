<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Blogcategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->sentence(1);

        return [
            'blogcategory_id' => Blogcategory::factory(),
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => fake()->paragraphs(5, true),
            'status' => fake()->boolean(50),
            'featured' => fake()->boolean(50),
            'slider' => fake()->boolean(50),
            'thumbnail' => fake()->imageUrl(500, 500, null, null, null, null, 'png'),
        ];
    }
}
