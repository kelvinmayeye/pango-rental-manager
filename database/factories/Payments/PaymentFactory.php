<?php

namespace Database\Factories\Payments;

use App\Models\Leases\Lease;
use App\Models\Tenants\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => $this->faker->randomElement([180000,360000,540000,200000,70000,90000,500000,50000,700000]),
            'tenant_id'=>Tenant::all()->random()->id,
            'lease_id'=>Lease::all()->random()->id,
        ];
    }
}
