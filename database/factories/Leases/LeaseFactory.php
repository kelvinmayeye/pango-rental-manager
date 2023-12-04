<?php

namespace Database\Factories\Leases;

use Carbon\Carbon;
use App\Models\Properties\Property;
use App\Models\Tenants\TenantProperty;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class LeaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = Carbon::create(2021, 1, 1); 
        $endDate = Carbon::create(2023, 12, 31); 
        return [
            'tenant_property_id'=>TenantProperty::all()->random()->id,
            'start_date' => $this->faker->dateTimeBetween($startDate, $endDate),
            'end_date' => $this->faker->dateTimeBetween($startDate, $endDate),
            'monthly_rate' => $this->faker->randomElement([30000,60000,90000,100000]),
            'status_id' => $this->faker->randomElement([1,2,3]),
        ];
    }
}
