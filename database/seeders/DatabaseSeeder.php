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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
         User::insert([
             'first_name' => fake()->name(),
             'last_name' => fake()->name(),
             'email' => "user@test.com",
             'phone_number' => 225672995073,
             'role' => 'admin',
             'email_verified_at' => now(),
             'password' => Hash::make('123'),//default password
             'remember_token' => Str::random(10),
             'created_at' => now(),
             'updated_at' => now()
         ]);

         $categories = ['residence house','plot','go-down','vehicle','motor-bike'];
         $properties = ['Howo Truck','Block E','Super Market','Land Cruiser Gx','Bajaj 150cc'];
         $i = 0;
         foreach($categories as $category){
            Category::insert([
                 'name' => $category,
                'created_at' => now(),
                'updated_at' => now()
             ]);
             Property::insert([
                 'name' => $properties[$i++],
                 'category_id'=>$i,
                 'user_id'=>1,
                 'created_at' => now(),
                 'updated_at' => now()
             ]);
         }

         DB::table('statuses')->insert(['name'=>'active','created_at'=>now(),'updated_at'=>now()]);
         DB::table('statuses')->insert(['name'=>'inactive','created_at'=>now(),'updated_at'=>now()]);

    }
}
