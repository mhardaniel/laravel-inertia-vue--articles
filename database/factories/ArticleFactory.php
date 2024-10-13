<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image' => fake()->imageUrl(),
            'title' => fake()->unique()->sentence(4),
            'link' => fake()->url(),
            'date' => fake()->date(),
            'content' => fake()->text(),
            'status' => fake()->randomElement(['for-edit', 'published']),
            'writer' => User::factory(),
            'editor' => null,
            'company' => Company::factory(),
        ];
    }
}
