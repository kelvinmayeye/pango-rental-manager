<?php

namespace Database\Factories\Tenants;

use App\Models\Tenants\Tenant;
use App\Models\Properties\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TenantPropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'property_id'=>Property::all()->random()->id,
            'tenant_id'=>Tenant::all()->random()->id,
        ];
    }
}
