<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Users\User;
use App\Models\Leases\Lease;
use App\Models\Tenants\Tenant;
use Illuminate\Database\Seeder;
use App\Models\Payments\Payment;
use Illuminate\Support\Facades\DB;
use App\Models\Categories\Category;
use App\Models\Properties\Property;
use App\Models\Tenants\TenantProperty;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(10)->create();
         Category::factory(5)->create();
         Property::factory(10)->create();
         Tenant::factory(20)->create();
         TenantProperty::factory(10)->create();
         $statuses = [
            ['name' => 'not paid'],
            ['name' => 'paid'],
            ['name' => 'expired'],
        ];
        DB::table('statuses')->insert($statuses);
        Lease::factory(20)->create();
        Payment::factory(40)->create();

    }
}
