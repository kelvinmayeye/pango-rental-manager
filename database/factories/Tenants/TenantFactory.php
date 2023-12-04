<?php

namespace Database\Factories\Tenants;

use Carbon\Carbon;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TenantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = Carbon::create(1940, 1, 1); 
        $endDate = Carbon::create(2005, 10, 31); 
        return [
            'first_name' => fake()->name(),
            'last_name' => fake()->name(),
            'sex' => $this->faker->randomElement(['male', 'female']),
            'birth_date' => $this->faker->dateTimeBetween($startDate, $endDate),
            'email' => fake()->unique()->safeEmail(),
            'phone_number' => fake()->unique()->e164PhoneNumber(),
            'occupation' => fake()->jobTitle,
            'user_id'=>User::all()->random()->id,

        ];
    }
}
