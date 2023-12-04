<?php

namespace Database\Factories\Properties;

use App\Models\Users\User;
use App\Models\Categories\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'category_id'=>Category::all()->random()->id,
            'user_id'=>User::all()->random()->id,
        ];
    }
}
